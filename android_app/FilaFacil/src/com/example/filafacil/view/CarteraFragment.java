package com.example.filafacil.view;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.actionbarsherlock.app.SherlockFragment;
import com.example.filafacil.R;
import com.example.filafacil.helpers.ServiceConnection;
import com.example.filafacil.helpers.ValuesManager;
 
public class CarteraFragment extends SherlockFragment {
	public String url = "http://filafacil.herokuapp.com/services.php?q=get_turn&params=cartera";
	private ValuesManager valorTurno;
	
	public CarteraFragment(ValuesManager valores) {
		valorTurno = valores;
	}

	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
        // Get the view from fragmenttab3.xml
        View view = inflater.inflate(R.layout.cartera_fragment, null);
        //valorTurno = new ValuesManager(view.getContext());
        String numeroTurno = valorTurno.getTurnoCartera();
        if (numeroTurno.equals("---")) {
    		Log.d("CONSOLA", "OnCreateView sin turno guardado cartera");
    	}
    	else {
    		Log.d("CONSOLA", "OnCreateView turno guardado cartera");
	    	TextView turno = (TextView) view.findViewById(
	    											R.id.numero_turno_cart);
			turno.setText(numeroTurno);
			Button boton = (Button) view.findViewById(R.id.boton_pedir_cart);
			boton.setEnabled(false);
    	}
        return view;
    }
 
    @Override
    public void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);
        setUserVisibleHint(true);
    }
 
    public void onClickPedir() {
    	if (!((MainActivity)getSherlockActivity()).isOnline()) {
    		((MainActivity)getSherlockActivity()).alertarSinRed();
    		return;
        }
    	AlertDialog.Builder alert = new AlertDialog.Builder(getView()
    															.getContext());
    	alert.setTitle(getResources().getString(R.string.titulo_alerta_pedir));
    	alert.setMessage(getResources().getString(R.string.mensaje_alerta_pedir)
    						+ " " + getResources().getString(R.string.cartera));
    	alert.setPositiveButton(getResources().getString(
    		R.string.alerta_continuar), new DialogInterface.OnClickListener() {
    		public void onClick(DialogInterface dialog,int id) {
    			//Invocar la función de conexión con base de datos etc.
    			//Ejemplo:
    			try{
	    			ServiceConnection handler = new ServiceConnection();
	    			handler.post(url, getThis());
	    			disableButton();
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
    
    public void updateView(String numeroTurno) {
    	Toast.makeText(getView().getContext(), getResources().getString(
				R.string.turno_reservado), Toast.LENGTH_LONG).show();
    	TextView text = (TextView) getView().findViewById(R.id.numero_turno_cart);
    	text.setText(numeroTurno);
    	valorTurno.putTurnoCartera(numeroTurno);
    	
    	Button pedir = (Button) getView().findViewById(R.id.boton_pedir_cart);
    	pedir.setEnabled(false);
    	getSherlockActivity().setProgressBarIndeterminateVisibility(false);
    }
    
    public CarteraFragment getThis() {
    	return this;
    }
}