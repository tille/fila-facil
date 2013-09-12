package com.example.filafacil.helpers;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;

import com.actionbarsherlock.app.SherlockFragment;
import com.example.filafacil.view.AdmisionesFragment;
import com.example.filafacil.view.CajaFragment;
import com.example.filafacil.view.CarteraFragment;
import com.example.filafacil.view.CertificadosFragment;

import android.os.AsyncTask;
import android.util.Log;

public class ServiceConnection {
	
	private String answer;
	private SherlockFragment fragment;
	
	public String post(String posturl, SherlockFragment fragment) {
		this.fragment = fragment;
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
			if (fragment instanceof AdmisionesFragment) {
				AdmisionesFragment admisionesFragment;
				admisionesFragment = (AdmisionesFragment) fragment;
				admisionesFragment.updateView(answer);
			}
			if (fragment instanceof CajaFragment) {
				CajaFragment cajaFragment;
				cajaFragment = (CajaFragment) fragment;
				cajaFragment.updateView(answer);
			}
			if (fragment instanceof CarteraFragment) {
				CarteraFragment carteraFragment;
				carteraFragment = (CarteraFragment) fragment;
				carteraFragment.updateView(answer);
			}
			if (fragment instanceof CertificadosFragment) {
				CertificadosFragment certificadosFragment;
				certificadosFragment = (CertificadosFragment) fragment;
				certificadosFragment.updateView(answer);
			}
        }
	}
}

