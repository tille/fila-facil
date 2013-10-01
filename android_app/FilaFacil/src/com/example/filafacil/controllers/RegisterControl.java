package com.example.filafacil.controllers;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import com.example.filafacil.R;
import com.example.filafacil.view.HomeActivity;
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

	public String post(HomeActivity homeActivity, String lastName, String name,
			String identification, String email, String password,
			boolean eafitStudent) {
		
		this.homeActivity = homeActivity;
		this.lastName = lastName;
		this.name = name;
		this.identification = identification;
		this.email = email;
		this.password = password;
		this.eafitStudent = eafitStudent;
		
		String quotes = "%22";
		String openBrace = "%7B";
		String closeBrace = "%7D";
		String mQuotes = quotes + ":" + quotes;
		
		String paramIdentification = quotes + homeActivity.getResources()
				.getString(R.string.json_identification) + quotes + ":" +
				identification;
		String paramName = quotes + homeActivity.getResources()
				.getString(R.string.json_name) + mQuotes + name + quotes;
		String paramLastName = quotes + homeActivity.getResources()
				.getString(R.string.json_lastname) + mQuotes + lastName + quotes;
		String paramEmail = quotes + homeActivity.getResources()
				.getString(R.string.json_email) + mQuotes + email + quotes;
		String paramPassword = quotes + homeActivity.getResources()
				.getString(R.string.json_password) + mQuotes + password + quotes;
		String paramEafitStudent = quotes + homeActivity.getResources()
				.getString(R.string.json_eafitStudent) + quotes + ":";
		paramEafitStudent += (eafitStudent) ? "1" : "0";
		String paramRol = homeActivity.getResources()
				.getString(R.string.json_rol);
		String paramJSON = PARAMS + openBrace + paramIdentification + "," + 
				paramName + "," + paramLastName + "," + paramEmail + "," +
				paramPassword + "," + paramEafitStudent + "," + paramRol +
				closeBrace;
		
		String url = homeActivity.getResources().getString(R.string.url);
		url += paramJSON;
		Log.d("CONSOLA", paramJSON);
		Log.d("CONSOLA", url);
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
				Log.d("CONSOLA", "Error: " + e.getMessage());
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			if (answer.equals(USER_REGISTERED)) {
				InputDataControl input = new InputDataControl(lastName, 
						name, identification, email, password, password, 
						eafitStudent);
				
				homeActivity.getValores().putPerfil(input);
			}
			homeActivity.responderRegister(answer);
		}
	}
	
}
