<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\ZoneCoverBranch;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Request;

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
        $this->middleware('auth');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'zone' => $data['zone'],
            'branch' => $data['branch'],
        ]);
    }

    protected function showSites($id)
    {
        if($id == 2){
            $data['zones'] = Zone::all();
            return view('auth/site_list', $data);
        }else if($id == 3){
            $data['branches'] = ZoneCoverBranch::all();
            return view('auth/branch_list', $data);
        }
    }

    protected function storeUser()
    {
        $validate = Request::validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        $insert = new User;
        $insert->name = Request::input('name');
        $insert->email = Request::input('email');
        $insert->password = Hash::make(Request::input('password'));
        $insert->role = Request::input('role');
        $insert->zone = Request::input('zone');
        $insert->branch = Request::input('branch');
        $insert->save();

        return back()->with('account-created', 'کاربر جدید موفقانه ایجاد گردید');
    }

    protected function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        $data['zones'] = Zone::all();
        $data['branches'] = ZoneCoverBranch::all();

        return view('auth/user_edit_modal', $data);
    }

    protected function updateUser()
    {
        if((Request::input('full-name') != '') && (Request::input('old-pass') == '') && (Request::input('new-pass') == '') && (Request::input('conf-pass') == '') && (Request::input('zone') != '')){
            $update = User::findOrFail(Request::input('data-id'));
            $update->name = Request::input('full-name');
            $update->zone = Request::input('zone');
            $update->save();
        }else if((Request::input('full-name') != '') && (Request::input('old-pass') != '') && (Request::input('new-pass') != '') && (Request::input('conf-pass') != '') && (Request::input('zone') != '')){
            $update = User::findOrFail(Request::input('data-id'));
            if(Hash::check(Request::input('old-pass'), $update->password) && (Request::input('new-pass') == Request::input('conf-pass'))){
                $update->name = Request::input('full-name');
                $update->password = Hash::make(Request::input('new-pass'));
                $update->zone = Request::input('zone');
                $update->save();
            }
        }else if((Request::input('full-name') != '') && (Request::input('old-pass') == '') && (Request::input('new-pass') == '') && (Request::input('conf-pass') == '') && (Request::input('zone') != '') && (Request::input('branch') != '')){
            $update = User::findOrFail(Request::input('data-id'));
            $update->name = Request::input('full-name');
            $update->zone = Request::input('zone');
            $update->branch = Request::input('branch');
            $update->save();
        }else if((Request::input('full-name') != '') && (Request::input('old-pass') != '') && (Request::input('new-pass') != '') && (Request::input('conf-pass') != '') && (Request::input('zone') != '') && (Request::input('branch') != '')){
            $update = User::findOrFail(Request::input('data-id'));
            if(Hash::check(Request::input('old-pass'), $update->password) && (Request::input('new-pass') == Request::input('conf-pass'))){
                $update->name = Request::input('full-name');
                $update->password = Hash::make(Request::input('new-pass'));
                $update->zone = Request::input('zone');
                $update->branch = Request::input('branch');
                $update->save();
            }
        }
        return back()->with('user-updated', 'تغییرات اجرا گردید');
    }
}
