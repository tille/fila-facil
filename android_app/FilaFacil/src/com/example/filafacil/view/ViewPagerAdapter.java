package com.example.filafacil.view;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
 
public class ViewPagerAdapter extends FragmentPagerAdapter {
 
    // Declare the number of ViewPager pages
    private AdmisionesFragment admisiones;
    private CarteraFragment cartera;
    private CajaFragment caja;
    private CertificadosFragment certificados;
    final int PAGE_COUNT = 4;
 
    public ViewPagerAdapter(FragmentManager fm) {
        super(fm);
        admisiones = new AdmisionesFragment();
        cartera = new CarteraFragment();
        caja = new CajaFragment();
        certificados = new CertificadosFragment();
    }
 
    @Override
    public Fragment getItem(int arg0) {
        switch (arg0) {
        case 0:
            return admisiones;
        case 1:
            return cartera;
        case 2:
            return caja;
        case 3:
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