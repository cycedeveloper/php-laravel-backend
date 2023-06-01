<?php

namespace Sayedsoft\DexAuthReferral\Controller\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\DexAuthReferral\Controller\Auth\RegisterController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class AuthAPIController extends Controller
{   


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()->json(['message' => 'No record'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hi '.$user->full_name.', welcome to home',
            'access_token' => $token, 
            'token_type' => 'Bearer',
            'user' => $user,
         ]);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'mobile_number' => 'required|numeric|digits:10',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
            'referral_code' => ['required','exists:referrals,referral_code'],
        ]);
    } 


    protected function create(array $data)
    {   
        $user = User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'password'      => Hash::make($data['password']),
            'password'      => Hash::make($data['password']),
        ]);
        
        $user->initReferral($data['referral_code']);
        return $user;
    }


    public function register (Request $request) {
        $this->validator($request->all())->validate();
        
        $user = $this->create($request->all());

        event(new Registered($user));

        $user = User::find($user->id);

        $token =  $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'message' => 'Hi '.$user->full_name.', welcome to home',
            'access_token' => $token, 
            'token_type' => 'Bearer',
            'user' => $user,
         ]);
    }

    public function resend (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return  response()->json(['message'=>'Email sent!']);
    }

    public function userData (Request $request) {
        $user  = User::find($request->user()->id);

        $token = $request->bearerToken();
        
        return response()->json([
            'message' => 'Hi '.$user->full_name.', welcome to home',
            'access_token' => $token, 
            'token_type' => 'Bearer',
            'user' => $user,
         ]);
        
    }

    public function verifyMail (Request $request) {
        $user = User::find($request->route('id'));
        
        if ($user->hasVerifiedEmail()) {
            return redirect(env('FRONT_URL') . '/email/verify/already-success');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect(env('FRONT_URL'));
    }

}
