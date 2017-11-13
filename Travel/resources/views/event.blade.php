@extends('index')
@section('content')
<body>
  <table class="table table-hover table-bordered responstable example" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> EVENT MANAGEMENT</h3>
      <a href="{{url('addevent')}}" class="btn btn-primary"><i class="fa fa-plus"></i> ADD EVENT</a><br>
     <div>
      @if (Session::has('flash_message7'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message7') !!}
      </div>
      @endif
      @if (Session::has('flash_message9'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message9') !!}
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
        <th style="text-align: center;">Status</th>
        <th style="text-align: center; width: 24%;">Action</th> 
      </tr>
    </thead>

    <tbody>
    @foreach($event as $item)
    <tr>
     <td>{{$item->idEvent}}</td>
     <td>{{$item->nameEvent}}</td>
     <td>{{$item->timeBeginEvent}}</td>
     <td>{{$item->timeEndEvent}}</td>
     <td>{{$item->places->namePlace}}</td>
     <td><img class="img-rounded img-responsive" width="104" height="90" src="{{asset('upload/'.$item->img)}}"></td>

    @if((strtotime($item->timeEndEvent) - strtotime($now)) <= 0)
      <td>Finished</td>
      <td>
        <a href="{{url('EditEvent/'.$item->idEvent)}}" disabled="" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
        <a href="{{ url('/DeleteEvent/'.$item->idEvent) }}" class ="btn btn-danger" 
          onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
        </a>
      </td>
    @else
      <td>Doing</td>
      <td>
        <a href="{{url('EditEvent/'.$item->idEvent)}}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
        <a href="{{ url('/DeleteEvent/'.$item->idEvent) }}" class ="btn btn-danger" 
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