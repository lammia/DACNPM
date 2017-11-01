@extends('index')
@section('content')
<body>
  <table class="table table-hover table-bordered responstable" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> USER MANAGEMENT</h3>
    <a href="{{url('adduser')}}" class="btn btn-primary"><i class="fa fa-plus"></i> ADD USER</a><br>
    
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

    @foreach($account as $item)
    <tbody>
    <tr>
     <td>{{$item->idAccount}}</td>
     <td>{{$item->nameAccount}}</td>
     <td>{{$item->email}}</td>
     <td>{{$item->address}}</td>
     <td>{{$item->phone}}</td>
     <td><img class="img-rounded" width="104" height="90" src="{{asset('upload/'.$item->img)}}"></td>
     <td>
        <a href="{{url('EditUser/'.$item->idAccount)}}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>

        <a href="{{ url('/DeleteUser/'.$item->idAccount) }}" class ="btn btn-danger" 
            onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
        </a>
     </td>
    </tr>
      
    </tbody>
    @endforeach
    </table>
</body>
@stop
