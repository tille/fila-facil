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
import com.example.filafacil.view.HomeActivity;
import android.os.AsyncTask;
import android.util.Log;

public class LoginControl {
	
	public static final String USER_NOT_FOUND = "-1";
	public static final String PARAMS = "services.php?q=login&params=";
	private HomeActivity homeActivity;
	private String answer;
	private String password;
	
	public String post(HomeActivity homeActivity, String user, String pass) {
		this.homeActivity = homeActivity;
		password = pass;
		String url = homeActivity.getResources().getString(R.string.url);
		new AsyncTaskRunnable().execute(url + PARAMS + user + "," + pass);
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
				String identification = respJSON.getString(homeActivity
						.getResources()
						.getString(R.string.param_identification));
				if(identification.equals(USER_NOT_FOUND)) {
					homeActivity.responderLogin(USER_NOT_FOUND);
				} else {
					String name = respJSON.getString(homeActivity
							.getResources()
							.getString(R.string.param_name));
					String lastName = respJSON.getString(homeActivity
							.getResources()
							.getString(R.string.param_lastname));
					String email = respJSON.getString(homeActivity
							.getResources()
							.getString(R.string.param_email));
					int eafitStudent = respJSON.getInt(homeActivity
							.getResources()
							.getString(R.string.param_eafit_student));
					
					boolean student = (eafitStudent == 1) ? true : false;
					
					InputDataControl input = new InputDataControl(lastName, 
							name, identification, email, password, password, 
							student);
					
					homeActivity.getValores().putPerfil(input);
					homeActivity.responderLogin(identification);
				}
				
			} catch (JSONException e) {
				e.printStackTrace();
			}
		}
    }
}