package com.example.filafacil.view;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.view.ViewPager;
import android.view.View;

import com.actionbarsherlock.app.ActionBar;
import com.actionbarsherlock.app.ActionBar.Tab;
import com.actionbarsherlock.app.SherlockFragmentActivity;
import com.actionbarsherlock.view.Window;
import com.example.filafacil.R;
import com.example.filafacil.helpers.ValuesManager;
 
public class MainActivity extends SherlockFragmentActivity {
 
    // Declare Variables
    private ActionBar mActionBar;
    private ViewPager mPager;
    private Tab tab;
    
    private ValuesManager valores;
    
    public static final int ITEM_ADMISIONES = 0;
    public static final int ITEM_CARTERA = 1;
    public static final int ITEM_CAJA = 2;
    public static final int ITEM_CERTIFICADOS = 3;
 
    @Override
    protected void onCreate(Bundle savedInstanceState) {
    	super.onCreate(savedInstanceState);
    	requestWindowFeature(Window.FEATURE_INDETERMINATE_PROGRESS);
        setContentView(R.layout.main_activity);
        setProgressBarIndeterminateVisibility(false);
        
        valores = new ValuesManager(getApplicationContext());
        
        // Activate Navigation Mode Tabs
        mActionBar = getSupportActionBar();
        mActionBar.setNavigationMode(ActionBar.NAVIGATION_MODE_TABS);
 
        // Locate ViewPager in activity_main.xml
        mPager = (ViewPager) findViewById(R.id.pager);
 
        // Activate Fragment Manager
        FragmentManager fm = getSupportFragmentManager();
 
        // Capture ViewPager page swipes
        ViewPager.SimpleOnPageChangeListener ViewPagerListener = 
        		new ViewPager.SimpleOnPageChangeListener() {
            @Override
            public void onPageSelected(int position) {
                super.onPageSelected(position);
                // Find the ViewPager Position
                mActionBar.setSelectedNavigationItem(position);
            }
        };
 
        mPager.setOnPageChangeListener(ViewPagerListener);
        // Locate the adapter class called ViewPagerAdapter.java
        ViewPagerAdapter viewpageradapter = new ViewPagerAdapter(fm, valores);
        // Set the View Pager Adapter into ViewPager
        mPager.setAdapter(viewpageradapter);
        //mPager.setCurrentItem(1);
 
        // Capture tab button clicks
        ActionBar.TabListener tabListener = new ActionBar.TabListener() {
 
            @Override
            public void onTabSelected(Tab tab, FragmentTransaction ft) {
                // Pass the position on tab click to ViewPager
                mPager.setCurrentItem(tab.getPosition());
            }
 
            @Override
            public void onTabUnselected(Tab tab, FragmentTransaction ft) {
            	
            }
 
            @Override
            public void onTabReselected(Tab tab, FragmentTransaction ft) {
                // TODO Auto-generated method stub
            }
        };
 
        // Create first Tab
        String name = getResources().getString(R.string.admisiones);
        tab = mActionBar.newTab().setText(name).setTabListener(tabListener);
        mActionBar.addTab(tab);
 
        // Create second Tab
        name = getResources().getString(R.string.cartera);
        tab = mActionBar.newTab().setText(name).setTabListener(tabListener);
        mActionBar.addTab(tab);
 
        // Create third Tab
        name = getResources().getString(R.string.caja);
        tab = mActionBar.newTab().setText(name).setTabListener(tabListener);
        mActionBar.addTab(tab);
        
        // Create fourth Tab
        name = getResources().getString(R.string.certificados);
        tab = mActionBar.newTab().setText(name).setTabListener(tabListener);
        mActionBar.addTab(tab);
        
        /*if (isOnline()) {
        	Toast.makeText(getApplicationContext(), "Online",Toast.LENGTH_LONG)
        																.show();
        }
        else {
        	Toast.makeText(getApplicationContext(), "Offline",Toast.LENGTH_LONG)
        																.show();
        }*/
    }
    
    @Override
    public void onBackPressed() {
    	AlertDialog.Builder alert = new AlertDialog.Builder(this);
    	alert.setTitle(getResources().getString(R.string.titulo_alerta_salir));
    	alert.setMessage(getResources().getString(
    											R.string.mensaje_alerta_salir));
    	alert.setPositiveButton(getResources().getString(R.string.alerta_salir),
    									new DialogInterface.OnClickListener() {
    		public void onClick(DialogInterface dialog,int id) {
    			finish();
    			//Intent intent = new Intent(getApplicationContext(),
    					//WelcomeActivity.class);
    			//intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
    			//intent.putExtra("EXIT", true);
    			//startActivity(intent);
			}
    	});
    	alert.setNegativeButton(getResources().getString(
    												R.string.alerta_cancelar),
    							new DialogInterface.OnClickListener() {
			public void onClick(DialogInterface dialog,int id) {
				dialog.cancel();
			}
		});
    	AlertDialog alertDialog = alert.create();
		alertDialog.show();
    }
    
    public boolean isOnline() {
        ConnectivityManager cm =
            (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        return cm.getActiveNetworkInfo() != null && 
           cm.getActiveNetworkInfo().isConnectedOrConnecting();
    }
    
    public void alertarSinRed() {
    	new AlertDialog.Builder(this)
    		.setTitle(getResources().getString(R.string.titulo_alerta_conexion))
    		.setMessage(getResources().getString(
    										  R.string.mensaje_alerta_conexion))
    		.setNeutralButton(getResources().getString(
    									  R.string.boton_alerta_conexion), null)
    		.show();
    }
    
    public void onClickPedirAdm(View v)
    {
    	ViewPagerAdapter viewPager = (ViewPagerAdapter)mPager.getAdapter();
    	AdmisionesFragment admisiones = (AdmisionesFragment)viewPager.getItem(
    														ITEM_ADMISIONES);
    	admisiones.onClickPedir();
    }
    
    public void onClickPedirCart(View v)
    {
    	ViewPagerAdapter viewPager = (ViewPagerAdapter)mPager.getAdapter();
    	CarteraFragment cartera = (CarteraFragment)viewPager.getItem(
    															 ITEM_CARTERA);
    	cartera.onClickPedir();
    }
    
    public void onClickPedirCaja(View v)
    {
    	ViewPagerAdapter viewPager = (ViewPagerAdapter)mPager.getAdapter();
    	CajaFragment caja = (CajaFragment)viewPager.getItem(ITEM_CAJA);
    	caja.onClickPedir();
    }
    
    public void onClickPedirCert(View v)
    {
    	ViewPagerAdapter viewPager = (ViewPagerAdapter)mPager.getAdapter();
    	CertificadosFragment certificados = (CertificadosFragment)viewPager.
    												getItem(ITEM_CERTIFICADOS);
    	certificados.onClickPedir();
    }
 
}