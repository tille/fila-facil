package com.example.filafacil;

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
 
public class AdmisionesFragment extends SherlockFragment {
	
	private ValuesManager valorTurno;
	
	public AdmisionesFragment(ValuesManager valores) {
		valorTurno = valores;
	}
	
	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
    	View view = inflater.inflate(R.layout.admisiones_fragment, null);
        //valorTurno = new ValuesManager(getActivity().getApplicationContext());
    	//valorTurno = new ValuesManager(view.getContext());
    	String numeroTurno = valorTurno.getTurnoAdmisiones();
    	if (numeroTurno.equals("---")) {
    		Log.d("CONSOLA", "OnCreateView sin turno guardado admisiones");
    	}
    	else {
    		Log.d("CONSOLA", "OnCreateView turno guardado admisiones");
	    	TextView turno = (TextView) view.findViewById(
	    												R.id.numero_turno_adm);
			turno.setText(numeroTurno);
			Button boton = (Button) view.findViewById(R.id.boton_pedir_adm);
			boton.setEnabled(false);
    	}
        return view;
    }
	
	@Override
    public void onSaveInstanceState(Bundle savedInstanceState) {
		super.onSaveInstanceState(savedInstanceState);
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
    			+ " " + getResources().getString(R.string.admisiones));
    	alert.setPositiveButton(getResources().getString(
    		R.string.alerta_continuar), new DialogInterface.OnClickListener() {
    		public void onClick(DialogInterface dialog,int id) {
    			Toast.makeText(getView().getContext(), getResources().getString(
    					R.string.turno_reservado), Toast.LENGTH_LONG).show();
    			
    			//Invocar la función de conexión con base de datos etc.
    			//Ejemplo:
    			cambiarTurno("012");
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
    
    public void cambiarTurno(String turno) {
    	TextView text = (TextView) getView().findViewById(
    													R.id.numero_turno_adm);
    	text.setText(turno);
    	valorTurno.putTurnoAdmisiones(turno);
    	
    	Button pedir = (Button) getView().findViewById(R.id.boton_pedir_adm);
    	pedir.setEnabled(false);
    }
}