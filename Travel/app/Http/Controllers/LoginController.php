<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Account;
use Validator;
use Session;
use App\MemberGroup;
use DB;
use Illuminate\Support\MessageBag;


class LoginController extends Controller
{
    //
  public function getForm(){
    if(Session::has('admin'))
      return redirect('user');
   return view('login');
  }
  public function postForm(Request $request){    	
     $rules = [
     'email' =>'required|email',
     'password' => 'required|min:8'
     ];
     $messages = [
     'email.required' => 'Email is a required field.',
     'email.email' => 'Email is invalid',
     'password.required' => 'Password is a required field.',
     'password.min' => 'Password consists 8 characters at least.',
     ];
     $validator = Validator::make($request->all(), $rules, $messages);
     if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
      } 
    else {
      $email = $request->input('email');
      $password = $request->input('password');

      $account = DB::table('Account')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

      if($account !=null){
        $isAdmin = DB::table('MemberGroup')
            ->where('idAccount',$account->idAccount)
            ->where('idGroup', 1)
            ->first();
        if($isAdmin !=null){
          Session::put('admin',$account);
          return redirect('/user');
        }
        else{
          $errors = new MessageBag(['errorlogin' => 'Email or Password that you have entered is incorect']);
          return redirect()->back()->withInput()->withErrors($errors);
        }  
      }
      else{
        $errors = new MessageBag(['errorlogin' => 'Email or Password that you have entered is incorect.']);
        return redirect()->back()->withInput()->withErrors($errors);
      }   
    }
  }

  public function logout(){   
  Session::forget('admin'); 
  return view('login');
  }
}

