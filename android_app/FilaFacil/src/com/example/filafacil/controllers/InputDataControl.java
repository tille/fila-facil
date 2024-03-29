package com.example.filafacil.controllers;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class InputDataControl {
	
	private String lastName;
	private String name;
	private String identification;
	private String email;
	private String password;
	private String passwordConfirm;
	private boolean eafitStudent;
	public static final String EMAIL_EXPR = "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-"+
			"z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
	public static final String PASS_EXPR = "^[a-zA-Z0-9]+$";
	public static final int CORRECT = 0;
	public static final int NO_EQUALS = 1;
	public static final int ILEGAL_CHAR = 2;
	
	public InputDataControl(String lastName, String name,
			String identification, String email, String password,
			String passwordConfirm, boolean eafitStudent) {
		//super();
		this.lastName = lastName;
		this.name = name;
		this.identification = identification;
		this.email = email;
		this.password = password;
		this.passwordConfirm = passwordConfirm;
		this.eafitStudent = eafitStudent;
	}
	
	public InputDataControl(String identification, String password) {
		super();
		this.identification = identification;
		this.password = password;
	}

	public boolean validarCorreo() {
		Pattern pattern = Pattern.compile(EMAIL_EXPR);
		Matcher matcher = pattern.matcher(email);
		return matcher.matches();
	}
	
	public int validarPassword() {
		Pattern pattern = Pattern.compile(PASS_EXPR);
		Matcher matcher = pattern.matcher(password);
		if (matcher.matches()) {
			if (password.equals(passwordConfirm)) return CORRECT;
			else return NO_EQUALS;
		}
		else return ILEGAL_CHAR;
	}

	public String getLastName() {
		return lastName;
	}

	public void setLastName(String lastName) {
		this.lastName = lastName;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}
	
	public String getIdentification() {
		return identification;
	}
	
	public void setIdentification(String identification) {
		this.identification = identification;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}
	
	public String getPasswordConfirm() {
		return passwordConfirm;
	}

	public void setPasswordConfirm(String passwordConfirm) {
		this.passwordConfirm = passwordConfirm;
	}

	public boolean isEafitStudent() {
		return eafitStudent;
	}

	public void setEafitStudent(boolean eafitStudent) {
		this.eafitStudent = eafitStudent;
	}
}
