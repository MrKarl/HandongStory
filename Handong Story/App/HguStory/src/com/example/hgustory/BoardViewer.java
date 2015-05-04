package com.example.hgustory;

import android.app.Activity;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.webkit.ValueCallback;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class BoardViewer extends Activity {
	WebView wv;
	private ValueCallback<Uri> mUploadMessage;
	private String url;
	/** Called when the activity is first created. */
	@SuppressWarnings("deprecation")
	@Override
	public void onCreate(Bundle savedInstanceState) {
	    super.onCreate(savedInstanceState);
	    setContentView(R.layout.boardwebview);
	    
	    Intent i = getIntent();
	    url = i.getExtras().getString("url");
	    wv = (WebView)findViewById(R.id.boardWebView1);
	    wv.setVerticalScrollBarEnabled(false);
	    wv.setHorizontalScrollBarEnabled(false);   
	    wv.getSettings().setJavaScriptEnabled(true); 
	    wv.getSettings().setPluginsEnabled(true);
	    wv.loadUrl(url); 
	     
	    wv.setWebViewClient(new WebViewClient(){
	    	public boolean shouldOverrideUrlLoading(WebView view, String url)
	        {
	    		view.loadUrl(url);
	    		return true;
	        }
	    });
	    
	    wv.setWebChromeClient(new WebChromeClient(){  
/*
	        public void openFileChooser(ValueCallback<Uri> uploadMsg) { 
	            mUploadMessage = uploadMsg;  
	            Intent i = new Intent(Intent.ACTION_GET_CONTENT);  
	            i.addCategory(Intent.CATEGORY_OPENABLE);  
	            i.setType("image/*");  
	            BoardViewer.this.startActivityForResult(Intent.createChooser(i,"File Chooser"), 1);  
	        }
	*/
	        public void openFileChooser( ValueCallback uploadMsg, String acceptType ) {
	           mUploadMessage = uploadMsg;
	           Intent i = new Intent(Intent.ACTION_GET_CONTENT);
	           i.addCategory(Intent.CATEGORY_OPENABLE);
	           i.setType("*/*");
	           BoardViewer.this.startActivityForResult(
	           Intent.createChooser(i, "File Browser"),
	           1);
	        }
	        public void openFileChooser(ValueCallback<Uri> uploadMsg, String acceptType, String capture){
	               mUploadMessage = uploadMsg;  
	               Intent i = new Intent(Intent.ACTION_GET_CONTENT);  
	               i.addCategory(Intent.CATEGORY_OPENABLE);  
	               i.setType("image/*");  
	               BoardViewer.this.startActivityForResult( Intent.createChooser( i, "File Chooser" ), 1 );
	
	        }
	    });
	    // TODO Auto-generated method stub
	}

}
