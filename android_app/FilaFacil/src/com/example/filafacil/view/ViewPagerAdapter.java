package com.example.filafacil.view;

import com.example.filafacil.helpers.ValuesManager;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.util.Log;
 
public class ViewPagerAdapter extends FragmentPagerAdapter {
 
    // Declare the number of ViewPager pages
    private AdmisionesFragment admisiones;
    private CarteraFragment cartera;
    private CajaFragment caja;
    private CertificadosFragment certificados;
    final int PAGE_COUNT = 4;
 
    public ViewPagerAdapter(FragmentManager fm, ValuesManager valores) {
        super(fm);
        admisiones = new AdmisionesFragment(valores);
        cartera = new CarteraFragment(valores);
        caja = new CajaFragment(valores);
        certificados = new CertificadosFragment(valores);
        Log.d("CONSOLA", "ViewPagerAdapter constructor");
    }
 
    @Override
    public Fragment getItem(int arg0) {
        switch (arg0) {
 
        // Open FragmentTab1.java
        case 0:
            return admisiones;
 
        // Open FragmentTab2.java
        case 1:
            //CarteraFragment cartera = new CarteraFragment();
            return cartera;
 
        // Open FragmentTab3.java
        case 2:
            //CajaFragment caja = new CajaFragment();
            return caja;
        case 3:
        	//CertificadosFragment certificados = new CertificadosFragment();
        	return certificados;
        }
        return null;
    }
 
    @Override
    public int getCount() {
        // TODO Auto-generated method stub
        return PAGE_COUNT;
    }
 
}