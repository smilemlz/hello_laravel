<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{	
	public function __construct(){
		$this->middleware('guest',[
			'only'=>['guest']
		]);

	}
    //
    public function create(){
    	return view('session.create');
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'email' => 'email|required|max:255',
    		'password' => 'required'
    	]);


    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	if (Auth::attempt($credentials,$request->has('remember'))) {
    		# code...通过认证
    		session()->flash('success','欢迎回来');
    		return redirect()->intended(route('users.show',[Auth::user()]));
    	}else{
    		session()->flash('danger','邮箱或密码错误');
    		return redirect()->back();
    	}
    	return;
    }

    public function destroy(){
    	Auth::logout();
    	session()->flash('success','您已退出成功');
    	return redirect('login');
    }

}
