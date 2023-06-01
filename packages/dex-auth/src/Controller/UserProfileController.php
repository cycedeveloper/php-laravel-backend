<?php

namespace Sayedsoft\DexAuthReferral\Controller;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Sayedsoft\DexAuthReferral\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{

    public function __construct()
    {
       
    }

    public function getProfile()
    {   
        $user = Auth::user();
        return view('dexauth::profile.profile',['user'=>$user]);
    } 

    /**
     * Update Profile
     * @param $profileData
     * @return Boolean With Success Message
     * @author Shani Singh
     */
    public function updateProfile(Request $request)
    {
        #Validations

        $validator =   Validator::make($request->all(),[
            'first_name' => 'required|string|max:255|min:3',
            'last_name' => 'required|string|max:255|min:3',
        ]);

        if($validator->fails()) return response()->json($validator->errors(),401); 

        try {
            DB::beginTransaction();
            
            #Update Profile Data
            $user = User::whereId(auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number,
            ]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success

            return response()
            ->json(['user' => $user]);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Change Password
     * @param Old Password, New Password, Confirm New Password
     * @return Boolean With Success Message
     * @author Shani Singh
     */
    public function changePassword(Request $request)
    {   

        $validator =   Validator::make($request->all(),[
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        if($validator->fails()) return response()->json($validator->errors(),401); 
        
        try {
            DB::beginTransaction();

            #Update Password
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            
            #Commit Transaction
            DB::commit(); 

            #Return To Profile page with success
            return response()->json(['message'=>'Password has been changes','user'=>$request->user()]);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message'=>$th->getMessage()],402);
        }
    }
}
