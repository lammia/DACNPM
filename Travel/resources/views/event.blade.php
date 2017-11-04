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
        <th style="text-align: center;">Action</th> 
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
     <td><img class="img-rounded" width="104" height="90" src="{{asset('upload/'.$item->img)}}"></td>
     <td>
      <a href="{{url('EditEvent/'.$item->idEvent)}}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
      <a href="{{ url('/DeleteEvent/'.$item->idEvent) }}" class ="btn btn-danger" 
          onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
      </a>
     </td>
     </tr>
    @endforeach
    </tbody>

  </table>
</body>
@stop