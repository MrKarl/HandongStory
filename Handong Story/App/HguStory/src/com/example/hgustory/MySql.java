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
            // 서버에 전달할 파라메터 세팅   
            List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
            nameValuePairs.add(new BasicNameValuePair("id", "phw1"));
            nameValuePairs.add(new BasicNameValuePair("password", "qkrvksrl1"));
   
            //     응답시간이 5초가 넘으면 timeout 처리하려면 아래 코드의 커맨트를 풀고 실행한다.
            HttpParams params = client.getParams();
			HttpConnectionParams.setConnectionTimeout(params, 5000);
			HttpConnectionParams.setSoTimeout(params, 5000);

            // HTTP를 통해 서버에 요청을 전달한다.
            // 요청에 대한결과는 responseHandler의 handleResponse()메서드가 호출되어 처리한다.
            // 서버에 전달되는 파라메터값을 인코딩하기위해 UrlEncodedFormEntity() 메서드를 사용한다.
            
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
