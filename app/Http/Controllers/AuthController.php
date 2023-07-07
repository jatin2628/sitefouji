<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Mail;
use Illuminate\Support\Facades\Session;

use function Termwind\render;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','updatepage','updateProfile','profile','logout','check_otp','setnewpassword','forgetmail','updatePassword','register','registerPage','loginPage','forgetPage','fillotp','setPass']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        

        if($validator->fails()) {
            
            session()->flash('error', $validator->errors());
            return redirect()->back();
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
        session()->flash('success', 'Register successful! Please Login to continue');
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
             session()->flash('error', $validator->errors());
            return redirect()->back();
        }

        if (!$token = auth()->attempt($validator->validated())) {
            session()->flash('error', 'Invalid credentials. Please try again.');
            return redirect()->back();
        }
        session()->flash('success', 'Login successful!');
        $user = auth()->user();
        Session::put('user', $user);
        
        $user = Session::get('user');
        if($user->account_type == '0'){
            return redirect('/users');
        }else{
            if($user->location){
            return redirect('/updatepage');
            }
            else{
                return redirect('/profile');
            }
        }
        
        
    }

    public function logout()
    {

        Session::forget('user');
        return redirect('/login');
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

        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        // Get the user from the database based on the email address
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            session()->flash('error', 'Invalid email address.');
            return redirect()->back();
        }

        // Check if the OTP matches
        if ($user->otp !== $request->input('otp')) {
            session()->flash('error', 'Invalid OTP.');
            return view('fillotp',['email'=>$request->email]);
        }

        // OTP is verified
        // You can perform further actions here, such as redirecting to a password reset form
        session()->flash('error', 'OTP verify successfully');
        return view('setPassword',['email'=>$request->email]);
        // return redirect()->route('setPass', ['token' => $user->reset_password_token])->with('success', 'OTP verified.');
    }

    public function forgetmail(Request $request)
    {
        
        $otp = mt_rand(100000, 999999); // Generate a 6-digit OTP

        $user = User::where('email', $request->input('email'))->first();
        if(!$user){
            session()->flash('error', "User doesn't exist!");
            return redirect()->back();
        }
        $user->otp = $otp;
        $user->save();

    
        $data = ['otp' => $otp];
        Mail::send('verifyMail', $data, function ($message) use ($user) {
            $message->to($user->email)->subject('Password Reset OTP');
        });

        // Confirmation message
        session()->flash('success', "Otp send successfully");
        return view('fillotp',['email'=>$request->email]);
    }

    //**********UPDATE PASSWORD*****************/

    public function setnewpassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Find the user with the provided email and OTP
        $user = User::where('email', $request->input('email'))
                    ->first();

        if (!$user) {
            session()->flash('error', "Invalid email or OTP.");
            return redirect()->back();
        }

        // Update the user's password
        $user->password = Hash::make($request->input('password'));
        $user->otp = null; 
        $user->save();
        session()->flash('success', 'Password reset successfully.');
        return redirect('/login');

    }

    public function profile(){
        $user = Session::get('user');
        $user = User::where('id', $user->id)->first();
        return view('profile',['user'=>$user]);
    }

//     public function updateProfile(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'firstName' => 'required|string',
//         'email' => 'required|string|email|unique:users',
//         'location' => 'required|string',
//         'designation' => 'required|string',
//         'bio' => 'required|string',
//     ]);

//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator)->withInput();
//     }

//     $user = Session::get('user');
//     $user = User::where('id', $user->id)->first();

  
//     $user->first_name = $request->input('firstName');
//     $user->last_name = $request->input('lastName');
//     $user->location = $request->input('location');
//     $user->designation = $request->input('designation');
//     $user->bio = $request->input('bio');

//     if ($request->hasFile('avatar')) {
//         $file = $request->file('avatar');
//         $originalName = $file->getClientOriginalName();
//         $path = $file->storeAs('uploads', $originalName);
//         $user->avatar = $originalName;
//     }

//     $user->save();

//     return redirect('/user');
// }


public function updateProfile(Request $request)
{
    try {
        
        //code...
    
  
   
    
   
    // Retrieve the user from the session
    $user = Session::get('user');
    $user = User::where('id', $user->id)->first();
    
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->location = $request->location;
    $user->designation = $request->designation;
    $user->bio = $request->bio;

    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $path = public_path('images');
        $originalName = $file->getClientOriginalName();
        $file->move($path, $originalName);
        $user->avatar = $originalName;
    }

    $user->save();
     return redirect('/updatepage');
    
  
} catch (\Throwable $th) {
    //throw $th;
    return $th->getMessage();

    // return redirect('/user');
}

}

public function updatepage(){
    $user = Session::get('user');
    $user = User::where('id', $user->id)->first();

    return view('uploadtest',['user'=>$user]);
}
}