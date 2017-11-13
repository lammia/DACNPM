<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discount;
use App\Place;
use Illuminate\Support\MessageBag;
use DB;
use Validator;

class DiscountController extends Controller
{
    //
    public function index()
    {
        $discount = Discount::all();
        $place = Place::all();
        $now = date('Y-m-d h:m:s',time());
        return view("discount", compact('discount', 'place', 'now'));

    }

    public function edit(request $request, $menu)
    {
        $discount = DB::table('Discount')
            ->where('idDiscount', $menu)->first();

        $place = Place::all();
        return view("editdiscount", compact('discount', 'place'));
    }

    public function addDiscount()
    {
        $discount = Discount::all();
        $place = Place::all();
       return view("addDiscount", compact('discount', 'place'));

    }

    public function insert (request $request)
    {
        $rules = [
        'percent' =>'required|numeric',
        'begin' => 'required',
        'end' => 'required',
        ];
       $messages = [
       'percent.required' => 'Percent discount is a required field.',
       'percent.numeric' => 'Percent discount must be number.',
       'begin.required' => 'Time begin is a required field.',
       'end.required' => 'Time end is a required field.',
       ];

       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        else{
            $percent = $request->percent;
            if($percent >100 ){
                $errors = new MessageBag(['percent' => 'Percent discount must be less than 100%']);
                return redirect()->back()->withInput()->withErrors($errors);
            } 
            $time =strtotime($request->end) - strtotime($request->begin);
            $now = date('Y-m-d h:m:s',time());
            $time2 = strtotime($request->end) - strtotime($now);
            if($time <= 0 || $time2 <= 0){
                $errors = new MessageBag(['errortime' => 'Time end must be after time begin and before the time of present']);
                return redirect()->back()->withInput()->withErrors($errors);
            }


            $list = DB::table('Discount')
                ->where('idPlace',$request->place)
                ->get();
            $dem = $list->count();   

            if($dem==0) {
                DB::table('Discount')->insert(['idPlace'=>$request->place, 'percentDiscount'=>$request->percent, 'timeBeginDiscount'=>$request->begin, 'timeEndDiscount'=>$request->end]);
                return redirect('discount')->with(['flash_message21'=>'Update success.']);
            }
            else{
                for($i=0;$i<$dem;$i++){                   
                    if((strtotime($list[$i]->timeBeginDiscount) <= strtotime($request->begin)) && (strtotime($list[$i]->timeEndDiscount) > strtotime($request->begin))){
                        $errors = new MessageBag(['overlaptime' => 'Already discount at this time']);
                        return redirect()->back()->withInput()->withErrors($errors);
                    }
                    else if((strtotime($list[$i]->timeBeginDiscount) < strtotime($request->end)) && (strtotime($list[$i]->timeEndDiscount) > strtotime($request->end))){
                        $errors = new MessageBag(['overlaptime' => 'Already discount at this time']);
                        return redirect()->back()->withInput()->withErrors($errors);    
                    }
                    else if((strtotime($list[$i]->timeBeginDiscount) >= strtotime($request->begin)) && (strtotime($list[$i]->timeEndDiscount) < strtotime($request->end))){
                        $errors = new MessageBag(['overlaptime' => 'Already discount at this time']);
                        return redirect()->back()->withInput()->withErrors($errors);   
                    }
                    if($i==$dem-1){
                        DB::table('Discount')->insert(['idPlace'=>$request->place, 'percentDiscount'=>$request->percent, 'timeBeginDiscount'=>$request->begin, 'timeEndDiscount'=>$request->end]);
                        return redirect('discount')->with(['flash_message21'=>'Update success.']);
                    }        
               } 
            }
        }   
    }

    public function update(request $request, $menu)
    {   
    	$rules = [
        'percent' =>'required|numeric',
        'begin' => 'required',
        'end' => 'required',
        ];
       $messages = [
       'percent.required' => 'Percent discount is a required field.',
       'percent.numeric' => 'Percent discount must be number.',
       'begin.required' => 'Time begin is a required field.',
       'end.required' => 'Time end is a required field.',
       ];

       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $percent = $request->percent;
            if($percent >100 ){
                $errors = new MessageBag(['percent' => 'Percent discount must be less than 100%']);
                return redirect()->back()->withInput()->withErrors($errors);
            } 
            $time =strtotime($request->end) - strtotime($request->begin);
            $now = date('Y-m-d h:m:s',time());
            $time2 = strtotime($request->end) - strtotime($now);
            if($time <= 0 || $time2 <= 0){
                $errors = new MessageBag(['errortime' => 'Time end must be after time begin and before the time of present']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
            ////////////////////////////////////

            $list = DB::table('Discount')
                ->where('idPlace',$request->place)
                ->where('timeBeginDiscount', '!=', $request->begin)
                ->where('timeEndDiscount', '!=', $request->end)
                ->get();
                
            $dem = $list->count();   

            if($dem==0) {
                DB::table('Discount')->where('idDiscount',$menu)->update(['percentDiscount'=>$request->percent, 'timeBeginDiscount'=>$request->begin, 'timeEndDiscount'=>$request->end]);
                return redirect('discount')->with(['flash_message20'=>'Update success.']);
            }
            else{
                for($i=0;$i<$dem;$i++){                   
                    if((strtotime($list[$i]->timeBeginDiscount) <= strtotime($request->begin)) && (strtotime($list[$i]->timeEndDiscount) > strtotime($request->begin))){
                        $errors = new MessageBag(['overlaptime' => 'Already discount at this time']);
                        return redirect()->back()->withInput()->withErrors($errors);
                    }
                    else if((strtotime($list[$i]->timeBeginDiscount) < strtotime($request->end)) && (strtotime($list[$i]->timeEndDiscount) > strtotime($request->end))){
                        $errors = new MessageBag(['overlaptime' => 'Already discount at this time']);
                        return redirect()->back()->withInput()->withErrors($errors);    
                    }
                    else if((strtotime($list[$i]->timeBeginDiscount) >= strtotime($request->begin)) && (strtotime($list[$i]->timeEndDiscount) < strtotime($request->end))){
                        $errors = new MessageBag(['overlaptime' => 'Already discount at this time']);
                        return redirect()->back()->withInput()->withErrors($errors);   
                    }
                    if($i==$dem-1){
                        DB::table('Discount')->where('idDiscount',$menu)->update(['percentDiscount'=>$request->percent, 'timeBeginDiscount'=>$request->begin, 'timeEndDiscount'=>$request->end]);
                        return redirect('discount')->with(['flash_message20'=>'Update success.']);
                    }        
               } 
            }


            ////////////////////////////

         	// DB::table('Discount')->where('idDiscount',$menu)->update(['percentDiscount'=>$request->percent, 'timeBeginDiscount'=>$request->begin, 'timeEndDiscount'=>$request->end]);
          //    return redirect('discount')->with(['flash_message20'=>'Update success.']);
         
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
        DB::table('Discount')->where('idDiscount',$menu)->delete();
        return redirect('discount');
    }
}
