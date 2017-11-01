<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Place;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;
use Image;
use Validator;

class EventController extends Controller
{
    //
    public function index()
    {
        $event = Event::all();
        $place = Place::all();
        
       return view("event", compact('event', 'place'));

    }

    public function edit(request $request, $menu)
    {
        $event = DB::table('Event')
            ->where('idEvent', $menu)->first();

        $place = Place::all();
        return view("editevent", compact('event', 'place'));

    }

    public function addevent()
    {
        $event = Event::all();
        $place = Place::all();
       return view("addEvent", compact('event', 'place'));

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

            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);

            DB::table('Event')->insert(['nameEvent'=>$request->name, 'timeBeginEvent'=>$request->begin, 'timeEndEvent'=>$request->end, 'img'=>$filename, 'idPlace'=>$request->place, 'description'=>$request->des]);
            return redirect('addevent')->with(['flash_message7'=>'Update success.']);
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
        return redirect()->back()->withErrors($validator)->with(['flash_message3'=>'Update fail.'])->withInput();
        }
        else{
        	//dd($request->file('image'));
        if($request->hasFile('image')){
          
            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);

            DB::table('Event')->where('idEvent',$menu)->update(['nameEvent'=>$request->name, 'timeBeginEvent'=>$request->begin, 'timeEndEvent'=>$request->end, 'idPlace'=>$request->place, 'description'=>$request->des, 'img'=>$filename]);
             return redirect('event')->with(['flash_message4'=>'Update success.']);
            
         }
         else{
         	DB::table('Event')->where('idEvent',$menu)->update(['nameEvent'=>$request->name, 'timeBeginEvent'=>$request->begin, 'timeEndEvent'=>$request->end, 'idPlace'=>$request->place, 'description'=>$request->des]);
             return redirect('event')->with(['flash_message4'=>'Update success.']);
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
        DB::table('Event')->where('idEvent',$menu)->delete();
        return redirect('event');
    }
}
