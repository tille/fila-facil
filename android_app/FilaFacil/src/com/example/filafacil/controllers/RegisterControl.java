package com.example.filafacil.controllers;

import java.io.IOException;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Map.Entry;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import com.example.filafacil.R;
import com.example.filafacil.helpers.Converter;
import com.example.filafacil.helpers.ValuesManager;
import com.example.filafacil.view.HomeActivity;

import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

public class RegisterControl {
	
	public static final String USER_REGISTERED = "1";
	public static final String PARAMS = "services.php?q=register&params=";
	private HomeActivity homeActivity;
	private String lastName;
	private String name;
	private String identification;
	private String email;
	private String password;
	private boolean eafitStudent;
	private String answer;
	private boolean device;

	public String post(HomeActivity homeActivity, String lastName, String name,
			String identification, String email, String password,
			boolean eafitStudent) {
		this.device = false; //No estoy registrando llave de dispositivo
		
		this.homeActivity = homeActivity;
		this.lastName = lastName;
		this.name = name;
		this.identification = identification;
		this.email = email;
		this.password = password;
		this.eafitStudent = eafitStudent;
		
		JSONObject jsonRegister = new JSONObject();
		  
        try {
	        jsonRegister.put(homeActivity.getResources()
	        		.getString(R.string.param_identification), identification);
	        jsonRegister.put(homeActivity.getResources()
					.getString(R.string.param_lastname), lastName);
	        jsonRegister.put(homeActivity.getResources()
					.getString(R.string.param_name), name);
	        jsonRegister.put(homeActivity.getResources()
					.getString(R.string.param_password), password);
	        jsonRegister.put(homeActivity.getResources()
					.getString(R.string.param_eafit_student), eafitStudent);
	        jsonRegister.put(homeActivity.getResources()
					.getString(R.string.param_rol), homeActivity.getResources()
					.getString(R.string.param_usuario));
	        jsonRegister.put(homeActivity.getResources()
					.getString(R.string.param_email), email);
        } catch (JSONException e) {
        	e.printStackTrace();
        }
        String url = homeActivity.getResources().getString(R.string.url);
		url += PARAMS + jsonRegister.toString();
		try {
			url = Converter.toUri(url);
		}
		catch (Exception ex) {
			Log.d("Error", "Error: " + ex.getMessage());
		}
		new AsyncTaskRunnable().execute(url);
		return null;
	}
	
	public String post (String regId, Context c) {
		this.device = true;
		
		ValuesManager values = new ValuesManager(c);
		values.putString(ValuesManager.DEVICE_KEY_TAG, regId);
		String identification = values.getIdentification();
		String url = "http://10.0.2.2/fila-facil/services.php?q=register_device";
		url += "&params=";
		JSONObject jSON = new JSONObject();
		try {
			jSON.put("identification", identification);
			jSON.put("regId", regId);
		} catch (JSONException e) {
			e.printStackTrace();
		}
		url += jSON.toString();
        Log.d("CONSOLA", "Posteando: " + url);
        try {
			url = Converter.toUri(url);
		}
		catch (Exception ex) {
			Log.d("Error", "Error: " + ex.getMessage());
		}
		new AsyncTaskRunnable().execute(url);
		return null;
	}
	
	class AsyncTaskRunnable extends AsyncTask<String, Float, Integer>{
		protected synchronized Integer doInBackground(String...urls) {
			try{
				HttpClient httpClient = new DefaultHttpClient();
				HttpPost httpPost = new HttpPost(urls[0]);
				HttpResponse resp = httpClient.execute(httpPost);
				HttpEntity ent = resp.getEntity();
				answer = EntityUtils.toString(ent);
				return 1;
			
			}
			catch(Exception e) {
				Log.d("CONSOLA", "Error AsyncTask: " + e.getMessage());
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			if (!device) {
				if (answer != null && answer.equals(USER_REGISTERED)) {
					InputDataControl input = new InputDataControl(lastName, 
							name, identification, email, password, password, 
							eafitStudent);
					
					homeActivity.getValores().putPerfil(input);
				}
				homeActivity.responderRegister(answer);
			}
		}
	}
}
