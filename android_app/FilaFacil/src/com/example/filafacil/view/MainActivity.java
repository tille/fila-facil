package com.example.filafacil.view;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.net.ConnectivityManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.view.ViewPager;
import android.util.Log;
import android.view.View;
import android.widget.Toast;
import com.actionbarsherlock.view.Menu;
import com.actionbarsherlock.view.MenuItem;
import com.actionbarsherlock.app.ActionBar;
import com.actionbarsherlock.app.ActionBar.Tab;
import com.actionbarsherlock.app.SherlockFragmentActivity;
import com.actionbarsherlock.view.Window;
import com.example.filafacil.R;
import com.example.filafacil.controllers.BoardControl;
import com.example.filafacil.helpers.GCMMain;
import com.example.filafacil.helpers.ValuesManager;
 
public class MainActivity extends SherlockFragmentActivity {
 
    // Declare Variables
    private ActionBar mActionBar;
    private ViewPager mPager;
    private Tab tab;
    private ViewPagerAdapter viewpageradapter;
    
    private ValuesManager valores;
    
    public static final int ITEM_ADMISIONES = 0;
    public static final int ITEM_CARTERA = 1;
    public static final int ITEM_CAJA = 2;
    public static final int ITEM_CERTIFICADOS = 3;
    
    private BoardControl boardControl;
 
    @Override
    protected void onCreate(Bundle savedInstanceState) {
    	super.onCreate(savedInstanceState);
    	requestWindowFeature(Window.FEATURE_INDETERMINATE_PROGRESS);
        setContentView(R.layout.main_activity);
        setProgressBarIndeterminateVisibility(false);
        
        valores = new ValuesManager(getApplicationContext());
        
        boardControl = new BoardControl(getApplicationContext());
        
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
         
        viewpageradapter = new ViewPagerAdapter(fm);
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
        
        
        //Registro mi dispositivo en el GMC server
        GCMMain gcm = new GCMMain(MainActivity.this);
        gcm.comprobar();
        gcm.registrar();
        
        if (valores.getString(ValuesManager.DEVICE_KEY_TAG) == null) {
        	
        }
        else {
        //Pido que me pusheen la información
        boardControl.post(this, valores.getString(ValuesManager.DEVICE_KEY_TAG),
        		"all");
        }
        
        //Corro la parte de actualizar el board
        //boardControl.post(getThis());
    }
    
    @Override
	public void onDestroy() {
	    super.onDestroy();
	    /*if (async != null) async.cancel(true);
	    async = null;*/
	    Log.d("CONSOLA", "OnDestroy de MainActivity");
	}
    
    /*class AsyncTaskRunnable extends AsyncTask<String, Float, Integer>{
		protected synchronized Integer doInBackground(String...urls) {
			try{
				//Thread.sleep(5000);
				boardControl.post(getThis());
				return 1;
			}
			catch(Exception e) {
				e.printStackTrace();
				return 0;
			}
		}
		
		protected void onPostExecute(Integer bytes) {
			//async = new AsyncTaskRunnable();
			//async.execute();
        }
	}*/
    
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
    	super.onCreateOptionsMenu(menu);
    	menu.add(1, 1, Menu.FIRST, getResources().getString(R.string.limpiar));
    	menu.add(1, 2, Menu.FIRST+1, getResources()
    			.getString(R.string.alerta_salir));
    	return true;
    }
    
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
    	switch(item.getItemId()) {
    		case 1:
    			valores.limpiar();
    			return true;
    		case 2:
    			onBackPressed();
    			return true;
    	}
    	return super.onOptionsItemSelected(item);
    }
    
    @Override
    public void onBackPressed() {
    	AlertDialog.Builder alert = new AlertDialog.Builder(this);
    	alert.setTitle(getResources().getString(R.string.titulo_alerta_salir));
    	alert.setMessage(getResources()
    			.getString(R.string.mensaje_alerta_salir));
    	alert.setPositiveButton(getResources().getString(R.string.alerta_salir), 
    			new DialogInterface.OnClickListener() {
    		public void onClick(DialogInterface dialog,int id) {
    			finish();
			}
    	});
    	alert.setNegativeButton(getResources()
    			.getString(R.string.alerta_cancelar), 
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
        return cm.getActiveNetworkInfo() != null && cm.getActiveNetworkInfo()
        		.isConnectedOrConnecting();
    }
    
    public void alertarSinRed() {
    	new AlertDialog.Builder(this)
    		.setTitle(getResources().getString(R.string.titulo_alerta_conexion))
    		.setMessage(getResources()
    				.getString(R.string.mensaje_alerta_conexion))
    		.setNeutralButton(getResources()
    				.getString(R.string.boton_alerta_conexion), null)
    		.show();
    }
    
    public void onClickPedirAdm(View v)
    {
    	ViewPagerAdapter viewPager = (ViewPagerAdapter)mPager.getAdapter();
    	AdmisionesFragment admisiones = (AdmisionesFragment)viewPager
    			.getItem(ITEM_ADMISIONES);
    	admisiones.onClickPedir();
    }
    
    public void onClickPedirCart(View v)
    {
    	ViewPagerAdapter viewPager = (ViewPagerAdapter)mPager.getAdapter();
    	CarteraFragment cartera = (CarteraFragment)viewPager
    			.getItem(ITEM_CARTERA);
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
    	CertificadosFragment certificados = (CertificadosFragment)viewPager
    			.getItem(ITEM_CERTIFICADOS);
    	certificados.onClickPedir();
    }
    
    public void informarTurnoReservado() {
    	setProgressBarIndeterminateVisibility(false);
		Toast.makeText(getApplicationContext(), getResources()
				.getString(R.string.turno_reservado), Toast.LENGTH_LONG).show();
    }

	public ValuesManager getValores() {
		return valores;
	}

	public BoardControl getBoardControl() {
		return boardControl;
	}
	
	public void isMyTurnAlert(String dep) {
    	AlertDialog.Builder builder = new AlertDialog.Builder(this);
    	builder.setMessage(getResources().getString(R.string.mensaje_alerta_miturno) + " en " + dep)
    	        .setTitle(getResources().getString(R.string.alerta_es_mi_turno))
    	        .setCancelable(false)
    	        .setNeutralButton(getResources().getString(R.string.alerta_ok),
    	                new DialogInterface.OnClickListener() {
    	                    public void onClick(DialogInterface dialog, int id) {
    	                        dialog.cancel();
    	                    }
    	                });
    	AlertDialog alert = builder.create();
    	alert.show();
    }
	
	public MainActivity getThis() {
		return this;
	}
}