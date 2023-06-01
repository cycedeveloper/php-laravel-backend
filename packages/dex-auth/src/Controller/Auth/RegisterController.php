<?php
namespace Sayedsoft\DexAuthReferral\Controller\Auth;



use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('guest');
    }

  

    public function showRegistrationForm(Request $request)
    {   
        $reffCode =  $request->get('code');
        if ($reffCode != null && $reffCode != '') {
          $check = Referral::where('referral_code',$reffCode)->exists();
          if (!$check) { abort(404); return; } 
          session()->forget('refferal_code');
          session()->put('refferal_code', $reffCode);
        }

        return view('dexauth::auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
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


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        $user = $this->create($request->all());

        event(new Registered($user));

        
        return User::find($user->id);

        

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

}
