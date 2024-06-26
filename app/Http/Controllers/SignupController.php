<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class SignupController extends Controller
{
    public function index(Request $request){
        return view('auth.login');
    }
    public function save(Request $request){
        $validate = $request->validate([
            'name'=>'required|alpha',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);
        $date = date('Y-m-d H:i:s');
        $user = new User();
        $user->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'created_at' => $date,
            'updated_at' => $date
        ]);
        return redirect('admin/users');
    }
}
