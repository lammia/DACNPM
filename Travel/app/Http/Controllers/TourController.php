<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Place;
use App\Schedule;
use App\listPlace;
use Illuminate\Support\MessageBag;
use DB;
use Session;
use Validator;

class TourController extends Controller
{
    public function index()
    {
        $tour = Schedule::all();
        return view("tour", compact('tour'));

    }

    public function addtour()
    {
        $place = Place::all();
        // $event = DB::table('Event')
        //   ->where('idPlace', $place[0]->idPlace)
        //   ->get();

        return view("addTour", compact('place'));

    }

    public function edit($id)
    {
        $place = Place::all();

        $tour = DB::table('Schedule')
          ->where('id', $id)
          ->first();

        return view("editTour", compact('tour', 'place'));

    }

    public function getEventByPlaceId(request $request)
    {
      $events = DB::table('Event')
          ->where('idPlace', $request->idPlace)
          ->get();

      return \Response::json($events);

    }

    public function insert(request $request){
        $tour = new Schedule();

        $tour->amountOfPeople = $request->people;
        $tour->timeBegin = $request->begin;
        $tour->timeEnd = $request->end;
        $tour->money = $request->money;
        $tour->save();

        for ($i=0; $i < count($request->place); $i++) { 
            $model = new listPlace();

            $model->idPlace = $request->place[$i];
            $model->idSchedule = $tour->id;
            $model->save();
        }
        return redirect('/tour');

    }

    public function update(request $request, $id){
        $tour = Schedule::where('id', $id)->first();

        $tour->amountOfPeople = $request->people;
        $tour->timeBegin = $request->begin;
        $tour->timeEnd = $request->end;
        $tour->money = $request->money;
        $tour->save();


        DB::table('listPlace')->where('idSchedule', $id)->delete();
        for ($i=0; $i < count($request->place); $i++) { 
            $model = new listPlace();

            $model->idPlace = $request->place[$i];
            $model->idSchedule = $tour->id;
            $model->save();
        }
        return redirect('/tour');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        DB::table('listPlace')->where('idSchedule', $id)->delete();
        DB::table('Schedule')->where('id',$id)->delete();
        return redirect('/tour');
    }

     
}
