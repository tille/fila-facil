package com.example.filafacil.helpers;

import java.net.MalformedURLException;
import java.net.URI;
import java.net.URISyntaxException;
import java.net.URL;

public class Converter {

	public static String toUri(String urlStr) throws MalformedURLException, 
		URISyntaxException{
			URL url = new URL(urlStr);
		    URI uri = new URI(url.getProtocol(), url.getUserInfo(), url.getHost(),
				  url.getPort(), url.getPath(), url.getQuery(), url.getRef());
		    url = uri.toURL();
		    return url.toString();
	}
}
