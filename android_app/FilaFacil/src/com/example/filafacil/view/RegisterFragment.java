package com.example.filafacil.view;

import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AutoCompleteTextView;
import android.widget.CheckBox;
import android.widget.Toast;
import android.widget.EditText;
import android.widget.Button;

import com.actionbarsherlock.app.SherlockFragment;
import com.example.filafacil.R;
import com.example.filafacil.controllers.InputDataControl;

public class RegisterFragment extends SherlockFragment {
	
	private EditText passwordField;
	private EditText confirmPasswordField;
	private EditText emailField;
	
	@Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.register_fragment, container, 
        		false);
        return rootView;
	}
	
	public void onClickRegister() {
		Button button = ((Button) getView().findViewById(R.id.boton_registro));
		getSherlockActivity().setProgressBarIndeterminateVisibility(true);
		button.setEnabled(false);
		
		//Agrego los listeners de los campos que voy a cambiar de color
        passwordField = (EditText) getSherlockActivity()
        		.findViewById(R.id.contrasena);
        passwordField.addTextChangedListener(new TextWatcher() {

            public void afterTextChanged(Editable s) {}
            public void beforeTextChanged(CharSequence s, int start, int count,
            		int after) {}
            public void onTextChanged(CharSequence s, int start, int before,
            		int count) {
            	passwordField.setBackgroundColor(Color.parseColor(getResources()
    					.getString(R.color.light_gray)));
            	confirmPasswordField.setBackgroundColor(Color
            			.parseColor(getResources()
    					.getString(R.color.light_gray)));
            }
        });
        
        confirmPasswordField = (EditText) getSherlockActivity()
        		.findViewById(R.id.confirm_contrasena);
        confirmPasswordField.addTextChangedListener(new TextWatcher() {

            public void afterTextChanged(Editable s) {}

            public void beforeTextChanged(CharSequence s, int start, int count,
            		int after) {}

            public void onTextChanged(CharSequence s, int start, int before,
            		int count) {
            	confirmPasswordField.setBackgroundColor(Color
            			.parseColor(getResources()
    					.getString(R.color.light_gray)));
            	passwordField.setBackgroundColor(Color.parseColor(getResources()
    					.getString(R.color.light_gray)));
            }
        });
        
        emailField = (EditText) getSherlockActivity()
        		.findViewById(R.id.correo);
        emailField.addTextChangedListener(new TextWatcher() {

            public void afterTextChanged(Editable s) {}
            public void beforeTextChanged(CharSequence s, int start, int count,
            		int after) {
            	emailField.setBackgroundColor(Color
            			.parseColor(getResources()
    					.getString(R.color.light_gray)));
            }
            public void onTextChanged(CharSequence s, int start, int before,
            		int count) {}
        });
        
        //Ahora si empiezo a verificar campos
		String lastName = ((EditText) getView()
				.findViewById(R.id.apellido)).getText().toString();
		String name = ((EditText) getView()
				.findViewById(R.id.nombre)).getText().toString();
		String identification = ((EditText) getView()
				.findViewById(R.id.documento)).getText().toString();
		String email = ((AutoCompleteTextView) getView()
				.findViewById(R.id.correo)).getText().toString();
		String password = ((EditText) getView()
				.findViewById(R.id.contrasena)).getText().toString();
		String passwordConfirm = ((EditText) getView()
				.findViewById(R.id.confirm_contrasena)).getText().toString();
		boolean eafitStudent = ((CheckBox) getView()
				.findViewById(R.id.estudiante_eafit)).isChecked();
		
		if (lastName.length() == 0 || name.length() == 0 || 
				identification.length() == 0 || email.length() == 0 ||
				password.length() == 0 || passwordConfirm.length() == 0) {
			//Poner código que diga cual está faltando
			Toast.makeText(getView().getContext(), "Faltan cosas", Toast.LENGTH_LONG).show();
			
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			return;
		}
		
		InputDataControl input = new InputDataControl(lastName, name,
				identification, email, password, passwordConfirm, eafitStudent);
		
		if (!input.validarPassword()) {
			Toast.makeText(getView().getContext(), 
					"Los campos de contraseña no coinciden", Toast.LENGTH_LONG)
					.show();
			
			passwordField.requestFocus();
			passwordField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			confirmPasswordField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			return;
		}
		if (!input.validarCorreo()) {
			Toast.makeText(getView().getContext(), 
					"No es una dirección de correo válida", Toast.LENGTH_LONG)
					.show();
			
			emailField.requestFocus();
			emailField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			return;
		}
		
		Toast.makeText(getView().getContext(), getResources().getString(
				R.string.app_name), Toast.LENGTH_LONG).show();
		getSherlockActivity().setProgressBarIndeterminateVisibility(false);
		
		//Guardo el perfil del tipo en el ValueManager (Sharedpreferences)
		HomeActivity home = (HomeActivity) getSherlockActivity();
		home.getValores().putPerfil(input);
		
		//Mandar el objeto input hacia foronda y el manda el Json y me retorna
		//Si si se pudo registrar, ingresar a la pantalla de turnos.
		Intent intent = new Intent(getSherlockActivity(), MainActivity.class);
		startActivity(intent);
		getSherlockActivity().finish();
	}
}
