<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Mail\OTPEmail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{   

    function userLogin(Request $request){

    //    $result=User::where($request->input())->count();//before
       $result=User::where('email','=',$request->input('email'))
                    ->where('password','=',$request->input('password'))
                    ->select('id')->first();

       // return $result;----akan theke id paici tai id ta tan diye nice niye nici 
       if($result !==null){

       $token=JWTToken::CreateToken($request->input('email'),$result->id);
       return response()->json([
        'status'=>"success",
        'message'=>"Login Successfully",
        // 'token'=>$token
       ],200)->cookie('token',$token,60*60*24);

       }else{
        return response()->json([
            'status'=>"failed",
            'data'=>"unauthorized"
           ],401);

       }
        

    }
    function userRegistration(Request $request){

        try{
            User::create([
            
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'email'=>$request->input('email'),
                'mobile'=>$request->input('mobile'),
                'password'=>$request->input('password')
            ]);
            return response()->json([
                'status'=>'success',             
                'message'=>"registration success "
            ],200);
        }catch(Exception $e){

            return response()->json([
                'status'=>'failed',
               // 'message'=>"Data Insert Failed"
                //'message'=>$e->getMessage()
                'message'=>"Registration Failed Please Try Again"
            ],200);
        }     
       

       
    } 
    
    function sendOtpToEmail(Request $request){

        $email=$request->input('email');
        $otp=rand(1000,9999);
        $count=User::where('email','=',$email)->count();
        if($count==1){

            Mail::to($email)->send(new OTPEmail($otp) );
            User::where('email','=',$email)->update(['otp'=>$otp]);
            return response()->json([
                'status'=>"success",
                'message'=>"OTP send your Email Address"
            ],200);
        }else{

            return response()->json([
                'status'=>"failed",
                'message'=>"unauthorized"
            ],401);
        }
    }

    function otpVerify(Request $request){

        $email=$request->input('email');
        $otp=$request->input('otp');

        $count=User::where('email',$email)->where('otp',$otp)->count();

        if($count==1){

            // update otp in table
            User::where('email',$email)->update(['otp'=>0]);

         
            $token=JWTToken::CreateTokenSetPassword($request->input('email'),$count->id);

            return response()->json([
                'status'=>"success",
                'message'=>"otp verify",
                'token'=>$token
            ],200)->cookie('token',$token,60*60*24);
        }else{

            return response()->json([
                'status'=>"failed",
                'message'=>"unauthorized"
            ],401);
        }

    }
  
    // logout function

    function userLogOut(Request $request){

        return redirect('/login')->cookie('token','',-1);
    }


    function setPassword(Request $request){    
        

        try{
            $email=$request->header('email');
            $password=$request->input('password');
            User::where('email','=',$email)->update(['password'=>$password]);
            return response()->json([
                'status'=>"success",
                'message'=>"Request Successful"                
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status'=>"failed",
                'message'=>"Something wrong"
            ],401);

        }
    }

    function getUser(Request $request){

        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user
        ],200);

    }

    function profileUpdate(Request $request){

        $email=$request->header('email');

        $res=User::where('email','=',$email)->update([
            'firstName'=>$request->input('firstName'),
            'lastName'=>$request->input('lastName'),
            'mobile'=>$request->input('mobile'),
            'password'=>$request->input('password')
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>"update success",
            "data"=>$res
        ],200);

    }





    function registration(){
      return view('pages.auth.registration-page');
    }

    function login(){
        return view('pages.auth.login-page');
    }

    function sendOtp(){
        return view('pages.auth.send-otp-page');
    }

    function verifyOtp(){
        return view('pages.auth.verify-otp-page');
    }
    function resetPassword(){
        return view("pages.auth.reset-password-page");
    }
    function dashboard(){
        return view('pages.dashboard.dashboard-page');
    }
    function profile(){
        return view('pages.dashboard.profile-pages');
    }
   
}
