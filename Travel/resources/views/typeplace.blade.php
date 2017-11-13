@extends('index')
@section('content')

<body> 
<h3 style="color: #5a738e;" align="center"> TYPE PLACE MANAGEMENT</h3>
<br>
    <div>
        @if (Session::has('flash_message17'))
        <div class="alert alert-success form-feedback" role="alert">
          {!! Session::get('flash_message17') !!}
        </div>
        @endif
        @if (Session::has('flash_message18'))
        <div class="alert alert-success form-feedback" role="alert">
          {!! Session::get('flash_message18') !!}
        </div>
        @endif
    </div>
    <form action="/newtype" method="POST" class="form-inline" enctype="multipart/form-data"> 
      <input type="hidden" name="_token"  value="{!!csrf_token()!!}">
      
      <div class="form-group">
      <input type="text" class="form-control" required="" maxlength="50" name="name" placeholder="Enter new type">
      </div>
      <button type="submit" style="margin-top: 5px;" class="btn">Save</button>
    </form><br>

    <table class="table table-hover table-bordered responstable example" style="border-collapse:collapse;">

      <thead>
        <tr align="center" >
          <th style="text-align: center">ID</th>      
          <th style="text-align: center">Name</th> 
          <th style="text-align: center; width: 35%;">Action</th> 
        </tr>
      </thead>
      
      @foreach($type as $item)
      <tbody>
      <tr>
        <form action="/EditType/{{$item->idType}}" method ="POST" enctype="multipart/form-data"> 
        <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

        <td>{{$item->idType}}</td>
        <td><input style="border: 0; background-color: #f0f8ff" class="form-control" type="text" id="example-text-input" required="" maxlength="50" name="name" value="{{$item->nameType}}"></td>
        <td>
          <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i>Save</button>
          <a href="{{ url('/DeleteType/'.$item->idType) }}" class ="btn btn-danger" 
              onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
          </a>
        </td>
        </form>
      </tr>
      </tbody>      
      @endforeach
    </table>

</body>
@stop