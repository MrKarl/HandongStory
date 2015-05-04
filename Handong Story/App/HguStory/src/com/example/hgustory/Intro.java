package com.example.hgustory;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;

public class Intro extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.intro);
		Handler mHandler = new Handler();
		mHandler.postDelayed(new Runnable(){
			public void run(){
				Intent intent = new Intent(Intro.this,Login.class);
				startActivity(intent);
				
				finish();;
			}
		}, 1500);
	}

}
