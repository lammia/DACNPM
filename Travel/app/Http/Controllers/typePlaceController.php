<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\typePlace;
use DB;
use Session;
use Validator;
class typePlaceController extends Controller
{
    //
    public function index()
    {
        $type = typePlace::all();
       return view("typeplace", compact('type'));
    }

    public function insert (request $request)
    {
        $rules = [
        'name' =>'required|max:30',
        ];
       $messages = [
       'name.required' => 'Type name is a required field.',
       'name.max' => 'Type name less than 30 characters .',
       ];
       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            DB::table('typePlace')->insert(['nameType'=>$request->name]);
            return redirect('typeplace')->with(['flash_message17'=>'Update success.']);
        }   
    }

    public function edit (request $request, $menu){

            DB::table('typePlace')
            	->where('idType', $menu)
            	->update(['nameType'=>$request->name]);
            return redirect('typeplace')->with(['flash_message18'=>'Update success.']);
          
    }

    public function delete($menu)
    {
        DB::table('typePlace')->where('idType',$menu)->delete();
        return redirect('typeplace');
    }
}
