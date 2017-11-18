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

        return view("addTour", compact('place'));

    }

    public function insert(request $request){
        $tour = new Schedule();

        $tour->amountOfPeople = $request->people;
        $tour->timeBegin = $request->begin;
        $tour->timeEnd = $request->end;
        $tour->money = $request->money;

        $tour->save();

    }

     
}
