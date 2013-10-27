package com.example.filafacil.controllers;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import com.example.filafacil.R;
import com.example.filafacil.controllers.RegisterControl.AsyncTaskRunnable;
import com.example.filafacil.helpers.Converter;
import com.example.filafacil.helpers.ValuesManager;
import com.example.filafacil.view.MainActivity;

import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

public class BoardControl {
	
	//public static final String URL = "filafacil.herokuapp.com/";
	public static final String PARAMS_ACTUAL = "services.php?q=board_status";
	public static final String PARAMS_QUEUE = "services.php?q=remaining_turns";
	public static final String PARAMS_PUSH = "services.php?q=device_message";
	public static final String ACTUAL_KEY = "actual_";
	public static final String QUEUE_KEY = "remaining_";
	private MainActivity mainActivity;
	private String answer;
	private Context context;
	private boolean needsAnswer;
	
	public BoardControl (Context context) {
		this.context = context;
	}
	
	public String post(MainActivity mainActivity) {
		this.mainActivity = mainActivity;
		needsAnswer = true;
		String url = mainActivity.getResources().getString(R.string.url);
		new AsyncTaskRunnable().execute(url + PARAMS_ACTUAL);
		return null;
	}
	
	public String post(MainActivity mainActivity, String regId, String requested) {
		this.mainActivity = mainActivity;
		needsAnswer = false;
		String url = mainActivity.getResources().getString(R.string.url);
		url += PARAMS_PUSH;
		url += "&params=";
		JSONObject jSON = new JSONObject();
		try {
			jSON.put("regId", regId);
			jSON.put("requested", requested);
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
				Log.e("Error", e.getMessage());
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			if (needsAnswer) {
				processAnswerActual(answer);
				String url = mainActivity.getResources().getString(R.string.url);
				new AsyncTaskRunnableRemaining().execute(url + PARAMS_QUEUE);
			}
		}
	}
	
	class AsyncTaskRunnableRemaining extends AsyncTask<String, Float, Integer>{
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
				Log.e("Error", e.getMessage());
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			/*try {
				JSONObject respJSON = new JSONObject(answer);
				
				String key0 = mainActivity.getResources()
						.getString(R.string.admisiones);
				String key1 = mainActivity.getResources()
						.getString(R.string.cartera);
				String key2 = mainActivity.getResources()
						.getString(R.string.caja);
				String key3 = mainActivity.getResources()
						.getString(R.string.certificados);
				
				String nAdmisiones = String.valueOf(respJSON
						.getLong(key0.toLowerCase()));
				String nCartera = String.valueOf(respJSON
						.getLong(key1.toLowerCase()));
				String nCaja = String.valueOf(respJSON
						.getLong(key2.toLowerCase()));
				String nCertificados = String.valueOf(respJSON
						.getLong(key3.toLowerCase()));
				
				mainActivity.getValores().putTurno(QUEUE_KEY + key0.toLowerCase(),
						nAdmisiones);
				mainActivity.getValores().putTurno(QUEUE_KEY + key1.toLowerCase(),
						nCartera);
				mainActivity.getValores().putTurno(QUEUE_KEY + key2.toLowerCase(),
						nCaja);
				mainActivity.getValores().putTurno(QUEUE_KEY + key3.toLowerCase(),
						nCertificados);
				
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}*/
			processAnswerRemaining(answer);
		}
	}
	
	public void processAnswerActual(String answer) {
		try {
			Log.d("CONSOLA", "proessAnswerActual answer: " + answer);
			JSONObject respJSON = new JSONObject(answer);
		
			String key0, key1, key2, key3;
			if (context != null) {
				key0 = context.getResources()
						.getString(R.string.admisiones);
				key1 = context.getResources()
						.getString(R.string.cartera);
				key2 = context.getResources()
						.getString(R.string.caja);
				key3 = context.getResources()
						.getString(R.string.certificados);
			}
			else if (mainActivity != null) {
				key0 = mainActivity.getResources()
						.getString(R.string.admisiones);
				key1 = mainActivity.getResources()
						.getString(R.string.cartera);
				key2 = mainActivity.getResources()
						.getString(R.string.caja);
				key3 = mainActivity.getResources()
						.getString(R.string.certificados);
			}
			else {
				Log.d("CONSOLA", "Error processAnswerActual: No hay instan" +
						"cia de context ni mainActivity");
				return;
			}
			
			String nAdmisiones = String.valueOf(respJSON
					.getLong(key0.toLowerCase()));
			String nCartera = String.valueOf(respJSON
					.getLong(key1.toLowerCase()));
			String nCaja = String.valueOf(respJSON
					.getLong(key2.toLowerCase()));
			String nCertificados = String.valueOf(respJSON
					.getLong(key3.toLowerCase()));
			
			ValuesManager valores;
			if (context != null) {
				valores = new ValuesManager(context);
			}
			else {
				valores = mainActivity.getValores();
			}
			valores.putTurno(ACTUAL_KEY + key0.toLowerCase(),
					nAdmisiones);
			valores.putTurno(ACTUAL_KEY + key1.toLowerCase(),
					nCartera);
			valores.putTurno(ACTUAL_KEY + key2.toLowerCase(),
					nCaja);
			valores.putTurno(ACTUAL_KEY + key3.toLowerCase(),
					nCertificados);
		} catch (JSONException e) {
			Log.d("CONSOLA", "Error en processAnswerActual: " + e.getMessage());
		}
	}
	
	public void processAnswerRemaining(String answer) {
		try {
			JSONObject respJSON = new JSONObject(answer);
			
			String key0, key1, key2, key3;
			if (context != null) {
				key0 = context.getResources()
						.getString(R.string.admisiones);
				key1 = context.getResources()
						.getString(R.string.cartera);
				key2 = context.getResources()
						.getString(R.string.caja);
				key3 = context.getResources()
						.getString(R.string.certificados);
			}
			else if (mainActivity != null) {
				key0 = mainActivity.getResources()
						.getString(R.string.admisiones);
				key1 = mainActivity.getResources()
						.getString(R.string.cartera);
				key2 = mainActivity.getResources()
						.getString(R.string.caja);
				key3 = mainActivity.getResources()
						.getString(R.string.certificados);
			}
			else {
				Log.d("CONSOLA", "Error processAnswerRemaining: No hay instan" +
						"cia de context ni mainActivity");
				return;
			}
			
			String nAdmisiones = String.valueOf(respJSON
					.getLong(key0.toLowerCase()));
			String nCartera = String.valueOf(respJSON
					.getLong(key1.toLowerCase()));
			String nCaja = String.valueOf(respJSON
					.getLong(key2.toLowerCase()));
			String nCertificados = String.valueOf(respJSON
					.getLong(key3.toLowerCase()));
			
			ValuesManager valores;
			if (context != null) {
				valores = new ValuesManager(context);
			}
			else {
				valores = mainActivity.getValores();
			}
			valores.putTurno(QUEUE_KEY + key0.toLowerCase(),
					nAdmisiones);
			valores.putTurno(QUEUE_KEY + key1.toLowerCase(),
					nCartera);
			valores.putTurno(QUEUE_KEY + key2.toLowerCase(),
					nCaja);
			valores.putTurno(QUEUE_KEY + key3.toLowerCase(),
					nCertificados);

			
		} catch (JSONException e) {
			e.printStackTrace();
			Log.d("CONSOLA","Error en processAnswerRemaining: "+e.getMessage());
		}
	}
}
