@extends('index')
@section('content')

<body> 

  <table class="table table-hover table-bordered responstable example" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> COMMENT MANAGEMENT</h3>
    <thead>
      <tr align="center" >
        <th style="text-align: center">ID</th>      
        <th style="text-align: center">Place</th>
        <th style="text-align: center">Content</th>
        <th style="text-align: center">User</th>
        <th style="text-align: center">Time</th> 
        <th style="text-align: center; width: 20%;">Action</th> 
      </tr>
    </thead>

    <tbody>
    @foreach($comment as $item)
    <tr>
     <td>{{$item->idComment}}</td>
     <td>{{$item->place->namePlace}}</td>
     <td>{{$item->content}}</td>
     <td>{{$item->user->nameAccount}}</td>
     <td>{{$item->timeComment}}</td>
     <td>
      <a href="{{ url('/DeleteComment/'.$item->idComment) }}" class ="btn btn-danger" 
          onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
      </a>
     </td>
     </tr>
    @endforeach
    </tbody>

  </table>
</body>
@stop