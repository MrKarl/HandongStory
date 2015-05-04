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
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager.NameNotFoundException;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Login extends Activity {

	private String version;

	private int cur_day;

	private boolean isInternetOk = true;
	private ProgressDialog progDialog;

	private EditText idText;
	private EditText pwText;

	private String id = "";
	private String pw = "";

	private Button loginBt;
	private Button registerBt;

	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.login);

		idText = (EditText) findViewById(R.id.editText_id_input);
		pwText = (EditText) findViewById(R.id.editText_pw_input);

		loginBt = (Button) findViewById(R.id.login);
		registerBt = (Button) findViewById(R.id.register);

		try {
			Context context = getApplicationContext();
			PackageInfo i = context.getPackageManager().getPackageInfo(
					context.getPackageName(), 0);
			version = i.versionName;
		} catch (NameNotFoundException e) {
			Log.e("Error", "Version unmatched");
		}

		loginBt.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				// TODO Auto-generated method stub

				ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
				AlertDialog.Builder netConDlgBuilder = Test
						.networkConnectivityTest(cm, Login.this);
				// 자동로그인 추가..........
				if (netConDlgBuilder == null) {
				}

				id = idText.getText().toString();

				pw = pwText.getText().toString();
				postdata();

				/*
				 * Intent intent = new Intent(Login.this, MainViewer.class);
				 * intent.putExtra("id", id); startActivity(intent);
				 */

			}

		});
		registerBt.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent intent = new Intent(Login.this, Register.class);
				startActivityForResult(intent, 1);
			}

		});
		// TODO Auto-generated method stub

	}

	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		if (resultCode == RESULT_OK) // 액티비티가 정상적으로 종료되었을 경우
		{
			if (requestCode == 1) {
				finish();
			}
		}
	}

	public void postdata() {
		final Map<String, String> params = new HashMap<String, String>();

		params.put("id", id);
		params.put("pw", pw);

		new Thread() {

			public void run() {
				String url = "http://54.238.208.62/auth/login";

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
					String response = "";

					// start listening to the stream
					Scanner inStream = new Scanner(conn.getInputStream());
					// process the stream and store it in StringBuilder
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

						Intent intent = new Intent(Login.this, MainViewer.class);
						intent.putExtra("id", id);
						startActivity(intent);
						finish();
					} else {
						// Toast.makeText(Register.this,
						// "같은 아이디가 존재합니다. 다른 아이디를 입력해주세요.",Toast.LENGTH_SHORT).show();
					}

					int status = conn.getResponseCode();
					if (status != 200) {
						throw new IOException("Post failed with error code "
								+ status);
					}
				} catch (IOException e) {
					Toast.makeText(Login.this,
							"네트워크 상태 및 서버 상태가 좋지않습니다. 다시 시도해주세요.",
							Toast.LENGTH_SHORT).show();
					e.printStackTrace();
				} finally {
					if (conn != null) {
						conn.disconnect();
					}
				}
			}

		}.start();

		// Intent intent = new Intent(Login.this, MainView.class);
		// startActivity(intent);

	}

}
