package com.example.filafacil;

import android.content.Context;
import android.content.SharedPreferences;
import android.util.Log;

public class ValuesManager {
	
	private Context context;
	private SharedPreferences sp;
	private SharedPreferences.Editor spEditor;
	private static final String TABLE_NAME = "values";
	
	public ValuesManager(Context c) {
		this.context = c;
		
		sp = c.getSharedPreferences(TABLE_NAME, Context.MODE_PRIVATE);
		spEditor = sp.edit();
		
		//Borrar todas las preferencias:
		Log.d("CONSOLA", "He borrado las preferencias");
		spEditor.clear();
		spEditor.commit();
	}
	
	public void putTurnoAdmisiones(String turnoAdmisiones) {
		spEditor.putString("admisiones", turnoAdmisiones);
		spEditor.commit();
	}
	
	public void putTurnoCaja(String turnoCaja) {
		spEditor.putString("caja", turnoCaja);
		spEditor.commit();
	}
	
	public void putTurnoCartera(String turnoCartera) {
		spEditor.putString("cartera", turnoCartera);
		spEditor.commit();
	}
	
	public void putTurnoCertificados(String turnoCertificados) {
		spEditor.putString("certificados", turnoCertificados);
		spEditor.commit();
	}
	
	public String getTurnoAdmisiones() {
		return sp.getString("admisiones", context.getResources().getString(
														R.string.sin_asignar));
	}
	
	public String getTurnoCartera() {
		return sp.getString("cartera", context.getResources().getString(
														R.string.sin_asignar));
	}
	
	public String getTurnoCaja() {
		return sp.getString("caja", context.getResources().getString(
														R.string.sin_asignar));
	}
	
	public String getTurnoCertificados() {
		return sp.getString("certificados", context.getResources().getString(
														R.string.sin_asignar));
	}
}
