package com.example.hgustory;

import java.io.IOException;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Map.Entry;
import java.util.Scanner;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.drawable.BitmapDrawable;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.PopupWindow;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

public class Register extends Activity implements
		RadioGroup.OnCheckedChangeListener {

	private int idCheckIndex = 0; // 0 �϶� �ߺ�Ȯ�� ����, 1�϶� id �ߺ�, 2�϶� ���̵� ���̰� ª�ų� ��,
									// 3�϶� ��밡��.
	private int i = 0;

	private EditText nameText;
	private EditText idText;
	private EditText pwText;
	private EditText pw2Text;
	private EditText phoneText;
	private EditText email1Text;
	private EditText email2Text;
	private EditText professorText;
	private EditText majorText;
	private RadioGroup positionGroup;
	private RadioButton positionRadio;

	private Button popup1;
	private Button popup2;
	private PopupWindow popWin;

	private Button confirm;

	private String name = "";
	private String id = "";
	private String pw = "";
	private String ckpw = "";
	private String phone = "";

	private String email = "";
	private String email1 = "";
	private String email2 = "";
	private String prof = "";
	private String major = "";
	private String position = "����";

	
	private String response = "";
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.register);

		nameText = (EditText) findViewById(R.id.namefield); // idfield editText1
		idText = (EditText) findViewById(R.id.idfield); // idfield editText1
		pwText = (EditText) findViewById(R.id.pwfield); // pwfield editText2
		pw2Text = (EditText) findViewById(R.id.pwconfirm); // pwconfirm
															// pwEditText2
		phoneText = (EditText) findViewById(R.id.phonefield);
		email1Text = (EditText) findViewById(R.id.email1);
		email2Text = (EditText) findViewById(R.id.email2);
		professorText = (EditText) findViewById(R.id.professorfield);
		majorText = (EditText) findViewById(R.id.majorfield);
		phoneText = (EditText) findViewById(R.id.phonefield);

		positionGroup = (RadioGroup) findViewById(R.id.positionfield);
		positionRadio = (RadioButton) findViewById(positionGroup
				.getCheckedRadioButtonId());

		positionGroup.setOnCheckedChangeListener(this);

		popup1 = (Button) findViewById(R.id.button2);// �̿��� popup â
		popup2 = (Button) findViewById(R.id.button1);// �������� popup â
		confirm = (Button) findViewById(R.id.button4);

		popup1.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				// ��Ʈ��ũ���� ���߿� xml�� �޾ƿò��ϱ�
				ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
				AlertDialog.Builder netConDlgBuilder = Test
						.networkConnectivityTest(cm, Register.this);

				// ��Ʈ��ũ ������ �Ǿ��ִٸ�
				if (netConDlgBuilder == null) {
					// TODO Auto-generated method stub

					LayoutInflater layoutInflater = (LayoutInflater) getBaseContext()
							.getSystemService(LAYOUT_INFLATER_SERVICE);

					final View popupView = layoutInflater.inflate(
							R.layout.popup1, null);

					popWin = new PopupWindow(popupView, 800, 900);
					popWin.setOutsideTouchable(true);
					popWin.setBackgroundDrawable(new BitmapDrawable());
					popWin.setAnimationStyle(-1);
					popWin.setTouchable(true);
					popWin.showAtLocation(popupView, Gravity.CENTER, 0, 0);
					popupView.setFocusableInTouchMode(true);

					// back key�� popup Window���� �ڵ�
					popWin.getContentView().setOnKeyListener(
							new View.OnKeyListener() {

								public boolean onKey(View v, int keyCode,
										KeyEvent event) {
									// TODO Auto-generated method stub
									Log.d("msg", "back key2");

									if (keyCode == KeyEvent.KEYCODE_BACK) {
										popWin.dismiss();
										return true;
									}
									return false;
								}
							});

				}
				// �˾� ������ ����
				/*
				 * webview1 = (WebView)findViewById(R.id); ���伳�� ����......
				 * findViewById���� layout�� �ٸ��Ƿ� ã���� ���� ���� �õ�
				 * webview1.loadUrl("www.google.com");
				 * webview1.setWebViewClient(new WebViewClient(){ public boolean
				 * shouldOverrideUrlLoading(WebView view, String url) {
				 * view.loadUrl(url); return true; } });
				 */

			}

		});

		popup2.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				// TODO Auto-generated method stub
				// ��Ʈ��ũ���� ���߿� xml�� �޾ƿò��ϱ�
				ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
				AlertDialog.Builder netConDlgBuilder = Test
						.networkConnectivityTest(cm, Register.this);

				// ��Ʈ��ũ ������ �Ǿ��ִٸ�
				if (netConDlgBuilder == null) {
					// TODO Auto-generated method stub

					LayoutInflater layoutInflater = (LayoutInflater) getBaseContext()
							.getSystemService(LAYOUT_INFLATER_SERVICE);

					final View popupView = layoutInflater.inflate(
							R.layout.popup2, null);

					popWin = new PopupWindow(popupView, 800, 900);
					popWin.setOutsideTouchable(true);
					popWin.setBackgroundDrawable(new BitmapDrawable());
					popWin.setAnimationStyle(-1);
					popWin.setTouchable(true);
					popWin.showAtLocation(popupView, Gravity.CENTER, 0, 0);
					popupView.setFocusableInTouchMode(true);

					// back key�� popup Window���� �ڵ�
					popWin.getContentView().setOnKeyListener(
							new View.OnKeyListener() {

								public boolean onKey(View v, int keyCode,
										KeyEvent event) {
									// TODO Auto-generated method stub

									if (keyCode == KeyEvent.KEYCODE_BACK) {
										popWin.dismiss();
										return true;
									}
									return false;
								}
							});

				}
			}
		});

		// idText.setOnFocusChangeListener(new OnFocusChangeListener(){
		//
		// public void onFocusChange(View arg0, boolean arg1) {
		//
		// // TODO Auto-generated method stub
		// id= idText.getText().toString();
		// if(id.equals("")){
		// if(i == 1)
		// tshow("���̵� �Է��� �ּ���");
		// i=1;
		// }else if(id.length() <4 || id.length()>16){
		// tshow("���̵�� 4�̻� 16�� �̸����� �Է��ϼ���");
		// }else{
		// tshow("����ϼŵ� ���� ���̵��Դϴ�.");
		// }
		// }
		//
		// });
		// i=0;
		// pwText.setOnFocusChangeListener(new OnFocusChangeListener(){
		//
		// public void onFocusChange(View arg0, boolean arg1) {
		//
		// // TODO Auto-generated method stub
		// pw= pwText.getText().toString();
		// if(pw.equals("")){
		// if(i == 1)
		// tshow("pw�� �Է��� �ּ���");
		// }else if(pw.length() <6 || pw.length()>16){
		// tshow("pw�� 6�� �̻� 16�� �̸����� �Է��ϼ���");
		// }else{
		// tshow("����ϼŵ� ���� ��й�ȣ�Դϴ�.");
		// }
		// }
		// });
		// i=0;
		// pw2Text.setOnFocusChangeListener(new OnFocusChangeListener(){
		//
		// public void onFocusChange(View arg0, boolean arg1) {
		// // TODO Auto-generated method stub
		// ckpw= pw2Text.getText().toString();
		// if(ckpw.equals("")){
		// if(i == 1)
		// tshow("Ȯ��pw�� �Է��� �ּ���");
		// }else if(ckpw.length() <6 || ckpw.length()>16){
		// tshow("Ȯ��pw�� 6�� �̻� 16�� �̸����� �Է��ϼ���");
		// }else if(!(ckpw.equals(pw))){
		// tshow("��й�ȣ ����ġ");
		// }else{
		// tshow("Ȯ�οϷ�");
		// }
		// }
		// });
		// confirm.setOnClickListener(new OnClickListener(){
		// public void onClick(View arg0) {
		// // if(pw == ckpw){
		// // postdata();
		// // }else{
		// // Toast.makeText(Register.this,
		// "��й�ȣ�� ����ġ�մϴ� �ٽ�Ȯ�����ּ���",Toast.LENGTH_SHORT).show();
		// // }
		//
		// if(id=="" | pw=="" | name=="" | phone=="" | email1=="" | email2=="" |
		// prof=="" | major=="" | position==""){
		// Toast.makeText(Register.this, "���� �Է¾ȵȵ�",Toast.LENGTH_SHORT).show();
		// }else{
		// postdata();
		// }
		// }
		// });
		// nameText.setOnFocusChangeListener(new OnFocusChangeListener(){
		// public void onFocusChange(View arg0, boolean arg1) {
		// // TODO Auto-generated method stub
		// name= nameText.getText().toString();
		// }
		// });
		//
		// phoneText.setOnFocusChangeListener(new OnFocusChangeListener(){
		// public void onFocusChange(View arg0, boolean arg1) {
		// // TODO Auto-generated method stub
		// phone = phoneText.getText().toString();
		// }
		// });
		//
		// email1Text.setOnFocusChangeListener(new OnFocusChangeListener(){
		// public void onFocusChange(View arg0, boolean arg1) {
		// // TODO Auto-generated method stub
		// email1 = email1Text.getText().toString();
		// }
		// });
		// email2Text.setOnFocusChangeListener(new OnFocusChangeListener(){
		// public void onFocusChange(View arg0, boolean arg1) {
		// // TODO Auto-generated method stub
		// email2 = email2Text.getText().toString();
		// }
		// });
		//
		// professorText.setOnFocusChangeListener(new OnFocusChangeListener(){
		// public void onFocusChange(View arg0, boolean arg1) {
		// // TODO Auto-generated method stub
		// prof = professorText.getText().toString();
		// }
		// });
		//
		// majorText.setOnFocusChangeListener(new OnFocusChangeListener(){
		// public void onFocusChange(View arg0, boolean arg1) {
		// // TODO Auto-generated method stub
		// major = majorText.getText().toString();
		// }
		// });
		confirm.setOnClickListener(new OnClickListener() {
			public void onClick(View arg0) {
				id = idText.getText().toString();
				pw = pwText.getText().toString();
				name = nameText.getText().toString();
				phone = phoneText.getText().toString();
				email1 = email1Text.getText().toString();
				email2 = email2Text.getText().toString();
				prof = professorText.getText().toString();
				major = majorText.getText().toString();
				positionRadio = (RadioButton) findViewById(positionGroup
						.getCheckedRadioButtonId());

				Log.d("msg", id + " " + pw + " " + name + " " + phone + " "
						+ email1 + " " + email2 + " " + prof + " " + major
						+ " " + position);

				if (id == "" | pw == "" | name == "" | phone == ""
						| email1 == "" | email2 == "" | prof == ""
						| major == "" | position == "") {
					Toast.makeText(Register.this, "���� �Է� �ȵȵ� �Ͽɴϴ�.",
							Toast.LENGTH_SHORT).show();
				} else {
					postdata();
//					Intent intent = new Intent(Register.this, MainViewer.class);
//					intent.putExtra("id", id);
//					startActivity(intent);
//					Intent i = getIntent();
//					setResult(RESULT_OK, i);
//					finish();
				}
			}
		});

	}

	public void postdata() {
		final Map<String, String> params = new HashMap<String, String>();

		params.put("name", name);
		params.put("id", id);
		params.put("pw", pw);
		params.put("phone", phone);
		params.put("email", email1 + " " + email2);
		params.put("prof", prof);
		params.put("major", major);
		params.put("position", position);

		new Thread() {

			public void run() {
				String url = "http://54.238.208.62/auth/register";

				URL posturl = null;
				try {
					posturl = new URL(url);
				} catch (MalformedURLException e) {
					throw new IllegalArgumentException("invalid url: "
							+ posturl);
				}
				StringBuilder bodyBuilder = new StringBuilder();
				Iterator<Entry<String, String>> iterator = params.entrySet()
						.iterator();
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
					// build the string to store the response text from the
					// server
					

					// start listening to the stream
					Scanner inStream = new Scanner(conn.getInputStream());
					// process the stream and store it in StringBuilder
					response = "";
					while (inStream.hasNextLine())
						response += (inStream.nextLine());
					Log.i("PROJECTCARUSO", "response: -" + response + "-.");

					if (response.equals("1")) {
						SharedPreferences pref = getSharedPreferences("pref",
								MODE_PRIVATE);
						SharedPreferences.Editor prefEditor = pref.edit();

						prefEditor.putString("id", id);
						prefEditor.putString("pw", id);
						prefEditor.commit();

						Intent intent = new Intent(Register.this, Login.class);
						//intent.putExtra("id", id);
						startActivity(intent);
						finish();
					} else {
						// Toast.makeText(Register.this,
						// "���� ���̵� �����մϴ�. �ٸ� ���̵� �Է����ּ���.",Toast.LENGTH_SHORT).show();
					}

					int status = conn.getResponseCode();
					if (status != 200) {
						throw new IOException("Post failed with error code "
								+ status);
					}
				} catch (IOException e) {
					// Toast.makeText(Register.this,
					// "��Ʈ��ũ ���� �� ���� ���°� �����ʽ��ϴ�. �ٽ� �õ����ּ���.",Toast.LENGTH_SHORT).show();
					e.printStackTrace();
				} finally {
					if (conn != null) {
						conn.disconnect();
					}
				}
			}

		}.start();

		// // handle the response
		// //build the string to store the response text from the server
		// String response= "";
		//
		// //start listening to the stream
		// Scanner inStream = new Scanner(conn.getInputStream());
		// //process the stream and store it in StringBuilder
		// while(inStream.hasNextLine())
		// response+=(inStream.nextLine());
		// //Log.i("PROJECTCARUSO","response: " + response);
		//
		// if(response != "TRUE"){
		// Toast.makeText(Register.this,
		// "����� �����Ͽ����ϴ�. �ٽ� �õ����ּ���.",Toast.LENGTH_SHORT).show();
		// //return;
		// }
		// Intent intent = new Intent(Register.this, Login.class);
		// startActivity(intent);

	}

	// pupupopWinindow ����
	@Override
	public void finish() {
		if (popWin != null) {
			if (popWin.isShowing()) {
				popWin.dismiss();
			}
			popWin = null;
			return;
		}
		super.finish();
	}

	public void tshow(String s) {
		Toast t = Toast
				.makeText(getApplicationContext(), s, Toast.LENGTH_SHORT);
		t.show();
	}

	public void onCheckedChanged(RadioGroup group, int checkedId) {
		switch (checkedId) {
		case R.id.position_captain:
			position = "����";
			break;
		case R.id.position_prof:
			position = "������";
			break;
		case R.id.position_member:
			position = "�����";
			break;
		}
	}
}