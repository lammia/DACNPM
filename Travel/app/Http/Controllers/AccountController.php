<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\MessageBag;
use App\Account;
use App\Group;
use App\MemberGroup;
use DB;
use Image;
use Session;
use Validator;

class AccountController extends Controller
{
    //
    public function index()
    {
        $account = Account::all();
        
       return view("user", compact('account'));

    }

    public function edit(request $request, $menu)
    {
       $colums = [
        'idAccount',
        'nameAccount',
        'email',
        'password',
        'address',
        'phone',
        'img',
        'description',
        ];
        $user = DB::table('Account')
            ->where('idAccount', $menu)->first();
        $group = Group::all();
        $member = DB::table('MemberGroup')
            ->where('idAccount', $menu)->first();
       	return view("edituser", compact('user', 'group', 'member'));

    }

    public function editpass(request $request, $menu){
    	$rules = [
        'password' =>'required|min:8',
        'cfpassword' => 'required',
        ];
       $messages = [
       'password.required' => 'Password is a required field.',
       'password.min' => 'Password must be at least 8 characters .',
       'cfpassword.required' => 'Confirm password is a required field.',
       ];
       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
        	if($request->password == $request->cfpassword){
        		DB::table('Account')->where('idAccount', $menu)->update(['password'=>$request->password]);
            return redirect('EditUser/'.$menu)->with(['flash_message3'=>'Change password success.']);
        	}
        	else {
        		return redirect('EditUser/'.$menu)->with(['flash_message4'=>'The password and confirmation password do not match. Please try again.']);
        	}
        }
    }

    public function update(request $request, $menu){
    	$rules = [
        'name' =>'required|max:100',
        'email' => 'required|email',
        'address' => 'required',
        'phone' => 'required|numeric',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'email.required' => 'Email is a required field.',
       'email.email' => 'Please include an "@" in the email address',
       'address.required' => 'Address is a required field.',
       'phone.required' => 'The phone is a required field.',
       'phone.numeric' => 'The phone is a number',
       ];
       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        else{
        	if($request->hasFile('image')){
        		
            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);

            DB::table('Account')->where('idAccount', $menu)->update(['nameAccount'=>$request->name, 'email'=>$request->email, 'address'=>$request->address,'img'=>$filename, 'phone'=>$request->phone, 'description'=>$request->des]);
            DB::table('MemberGroup')->where('idAccount', $menu)->update(['idGroup'=>$request->group]);
            return redirect('user')->with(['flash_message1'=>'Update success.']);
        	}

        	else{
        		DB::table('Account')->where('idAccount', $menu)->update(['nameAccount'=>$request->name, 'email'=>$request->email, 'address'=>$request->address, 'phone'=>$request->phone, 'description'=>$request->des]);
            DB::table('MemberGroup')->where('idAccount', $menu)->update(['idGroup'=>$request->group]);
            return redirect('user')->with(['flash_message1'=>'Update success.']);
        	}
        	
        }   
    }

    public function adduser()
    {
    	$group = Group::all();
        
       return view("adduser", compact('group'));

    }

    public function insert (request $request)
    {
        $rules = [
        'idAccount',
        'name' =>'required|max:100',
        'email' => 'required|email',
        'password'=>'required|min:8',
        'address' => 'required',
        'phone' => 'required|numeric',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'email.required' => 'Email is a required field.',
       'email.email' => 'Please include an "@" in the email address',
       'address.required' => 'Address is a required field.',
       'phone.required' => 'The phone is a required field.',
       'phone.numeric' => 'The phone is a mumber',
       ];
       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
        	if($request->hasFile('image')){
        		
            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);
        	}
        	else{
        		$filename = 'default.png';
        	}

            DB::table('Account')->insert(['nameAccount'=>$request->name, 'email'=>$request->email, 'address'=>$request->address,'img'=>$filename, 'password'=>bcrypt($request->password), 'phone'=>$request->phone, 'description'=>$request->des]);

            $id =DB::table('Account')->where('email', $request->email)->value('idAccount');

            DB::table('MemberGroup')->insert(['idAccount'=>$id, 'idGroup'=>$request->group]);

            return redirect('user')->with(['flash_message'=>'Update success.']);
        	
        }   
    }

    public function delete($menu)
    {   
        $countadmin=DB::table('MemberGroup')->where('idGroup',1)->count();

        if($countadmin == 1) {
          return redirect('user')->with(['flash_message0'=>'Delete fail. Because the system must be at least one a administrator']);
        }

        // DB::table('MemberGroup')->where('idAccount',$menu)->delete();
        // DB::table('Account')->where('idAccount',$menu)->delete();
       
        // return redirect('user');
    }
}

