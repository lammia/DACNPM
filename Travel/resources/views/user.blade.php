@extends('index')
@section('content')
<body>
  <table class="stripe responstable example" width="100%" cellspacing="0" border-collapse: collapse ;> 
    <h3 style="color: #5a738e;" align="center"> USER MANAGEMENT</h3>
    <a href="{{url('adduser')}}" class="btn btn-primary"><i class="fa fa-plus"></i> ADD USER</a><br>
    
    <div>
      @if (Session::has('flash_message0'))
      <div class="alert alert-danger form-feedback" role="alert">
        {!! Session::get('flash_message0') !!}
      </div>
      @endif
      @if (Session::has('flash_message1'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message1') !!}
      </div>
      @endif
      @if (Session::has('flash_message'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message') !!}
      </div>
      @endif
    </div>

    <thead>
      <tr align="center" >
        <th style="text-align: center">ID</th>      
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Email</th>
        <th style="text-align: center">Adress</th>
        <th style="text-align: center">Phone number</th>      
        <th style="text-align: center">Image</th>
        <th style="text-align: center; width: 24%;">Action</th> 
      </tr>
    </thead>

    <tbody>
    @foreach($account as $item)
    <tr>
     <td>{{$item->idAccount}}</td>
     <td>{{$item->nameAccount}}</td>
     <td>{{$item->email}}</td>
     <td>{{$item->districts->name}}, {{$item->provinces->name}}</td>
     <td>{{$item->phone}}</td>
     <td><img class="img-rounded img-responsive" width="104" height="90" src="{{asset('upload/'.$item->img)}}"></td>
     <td>
        <a href="{{url('EditUser/'.$item->idAccount)}}" class="btn btn-success btn-responsive"><i class="fa fa-edit"></i> Edit</a>

        <a href="{{ url('/DeleteUser/'.$item->idAccount) }}" class ="btn btn-danger btn-responsive" 
            onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
        </a>
     </td>
    </tr>
    @endforeach 
    </tbody>
    </table>
</body>
@stop
