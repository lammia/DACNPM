<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Place;
use App\typePlace;
use Illuminate\Support\MessageBag;
use DB;
use Image;
use Session;
use Validator;

class PlaceController extends Controller
{
    public function index()
    {
        $place = Place::all();
       return view("place", compact('place'));

    }

     public function edit(request $request, $menu)
    {
        $place = DB::table('Place')
            ->where('idPlace', $menu)->first();

        $type = typePlace::all();
        return view("editplace", compact('place', 'type'));

    }

    public function addplace()
    {
        $place = Place::all();
        $type = typePlace::all();
       return view("addplace", compact('place', 'type'));

    }

    public function insert (request $request)
    {
        $rules = [
        'name' =>'required|max:100',
        'money' => 'required|numeric',
        'address' => 'required',
        'des' => 'required',
        'latlog' => 'required',
        'image' => 'required',
        'type' => 'required',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'money.required' => 'Money To Travel is a required field.',
       'money.numeric' => 'Money To Travel must be number.',
       'address.required' => 'Address is a required field.',
       'des.required' => 'Description is a required field.',
       'latlog.required' => 'Latlog is a required field.',
       'image.required' => 'Image is a required field.',
       'type.required' => 'Type is a required field.',
       ];
       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);

            DB::table('Place')->insert(['namePlace'=>$request->name, 'MoneyToTravel'=>$request->money, 'address'=>$request->address,'img'=>$filename, 'idType'=>$request->type, 'description'=>$request->des, 'latlog'=>$request->latlog]);
            return redirect('place')->with(['flash_message5'=>'Update success.']);
        }   
    }

    public function update(request $request, $menu)
    {   

        $rules = [
        'name' =>'required|max:100',
        'money' => 'required|numeric',
        'address' => 'required',
        'des' => 'required',
        'latlog' => 'required',
        'type' => 'required',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'money.required' => 'Money To Travel is a required field.',
       'money.numeric' => 'Money To Travel must be number.',
       'address.required' => 'Address is a required field.',
       'des.required' => 'Description is a required field.',
       'latlog.required' => 'Latlog is a required field.',
       'type.required' => 'Type is a required field.',
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
        
            DB::table('Place')->where('idPlace',$menu)->update(['namePlace'=>$request->name, 'MoneyToTravel'=>$request->money, 'address'=>$request->address,'img'=>$filename, 'idType'=>$request->type, 'description'=>$request->des, 'latlog'=>$request->latlog]);
             return redirect('place')->with(['flash_message6'=>'Update success.']);
        }
        else{
            DB::table('Place')->where('idPlace',$menu)->update(['namePlace'=>$request->name, 'MoneyToTravel'=>$request->money, 'address'=>$request->address,'idType'=>$request->type, 'description'=>$request->des, 'latlog'=>$request->latlog]);
             return redirect('place')->with(['flash_message6'=>'Update success.']);
        }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($menu)
    {
        DB::table('Event')->where('idPlace',$menu)->delete();
        DB::table('Festival')->where('idPlace',$menu)->delete();
        DB::table('Discount')->where('idPlace',$menu)->delete();
        DB::table('Place')->where('idPlace',$menu)->delete();
        return redirect('place');
    }
}
