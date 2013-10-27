package com.example.filafacil.helpers;

import com.actionbarsherlock.app.SherlockFragmentActivity;
import com.example.filafacil.R;
import com.example.filafacil.controllers.InputDataControl;

import android.content.Context;
import android.content.SharedPreferences;

public class ValuesManager {
	
	private Context context;
	private SharedPreferences sp;
	private SharedPreferences.Editor spEditor;
	private static final String TABLE_NAME = "values";
	public static final String DEVICE_KEY_TAG = "dev_key";
	
	public ValuesManager(Context context) {
		this.context = context;
		Context c = context;
		sp = c.getSharedPreferences(TABLE_NAME, Context.MODE_PRIVATE);
		spEditor = sp.edit();
		
		//Borrar todas las preferencias:
		//limpiar();
	}

	public void limpiar() {
		spEditor.clear();
		spEditor.commit();
	}
	
	public void limpiar(String key) {
		spEditor.remove(key);
		spEditor.commit();
	}
	
	public void putTurno(String dependencia, String turno) {
		spEditor.putString(dependencia, turno);
		spEditor.commit();
	}
	
	public void putString(String key, String value) {
		spEditor.putString(key, value);
		spEditor.commit();
	}
	
	public String getTurno(String dependencia) {
		return sp.getString(dependencia, context.getResources()
				.getString(R.string.sin_asignar));
	}
	
	public String getString(String key) {
		return sp.getString(key, null);
	}

	//Empiezo el perfil
	
	public void putPerfil(InputDataControl data) {
		spEditor.putString("lastName", data.getLastName());
		spEditor.putString("name", data.getName());
		spEditor.putString("identification", data.getIdentification());
		spEditor.putString("email", data.getEmail());
		spEditor.putString("password", data.getPassword());
		spEditor.putBoolean("eafitStudent", data.isEafitStudent());
		spEditor.commit();
	}
	
	public String getLastName() {
		return sp.getString("lastName", null);
	}
	
	public String getName() {
		return sp.getString("name", null);
	}
	
	public String getIdentification() {
		return sp.getString("identification", null);
	}
	
	public String getEmail() {
		return sp.getString("email", null);
	}
	
	public String getPassword() {
		return sp.getString("password", null);
	}
	
	public boolean getEafitStudent() {
		return sp.getBoolean("eafitStudent", false);
	}
}
