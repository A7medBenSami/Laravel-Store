<?php
namespace App\Actions\Fortify;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthUser {

    public function AdminAuth($request){
        $username = $request->post(config('fortify.username'));
        $password = $request->post('password');

        $user = Admin::where('username',$username)
        ->orWhere('email',$username)
        ->orWhere('phone_number',$username)

        ->first();

        if($user && Hash::check($password,$user->password)){
            return $user;
        }
        return false;

        }


    public function UserAuth($request)
    {
        $username = $request->post(config('fortify.username'));
        $password = $request->post('password');

        $user = User::where('email', $username)
            ->orWhere('phone_number', $username)
            ->orWhere('name', $username)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return false;

    }
}
