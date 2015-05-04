package com.example.hgustory;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;


public class Test {
	
	/*private static boolean isOnline(){
		try{
			ConnectivityManager con = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
		}
	}*/
	
	public static AlertDialog.Builder networkConnectivityTest(ConnectivityManager cm, Context con){
		NetworkInfo ni = cm.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
		boolean isWifiCon = ni.isConnected();
		ni = cm.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);
		boolean isMobileCon = ni.isConnected();
		
		if(isWifiCon == false && isMobileCon == false){
			//인터넷체크 알림창 객체 생성
			AlertDialog.Builder builder = new AlertDialog.Builder(con);
			builder.setMessage("Check your Internet.")
			.setCancelable(false)
			.setPositiveButton("Okay", new DialogInterface.OnClickListener() {
				
				public void onClick(DialogInterface dialog, int id) {
					
				}
			});
			AlertDialog dialog = builder.create();    
			dialog.show(); 			// 알림창 객체 생성
			return builder;
		}
		
		return null;
		
	}
}
