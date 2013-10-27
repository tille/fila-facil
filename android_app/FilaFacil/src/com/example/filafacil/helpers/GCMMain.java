package com.example.filafacil.helpers;

import android.content.Context;
import android.util.Log;

import com.example.filafacil.controllers.RegisterControl;
import com.google.android.gcm.GCMRegistrar;

public class GCMMain {

	private Context context;
	
	public GCMMain(Context context) {
		this.context = context;
	}
	
	public void comprobar() {
		GCMRegistrar.checkDevice(context);
		GCMRegistrar.checkManifest(context);
		Log.d("CONSOLA", "Excelente comprobar");
	}
	
	public void registrar() {
        Log.d("CONSOLA", "Registering device");
        String regId = GCMRegistrar.getRegistrationId(context);
        
        Log.d("CONSOLA", "regId: " + regId);
        if (regId.equals("")) {
            // Retrive the sender ID from GCMIntentService.java
            // Sender ID will be registered into GCMRegistrar
	         GCMRegistrar.register(context, GCMIntentService.SENDER_ID);
	         Log.d("CONSOLA", "Registrado");
            //mostrar("Registrando");
	         
	         //En el onRegistered ya tengo para registrarme a la DB
        }
        else {
        	Log.d("CONSOLA", "Ya estoy con: " + regId);
        	RegisterControl registerControl = new RegisterControl();
    		registerControl.post(regId, context);
        }
    }
}
