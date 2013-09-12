package com.example.filafacil.controllers;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.TextView;

public class httpHandler {
	public String ans;
	public TextView tv;
	
	public String post(String posturl, TextView tv){	
		this.tv = tv;
		new asinPost().execute(posturl);
		System.out.println("Paso primero por aca" + ans);
		return ans;
	}


class asinPost extends AsyncTask<String, Float, Integer>{
		protected synchronized Integer doInBackground(String...urls) {
			try{
				HttpClient httpClient = new DefaultHttpClient();
				HttpPost httpPost = new HttpPost(urls[0]);
			
				HttpResponse resp = httpClient.execute(httpPost);
				HttpEntity ent = resp.getEntity();
				
				ans = EntityUtils.toString(ent);
				System.out.println("Si funciona" + ans);
				//tv.setText(ans);
				return 1;
			
			}catch(Exception e){
				Log.e("Error", e.getMessage());
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
            tv.setText(ans);
        }
	}
}

