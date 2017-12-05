<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Place;
use App\typePlace;
use App\Comment;
use App\Rating;
use Illuminate\Support\MessageBag;
use DB;
use Image;
use Session;
use Validator;

class PlaceController extends Controller
{
    public function index()
    {
      $place = Place::all();

      return view("place", compact('place'));

    }

     public function edit(request $request, $menu)
    {
        $place = DB::table('Place')
            ->where('idPlace', $menu)->first();

        $type = typePlace::all();
        return view("editplace", compact('place', 'type'));

    }

    public function addplace()
    {
        $place = Place::all();
        $type = typePlace::all();
       return view("addplace", compact('place', 'type'));

    }

    public function comment($menu)
    {
        $comment = Comment::where('idTypeService', 1)
        ->where('idService', $menu)
        ->get();
        $idplace = $menu;

       return view("commentplace", compact('comment', 'idplace'));

    }

    public function insertcomment(request $request){
      $admin = Session::get('admin');
      $idadmin = $admin->idAccount;
      $now = date('Y-m-d h:m:s',time());

      DB::table('Comment')->insert(['idAccount'=>$idadmin, 'idTypeService'=>'1', 'idService'=>$request->place, 'content'=>$request->content, 'timeComment'=>$now]);
            return redirect()->back()->with(['flash_message01'=>'Update success.']);
    }

    public function editcomment(request $request, $menu){
      $now = date('Y-m-d h:m:s',time());
      DB::table('Comment')->where('idComment', $menu)->update(['content'=>$request->content, 'timeComment'=>$now]);
            return redirect()->back()->with(['flash_message02'=>'Update success.']);
    }

    public static function getPlace()
    {
      $data = Place::get();

      return \Response::json($data);
    }

    public function insert (request $request)
    {
        $rules = [
        'name' =>'required|max:100',
        'money' => 'required|numeric',
        'address' => 'required',
        'des' => 'required',
        'latlog' => 'required',
        'image' => 'required',
        'type' => 'required',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'money.required' => 'Money To Travel is a required field.',
       'money.numeric' => 'Money To Travel must be number.',
       'address.required' => 'Address is a required field.',
       'des.required' => 'Description is a required field.',
       'latlog.required' => 'Latlog is a required field.',
       'image.required' => 'Image is a required field.',
       'type.required' => 'Type is a required field.',
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
            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);

            DB::table('Place')->insert(['namePlace'=>$request->name, 'MoneyToTravel'=>$request->money, 'address'=>$request->address,'img'=>$filename, 'idType'=>$request->type, 'description'=>$request->des, 'latlog'=>$request->latlog]);
            return redirect('place')->with(['flash_message5'=>'Update success.']);
        }   
    }

    public function update(request $request, $menu)
    {   

        $rules = [
        'name' =>'required|max:100',
        'money' => 'required|numeric',
        'address' => 'required',
        'des' => 'required',
        'latlog' => 'required',
        'type' => 'required',
        ];
       $messages = [
       'name.required' => 'Name is a required field.',
       'name.max' => 'Name less than 100 characters .',
       'money.required' => 'Money To Travel is a required field.',
       'money.numeric' => 'Money To Travel must be number.',
       'address.required' => 'Address is a required field.',
       'des.required' => 'Description is a required field.',
       'latlog.required' => 'Latlog is a required field.',
       'type.required' => 'Type is a required field.',
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
        if($request->hasFile('image')){
          
            $img = $request->file('image');        
            $filename = time() . '.'. $img->getClientOriginalExtension();            
            $location = public_path('upload/'. $filename);
            Image::make($img)->save($location);
        
            DB::table('Place')->where('idPlace',$menu)->update(['namePlace'=>$request->name, 'MoneyToTravel'=>$request->money, 'address'=>$request->address,'img'=>$filename, 'idType'=>$request->type, 'description'=>$request->des, 'latlog'=>$request->latlog]);
             return redirect('place')->with(['flash_message6'=>'Update success.']);
        }
        else{
            DB::table('Place')->where('idPlace',$menu)->update(['namePlace'=>$request->name, 'MoneyToTravel'=>$request->money, 'address'=>$request->address,'idType'=>$request->type, 'description'=>$request->des, 'latlog'=>$request->latlog]);
             return redirect('place')->with(['flash_message6'=>'Update success.']);
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
        DB::table('Event')->where('idPlace',$menu)->delete();
        DB::table('Festival')->where('idPlace',$menu)->delete();
        DB::table('Discount')->where('idPlace',$menu)->delete();
        DB::table('Place')->where('idPlace',$menu)->delete();
        return redirect('place');
    }

    public function deletecomment($menu)
    {
        DB::table('Comment')->where('idComment',$menu)->delete();
        return redirect()->back();
    }

    public static function getPlaces()
    {
      $data = [
        "listPlaces" => [
          [
            "id" => "4",
            "idEvent" => "1",
            "name" => "Bà Nà Núi Chúa",
            "money" => "300000",
            "salePrice" => "250000",
            "maxPeople" => 300,
            "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
            "type" => "Ecotourism Travel",
            "description" => "Sau Cách mạng tháng Tám năm 1945, Bà Nà dần vắng bóng người. Khi Pháp quay trở lại xâm lược Việt Nam lần thứ 2, nhân dân địa phương thực hiện chủ trương tiêu thổ kháng chiến nên đã triệt hạ các công trình xây dựng ở Bà Nà. Từ đấy, khu nghỉ mát hoang phế dần và bị cây rừng che phủ trong quên lãng gần nửa thế kỷ. Đầu năm 1997, UBND thành phố Đà Nẵng quyết định xây dựng lại Bà Nà thành một khu du lịch sinh thái có quy mô lớn với hệ thống nhà nghỉ, nhà hàng, khu bảo tồn... Con đường từ chân núi lên đỉnh Bà Nà dài 15 km đã được rải nhựa, thuận tiện cho giao thông. Sau năm 2000, Bà Nà đã được đánh thức và tái tạo vị thế một thị trấn du lịch và nhanh chóng trở lại ngôi vị của một trong những khu du lịch nổi tiếng nhất của thành phố Đà Nẵng.",
            "latLng" => "16.0004126,107.9867858",
            "rate" => [
              "id" => "r0",
              "countRate" => "50",
              "countComment" => "20",
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
              "bana1.png",
              "bana2.png",
              "bana3.png",
            ],
            "imagesVertical" => [
              "bana0.png",
            ],
          ],
          [
            "id" => "6",
            "idEvent" => "2",
            "name" => "Chùa Linh Ứng",
            "money" => "300000",
            "salePrice" => "250000",
            "maxPeople" => 300,
            "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
            "type" => "Ecotourism Travel",
            "description" => "Chùa Linh Ứng – Bãi Bụt, Sơn Trà- Đà Nẵng là một trong ba ngôi chùa cùng mang tên Linh Ứng ở Đà Nẵng. Không rõ là do vô tình hay do chữ duyên mà cả ba ngôi chùa đều được tọa lạc trên những vị thế đắc địa của thành phố Đà Nẵng, tạo thành một tam giác linh thiêng trong thành phố. Đó là chùa Linh Ứng Non Nước, nằm trên hòn Thủy sơn của một trong 5 ngọn núi Ngũ Hành Sơn. Chùa Linh Ứng Bà Nà, nằm trên chót vót núi cao của địa danh nghỉ mát Đà Lạt của miền Trung và Linh ứng Bãi Bụt, Sơn Trà, nằm lưng chừng núi – bán đảo Sơn Trà. Linh Ứng Tự Bãi Bụt là ngôi chùa to nhất, mới nhất và đẹp nhất trong 3 ngôi chùa.",
            "latLng" => "16.100088, 108.278101",
            "rate" => [
              "id" => "r1",
              "countRate" => "150",
              "countComment" => "30",
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
              "linhung1.png",
              "linhung2.png",
              "linhung3.png",
            ],
            "imagesVertical" => [
              "linhung0.png",
            ],
          ],
          [
            "id" => "7",
            "idEvent" => "3",
            "name" => "Công viên châu Á Đà Nẵng",
            "money" => "300000",
            "salePrice" => "200000",
            "maxPeople" => 300,
            "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
            "type" => "Leisure Travel",
            "description" => "Công viên vui chơi giải trí hàng đầu Đông Nam Á mang đẳng cấp quốc tế, Asia Park tại Đà Nẵng đã hoàn thành xong một vài hạng mục công trình để đưa vào hoạt động trong năm 2015 bên cạnh Sun Wheel, vòng quay top 10 thế giới đã mở cửa trước đó. Công viên Châu Á - Asian Park, tên đầy đủ là Khu Công viên Văn hóa và Vui chơi giải trí Đông Nam Đài Tưởng niệm, với quy mô đầu tư “khủng” lên đến 4.000 tỉ đồng, là khu vui chơi giải trí mang đẳng cấp quốc tế tại Đông Nam Á. Dù chưa hoàn thành hết tất cả các hạng mục nhưng trong năm 2015, dự kiến một số trò chơi mới nhất vừa hoàn thành sẽ được đưa vào hoạt động.",
            "latLng" => "16.039493, 108.228492",
            "rate" => [
              "id" => "r3",
              "countRate" => "50",
              "countComment" => "20",
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
              "asianpark1.png",
              "asianpark2.png",
              "asianpark3.png",
            ],
            "imagesVertical" => [
              "asianpark0.png",
            ],
          ],
          [
            "id" => "8",
            "idEvent" => "4",
            "name" => "Đèo Hải Vân",
            "money" => "0",
            "salePrice" => "0",
            "maxPeople" => 500,
            "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
            "type" => "Leisure Travel",
            "description" => "Đèo Hải Vân còn có tên là đèo Ải Vân (vì trên đỉnh đèo xưa kia có một cửa ải) hay đèo Mây (vì đỉnh đèo thường có mây che phủ), cao 500 m (so với mực nước biển), dài 20 km, cắt ngang dãy núi Bạch Mã (là một phần của dãy Trường Sơn chạy cắt ra sát biển) ở giữa ranh giới tỉnh Thừa Thiên-Huế (ở phía Bắc) và thành phố Đà Nẵng (ở phía Nam), Việt Nam",
            "latLng" => "16.200577, 108.133333",
            "rate" => [
              "id" => "r4",
              "countRate" => "50",
              "countComment" => "20",
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
              "deohaivan1.png",
              "deohaivan2.png",
              "deohaivan3.png",
            ],
            "imagesVertical" => [
              "deohaivan0.png",
            ],
          ],
          [
            "id" => "9",
            "idEvent" => "5",
            "name" => "Ngũ Hành Sơn",
            "money" => "100000",
            "salePrice" => "50000",
            "maxPeople" => 100,
            "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
            "type" => "Adventure Travel",
            "description" => "Ngũ Hành Sơn hay núi Non Nước là tên chung của một danh thắng gồm 5 ngọn núi đá vôi nhô lên trên một bãi cát ven biển, trên một diện tích khoảng 2 km2, gồm: Kim Sơn, Mộc Sơn, Thủy Sơn (lớn, cao và đẹp nhất), Hỏa Sơn (có hai ngọn) và Thổ Sơn, nằm cách trung tâm thành phố Đà Nẵng khoảng 8 km về phía Đông Nam, ngay trên tuyến đường Đà Nẵng - Hội An; nay thuộc phường Hòa Hải, quận Ngũ Hành Sơn, thành phố Đà Nẵng, Việt Nam.",
            "latLng" => "16.004221, 108.262865",
            "rate" => [
              "id" => "r0",
              "countRate" => "50",
              "countComment" => "20",
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
              "nguhanhson1.png",
              "nguhanhson2.png",
              "nguhanhson3.png",
            ],
            "imagesVertical" => [
              "nguhanhson0.png",
            ],
          ],
          [
            "id" => "10",
            "idEvent" => "6",
            "name" => "CÔNG VIÊN SUỐI KHOÁNG NÓNG NÚI THẦN TÀI",
            "money" => "300000",
            "salePrice" => "250000",
            "maxPeople" => 300,
            "address" => "thôn Phú Túc, xã Hòa Phú, huyện Hòa Vang, thành phố Đà Nẵng",
            "type" => "Adventure Travel",
            "description" => "Nằm tại khu bảo tồn thiên nhiên Bà Nà Núi Chúa, thôn Phú Túc, xã Hòa Phú, huyện Hòa Vang, thành phố Đà Nẵng, Công viên suối khoáng nóng Núi Thần Tài có thể nói là một tuyệt tác mà thiên nhiên ban tặng cho thủ phủ của miền Trung Việt Nam, trải dài trên một diện tích hơn 60 hectare. Giữa thành phố biển nhưng nơi đây lại mang một khí hậu đặc trưng của Bà Nà với 4 mùa trong ngày.",
            "latLng" => "15.967993, 108.019863",
            "rate" => [
              "id" => "r0",
              "countRate" => "50",
              "countComment" => "20",
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
              "nuithantai1.png",
              "nuithantai2.png",
              "nuithantai3.png",
            ],
            "imagesVertical" => [
              "nuithantai0.png",
            ],
          ],
        ],
      ];
      return $data;
    }
}
