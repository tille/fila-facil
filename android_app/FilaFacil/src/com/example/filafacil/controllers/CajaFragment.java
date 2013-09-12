package com.example.filafacil.controllers;

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
 
public class CajaFragment extends SherlockFragment {
	public String url = "http://filafacil.herokuapp.com/services.php?q=get_turn&params=caja";
	private ValuesManager valorTurno;
	
    public CajaFragment(ValuesManager valores) {
		valorTurno = valores;
	}

	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
        // Get the view from fragmenttab3.xml
        View view = inflater.inflate(R.layout.caja_fragment, null);
        //valorTurno = new ValuesManager(view.getContext());
        String numeroTurno = valorTurno.getTurnoCaja();
        if (numeroTurno.equals("---")) {
    		Log.d("CONSOLA", "OnCreateView sin turno guardado caja");
    	}
    	else {
    		Log.d("CONSOLA", "OnCreateView turno guardado caja");
	    	TextView turno = (TextView) view.findViewById(
	    												R.id.numero_turno_caja);
			turno.setText(numeroTurno);
			Button boton = (Button) view.findViewById(R.id.boton_pedir_caja);
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
    			+ " " + getResources().getString(R.string.caja));
    	alert.setPositiveButton(getResources().getString(
    		R.string.alerta_continuar), new DialogInterface.OnClickListener() {
    		public void onClick(DialogInterface dialog,int id) {
    			Toast.makeText(getView().getContext(), getResources().getString(
    					R.string.turno_reservado), Toast.LENGTH_LONG).show();
    			
    			//Invocar la función de conexión con base de datos etc.
    			//Ejemplo:
    			try{
	    			httpHandler handler = new httpHandler();
	    			TextView text = (TextView) getView().findViewById(R.id.numero_turno_caja);
	    			handler.post(url, text);
	    			cambiarTurno("");
	    			
	    			//System.out.println(txt);
	    			//cambiarTurno(txt);
    			} catch(Exception e){
    				System.out.println("Error");
    				
    			}
			}
    	});
    	alert.setNegativeButton(getResources().getString(
    												R.string.alerta_cancelar),
    							new DialogInterface.OnClickListener() {
			public void onClick(DialogInterface dialog,int id) {
				dialog.cancel();
			}
		});
    	AlertDialog alertDialog = alert.create();
		alertDialog.show();
    }
    
    public void cambiarTurno(String turno) {
    	//TextView text = (TextView) getView().findViewById(
    	//												R.id.numero_turno_caja);
    	//text.setText(turno);
    	//valorTurno.putTurnoCaja(turno);
    	
    	Button pedir = (Button) getView().findViewById(R.id.boton_pedir_caja);
    	pedir.setEnabled(false);
    }
}