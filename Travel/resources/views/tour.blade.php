@extends('index')
@section('content')

<body> 

  <table class="table table-hover table-bordered responstable example" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> TOUR MANAGEMENT</h3>
      <a href="{{url('addtour')}}" class="btn btn-primary"><i class="fa fa-plus"></i> ADD TOUR</a>
    <div>
      @if (Session::has('flash_message6'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message6') !!}
      </div>
      @endif
      @if (Session::has('flash_message5'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message5') !!}
      </div>
    @endif 
    </div>

    <thead>
      <tr align="center" >
        <th style="text-align: center">ID</th>      
        <th style="text-align: center">People</th>
        <th style="text-align: center">List Place</th>
        <th style="text-align: center">Money</th>
        <th style="text-align: center">Time begin</th>
        <th style="text-align: center">Time end</th>
        <!-- <th style="text-align: center">Rating</th> -->  
        <th style="text-align: center; width: 24%;">Action</th> 
      </tr>
    </thead>

    <tbody>
    @foreach($tour as $item)
    <tr>
     <td>{{$item->idSchedule}}</td>
     <td>{{$item->amountOfPeople}}</td>
     <td></td>
     <td>{{$item->money}}</td>
     <td>{{$item->timeBegin}}</td>
     <td>{{$item->timeEnd}}</td>
     <td>
      <a href="{{ url('/edit-tour/'.$item->idSchedule) }}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
      <a href="{{ url('/delete-tour/'.$item->idSchedule) }}" class ="btn btn-danger" 
            onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
        </a> 
     </td>
     </tr>
    @endforeach
    </tbody>

  </table>
</body>
@stop