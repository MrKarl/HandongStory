package com.example.hgustory;

import java.io.IOException;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;
import java.util.Scanner;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

public class AddTeam extends Activity {
	
	private Button confirmBtn;
	private EditText teamNameText;
	private int open = 1995;
	private int curYear;
	
	private List<String> spYear = new ArrayList<String> ();
	
	private String selectedYear;
	private String teamName = "";
	private String id;

	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
	    super.onCreate(savedInstanceState);
	    setContentView(R.layout.addteamview);
	    
	    Intent intent = getIntent();
	    id = intent.getExtras().getString("id");
	    
	    Calendar cur_time = Calendar.getInstance(); 
	    curYear = cur_time.get(Calendar.YEAR);
	    
	    confirmBtn = (Button)findViewById(R.id.teamConfirm);
	    teamNameText = (EditText)findViewById(R.id.teamNameEditText);
	    Spinner sp = (Spinner) this.findViewById(R.id.yearSpinner);
	    
	    for(int i=curYear; i>=open ; i--){
	    	String s = String.valueOf(i);
	    	spYear.add(s);
	    }
	    ArrayAdapter<String> adapter = new ArrayAdapter <String> (this, android.R.layout.simple_spinner_dropdown_item, spYear);	
	    sp.setPrompt("해당년도를 선택하세요");
	    sp.setAdapter(adapter);
	    sp.setOnItemSelectedListener(new OnItemSelectedListener(){

			public void onItemSelected(AdapterView<?> parent, View v,
					int position, long id) {
				// TODO Auto-generated method stub
				TextView tv = (TextView)v;
				selectedYear = tv.getText().toString();		
			}

			public void onNothingSelected(AdapterView<?> arg0) {
				// TODO Auto-generated method stub
				selectedYear = Integer.toString(curYear);
			}	
	    });
	    
	    
	    confirmBtn.setOnClickListener(new OnClickListener(){

			public void onClick(View v) {
				// TODO Auto-generated method stub
				//Intent i = getIntent();
				if(teamNameText.getText().toString().equals("")){
					Toast t = Toast.makeText(getApplicationContext(), "팀이름을 입력해주세요", Toast.LENGTH_LONG);
					t.show();
				}else{
	
					
					
					teamName = teamNameText.getText().toString();
					//i.putExtra("team_name", teamName);
					//setResult(RESULT_OK, i);
					
					
					postdata();
					//finish();
				}
			}
	    });
	    // TODO Auto-generated method stub
	}
	
	public void postdata(){
		final Map<String, String> params= new HashMap<String, String>();
		
		params.put("id", id);
		params.put("prof", teamName);
		params.put("year", selectedYear);
		
		new Thread(){
			
	        public void run() {
	        	String url = "http://54.238.208.62/auth/setprofyear";
                    
                URL posturl = null;
                try {
                	posturl = new URL(url);
                } catch (MalformedURLException e) {
                    throw new IllegalArgumentException("invalid url: " + posturl);
                }
                StringBuilder bodyBuilder = new StringBuilder();
                Iterator<Entry<String, String>> iterator = params.entrySet().iterator();
                // constructs the POST body using the parameters
                while (iterator.hasNext()) {
                    Entry<String, String> param = iterator.next();
                    bodyBuilder.append(param.getKey()).append('=')
                            .append(param.getValue());
                    if (iterator.hasNext()) {
                        bodyBuilder.append('&');
                    }
                }
                String body = bodyBuilder.toString();
                Log.v("msg", "Posting '" + body + "' to " + posturl);
                byte[] bytes = body.getBytes();
                HttpURLConnection conn = null;
                try {
                    Log.e("URL", "> " + posturl);
                    conn = (HttpURLConnection) posturl.openConnection();
                    conn.setDoOutput(true);
                    conn.setUseCaches(false);
                    conn.setFixedLengthStreamingMode(bytes.length);
                    conn.setRequestMethod("POST");
                    conn.setRequestProperty("Content-Type",
                            "application/x-www-form-urlencoded;charset=UTF-8");
                    // post the request
                    OutputStream out = conn.getOutputStream();
                    out.write(bytes);
                    out.close();
                    
                    
                    // handle the response
                    //build the string to store the response text from the server
                    String response= "";
              
                    //start listening to the stream
                    Scanner inStream = new Scanner(conn.getInputStream());
                    //process the stream and store it in StringBuilder
                    while(inStream.hasNextLine())
                  	response+=(inStream.nextLine());
                    Log.i("PROJECTCARUSO","response: -" + response+"-.");
                    
                    
                    if(response.equals("1")){
                    	Intent i = getIntent();
                    	setResult(RESULT_OK, i);
                  	    finish();
                    }else{
//                	    Toast.makeText(Register.this, "같은 아이디가 존재합니다. 다른 아이디를 입력해주세요.",Toast.LENGTH_SHORT).show(); 
                    }
                    
                    int status = conn.getResponseCode();
                    if (status != 200) {
                      throw new IOException("Post failed with error code " + status);
                    }
                } catch (IOException e) {
                	Toast.makeText(AddTeam.this, "네트워크 상태 및 서버 상태가 좋지않습니다. 다시 시도해주세요.",Toast.LENGTH_SHORT).show();
                	e.printStackTrace();
				} finally {
                    if (conn != null) {
                        conn.disconnect();
                    }
                }
	        }	
	        
	    }.start();	    
	    
//	    Intent intent = new Intent(Login.this, MainView.class);
//        startActivity(intent);
	    
	}

}
