package com.app.trackschool;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import androidx.appcompat.app.AppCompatActivity;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;


public class ForgotPassActivity extends AppCompatActivity {

    private EditText phoneAndOtp,pass,cnfpass;
    private Button sendAndVerify,resetPass;
    private TextView head, back;
    private Animation shakeAnimation;
    private boolean isPhoneEntered = false, mVerificationInProgress = false, passOpen = false, doubleBackToExitPressedOnce = false;
    private RelativeLayout forgPass, otply;
    private ProgressDialog progressDialog;
    private String phoneNumber;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forgot_pass);

        phoneAndOtp = findViewById(R.id.otpFP);
        pass = findViewById(R.id.passFP);
        cnfpass = findViewById(R.id.cnfpassFP);
        resetPass = findViewById(R.id.resetButtonFP);
        sendAndVerify = findViewById(R.id.verifybtnFP);
        head = findViewById(R.id.headingFP);
        back = findViewById(R.id.backFP);
        forgPass = findViewById(R.id.forgPassLYFP);
        otply = findViewById(R.id.otpverifylayoutFP);
        shakeAnimation = AnimationUtils.loadAnimation(this, R.anim.shake_animation);

        forgPass.setVisibility(View.GONE);
        head.setText("Verify Phone");
        phoneAndOtp.setHint("Registered Phone");

        sendAndVerify.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(phoneAndOtp.getText().toString().length() == 10){
                    isPhoneEntered = true;
                    phoneNumber = phoneAndOtp.getText().toString().trim();
                }else{
                    isPhoneEntered = false;
                }
                if(isPhoneEntered && !mVerificationInProgress){
                    //sendOTP();
                    phoneAndOtp.setHint("OTP");
                    phoneAndOtp.setText("");
                    head.setText("Verify OTP");
                }
                else if(mVerificationInProgress){
                    //verifyotp();
                }
            }
        });

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });

        validatePassCnfpass();

        resetPass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String password = pass.getText().toString();
                String cnfpassword = cnfpass.getText().toString();

                if(password.length() < 6){
                    pass.setError("Length should be at least 6");
                    return;
                }
                if(!password.equals(cnfpassword)){
                    pass.setError("Password didn't match");
                    cnfpass.setError("Password didn't match");
                    return;
                }
                progressDialog = ProgressDialog.show(ForgotPassActivity.this, "",
                        "Please wait...", true);
                progressDialog.setCancelable(false);
                progressDialog.show();

            }
        });
    }



    @Override
    public void onBackPressed() {

        if(passOpen){
            if (doubleBackToExitPressedOnce) {
                super.onBackPressed();
                startActivity(new Intent(ForgotPassActivity.this , UserLogin.class));
                finish();
                return;
            }
            Toast.makeText(this, "Please BACK again to exit", Toast.LENGTH_SHORT).show();
            doubleBackToExitPressedOnce = true;
            new Handler().postDelayed(new Runnable() {

                @Override
                public void run() {
                    doubleBackToExitPressedOnce=false;
                }
            }, 2000);
        }
        if(mVerificationInProgress){
            mVerificationInProgress = false;
            phoneAndOtp.setText("");
            phoneAndOtp.setHint("Registered Phone");
            phoneAndOtp.setText(phoneNumber);
            head.setText("Verify Phone");
            return;
        }
        startActivity(new Intent(ForgotPassActivity.this , UserLogin.class));
        finish();
    }

    private void validatePassCnfpass(){
        cnfpass.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {

            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                if(!cnfpass.getText().toString().trim().equals(pass.getText().toString().trim())){
                    cnfpass.setError("Password didn't match");
                    pass.setError("Password didn't match");
                }else{
                    pass.setError(null);
                }

            }

            @Override
            public void afterTextChanged(Editable s) {

            }
        });
        pass.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {

            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
            }

            @Override
            public void afterTextChanged(Editable s) {

            }
        });
    }
}
