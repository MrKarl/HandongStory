package com.example.hgustory;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;
import org.apache.http.util.EntityUtils;

import android.util.Log;

public class MySql {
	public static boolean setLogin(String id, String pw){
		/*
		String url = "http://54.238.208.62/login.php";
        HttpClient client = new DefaultHttpClient();
        try { 
        	HttpPost request = new HttpPost(url);
            // ������ ������ �Ķ���� ����   
            List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
            nameValuePairs.add(new BasicNameValuePair("id", "phw1"));
            nameValuePairs.add(new BasicNameValuePair("password", "qkrvksrl1"));
   
            //     ����ð��� 5�ʰ� ������ timeout ó���Ϸ��� �Ʒ� �ڵ��� Ŀ��Ʈ�� Ǯ�� �����Ѵ�.
            HttpParams params = client.getParams();
			HttpConnectionParams.setConnectionTimeout(params, 5000);
			HttpConnectionParams.setSoTimeout(params, 5000);

            // HTTP�� ���� ������ ��û�� �����Ѵ�.
            // ��û�� ���Ѱ���� responseHandler�� handleResponse()�޼��尡 ȣ��Ǿ� ó���Ѵ�.
            // ������ ���޵Ǵ� �Ķ���Ͱ��� ���ڵ��ϱ����� UrlEncodedFormEntity() �޼��带 ����Ѵ�.
            
            UrlEncodedFormEntity ent = new UrlEncodedFormEntity(nameValuePairs, "UTF-8");
            request.setEntity(ent);
            HttpResponse responsePOST = client.execute(request);
            HttpEntity resEntity = responsePOST.getEntity();
            
            Log.i("respons1", responsePOST.toString());
            Log.i("response2", resEntity.toString());
            Log.d("response33", EntityUtils.toString(resEntity));
            
            if(resEntity.equals("User Found")){
            	Log.d("msg","here1");
            	return true;
            }else{
            	Log.d("msg","here2");
            	return false;
            }
            	
            //Log.i("RESPONSE", EntityUtils.toString(resEntity));               
            
            
            
       }catch(Exception e){
    	   Log.d("msg","e");
    	   e.printStackTrace();
       }
        Log.d("msg","here2");
        */
		return false;
		
	}
	
}
