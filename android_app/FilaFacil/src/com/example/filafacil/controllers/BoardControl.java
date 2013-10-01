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
import com.example.filafacil.view.MainActivity;
import android.os.AsyncTask;
import android.util.Log;

public class BoardControl {
	
	public static final String PARAMS = "services.php?q=board_status";
	public static final String ADD_KEY = "actual_";
	private MainActivity mainActivity;
	private String answer;
	
	public String post(MainActivity mainActivity) {
		this.mainActivity = mainActivity;
		String url = mainActivity.getResources().getString(R.string.url);
		new AsyncTaskRunnable().execute(url + PARAMS);
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
			try {
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
				
				mainActivity.getValores().putTurno(ADD_KEY + key0.toLowerCase(),
						nAdmisiones);
				mainActivity.getValores().putTurno(ADD_KEY + key1.toLowerCase(),
						nCartera);
				mainActivity.getValores().putTurno(ADD_KEY + key2.toLowerCase(),
						nCaja);
				mainActivity.getValores().putTurno(ADD_KEY + key3.toLowerCase(),
						nCertificados);
				
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
	}
	
	
}
