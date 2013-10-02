package com.example.filafacil.view;

import android.graphics.Color;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.actionbarsherlock.app.SherlockFragment;
import com.example.filafacil.R;
import com.example.filafacil.controllers.InputDataControl;
import com.example.filafacil.controllers.LoginControl;

public class LoginFragment extends SherlockFragment {

	private EditText identificationField;
	private EditText passwordField;
	
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
		
		identificationField = (EditText) getSherlockActivity()
        		.findViewById(R.id.documento_login);
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
        		.findViewById(R.id.contrasena_login);
        passwordField.addTextChangedListener(new TextWatcher() {

            public void afterTextChanged(Editable s) {}
            public void beforeTextChanged(CharSequence s, int start, int count,
            		int after) {}
            public void onTextChanged(CharSequence s, int start, int before,
            		int count) {
            	passwordField.setBackgroundColor(Color.parseColor(getResources()
    					.getString(R.color.light_gray)));
            }
        });
		
		String identification = ((EditText) getView()
				.findViewById(R.id.documento_login)).getText().toString();
		String password = ((EditText) getView()
				.findViewById(R.id.contrasena_login)).getText().toString();
		
		if (identification.length() > 15) {
			Toast toast = Toast.makeText(getView().getContext(),
					getResources().getString(R.string.long_identification),
					Toast.LENGTH_LONG);
			toast.setGravity(Gravity.CENTER, 0, 0);
			toast.show();
			button.setEnabled(true);
			getSherlockActivity().setProgressBarIndeterminateVisibility(false);
			return;
		}
		
		boolean missing = false;
		if (password.length() == 0) {
			passwordField.requestFocus();
			passwordField.setBackgroundColor(Color.parseColor(getResources()
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
		
		if (missing) {
			Toast toast = Toast.makeText(getView().getContext(),
					getResources().getString(R.string.incomplete_fields),
					Toast.LENGTH_LONG);
			toast.setGravity(Gravity.CENTER, 0, 0);
			toast.show();
			return;
		}
		
		InputDataControl input = new InputDataControl(identification, password);
		input.setPasswordConfirm(password);
		
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
				
				button.setEnabled(true);
				getSherlockActivity()
					.setProgressBarIndeterminateVisibility(false);
				return;
				
			default:
				break;
		}

		LoginControl login = new LoginControl();
		Log.d("CONSOLA", "Id: " + identification + " Pass: " + password);
		login.post((HomeActivity) getSherlockActivity(), identification,
				password);
	}
}
