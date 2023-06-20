<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;
use Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','check_otp','setnewpassword','forgetmail','updatePassword','register','registerPage','loginPage','forgetPage','fillotp','setPass']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            

        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'user' => $user
        // ], 201);
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        return $this->createNewToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function forgetPage(){
        return view('forgetPage');
    }

    public function registerPage(){
        return view('register');
    }

    public function loginPage(){
        return view('login');
    }

    public function fillotp(){
        return view('fillotp');
    }

    public function setPass(){
        return view('setPassword');
    }

    public function check_otp(Request $request)
    {
        // $email = $req->email;
        // //return $email;
        // $data = User::where('token',$req->otp)->first();
        // //return $data;
        // $value = Cache::get($this->otp);
        // if($value)
        // {
            
        //    if($value == $req->otp)
        //    {
                
        //         return view('setPassword',['product'=>$data]);
        //    }
        // }
        // else 
        // {
        //     return "<h3><center>invalid otp or Expired OTP</center></h3>";
        // }

        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        // Get the user from the database based on the email address
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid email address.');
        }

        // Check if the OTP matches
        if ($user->otp !== $request->input('otp')) {
            return redirect()->back()->with('error', 'Invalid OTP.');
        }

        // OTP is verified
        // You can perform further actions here, such as redirecting to a password reset form
        return view('setPassword',['email'=>$request->email]);
        // return redirect()->route('setPass', ['token' => $user->reset_password_token])->with('success', 'OTP verified.');
    }

    public function forgetmail(Request $request)
    {
        // $user =  User::where(['email'=>$req->email])->first();
        // $random = rand(100000,999999);
        //        //$rando = random(4); ****Generate Four random string***********
        //         $data['email'] = $req->email;
        //         $data['title'] = "Forget Password Mail";
        //         $data['body'] = "Please verify OTP to reset your password";
        //         $data['otp'] = $random;
        //         $data['status'] ='2';
              
        //         //$this->copyotp = $random;

        //         $sent = Mail::send('verifyMail',['data'=>$data],function($message) use ($data)
        //         {
        //             $message->to($data['email'])->subject($data['title']);
        //         });

        //         if($sent)
        //         {
        //             $user->token = $random;
        //             $user->save();
        //             $userid = User::find($user->id);
        //             Cache::put($this->otp, $random,120);

        //             //$req->session()->put('type', '2');
        //             return view('fillotp',['email'=>$req->email]);
        //         }
        //         else 
        //         {
        //             return "failed";
        //         }

        $otp = mt_rand(100000, 999999); // Generate a 6-digit OTP

        // Store the OTP in the user's record (e.g., user table or password reset token table)
        // Replace 'user' with your user model
        $user = User::where('email', $request->input('email'))->first();
        if(!$user){
            return response()->json(["msg"=>"User doesn't exist"]);
        }
        $user->otp = $otp;
        $user->save();

        // Send OTP via email
        $data = ['otp' => $otp];
        Mail::send('verifyMail', $data, function ($message) use ($user) {
            $message->to($user->email)->subject('Password Reset OTP');
        });

        // Confirmation message
        return view('fillotp',['email'=>$request->email]);
    }

    //**********UPDATE PASSWORD*****************/

    public function setnewpassword(Request $request)
    {
        //return $req;
        // $user =  User::where(['email'=>$req->email])->first();
        // $user->password=Hash::make($req->password);
        // $res = $user->save();

        // if($res)
        // {
        //     $msg = 'Password successfully changed !';
        //     Session::flash ( 'message', $msg );
        //         $data = Product::all();
        //         return view('product',['products'=>$data]);
        // }

        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
            'password' => 'required|confirmed|min:8',
        ]);

        // Find the user with the provided email and OTP
        $user = User::where('email', $request->input('email'))
                    ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid email or OTP.');
        }

        // Update the user's password
        $user->password = Hash::make($request->input('password'));
        $user->otp = null; // Clear the OTP field
        $user->save();

        // Redirect to login page or any other desired page
        return redirect('/login')->with('success', 'Password reset successfully.');

    }
}
