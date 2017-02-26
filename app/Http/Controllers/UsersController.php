<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;

class UsersController extends Controller
{	

	public function __construct(){
		$this->middleware('auth',[
			'only'=>['edit','update','destroy']
		]);
		$this->middleware('guest',[
			'only'=>['create']
		])
	}
    //
	public function index(){
		$users = User::paginate(30);
		return view('users.index',compact($users));
	}

    public function create(){
    	return view('users.create');
    }

    public function show($id){
      $user = User::findOrFail($id);
      return view('users.show',compact('user'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'name'=>'required|max:50',
    		'email'=>'required|email|unique:users|max:255',
    		'password'=>'required'
    	]);

    	$user = User::create([
    		'name'=>$request->name,
    		'email'=>$request->email,
    		'password'=>$request->bcrypt(password)
    	]);

    	Auth::login($user);
    	session()->flash('success','欢迎开启一段新的旅程');
    	return redirect()->route('users.show',[$user]);
    }


    public function edit($id){
    	$user = User::findOrFail($id);
    	$this->authorize('update',$user);
    	return view('users.edit',compact($user))
    }

    public function update($id,Request $request){
    	$this->validate($request,[
    		'name'=>'required|max:50',
    		'password'=>'confirmed|max:60'
    	]);

    	$user = User::findOrFail($id);
    	$this->authorize('update',$user);
    	$data = [];
    	$data['name'] = $request->name;
    	if ($request->password) {
    		# code...
    		$data['password'] =bcrypt($request->password);
    	}
    	$user = update($data);
    	session()->flash('success','个人资料更新成功');
    	return redirect()->route('users.show',$id);
    }

    public function destroy($id){
    	$user = User::findOrFail($id);
    	$this->authorize('destroy', $user);
    	$user->delete();
    	session()->flash('success','删除用户成功');
    	return back();
    }
}
