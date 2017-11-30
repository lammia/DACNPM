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
use Session;

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
        $idevent = $menu;
       return view("commentevent", compact('comment', 'idevent'));

    }

    public function insertcomment(request $request){
      $admin = Session::get('admin');
      $idadmin = $admin->idAccount;
      $now = date('Y-m-d h:m:s',time());

      DB::table('Comment')->insert(['idAccount'=>$idadmin, 'idTypeService'=>'2', 'idService'=>$request->event, 'content'=>$request->content, 'timeComment'=>$now]);
            return redirect()->back()->with(['flash_message03'=>'Update success.']);
    }

    public function editcomment(request $request, $menu){
      $now = date('Y-m-d h:m:s',time());
      DB::table('Comment')->where('idComment', $menu)->update(['content'=>$request->content, 'timeComment'=>$now]);
            return redirect()->back()->with(['flash_message04'=>'Update success.']);
    }

    public static function getEvent()
    {
        $data = Event::get();

        return \Response::json($data);
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

    public function deletecomment($menu)
    {
        DB::table('Comment')->where('idComment',$menu)->delete();
        return redirect()->back();
    }

    public static function getEvents()
    {
        $data = [
          "listEvents" => [
            [
              "id" => "1",
              "name" => "Lễ Hội Bắn Pháo Hoa Quốc Tế",
              "money" => "2000",
              "address" => "Cầu Sông Hàn, Thành Phố Đà Nẵng",
              "description" => "Lễ Hội Pháo Hoa Đà Nẵng 2017 (DIFF 2017) được đổi tên từ cuộc thi trình diễn pháo hoa quốc tế Đà Nẵng DIFC sẽ kéo dài 2 tháng với 5 đêm bắn => 30/4, 20/5, 27/5, 03/6 và 24/6/2017 được đánh giá là sự kiện lễ hội lớn nhất Châu Á, với sự tham gia của 8 đội dự thi đến từ nhiều quốc gia có truyền thống bắn pháo hoa lâu năm. Khi đến với cuộc thi bắn pháo hoa quốc tế Đà Nẵng 2017 thì ngoài việc bạn được mãn nhãn với những màn bắn pháo hoa tuyệt đẹp của các đội dự thi trổ tài thì bạn có thể tham gia cùng với 24 lễ hội đồng hành cùng pháo hoa => Vũ Điệu Đường Phố, Âm nhạc đường phố, Không gian ẩm thực ngũ hành, lễ hội du lịch biển Đà Nẵng 2017",
              "rate" => [
                "id" => "r0",
                "countRate" => "50",
                "countComment" => "10",
                "listUser" => [
                  [
                    "id" => "id00001",
                    "name" => "Vien",
                    "email" => "viennguyen@gmail.com",
                    "username" => "viennguyen"
                  ],
                  [
                    "id" => "id00003",
                    "name" => "Dinh",
                    "email" => "longngao@gmail.com",
                    "username" => "longngao"
                  ],
                  [
                    "id" => "id00004",
                    "name" => "Lam",
                    "email" => "lampham@gmail.com",
                    "username" => "lampham"
                  ]
                ]
              ],
              "imagesHorizontal" => [
                "phaohoa1.png",
                "phaohoa2.png",
                "phaohoa3.png",
              ],
              "imagesVertical" => [
                "phaohoa0.png",
              ],
              "timeStart" => "10/10/2017",
              "timeEnd" => "31/12/2017"
            ],
            [
              "id" => "2",
              "name" => "Lễ Hội Đua Thuyền Đà Nẵng",
              "money" => "3000",
              "address" => "Cầu Sông Hàn, Thành Phố Đà Nẵng",
              "description" => "Theo ông cha kể lại, người xưa tổ chức Lễ hội đua thuyền vào ngày đầu xuân để khai thông sông rạch với ước muốn cầu mong mưa thuận, gió hòa. Làng nào giành chiến thắng trong cuộc đua thì năm đó sẽ gặp nhiều may mắn, làm ăn phát đạt. Từ xa xưa, kể cả trong những năm chiến tranh ác liệt hay thời bình, giải đua thuyền đã trở thành thông lệ trong những ngày đầu năm.",
              "rate" => [
                "id" => "r2",
                "countRate" => "30",
                "countComment" => "14",
                "listUser" => [
                  [
                    "id" => "id00007",
                    "name" => "Dung",
                    "email" => "nguyendungitbk@gmail.com",
                    "username" => "NPD"
                  ],
                  [
                    "id" => "id00003",
                    "name" => "Dinh",
                    "email" => "longngao@gmail.com",
                    "username" => "longngao"
                  ],
                  [
                    "id" => "id00004",
                    "name" => "Lam",
                    "email" => "lampham@gmail.com",
                    "username" => "lampham"
                  ]
                ]
              ],
              "imagesHorizontal" => [
                "duathuyen1.png",
                "duathuyen2.png",
                "duathuyen3.png",
              ],
              "imagesVertical" => [
                "duathuyen0.png",
              ],
              "timeStart" => "06/01/2018",
              "timeEnd" => "08/01/2018"
            ],
            [
              "id" => "3",
              "name" => "Lễ hội Cầu ngư",
              "money" => "1000",
              "address" => "Cầu Sông Hàn, Thành Phố Đà Nẵng",
              "description" => "Lễ hội Cá Ông (còn được gọi là lễ tế Cá Voi) là lễ hội lớn nhất của ngư dân thành phố Đà Nẵng. Thờ  Cá Ông ở đây không chỉ được xem là sự tôn kính thần linh mà còn gắn liền với sự hưng thịnh của cả làng. 'Ông' là tiếng gọi tôn kính của ngư dân dành riêng cho cá voi, loài cá thường giúp họ vượt qua tai nạn khi lênh đênh trên biển cả. Hàng năm, thường là sau khi ăn Tết xong, như dân tổ chức lễ tế cá Ông lồng ghép dưới hình thức Lễ hội Cầu ngư và lễ ra quân đánh bắt vụ cá nam. Tại Đà Nẵng, Lễ hội Cầu ngư được tổ chức ở những vùng ven biển như Mân Thái, Thọ Quang, Thanh Lộc Đán, Xuân Hà, Hòa Hiệp...",
              "rate" => [
                "id" => "r3",
                "countRate" => "30",
                "countComment" => "10",
                "listUser" => [
                  [
                    "id" => "id00007",
                    "name" => "Dung",
                    "email" => "nguyendungitbk@gmail.com",
                    "username" => "NPD"
                  ],
                  [
                    "id" => "id00003",
                    "name" => "Dinh",
                    "email" => "longngao@gmail.com",
                    "username" => "longngao"
                  ],
                  [
                    "id" => "id00004",
                    "name" => "Lam",
                    "email" => "lampham@gmail.com",
                    "username" => "lampham"
                  ]
                ]
              ],
              "imagesHorizontal" => [
                "caungu1.png",
                "caungu2.png",
                "caungu3.png",
              ],
              "imagesVertical" => [
                "caungu0.png",
              ],
              "timeStart" => "10/03/2018",
              "timeEnd" => "11/03/2018s"
            ],
          ],
        ];
        return $data;
    }
}
