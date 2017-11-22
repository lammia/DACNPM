<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Place;
use App\Comment;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;
use DateTime;
use Image;
use Validator;

class EventController extends Controller
{
    //
    public function index()
    {
        $event = Event::all();
        $place = Place::all();
        $now = date('Y-m-d h:m:s',time());
        
       return view("event", compact('event', 'place','now'));

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

    public function comment($menu)
    {
        $comment = Comment::where('idTypeService', 2)
        ->where('idService', $menu)
        ->get();
       return view("commentevent", compact('comment'));

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
            $name = $request->name;
            for( $i = 0; $i <= strlen($name) - 1; $i++){
              if(($name[$i] >= '!' && $name[$i] <= '@') ||
                 ($name[$i] >= '[' && $name[$i] <= '`') ||
                 ($name[$i] >= '{' && $name[$i] <= '~')){
                $errors = new MessageBag(['errorname' => 'The name must be string (a-z, A-Z) ']);
                return redirect()->back()->withInput()->withErrors($errors);
              }
            }

            $time = strtotime($request->end) - strtotime($request->begin);
            $now = date('Y-m-d h:m:s',time());
            $time2 = strtotime($request->end) - strtotime($now);
            if($time <= 0 || $time2 <= 0){
                $errors = new MessageBag(['errortime' => 'Time end must be after time begin and before the time of present']);
                return redirect()->back()->withInput()->withErrors($errors);
            }

            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);

            DB::table('Event')->insert(['nameEvent'=>$request->name, 'timeBeginEvent'=>$request->begin, 'timeEndEvent'=>$request->end, 'img'=>$filename, 'idPlace'=>$request->place, 'description'=>$request->des]);
            return redirect('event')->with(['flash_message9'=>'Update success.']);
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
            $name = $request->name;
            for( $i = 0; $i <= strlen($name) - 1; $i++){
              if(($name[$i] >= '!' && $name[$i] <= '@') ||
                 ($name[$i] >= '[' && $name[$i] <= '`') ||
                 ($name[$i] >= '{' && $name[$i] <= '~')){
                $errors = new MessageBag(['errorname' => 'The name must be string (a-z, A-Z)']);
                return redirect()->back()->withInput()->withErrors($errors);
              }
            }
            
            $time = strtotime($request->end) - strtotime($request->begin);
            $now = date('Y-m-d h:m:s',time());
            $time2 = strtotime($request->end) - strtotime($now);
            if($time <= 0 || $time2 <= 0){
                $errors = new MessageBag(['errortime' => 'Time end must be after time begin and before the time of present']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
            if($request->hasFile('image')){
              
                $img = $request->file('image');        
                $filename = time() . '.'. $img->getClientOriginalExtension();            
                $location = public_path('upload/'. $filename);
                Image::make($img)->save($location);

                DB::table('Event')->where('idEvent',$menu)->update(['nameEvent'=>$request->name, 'timeBeginEvent'=>$request->begin, 'timeEndEvent'=>$request->end, 'idPlace'=>$request->place, 'description'=>$request->des, 'img'=>$filename]);
                 return redirect('event')->with(['flash_message7'=>'Update success.']);
                
             }
             else{
             	DB::table('Event')->where('idEvent',$menu)->update(['nameEvent'=>$request->name, 'timeBeginEvent'=>$request->begin, 'timeEndEvent'=>$request->end, 'idPlace'=>$request->place, 'description'=>$request->des]);
                 return redirect('event')->with(['flash_message7'=>'Update success.']);
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
