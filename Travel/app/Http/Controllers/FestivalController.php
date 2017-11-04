<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Festival;
use App\Place;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;
use Image;
use Validator;

class FestivalController extends Controller
{
    //
    public function index()
    {
        $festival = Festival::all();
        $place = Place::all();
        
        return view("festival", compact('festival', 'place'));

    }

    public function edit(request $request, $menu)
    {
        $festival = DB::table('Festival')
            ->where('idFestival', $menu)->first();

        $place = Place::all();
        return view("editfestival", compact('festival', 'place'));

    }

    public function addfestival()
    {
        $festival = Festival::all();
        $place = Place::all();
       return view("addFestival", compact('festival', 'place'));

    }

    public function insert (request $request)
    {
        $rules = [
        'name' =>'required|max:100',
        'begin' => 'required',
        'end' => 'required',
        'des' => 'required',
        'image' => 'required',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'begin.required' => 'Time begin is a required field.',
       'end.required' => 'Time end is a required field.',
       'des.required' => 'Description is a required field.',
       'image.required' => 'Image is a required field.',
       ];

       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $time =strtotime($request->end) - strtotime($request->begin);
            if($time <= 0){
                $errors = new MessageBag(['errortime' => 'Time end must be after time begin']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);

            DB::table('Festival')->insert(['nameFestival'=>$request->name, 'timeBeginFestival'=>$request->begin, 'timeEndFestival'=>$request->end, 'img'=>$filename, 'idPlace'=>$request->place, 'description'=>$request->des]);
            return redirect('festival')->with(['flash_message12'=>'Update success.']);
        }   
    }

    public function update(request $request, $menu)
    {   
    	$rules = [
        'name' =>'required|max:100',
        'begin' => 'required',
        'end' => 'required',
        'des' => 'required',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'begin.required' => 'Time begin is a required field.',
       'end.required' => 'Time end is a required field.',
       'des.required' => 'Description is a required field.',
       ];

       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
        $time =strtotime($request->end) - strtotime($request->begin);
        if($time <= 0){
            $errors = new MessageBag(['errortime' => 'Time end must be after time begin']);
            return redirect()->back()->withInput()->withErrors($errors);
        }

        if($request->hasFile('image')){
          
            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);

            DB::table('Festival')->where('idFestival',$menu)->update(['nameFestival'=>$request->name, 'timeBeginFestival'=>$request->begin, 'timeEndFestival'=>$request->end, 'idPlace'=>$request->place, 'Description'=>$request->des, 'img'=>$filename]);
             return redirect('festival')->with(['flash_message14'=>'Update success.']);
            
         }
         else{
         	DB::table('Festival')->where('idFestival',$menu)->update(['nameFestival'=>$request->name, 'timeBeginFestival'=>$request->begin, 'timeEndFestival'=>$request->end, 'idPlace'=>$request->place, 'Description'=>$request->des]);
             return redirect('festival')->with(['flash_message14'=>'Update success.']);
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
        DB::table('Festival')->where('idFestival',$menu)->delete();
        return redirect('festival');
    }
}
