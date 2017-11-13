@extends('index')
@section('content')
<body>
  <table class="table table-hover table-bordered responstable example" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> DISCOUNT MANAGEMENT</h3>
      <a href="{{url('addDiscount')}}" class="btn btn-primary"><i class="fa fa-plus"></i> ADD DISCOUNT</a><br>
    <div>
      @if (Session::has('flash_message20'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message20') !!}
      </div>
      @endif 
      @if (Session::has('flash_message21'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message21') !!}
      </div>
      @endif 
    </div>

    <thead>
      <tr align="center" >
        <th style="text-align: center">ID</th>
        <th style="text-align: center">Place</th>      
        <th style="text-align: center">Percent Discount</th>
        <th style="text-align: center">Time begin</th>
        <th style="text-align: center">Time end</th>
        <th style="text-align: center">Status</th>
        <th style="text-align: center; width: 24%;">Action</th> 
      </tr>
    </thead>

    <tbody>
    @foreach($discount as $item)
    <tr>
     <td>{{$item->idDiscount}}</td>
     <td>{{$item->places->namePlace}}</td>
     <td>{{$item->percentDiscount}}%</td>
     <td>{{$item->timeBeginDiscount}}</td>
     <td>{{$item->timeEndDiscount}}</td>
     @if((strtotime($item->timeEndDiscount) - strtotime($now)) <= 0)
      <td>Finished</td>
      <td>
      <a href="{{url('EditDiscount/'.$item->idDiscount)}}" class="btn btn-success" disabled=""><i class="fa fa-edit"></i> Edit</a>
      <a href="{{ url('/DeleteDiscount/'.$item->idDiscount) }}" class ="btn btn-danger" 
            onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
        </a> 
     </td>
     @else
      <td>Doing</td>
      <td>
      <a href="{{url('EditDiscount/'.$item->idDiscount)}}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
      <a href="{{ url('/DeleteDiscount/'.$item->idDiscount) }}" class ="btn btn-danger" 
            onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
        </a> 
     </td>
     @endif
     </tr>
    @endforeach
    </tbody>

  </table>
</body>
@stop