package com.example.hgustory;

import java.io.IOException;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;
import java.util.Scanner;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.View.OnTouchListener;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.TranslateAnimation;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.example.sideanimation.CloseAnimation;
import com.example.sideanimation.OpenAnimation;

public class MainViewer extends Activity {
	private List<TeamInfo> datas = new ArrayList<TeamInfo>();

	private String id;
	private UserInfo curUser;

	private HorizontialListView listview;
	private Button addBtn;
	private float xDistance, yDistance, lastX, lastY;
	
	private String url;
	
	/* slide menu */
	private DisplayMetrics metrics;
	private LinearLayout ll_mainLayout;
	private LinearLayout ll_menuLayout;
	private FrameLayout.LayoutParams leftMenuLayoutPrams;
	private int leftMenuWidth;
	private static boolean isLeftExpanded;
	private Button btn1, btn2, btn3, btn4, btn5, btn6, btn7;
	private ImageButton sideBtn;
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
	    super.onCreate(savedInstanceState); 
	   	    
	    setContentView(R.layout.main);
	    // TODO Auto-generated method stub
	    
	    Intent intent = getIntent();
	    id = intent.getExtras().getString("id");
	    
	    initSildeMenu();
	    listview = (HorizontialListView) findViewById(R.id.listview);
	    getdata();
	    
        listview.setAdapter(mAdapter);
        listview.setOnItemClickListener(new OnItemClickListener(){

			public void onItemClick(AdapterView<?> parent, View v, int position,
					long id) {
				// TODO Auto-generated method stub
				url = "http://54.238.208.62/welcome";
				Intent i = new Intent(MainViewer.this,BoardViewer.class);
				i.putExtra("url",url);
				startActivity(i);
			}
        });
        
        addBtn = (Button)findViewById(R.id.addTeam);
        
        addBtn.setOnClickListener(new OnClickListener(){
			public void onClick(View arg0) {
				// TODO Auto-generated method stub
				Intent i = new Intent(MainViewer.this,AddTeam.class);
				i.putExtra("id", id);
				startActivityForResult(i, 1);
			}  	
        });
        
	    // TODO Auto-generated method stub
	}
	protected void onActivityResult(int requestCode, int resultCode, Intent data){
		super.onActivityResult(requestCode, resultCode, data);
		if(resultCode==RESULT_OK) // 액티비티가 정상적으로 종료되었을 경우
		{
			if(requestCode==1)
			{
				getdata();
				listview.setAdapter(mAdapter);
			}
		}
	}
	
      
    private BaseAdapter mAdapter = new BaseAdapter() {

        public int getCount() {
        	Log.d("here",""+datas.size());
            return datas.size();
        }
  

        public Object getItem(int position) {
            return null;  
        }
  

        public long getItemId(int position) {
            return 0;
        }
  
        public View getView(int position, View convertView, ViewGroup parent) {  
            View retval = LayoutInflater.from(parent.getContext()).inflate(R.layout.mainitems, null);  
            TextView title = (TextView) retval.findViewById(R.id.teanName1);  
            title.setText(datas.get(position).getTeamYear()+"년도 "+datas.get(position).getTeamProf()+"교수님팀");  
              
            return retval;
        }
    };
    
    private void initSildeMenu() {

		// init left menu width
    	metrics = new DisplayMetrics();
		getWindowManager().getDefaultDisplay().getMetrics(metrics);
		leftMenuWidth = (int) ((metrics.widthPixels) * 0.75);

		// init main view
		ll_mainLayout = (LinearLayout) findViewById(R.id.ll_mainlayout);

		// init left menu
		ll_menuLayout = (LinearLayout) findViewById(R.id.ll_menuLayout);
		leftMenuLayoutPrams = (FrameLayout.LayoutParams) ll_menuLayout
				.getLayoutParams();
		leftMenuLayoutPrams.width = leftMenuWidth;
		ll_menuLayout.setLayoutParams(leftMenuLayoutPrams);

		// init ui
		sideBtn = (ImageButton) findViewById(R.id.sideMenuBtn1);
		sideBtn.setOnClickListener(new OnClickListener(){
			public void onClick(View arg0) {
				// TODO Auto-generated method stub
				menuLeftSlideAnimationToggle();
			}
		});

		btn1 = (Button) findViewById(R.id.btn1);
		btn2 = (Button) findViewById(R.id.btn2);
		btn3 = (Button) findViewById(R.id.btn3);
		btn4 = (Button) findViewById(R.id.btn4);
		btn5 = (Button) findViewById(R.id.btn5);
		btn6 = (Button) findViewById(R.id.btn6);
		btn7 = (Button) findViewById(R.id.btn7);
		
		btn3.setOnClickListener(new OnClickListener(){

			public void onClick(View arg0) {
				// TODO Auto-generated method stub\
				url = "http://54.238.208.62/board";
				Intent i = new Intent(MainViewer.this,BoardViewer.class);
				i.putExtra("url",url);
				startActivity(i);
			}
		});
		btn4.setOnClickListener(new OnClickListener(){

			public void onClick(View arg0) {
				// TODO Auto-generated method stub\
				url = "http://54.238.208.62/teamcc";
				Intent i = new Intent(MainViewer.this,BoardViewer.class);
				i.putExtra("url",url);
				startActivity(i);
			}
		});
		btn6.setOnClickListener(new OnClickListener(){

			public void onClick(View arg0) {
				// TODO Auto-generated method stub\
				url = "http://54.238.208.62/";
				Intent i = new Intent(MainViewer.this,BoardViewer.class);
				i.putExtra("url",url);
				startActivity(i);
			}
		});
		//btn2.setOnClickListener(this);
		//btn3.setOnClickListener(this);
		//btn4.setOnClickListener(this);
		//btn5.setOnClickListener(this);
		//btn6.setOnClickListener(this);
		//btn7.setOnClickListener(this);
		
	}

	/**
	 * left menu toggle
	 */
	private void menuLeftSlideAnimationToggle() {

		if (!isLeftExpanded) {

			isLeftExpanded = true;

			// Expand
			new OpenAnimation(ll_mainLayout, leftMenuWidth,
					Animation.RELATIVE_TO_SELF, 0.0f,
					Animation.RELATIVE_TO_SELF, 0.75f, 0, 0.0f, 0, 0.0f);

			// disable all of main view
			FrameLayout viewGroup = (FrameLayout) findViewById(R.id.ll_fragment).getParent();
			enableDisableViewGroup(viewGroup, false);

			// enable empty view
			((LinearLayout) findViewById(R.id.ll_empty))
					.setVisibility(View.VISIBLE);

			findViewById(R.id.ll_empty).setEnabled(true);
			findViewById(R.id.ll_empty).setOnTouchListener(
					new OnTouchListener() {

						public boolean onTouch(View arg0, MotionEvent arg1) {
							menuLeftSlideAnimationToggle();
							return true;
						}
					});

		} else {
			isLeftExpanded = false;

			// close
			new CloseAnimation(ll_mainLayout, leftMenuWidth,
					TranslateAnimation.RELATIVE_TO_SELF, 0.75f,
					TranslateAnimation.RELATIVE_TO_SELF, 0.0f, 0, 0.0f, 0, 0.0f);

			// enable all of main view
			FrameLayout viewGroup = (FrameLayout) findViewById(R.id.ll_fragment)
					.getParent();
			enableDisableViewGroup(viewGroup, true);

			// disable empty view
			((LinearLayout) findViewById(R.id.ll_empty))
					.setVisibility(View.GONE);
			findViewById(R.id.ll_empty).setEnabled(false);

		}
	}

	/**
	 * 
	 * 
	 * @param viewGroup
	 * @param enabled
	 */
	public static void enableDisableViewGroup(ViewGroup viewGroup,boolean enabled) {
		int childCount = viewGroup.getChildCount();
		for (int i = 0; i < childCount; i++) {
			View view = viewGroup.getChildAt(i);
			if (view.getId() != R.id.sideMenuBtn1) {
				view.setEnabled(enabled);
				if (view instanceof ViewGroup) {
					enableDisableViewGroup((ViewGroup) view, enabled);
				}
			}
		}
	}
	
	public void getdata(){
		final Map<String, String> params= new HashMap<String, String>();
		
		params.put("id", id);
		
		new Thread(){
			
	        public void run() {
	        	String url = "http://54.238.208.62/auth/getprofyear";
                    
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
                    
                    String resultStr = "";
                    
                    JSONArray jArr = new JSONArray(response);
                    Log.d("prof",""+jArr.length());
                    datas.clear();
                    for(int i = 0; i < jArr.length(); i++){
                    	JSONObject jObj = jArr.getJSONObject(i);
                    	String id = jObj.getString("id");
                    	String prof = jObj.getString("prof");
                    	
                    	String year = jObj.getString("year");
                    	
                    	Log.d("prof",prof);
                    	Log.d("year",year);
                    	datas.add(new TeamInfo(year,prof,id));
                    }
                   
                    /*datas.add("성금영교수님팀");
					    datas.add("박현우");
					    datas.add("박판기");
					    datas.add("박");
					    datas.add("판");
					    datas.add("기");
					    */
                    
                    int status = conn.getResponseCode();
                    if (status != 200) {
                      throw new IOException("Post failed with error code " + status);
                    }
                } catch (IOException e) {
                	Toast.makeText(MainViewer.this, "네트워크 상태 및 서버 상태가 좋지않습니다. 다시 시도해주세요.",Toast.LENGTH_SHORT).show();
                	e.printStackTrace();
                } catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				} finally {
                    
                    Message msg = handler.obtainMessage();
					msg.obj = "end";
					handler.sendMessage(msg);
                    
                }
	        }	
	        
	    }.start();	    
	    
//	    Intent intent = new Intent(Login.this, MainView.class);
//        startActivity(intent);
	    
	}
	private Handler handler = new Handler() {

		//Thread상에서 보내는 Message를 다루는 method override
		@Override
		public void handleMessage(Message msg) {
			String loginmsg = (String) msg.obj;
			if (loginmsg.equals("end")) {
				listview.setAdapter(mAdapter);
			
			//exception handling 해줄 것
			}else if (loginmsg.equals("Network_unconnected")) {
			}
		}
	};
}
