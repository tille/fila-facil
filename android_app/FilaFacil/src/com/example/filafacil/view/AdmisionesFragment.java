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

	public static final String url = "http://filafacil.herokuapp.com/services.php?q=get_turn&params=admisiones";
	private ValuesManager valorTurno;
	private AsyncTaskRunnable async;
	private String myTurn;
	private String actualTurn;
	
	@Override
	public void onDestroyView() {
	    super.onDestroyView();
	    async.cancel(true);
	    valorTurno = null;
	    async = null;
	}
	
	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
    	View view = inflater.inflate(R.layout.admisiones_fragment, null);
    	
    	valorTurno = ((MainActivity) getSherlockActivity()).getValores();
    	
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
						.getString(R.string.admisiones);
				myTurn = valorTurno.getTurno(key);
				Log.d("CONSOLA", "Con: " + BoardControl.ADD_KEY +
						key.toLowerCase());
				actualTurn = valorTurno.getTurno(BoardControl.ADD_KEY +
						key.toLowerCase());
				return 1;
			}
			catch(Exception e) {
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			updateBoard(myTurn, actualTurn);
			async = new AsyncTaskRunnable();
			async.execute();
        }
	}
	
    public void onClickPedir() {
    	disableButton();
    	if (!((MainActivity)getSherlockActivity()).isOnline()) {
    		((MainActivity)getSherlockActivity()).alertarSinRed();
    		enableButton();
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
	    			TurnControl handler = new TurnControl();
	    			handler.post(url, (MainActivity) getSherlockActivity(),
	    					MainActivity.ITEM_ADMISIONES);
	    			getSherlockActivity()
	    				.setProgressBarIndeterminateVisibility(true);
    			} catch(Exception e){
    				System.out.println("Error");
    				getSherlockActivity()
    					.setProgressBarIndeterminateVisibility(false);
    			}
			}
    	});
    	alert.setNegativeButton(getResources().getString(
    		R.string.alerta_cancelar), new DialogInterface.OnClickListener() {
			public void onClick(DialogInterface dialog,int id) {
				enableButton();
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
    
    public void updateBoard(String myTurn, String actualTurn) {
    	if (this.isVisible()) {
        	if (myTurn != null && actualTurn != null) {
        		TextView myView = (TextView) getView()
        				.findViewById(R.id.numero_turno_adm);
        		myView.setText(myTurn);
        		
        		TextView actualView = (TextView) getView()
        				.findViewById(R.id.numero_actual_admisiones);
        		actualView.setText(actualTurn);
        	}
        	if (!myTurn.equals(getResources().getString(R.string.sin_asignar)))
        		disableButton();
    	}
    }
}