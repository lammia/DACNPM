@extends('index')
@section('content')
<body>
  <table class="table table-hover table-bordered responstable" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> FESTIVAL MANAGEMENT</h3>
      <a href="{{url('addfestival')}}" class="btn btn-primary"><i class="fa fa-plus"></i> ADD FESTIVAL</a><br>
    <div>
      @if (Session::has('flash_message12'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message12') !!}
      </div>
      @endif
      @if (Session::has('flash_message14'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message14') !!}
      </div>
      @endif  
    </div>

    <thead>
      <tr align="center" >
        <th style="text-align: center">ID</th>      
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Time begin</th>
        <th style="text-align: center">Time end</th>
        <th style="text-align: center">Place</th>
        <th style="text-align: center">Image</th>
        <th style="text-align: center; width: 24%;">Action</th> 
      </tr>
    </thead>

    @foreach($festival as $item)
    <tbody>
    <tr>
     <td>{{$item->idFestival}}</td>
     <td>{{$item->nameFestival}}</td>
     <td>{{$item->timeBeginFestival}}</td>
     <td>{{$item->timeEndFestival}}</td>
     <td>{{$item->places->namePlace}}</td>
     <td><img class="img-rounded" width="104" height="90" src="{{asset('upload/'.$item->img)}}"></td>
     <td>
      <a href="{{url('EditFestival/'.$item->idFestival)}}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
      <a href="{{ url('/DeleteFestival/'.$item->idFestival) }}" class ="btn btn-danger" 
            onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
        </a> 
     </td>
     </tr>
    
    </tbody>

    @endforeach

  </table>
</body>
@stop