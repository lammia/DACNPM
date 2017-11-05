@extends('index')
@section('content')

<body> 

  <table class="table table-hover table-bordered responstable example" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> PLACE MANAGEMENT</h3>
      <a href="{{url('addplace')}}" class="btn btn-primary"><i class="fa fa-plus"></i> ADD PLACE</a><br>
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
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Type</th>
        <th style="text-align: center">Money</th>
        <th style="text-align: center">Adress</th>
        <th style="text-align: center">Image</th>  
        <th style="text-align: center; width: 24%;">Action</th> 
      </tr>
    </thead>

    <tbody>
    @foreach($place as $item)
    <tr>
     <td>{{$item->idPlace}}</td>
     <td>{{$item->namePlace}}</td>
     <td>{{$item->type->nameType}}</td>
     <td>{{$item->MoneyToTravel}}</td>
     <td>{{$item->address}}</td>
     <td><img class="img-rounded img-responsive" width="104" height="90" src="{{asset('upload/'.$item->img)}}"></td>
     <td>
      <a href="{{url('EditPlace/'.$item->idPlace)}}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
      <a href="{{ url('/DeletePlace/'.$item->idPlace) }}" class ="btn btn-danger" 
          onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
      </a>
     </td>
     </tr>
    @endforeach
    </tbody>

  </table>
</body>
@stop