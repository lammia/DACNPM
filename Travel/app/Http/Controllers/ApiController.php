<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PlaceController;
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
use App\Schedule;
use DB;
use Image;
use Session;
use Validator;

class ApiController extends Controller
{
  public function login(request $request) {
    $acc = Account::where('email', $request->email)->first();
    if ($acc->password === $request->password) {
      return \Response::json($acc);
    }
    return \Response::json("User Invalid");
  }

  public function getEvents(request $request)
  {
    $data = EventController::getEvents();

    return \Response::json($data);
  }

  public function getPlaces(request $request)
  {
    $data = PlaceController::getPlaces();

    return \Response::json($data);
  }

  public function getTours(request $request)
  {
    $data = Schedule::with('listplace')->get();
    return \Response::json($data);
  }
}

