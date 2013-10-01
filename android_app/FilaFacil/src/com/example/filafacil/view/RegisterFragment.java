package com.example.filafacil.view;

import android.graphics.Color;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.Gravity;
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
import com.example.filafacil.controllers.RegisterControl;

public class RegisterFragment extends SherlockFragment {
	
	private EditText lastNameField;
	private EditText nameField;
	private EditText identificationField;
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
		lastNameField = (EditText) getSherlockActivity()
        		.findViewById(R.id.apellido);
		lastNameField.addTextChangedListener(new TextWatcher() {

            public void afterTextChanged(Editable s) {}
            public void beforeTextChanged(CharSequence s, int start, int count,
            		int after) {}
            public void onTextChanged(CharSequence s, int start, int before,
            		int count) {
            	lastNameField.setBackgroundColor(Color.parseColor(getResources()
    					.getString(R.color.light_gray)));
            }
        });
		
		nameField = (EditText) getSherlockActivity()
        		.findViewById(R.id.nombre);
		nameField.addTextChangedListener(new TextWatcher() {

            public void afterTextChanged(Editable s) {}
            public void beforeTextChanged(CharSequence s, int start, int count,
            		int after) {}
            public void onTextChanged(CharSequence s, int start, int before,
            		int count) {
            	nameField.setBackgroundColor(Color.parseColor(getResources()
    					.getString(R.color.light_gray)));
            }
        });
		
		identificationField = (EditText) getSherlockActivity()
        		.findViewById(R.id.documento);
		identificationField.addTextChangedListener(new TextWatcher() {

            public void afterTextChanged(Editable s) {}
            public void beforeTextChanged(CharSequence s, int start, int count,
            		int after) {}
            public void onTextChanged(CharSequence s, int start, int before,
            		int count) {
            	identificationField.setBackgroundColor(Color.parseColor(getResources()
    					.getString(R.color.light_gray)));
            }
        });
		
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
		
		boolean missing = false;
		if (passwordConfirm.length() == 0) {
			confirmPasswordField.requestFocus();
			confirmPasswordField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			missing = true;
		}
		if (password.length() == 0) {
			passwordField.requestFocus();
			passwordField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			missing = true;
		}
		if (email.length() == 0) {
			emailField.requestFocus();
			emailField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			missing = true;
		}
		if (identification.length() == 0) {
			identificationField.requestFocus();
			identificationField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			missing = true;
		}
		if (name.length() == 0) {
			nameField.requestFocus();
			nameField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			missing = true;
		}
		
		if (lastName.length() == 0) {
			lastNameField.requestFocus();
			lastNameField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			missing = true;
			//return;
		}
		
		if (missing) {
			Toast toast = Toast.makeText(getView().getContext(),
					getResources().getString(R.string.incomplete_fields),
					Toast.LENGTH_LONG);
			toast.setGravity(Gravity.CENTER, 0, 0);
			toast.show();
			return;
		}
		
		InputDataControl input = new InputDataControl(lastName, name,
				identification, email, password, passwordConfirm, eafitStudent);
		
		switch (input.validarPassword()) {
		
			case InputDataControl.ILEGAL_CHAR:
				
				Toast toast = Toast.makeText(getView().getContext(),
						getResources().getString(R.string.ilegal_char),
						Toast.LENGTH_LONG);
				toast.setGravity(Gravity.CENTER, 0, 0);
				toast.show();
				
				passwordField.requestFocus();
				passwordField.setBackgroundColor(Color.parseColor(getResources()
						.getString(R.color.light_red)));
				confirmPasswordField.setBackgroundColor(Color.parseColor(getResources()
						.getString(R.color.light_red)));
				
				button.setEnabled(true);
				getSherlockActivity().setProgressBarIndeterminateVisibility(false);
				return;
				
			case InputDataControl.NO_EQUALS:
				
				Toast toast2 = Toast.makeText(getView().getContext(),
						getResources().getString(R.string.pass_no_equal),
						Toast.LENGTH_LONG);
				toast2.setGravity(Gravity.CENTER, 0, 0);
				toast2.show();
				
				passwordField.requestFocus();
				passwordField.setBackgroundColor(Color.parseColor(getResources()
						.getString(R.color.light_red)));
				confirmPasswordField.setBackgroundColor(Color
						.parseColor(getResources()
								.getString(R.color.light_red)));
				
				button.setEnabled(true);
				getSherlockActivity()
					.setProgressBarIndeterminateVisibility(false);
				return;
				
			default:
				break;
		}
		
		if (!input.validarCorreo()) {
			Toast toast = Toast.makeText(getView().getContext(),
					getResources().getString(R.string.ilegal_email),
					Toast.LENGTH_LONG);
			toast.setGravity(Gravity.CENTER, 0, 0);
			toast.show();
			
			emailField.requestFocus();
			emailField.setBackgroundColor(Color.parseColor(getResources()
					.getString(R.color.light_red)));
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			return;
		}
		
		RegisterControl register = new RegisterControl();
		register.post((HomeActivity) getSherlockActivity(), lastName, name,
				identification, email, password, eafitStudent);
		getSherlockActivity().setProgressBarIndeterminateVisibility(true);
	}
}
