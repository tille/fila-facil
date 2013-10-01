package com.example.filafacil.view;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
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
 
public class CarteraFragment extends SherlockFragment {
	public String url = "http://filafacil.herokuapp.com/services.php?q=get_turn&params=cartera";
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
    	View view = inflater.inflate(R.layout.cartera_fragment, null);
    	
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
				//Log.d("CONSOLA", "Entro al cosito cartera");
				String key = getSherlockActivity().getResources()
						.getString(R.string.cartera);
				myTurn = valorTurno.getTurno(key);
				actualTurn = valorTurno.getTurno(BoardControl.ADD_KEY +
						key.toLowerCase());
				return 1;
			}
			catch(Exception e) {
				//Log.e("Error", e.getMessage());
				//Log.d("CONSOLA", "Error en el async: " + e.getMessage());
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			//Log.d("CONSOLA", "Updateo board cartera");
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
    	alert.setTitle(getResources().getString(R.string.titulo_alerta_pedir));
    	alert.setMessage(getResources().getString(R.string.mensaje_alerta_pedir)
    			+ " " + getResources().getString(R.string.cartera));
    	alert.setPositiveButton(getResources()
    			.getString(R.string.alerta_continuar),
    			new DialogInterface.OnClickListener() {
    		public void onClick(DialogInterface dialog,int id) {
    			try{
	    			TurnControl handler = new TurnControl();
	    			handler.post(url, (MainActivity) getSherlockActivity(),
	    					MainActivity.ITEM_CARTERA);
	    			//disableButton();
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
    	Button pedir = (Button) getView().findViewById(R.id.boton_pedir_cart);
    	pedir.setEnabled(false);
    }
    
    public void enableButton() {
    	Button pedir = (Button) getView().findViewById(R.id.boton_pedir_cart);
    	pedir.setEnabled(true);
    }
    
    public void updateBoard(String myTurn, String actualTurn) {
    	if (this.isVisible()) {
        	if (myTurn != null && actualTurn != null) {
        		TextView myView = (TextView) getView()
        				.findViewById(R.id.numero_turno_cart);
        		myView.setText(myTurn);
        		
        		TextView actualView = (TextView) getView()
        				.findViewById(R.id.numero_actual_cartera);
        		actualView.setText(actualTurn);
        	}
        	if (!myTurn.equals(getResources().getString(R.string.sin_asignar)))
        		disableButton();
    	}
    }
}