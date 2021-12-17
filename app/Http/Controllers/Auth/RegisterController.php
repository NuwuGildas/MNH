<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\role;
use App\wallet;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;



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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       // dd($data);
       $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->passes()) {
			return $validator;
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $bosscode = Str::random();
        $request = request();
        //dd('here....');
        $photo = $bosscode.'.'.$request->file('user_photo')->getClientOriginalExtension();
        $upload_path = 'avatars';
        
        $profile_image_url = $upload_path . $photo;
        //dd($request->file('user_photo')->getClientOriginalExtension());
        // $extension = $request->file('user_photo')->extension();
        //$extension = $request->file('user_photo')->getClientOriginalExtension();
        //dd($photo);
        //File::move(public_path('exist/test.png'), public_path($upload_path.$photo));
        $success = $request->file('user_photo')->move($upload_path, $photo);
        //$success = $request->file('user_photo')->move($upload_path, $request->file('user_photo')->getClientOriginalName());
        //dd($success);
        $myBoss = null;
        
       if(array_key_exists('boss_code', $data)){
            $boss = $data['boss_code'];
            $users = DB::table('users')->where('boss_code', $boss)->first();
            if (!empty($users)) {
                $myBoss = $data['boss_code'];
                role::create([
                    'bosscode' => $boss,
                    'my_bosscode' => $bosscode
                ]);
            }
        }
        //
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'My_boss_code' =>  $myBoss,
            'boss_code' =>  $bosscode,
            'age' => $data['age'],
            'profession' => $data['profession'],
            'birth_city' => $data['birth_city'],
            'city' => $data['city'],
            'telephone' => $data['telephone'],
            'current_amount' => $data['amount'],
            'amount' => $data['amount'],
            'paiement' => $data['paiement'],
            'sex' => $data['sex']
        ]);
    }     

}
