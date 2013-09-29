package com.example.filafacil.view;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.actionbarsherlock.app.SherlockFragment;
import com.example.filafacil.R;
import com.example.filafacil.controllers.InputDataControl;

public class LoginFragment extends SherlockFragment {

	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.login_fragment, container, false);
        return rootView;
    }
	
	public void onClickLogin() {
		Button button = ((Button) getView().findViewById(R.id.boton_login));
		getSherlockActivity().setProgressBarIndeterminateVisibility(true);
		button.setEnabled(false);
		
		String identification = ((EditText) getView()
				.findViewById(R.id.documento_login)).getText().toString();
		String password = ((EditText) getView()
				.findViewById(R.id.contrasena_login)).getText().toString();
		
		if (identification.length() == 0 || password.length() == 0) {
			//Poner código que diga cual está faltando
			Toast.makeText(getView().getContext(), "Faltan cosas", Toast.LENGTH_LONG).show();
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			return;
		}
		
		//InputDataControl input = new InputDataControl(identification, password);
		
		Toast.makeText(getView().getContext(), getResources().getString(
				R.string.app_name), Toast.LENGTH_LONG).show();
		
		//Guardo el perfil del tipo en el ValueManager (Sharedpreferences)
		InputDataControl input = new InputDataControl(identification, password);
		HomeActivity home = (HomeActivity) getSherlockActivity();
		home.getValores().putPerfil(input);
		
		//Mandar el objeto input hacia foronda y el manda el Json y me retorna
		//Si si se pudo registrar, ingresar a la pantalla de turnos.
		Intent intent = new Intent(getSherlockActivity(), MainActivity.class);
		startActivity(intent);
		getSherlockActivity().finish();
	}
}
