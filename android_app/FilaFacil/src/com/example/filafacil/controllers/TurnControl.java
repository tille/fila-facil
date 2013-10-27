package com.example.filafacil.controllers;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import com.example.filafacil.R;
import com.example.filafacil.helpers.Converter;
import com.example.filafacil.view.MainActivity;
import android.os.AsyncTask;
import android.util.Log;

public class TurnControl {
	
	public static final String PARAMS = "services.php?q=get_turn&params={";
	private String answer;
	private MainActivity mainActivity;
	private int dependencia;
	
	public String post(MainActivity mainActivity,
			int dependencia, String user, String password) {
		this.mainActivity = mainActivity;
		this.dependencia = dependencia;
		
		String url = mainActivity.getResources().getString(R.string.url);
		url += PARAMS;
		String userParam = "\"user\":" + user;
		String passParam = "\"pwd\":\"" + password + "\"";
		String moduleParam = "\"mod\":\"";
		switch (dependencia) {
			case MainActivity.ITEM_ADMISIONES:
				moduleParam += mainActivity.getResources()
				.getString(R.string.admisiones).toLowerCase() + "\"";
				break;
			case MainActivity.ITEM_CARTERA:
				moduleParam += mainActivity.getResources()
				.getString(R.string.cartera).toLowerCase() + "\"";
				break;
			case MainActivity.ITEM_CAJA:
				moduleParam += mainActivity.getResources()
				.getString(R.string.caja).toLowerCase() + "\"";
				break;
			case MainActivity.ITEM_CERTIFICADOS:
				moduleParam += mainActivity.getResources()
				.getString(R.string.certificados).toLowerCase() + "\"";
				break;
			default:
				break;
		}
		url += userParam + "," + passParam + "," + moduleParam + "}";
		Log.d("CONSOLA", "URL: " + url);
		try {
			url = Converter.toUri(url);
		} catch (Exception ex) {
			Log.e("Error", ex.getMessage());
		}
		Log.d("CONSOLA", "URI: " + url);
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
				Log.d("CONSOLA", "Answer sale: " + answer);
				return 1;
			
			}
			catch(Exception e) {
				Log.d("CONSOLA", "Error: " + e.getMessage());
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			Log.d("CONSOLA", "answer entra: " + answer);
			BoardControl boardControl;
			switch (dependencia) {
				case MainActivity.ITEM_ADMISIONES:
					String key0 = mainActivity.getResources()
						.getString(R.string.admisiones).toLowerCase();
					mainActivity.getValores().putTurno(key0, answer);
					mainActivity.informarTurnoReservado();
					
					//Lamo el servicio para actualizar turnos en cola
					//boardControl = new BoardControl(mainActivity
							//.getApplicationContext());
					//boardControl.post(mainActivity);
					break;
				case MainActivity.ITEM_CARTERA:
					String key1 = mainActivity.getResources()
						.getString(R.string.cartera).toLowerCase();
					mainActivity.getValores().putTurno(key1, answer);
					mainActivity.informarTurnoReservado();
					/*boardControl = new BoardControl(mainActivity
							.getApplicationContext());
					boardControl.post(mainActivity);*/
					break;
				case MainActivity.ITEM_CAJA:
					String key2 = mainActivity.getResources()
						.getString(R.string.caja).toLowerCase();
					mainActivity.getValores().putTurno(key2, answer);
					mainActivity.informarTurnoReservado();
					/*boardControl = new BoardControl(mainActivity
					.getApplicationContext());
			boardControl.post(mainActivity);*/
					break;
				case MainActivity.ITEM_CERTIFICADOS:
					String key3 = mainActivity.getResources()
						.getString(R.string.certificados).toLowerCase();
					mainActivity.getValores().putTurno(key3, answer);
					mainActivity.informarTurnoReservado();
					/*boardControl = new BoardControl(mainActivity
					.getApplicationContext());
			boardControl.post(mainActivity);*/
					break;
				default:
					Log.d("CONSOLA", "Entro a default");
					break;
			}
        }
	}
}

