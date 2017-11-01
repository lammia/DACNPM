@extends('index')
@section('content')

<body> 

  <table class="table table-hover table-bordered responstable" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> PLACE MANAGEMENT</h3>
      <a href="{{url('addplace')}}" class="btn btn-primary"><i class="fa fa-plus"></i> ADD PLACE</a><br>
    <div>
      @if (Session::has('flash_message2'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message2') !!}
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

    @foreach($place as $item)
    <tbody>
    <tr>
     <td>{{$item->idPlace}}</td>
     <td>{{$item->namePlace}}</td>
     <td>{{$item->type->nameType}}</td>
     <td>{{$item->MoneyToTravel}}</td>
     <td>{{$item->address}}</td>
     <td><img class="img-rounded" width="104" height="90" src="{{asset('upload/'.$item->img)}}"></td>
     <td>
      <a href="{{url('EditPlace/'.$item->idPlace)}}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
      <a href="{{ url('/DeletePlace/'.$item->idPlace) }}" class ="btn btn-danger" 
          onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
      </a>
     </td>
     </tr>
    
    </tbody>

    @endforeach

  </table>
</body>
@stop