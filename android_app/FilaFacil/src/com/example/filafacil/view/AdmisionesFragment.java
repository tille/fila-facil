package com.example.filafacil.view;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import com.actionbarsherlock.app.SherlockFragment;
import com.example.filafacil.R;
import com.example.filafacil.controllers.BoardControl;
import com.example.filafacil.controllers.TurnControl;
import com.example.filafacil.helpers.ValuesManager;

public class AdmisionesFragment extends SherlockFragment {
	
	private ValuesManager valorTurno;
	private AsyncTaskRunnable async;
	private String myTurn;
	private String actualTurn;
	private String inQueue;
	private boolean wasAttended = false;
	private boolean requestingTurn = false;
	
	@Override
	public void onDestroyView() {
	    super.onDestroyView();
	    if (async != null) async.cancel(true);
	    valorTurno = null;
	    async = null;
	}
	
	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
    	View view = inflater.inflate(R.layout.admisiones_fragment, null);
    	
    	valorTurno = ((MainActivity) getSherlockActivity()).getValores();
    	
    	String key = getSherlockActivity().getResources()
				.getString(R.string.admisiones).toLowerCase();
		myTurn = valorTurno.getTurno(key);
		actualTurn = valorTurno.getTurno(BoardControl.ACTUAL_KEY +
				key);
		inQueue = valorTurno.getTurno(BoardControl.QUEUE_KEY +
				key.toLowerCase());
		
		Log.d("CONSOLA", "inQueueAdmin: " + BoardControl.QUEUE_KEY +
				key.toLowerCase() + " y es " + inQueue);
		
		updateBoard(myTurn, actualTurn, inQueue);
    	
    	async = new AsyncTaskRunnable();
    	async.execute();
	
        return view;
    }
	
	@Override
    public void onSaveInstanceState(Bundle savedInstanceState) {
		super.onSaveInstanceState(savedInstanceState);
    }
    
	class AsyncTaskRunnable extends AsyncTask<String, Float, Integer>{
		protected synchronized Integer doInBackground(String...urls) {
			try{
				String key = getSherlockActivity().getResources()
						.getString(R.string.admisiones).toLowerCase();
				myTurn = valorTurno.getTurno(key);
				actualTurn = valorTurno.getTurno(BoardControl.ACTUAL_KEY +
						key.toLowerCase());
				inQueue = valorTurno.getTurno(BoardControl.QUEUE_KEY +
						key.toLowerCase());
				return 1;
			}
			catch(Exception e) {
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			updateBoard(myTurn, actualTurn, inQueue);
			async = new AsyncTaskRunnable();
			async.execute();
        }
	}
	
    public void onClickPedir() {
    	disableButton();
    	requestingTurn = true;
    	if (!((MainActivity)getSherlockActivity()).isOnline()) {
    		((MainActivity)getSherlockActivity()).alertarSinRed();
    		enableButton();
    		requestingTurn = false;
    		return;
        }

    	AlertDialog.Builder alert = new AlertDialog.Builder(getView()
    			.getContext());
    	alert.setCancelable(false);
    	alert.setTitle(getResources().getString(R.string.titulo_alerta_pedir));
    	alert.setMessage(getResources().getString(R.string.mensaje_alerta_pedir)
    			+ " " + getResources().getString(R.string.admisiones));
    	alert.setPositiveButton(getResources()
    			.getString(R.string.alerta_continuar),
    			new DialogInterface.OnClickListener() {
    		public void onClick(DialogInterface dialog,int id) {
    			try{
    				requestingTurn = true;
    				MainActivity main = (MainActivity) getSherlockActivity();
    				String user = main.getValores().getIdentification();
    				String pass = main.getValores().getPassword();
	    			TurnControl handler = new TurnControl();
	    			handler.post((MainActivity) getSherlockActivity(),
	    					MainActivity.ITEM_ADMISIONES, user, pass);
	    			getSherlockActivity()
	    				.setProgressBarIndeterminateVisibility(true);
    			} catch(Exception e){
    				System.out.println("Error");
    				getSherlockActivity()
    					.setProgressBarIndeterminateVisibility(false);
    				requestingTurn = false;
    			}
			}
    	});
    	alert.setNegativeButton(getResources().getString(
    		R.string.alerta_cancelar), new DialogInterface.OnClickListener() {
			public void onClick(DialogInterface dialog,int id) {
				enableButton();
				requestingTurn = false;
				dialog.cancel();
			}
		});
    	AlertDialog alertDialog = alert.create();
		alertDialog.show();
    }
    
    public void disableButton() {
    	Button pedir = (Button) getView().findViewById(R.id.boton_pedir_adm);
    	pedir.setEnabled(false);
    }
    
    public void enableButton() {
    	Button pedir = (Button) getView().findViewById(R.id.boton_pedir_adm);
    	pedir.setEnabled(true);
    }
    
    public void updateBoard(String myTurn, String actualTurn, String inQueue) {
    	if (this.isVisible()) {
        	if (myTurn != null && actualTurn != null && inQueue != null) {
        		TextView titleView = (TextView) getView()
        				.findViewById(R.id.turno_actual_admisiones);
            	TextView myView = (TextView) getView()
        				.findViewById(R.id.numero_turno_adm);
            	TextView actualView = (TextView) getView()
        				.findViewById(R.id.numero_actual_admisiones);
            	
            	if (myTurn.equals(getResources().getString(R.string.sin_asignar))){
            		titleView.setText(getView().getResources()
            				.getString(R.string.en_cola));
            		actualView.setText(inQueue);
            		if (!requestingTurn) enableButton();
            	}
            	else {
            		requestingTurn = false;
            		titleView.setText(getView().getResources()
            				.getString(R.string.turno_actual));
            		if (actualTurn.equals("-1")) actualView
            		.setText(getResources().getString(R.string.sin_asignar));
            		else actualView.setText(actualTurn);
            		disableButton();
            		int myInt = Integer.parseInt(myTurn);
            		int actualInt = Integer.parseInt(actualTurn);
            		String key = getSherlockActivity().getResources()
    						.getString(R.string.admisiones).toLowerCase();
            		if (actualInt == myInt) {
            			if (!wasAttended) { 
            				((MainActivity) getSherlockActivity())
            					.isMyTurnAlert(key);
            			}
            			wasAttended = true;
            		}
            		if ((actualInt == -1 || actualInt > myInt) && wasAttended) {
            			
            			((MainActivity) getSherlockActivity()).getValores()
            				.limpiar(key);
            			wasAttended = false;
            		}
            	}
            	myView.setText(myTurn);
        	}
        	
    	}
    }
}