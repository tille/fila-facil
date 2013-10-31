package com.example.filafacil.view;

import java.util.Timer;
import java.util.TimerTask;
import android.content.Intent;
import android.graphics.Typeface;
import android.os.Bundle;
import android.view.Window;
import android.widget.TextView;

import com.actionbarsherlock.app.SherlockActivity;
import com.example.filafacil.R;
import com.example.filafacil.helpers.ValuesManager;

public class WelcomeActivity extends SherlockActivity{
	
	private ValuesManager valores;
	private TimerTask task;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
    	super.onCreate(savedInstanceState);
    	this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.welcome_activity);
        
        String fontName = "LobsterTwo-Regular.otf";
        
        TextView nombre = (TextView) findViewById(R.id.welcome_app_name);
        
        Typeface tf = Typeface.createFromAsset(getAssets(), fontName);
        
        nombre.setTypeface(tf);
        //Si tengo que salirme porque cerré desde otra actividad
        if (getIntent().getBooleanExtra("EXIT", false)) {
        	System.out.println("Hola");
            finish();
        }
        
        valores = new ValuesManager(getApplicationContext());
        
        task = new TimerTask() {
            @Override
            public void run() {
            	if (valores.getIdentification() != null &&
                		valores.getPassword() != null) {
                	Intent intent = new Intent(getApplicationContext(),
                			MainActivity.class);
            		startActivity(intent);
            		finish();
                }
                else {
                	Intent intent = new Intent(getApplicationContext(),
                			HomeActivity.class);
            		startActivity(intent);
            		finish();
                }
            }
        };
        Timer timer_on_task = new Timer();
        timer_on_task.schedule(task, 5000);
	}
	
	@Override
    public void onBackPressed() {
		task.cancel();
		finish();
    }
	
	@Override
    protected void onStop() 
    {
        super.onStop();
        task.cancel();
    }
}
