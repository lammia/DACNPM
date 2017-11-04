@extends('index')
@section('content')

<body> 

  <h3 style="color: #5a738e" align="center"> EDIT FESTIVAL</h3><br>
  <form action="/updateFestival/{{$festival->idFestival}}" method="POST" name="form" style="margin-left: 150px" enctype="multipart/form-data">
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

  <div class="form-group">
      <label class="control-label col-sm-2">ID:</label>
      <input type="text" disabled="disabled" class="form-control" id="formGroupExampleInput" name="id" value="{{$festival->idFestival}}">
  </div>

  <div class="form-group">
      <label class="control-label col-sm-2">Name:</label>
     <input type="text" class="form-control" required="" maxlength="100" id="formGroupExampleInput" name="name" value="{{$festival->nameFestival}}">
  </div>
    @if($errors->has('name'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('name') }}</p>
      </div>
    @endif          

  <div class="form-group">
    <label class="control-label col-sm-2">Time Begin:</label>
    <input type="" class="form-control datetime" required="" readonly="" name="begin" value="{{$festival->timeBeginFestival}}">
  </div>
  @if($errors->has('begin'))
    <div style="padding-left: 50px;">
    <p style="color:red">{{ $errors->first('begin') }}</p>
    </div>
  @endif

   <div class="form-group">
    <label class="control-label col-sm-2">Time End:</label>
    <input type="" class="form-control datetime" required="" readonly="" name="end" value="{{$festival->timeEndFestival}}">
  </div>
  @if($errors->has('end'))
    <div style="padding-left: 50px;">
    <p style="color:red">{{ $errors->first('end') }}</p>
    </div>
  @endif
  @if($errors->has('errortime'))
    <div style="padding-left: 150px;">
    <p style="color:red">{{ $errors->first('errortime') }}</p>
    </div>
  @endif
  
  <div class="form-group">
      <label class="control-label col-sm-2">Place:</label>
     <select name ="place" class="input-large form-control">
        @foreach( $place as $value)
          @if($value->idPlace == $festival->idPlace)
          <option selected="" value="{{$value->idPlace}}">{{$value->namePlace}}</option>
          @else
        <option value="{{$value->idPlace}}">{{$value->namePlace}}</option>
        @endif
        @endforeach     
      </select>
  </div>

  <div class="form-group">
      <label class="control-label col-sm-2">Image:</label>
      <input type="file" class="form-control" id="formGroupExampleInput" name="image" value="{{$festival->img}}">
  </div>
    @if($errors->has('image'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('image') }}</p>
      </div>
    @endif

  <div class="form-group">
      <label class="control-label col-sm-2">Description</label><br><br>
      <div style="padding-right: 90px">
      <textarea id="ckeditor" name="des" value="{{$festival->Description}}"></textarea>
      </div>
    </div>
    @if($errors->has('des'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('des') }}</p>
      </div>
    @endif            
              
    <div style="text-align: center; margin-left: -150px; margin-bottom: 10px;" >
      <button style="margin-top: 15px" type="submit" class="btn btn-success">Save</button>
    </div>

  </form>                

</body>
@stop          
