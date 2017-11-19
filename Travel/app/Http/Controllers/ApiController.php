<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use DB;
use Image;
use Session;
use Validator;

class ApiController extends Controller
{
  public function getEvents(request $request)
  {
    // $events = DB::table('Event')->get();

    $dummydata = [
      "listEvents" => [
        [
          "id" => "e001",
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
          "id" => "e002",
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
          "id" => "e003",
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

    return \Response::json($dummydata);

  }


  public function getPlaces(request $request)
  {
    $dummydata = [
      "listPlaces" => [
        [
          "id" => "p001",
          "name" => "Bà Nà Núi Chúa",
          "money" => "3000000",
          "salePrice" => "2500000",
          "maxPeople" => 300,
          "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
          "type" => "DayTrip",
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
          "id" => "p002",
          "name" => "Chùa Linh Ứng",
          "money" => "3000000",
          "salePrice" => "2500000",
          "maxPeople" => 300,
          "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
          "type" => "DayTrip",
          "description" => "Chùa Linh Ứng – Bãi Bụt, Sơn Trà- Đà Nẵng là một trong ba ngôi chùa cùng mang tên Linh Ứng ở Đà Nẵng. Không rõ là do vô tình hay do chữ duyên mà cả ba ngôi chùa đều được tọa lạc trên những vị thế đắc địa của thành phố Đà Nẵng, tạo thành một tam giác linh thiêng trong thành phố. Đó là chùa Linh Ứng Non Nước, nằm trên hòn Thủy sơn của một trong 5 ngọn núi Ngũ Hành Sơn. Chùa Linh Ứng Bà Nà, nằm trên chót vót núi cao của địa danh nghỉ mát Đà Lạt của miền Trung và Linh ứng Bãi Bụt, Sơn Trà, nằm lưng chừng núi – bán đảo Sơn Trà. Linh Ứng Tự Bãi Bụt là ngôi chùa to nhất, mới nhất và đẹp nhất trong 3 ngôi chùa.",
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
          "id" => "p003",
          "name" => "Công viên châu Á Đà Nẵng",
          "money" => "300000",
          "salePrice" => "200000",
          "maxPeople" => 300,
          "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
          "type" => "DayTrip",
          "description" => "Công viên vui chơi giải trí hàng đầu Đông Nam Á mang đẳng cấp quốc tế, Asia Park tại Đà Nẵng đã hoàn thành xong một vài hạng mục công trình để đưa vào hoạt động trong năm 2015 bên cạnh Sun Wheel, vòng quay top 10 thế giới đã mở cửa trước đó. Công viên Châu Á - Asian Park, tên đầy đủ là Khu Công viên Văn hóa và Vui chơi giải trí Đông Nam Đài Tưởng niệm, với quy mô đầu tư “khủng” lên đến 4.000 tỉ đồng, là khu vui chơi giải trí mang đẳng cấp quốc tế tại Đông Nam Á. Dù chưa hoàn thành hết tất cả các hạng mục nhưng trong năm 2015, dự kiến một số trò chơi mới nhất vừa hoàn thành sẽ được đưa vào hoạt động.",
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
          "id" => "p004",
          "name" => "Đèo Hải Vân",
          "money" => "0",
          "salePrice" => "0",
          "maxPeople" => 500,
          "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
          "type" => "DayTrip",
          "description" => "Đèo Hải Vân còn có tên là đèo Ải Vân (vì trên đỉnh đèo xưa kia có một cửa ải) hay đèo Mây (vì đỉnh đèo thường có mây che phủ), cao 500 m (so với mực nước biển), dài 20 km, cắt ngang dãy núi Bạch Mã (là một phần của dãy Trường Sơn chạy cắt ra sát biển) ở giữa ranh giới tỉnh Thừa Thiên-Huế (ở phía Bắc) và thành phố Đà Nẵng (ở phía Nam), Việt Nam",
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
          "id" => "p005",
          "name" => "Ngũ Hành Sơn",
          "money" => "100000",
          "salePrice" => "50000",
          "maxPeople" => 100,
          "address" => "An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng",
          "type" => "DayTrip",
          "description" => "Ngũ Hành Sơn hay núi Non Nước là tên chung của một danh thắng gồm 5 ngọn núi đá vôi nhô lên trên một bãi cát ven biển, trên một diện tích khoảng 2 km2, gồm: Kim Sơn, Mộc Sơn, Thủy Sơn (lớn, cao và đẹp nhất), Hỏa Sơn (có hai ngọn) và Thổ Sơn, nằm cách trung tâm thành phố Đà Nẵng khoảng 8 km về phía Đông Nam, ngay trên tuyến đường Đà Nẵng - Hội An; nay thuộc phường Hòa Hải, quận Ngũ Hành Sơn, thành phố Đà Nẵng, Việt Nam.",
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
          "id" => "p006",
          "name" => "CÔNG VIÊN SUỐI KHOÁNG NÓNG NÚI THẦN TÀI",
          "money" => "300000",
          "salePrice" => "250000",
          "maxPeople" => 300,
          "address" => "thôn Phú Túc, xã Hòa Phú, huyện Hòa Vang, thành phố Đà Nẵng",
          "type" => "DayTrip",
          "description" => "Nằm tại khu bảo tồn thiên nhiên Bà Nà Núi Chúa, thôn Phú Túc, xã Hòa Phú, huyện Hòa Vang, thành phố Đà Nẵng, Công viên suối khoáng nóng Núi Thần Tài có thể nói là một tuyệt tác mà thiên nhiên ban tặng cho thủ phủ của miền Trung Việt Nam, trải dài trên một diện tích hơn 60 hectare. Giữa thành phố biển nhưng nơi đây lại mang một khí hậu đặc trưng của Bà Nà với 4 mùa trong ngày.",
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

    return \Response::json($dummydata);
  }
}

