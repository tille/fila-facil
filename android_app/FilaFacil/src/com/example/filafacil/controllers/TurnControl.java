package com.example.filafacil.controllers;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import com.example.filafacil.R;
import com.example.filafacil.view.MainActivity;
import android.os.AsyncTask;
import android.util.Log;

public class TurnControl {
	
	private String answer;
	private MainActivity mainActivity;
	private int dependencia;
	
	public String post(String posturl, MainActivity mainActivity,
			int dependencia) {
		this.mainActivity = mainActivity;
		this.dependencia = dependencia;
		new AsyncTaskRunnable().execute(posturl);
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
			switch (dependencia) {
				case MainActivity.ITEM_ADMISIONES:
					String key0 = mainActivity.getResources()
						.getString(R.string.admisiones);
					mainActivity.getValores().putTurno(key0, answer);
					mainActivity.informarTurnoReservado();
					break;
				case MainActivity.ITEM_CARTERA:
					String key1 = mainActivity.getResources()
						.getString(R.string.cartera);
					mainActivity.getValores().putTurno(key1, answer);
					mainActivity.informarTurnoReservado();
					break;
				case MainActivity.ITEM_CAJA:
					String key2 = mainActivity.getResources()
						.getString(R.string.caja);
					mainActivity.getValores().putTurno(key2, answer);
					mainActivity.informarTurnoReservado();
					break;
				case MainActivity.ITEM_CERTIFICADOS:
					String key3 = mainActivity.getResources()
						.getString(R.string.certificados);
					mainActivity.getValores().putTurno(key3, answer);
					mainActivity.informarTurnoReservado();
					break;
				default:
					break;
			}
        }
	}
}

