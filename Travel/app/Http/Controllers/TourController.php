<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Place;
use App\Schedule;
use App\listPlace;
use App\typePlace;
use App\Discount;
use Illuminate\Support\MessageBag;
use DB;
use Session;
use Validator;

class TourController extends Controller
{
    public function index()
    {
        $tour = Schedule::all();
        // $listplace = array();

        // for($i=0; $i < count($tour); $i++){
        //     $place = listPlace::where('idSchedule', $tour[$i]->idSchedule)
        //             ->get()->toArray();
        //     array_push($listplace, $place);
        // }

        //return view("tour", compact('tour', 'listplace'));
        return view("tour", compact('tour'));

    }

    public function addtour()
    {
        $place = Place::all();
        $type = typePlace::all();

        return view("addTour", compact('place', 'type'));

    }

    public function edit($id)
    {
        $place = Place::all();
        $type = typePlace::all();

        $tour = DB::table('Schedule')
          ->where('id', $id)
          ->first();

        return view("editTour", compact('tour', 'place', "type"));

    }

    public function getEventByPlaceId(request $request)
    {
      $events = DB::table('Event')
          ->where('idPlace', $request->idPlace)
          ->get();

      return \Response::json($events);

    }

    public function getPlaceByTypeId(request $request)
    {
      $places = DB::table('Place')
          ->where('idType', $request->type)
          ->get();

      return \Response::json($places);

    }

    public function insert(request $request){
        $tour = new Schedule();
        $money = 0;
        for($i=0; $i < count($request->place); $i++){
            $places = Place::where('idPlace', $request->place[$i])
                        ->select('MoneyToTravel')
                        ->get()->toArray();
                  
            $money += $places[0]['MoneyToTravel'];
        }

        $tour->amountOfPeople = $request->people;
        $tour->timeBegin = $request->begin;
        $tour->timeEnd = $request->end;
        $tour->type = $request->type;
        $tour->money = $money;
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
        $money = 0;
        for($i=0; $i < count($request->place); $i++){
            $places = Place::where('idPlace', $request->place[$i])
                        ->select('MoneyToTravel')
                        ->get()->toArray();
                  
            $money += $places[0]['MoneyToTravel'];
        }

        $tour->amountOfPeople = $request->people;
        $tour->timeBegin = $request->begin;
        $tour->timeEnd = $request->end;
        $tour->type = $request->type;
        $tour->money = $money;
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
