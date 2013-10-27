package com.example.filafacil.helpers;

import android.content.Context;
import android.content.Intent;
import android.util.Log;

import com.example.filafacil.controllers.BoardControl;
import com.example.filafacil.controllers.RegisterControl;
import com.google.android.gcm.GCMBaseIntentService;

public class GCMIntentService extends GCMBaseIntentService {

	public static final String SENDER_ID = "320009701389";
	
	public GCMIntentService() {
		super(SENDER_ID);
	}
	
	@Override
    protected void onRegistered(Context context, String registrationId) {
		RegisterControl registerControl = new RegisterControl();
		registerControl.post(registrationId, context);
        Log.d("CONSOLA", "onRegistered: registrationId=" + registrationId);
    }
 
    @Override
    protected void onUnregistered(Context context, String registrationId) {
 
        Log.d("CONSOLA", "onUnregistered: registrationId=" + registrationId);
    }
	
	@Override
    protected void onMessage(Context context, Intent data) {
		Log.d("CONSOLA", "Recibo mensaje");
		//ValuesManager valores = new ValuesManager(context);
        String message;
        // Message from PHP server
        //message = data.getStringExtra("message");
        /*message = data.getStringExtra("message");
       
        
        if (message != null) {
        	BoardControl control = new BoardControl(context);
        	control.processAnswerRemaining(message);
        	//valores.putTurno("remaining_admisiones", message);
        	Log.d("CONSOLA", "Cogí el mensaje: " + message);
        }*/
        message = data.getStringExtra("remaining");
        if (message != null) {
        	BoardControl control = new BoardControl(context);
        	control.processAnswerRemaining(message);
        	//valores.putTurno("remaining_admisiones", message);
        	Log.d("CONSOLA", "Cogí el remaining: " + message);
        }
        message = data.getStringExtra("actual");
        if (message != null) {
        	BoardControl control = new BoardControl(context);
        	control.processAnswerActual(message);
        	//valores.putTurno("remaining_admisiones", message);
        	Log.d("CONSOLA", "Cogí el actual: " + message);
        }
    }
	
	@Override
    protected void onError(Context arg0, String errorId) {
        Log.d("CONSOLA", "onError: errorId=" + errorId);
    }
}
