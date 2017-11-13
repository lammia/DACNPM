<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Place;
use App\Schedule;
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

     
}
