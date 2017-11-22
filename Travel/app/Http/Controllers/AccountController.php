<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\MessageBag;
use App\Account;
use App\Group;
use App\MemberGroup;
use App\Place;
use App\Event;
use App\Festival;
use App\Discount;
use App\Province;
use App\District;
use App\Village;
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
        $province = Province::all();
        $district = District::all();
        $village = Village::all();
       return view("user", compact('account', 'province', 'district', 'village'));

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
        $province = Province::all();
        $district = DB::table('District')
                  ->where('idProvince', $user->idProvince)
                  ->get();
        $village = DB::table('Village')
                  ->where('idVillage', $user->idVillage)
                  ->get();
       	return view("edituser", compact('user', 'group', 'member', 'province', 'district', 'village'));

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
        'phone' => 'required|numeric',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'email.required' => 'Email is a required field.',
       'email.email' => 'Please include an "@" in the email address',
       'phone.required' => 'The phone is a required field.',
       'phone.numeric' => 'The phone is a number',
       ];
       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
          $name = $request->name;
          for( $i = 0; $i <= strlen($name) - 1; $i++){
            if(($name[$i] >= '!' && $name[$i] <= '@') ||
               ($name[$i] >= '[' && $name[$i] <= '`') ||
               ($name[$i] >= '{' && $name[$i] <= '~')){
              $errors = new MessageBag(['errorname' => 'The name must be string (a-z, A-Z)']);
              return redirect()->back()->withInput()->withErrors($errors);
            }
          }
  
          $email = DB::table('Account')
                  ->where('email', $request->email)->first();
          $mail = DB::table('Account')
                  ->where('idAccount', $menu)
                  ->first();
          $isoldemail = $mail->email;
          if($email !=null && ($request->email != $isoldemail)){
            $errors = new MessageBag(['erroremail' => 'Email already exists']);
            return redirect()->back()->withInput()->withErrors($errors);
          }
          
          else{
          	if($request->hasFile('image')){
          		
              $img = $request->file('image');        
              $filename = time() . '.'. $img->getClientOriginalExtension();            
              $location = public_path('upload/'. $filename);
              Image::make($img)->save($location);

              DB::table('Account')->where('idAccount', $menu)->update(['nameAccount'=>$request->name, 'email'=>$request->email, 'img'=>$filename, 'phone'=>$request->phone, 'description'=>$request->des, 'idProvince'=>$request->province, 'idDistrict'=>$request->district, 'idVillage'=>$request->village]);
              DB::table('MemberGroup')->where('idAccount', $menu)->update(['idGroup'=>$request->group]);
              return redirect('user')->with(['flash_message1'=>'Update success.']);
          	}

          	else{
          		DB::table('Account')->where('idAccount', $menu)->update(['nameAccount'=>$request->name, 'email'=>$request->email, 'phone'=>$request->phone, 'description'=>$request->des, 'idProvince'=>$request->province, 'idDistrict'=>$request->district, 'idVillage'=>$request->village]);
              DB::table('MemberGroup')->where('idAccount', $menu)->update(['idGroup'=>$request->group]);
              return redirect('user')->with(['flash_message1'=>'Update success.']);
          	}
        	}
        }   
    }

    public function adduser()
    {
      $group = Group::all();
      $province = Province::all();
      $district = DB::table('District')
          ->where('idProvince', $province[0]->idProvince)
          ->get();
      $village = DB::table('Village')
          ->where('idDistrict', $district[0]->idDistrict)
          ->get();  
      return view("adduser", compact('group', 'province', 'district', 'village'));

    }
    public function getDistrictByProvinceId(request $request)
    {
      $districts = DB::table('District')
          ->where('idProvince', $request->idProvince)
          ->get();

      $villages = DB::table('Village')
          ->where('idDistrict', $districts[0]->idDistrict)
          ->get();

      $data["districts"] = $districts;
      $data["villages"] = $villages;

      return \Response::json($data);

    }

    public function getVillageByDistrictId(request $request)
    { 

      $village = DB::table('Village')
          ->where('idDistrict', $request->idDistrict)
          ->get();

      return \Response::json($village);

    }

    public function insert (request $request)
    {
        $rules = [
        'idAccount',
        'name' =>'required|max:100',
        'email' => 'required|email',
        'password'=>'required|min:8',
        'phone' => 'required|numeric',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'email.required' => 'Email is a required field.',
       'email.email' => 'Please include an "@" in the email address',
       'phone.required' => 'The phone is a required field.',
       'phone.numeric' => 'The phone is a number',
       ];
       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
          $name = $request->name;
          for( $i = 0; $i <= strlen($name) - 1; $i++){
            if(($name[$i] >= '!' && $name[$i] <= '@') ||
               ($name[$i] >= '[' && $name[$i] <= '`') ||
               ($name[$i] >= '{' && $name[$i] <= '~')){
              $errors = new MessageBag(['errorname' => 'The name must be string (a-z, A-Z)']);
              return redirect()->back()->withInput()->withErrors($errors);
            }
           }
          $email = DB::table('Account')
                  ->where('email', $request->email)->first();
          if($email !=null){
            $errors = new MessageBag(['erroremail' => 'Email already exists']);
            return redirect()->back()->withInput()->withErrors($errors);
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



              DB::table('Account')->insert(['nameAccount'=>$request->name, 'email'=>$request->email,'img'=>$filename, 'password'=>$request->password, 'phone'=>$request->phone, 'description'=>$request->des, 'idProvince'=>$request->province, 'idDistrict'=>$request->district, 'idVillage'=>$request->village]);

              $id =DB::table('Account')->where('email', $request->email)->value('idAccount');

              DB::table('MemberGroup')->insert(['idAccount'=>$id, 'idGroup'=>$request->group]);

              return redirect('user')->with(['flash_message'=>'Update success.']);
          }
        	
        }   
    }

    public function delete($menu)
    {   
        $place = DB::table('Place')
                  ->where('idAccount', $menu)
                  ->first();
        $event = DB::table('Event')
                  ->where('idAccount', $menu)
                  ->first();
        $festival = DB::table('Festival')
                  ->where('idAccount', $menu)
                  ->first();
        $discount = DB::table('Discount')
                  ->where('idAccount', $menu)
                  ->first();

        $isadmin = DB::table('MemberGroup')
                  ->where('idAccount', $menu)
                  ->where('idGroup',1)
                  ->first();

        if($isadmin !=null){
          $countadmin = DB::table('MemberGroup')->where('idGroup',1)->count();

          if($countadmin == 1) {
            return redirect('user')->with(['flash_message0'=>'Delete fail. Because the system must be at least one a administrator']);
          }
          else{
            if($place != null){
              DB::table('Event')->where('idPlace', $place->idPlace)->delete();
              DB::table('Festival')->where('idPlace', $place->idPlace)->delete();
              DB::table('Discount')->where('idPlace', $place->idPlace)->delete();
              DB::table('Place')->where('idAccount', $menu)->delete();
            }
            if($event != null){
              DB::table('Event')->where('idAccount', $menu)->delete();
            }
            if($festival != null){
              DB::table('Festival')->where('idAccount', $menu)->delete();
            }
            if($discount != null){
              DB::table('Discount')->where('idAccount', $menu)->delete();
            }

            DB::table('MemberGroup')->where('idAccount',$menu)->delete();
            DB::table('Account')->where('idAccount',$menu)->delete();
           
            return redirect('user');
          }
        }
        else{
          if($place != null){
            DB::table('Event')->where('idPlace', $place->idPlace)->delete();
            
            DB::table('Festival')->where('idPlace', $place->idPlace)->delete();
            DB::table('Discount')->where('idPlace', $place->idPlace)->delete();
            DB::table('Place')->where('idAccount', $menu)->delete();
          }
          if($event != null){
            DB::table('Event')->where('idAccount', $menu)->delete();
          }
          if($festival != null){
            DB::table('Festival')->where('idAccount', $menu)->delete();
          }
          if($discount != null){
            DB::table('Discount')->where('idAccount', $menu)->delete();
          }
          DB::table('MemberGroup')->where('idAccount',$menu)->delete();
          DB::table('Account')->where('idAccount',$menu)->delete();
         
          return redirect('user');
        }
        
    }
}

