package com.example.filafacil.view;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;

public class ProfilePagerAdapter extends FragmentPagerAdapter {
 
    // Declare the number of ViewPager pages
    private RegisterFragment register;
    private LoginFragment login;
    final int PAGE_COUNT = 2;
 
    public ProfilePagerAdapter(FragmentManager fm) {
        super(fm);
        login = new LoginFragment();
        register = new RegisterFragment();
    }

    @Override
    public Fragment getItem(int arg0) {
        switch (arg0) {
        case 0:
            return register;
        case 1:
            return login;
        }
        return null;
    }
 
    @Override
    public int getCount() {
        // TODO Auto-generated method stub
        return PAGE_COUNT;
    }
 
}