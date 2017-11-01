@extends('index')
@section('content')

<body>
  
  <h3 style="color: #5a738e" align="center"> ADD FESTIVAL</h3><br>
  <form action="/newfestival" method="POST" name="formplace" style="margin-left: 150px" enctype="multipart/form-data">
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">
  <div>
    @if (Session::has('flash_message8'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message8') !!}
      </div>
    @endif
  </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Name Place:</label>
      <select name="place" class="input-large form-control">
        @foreach($place as $value)
          <option value="{{$value->idPlace}}">{{$value->namePlace}}</option>
        @endforeach 
      </select>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Name:</label>
      <input type="text" class="form-control" required="" maxlength="50" id="formGroupExampleInput" name="name">
    </div>
    @if($errors->has('name'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('name') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Time begin:</label>
      <input type="datetime-local" class="form-control datepicker" required="" id="formGroupExampleInput" name="begin">  
    </div>
    @if($errors->has('begin'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('begin') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Time end:</label>
      <input type="datetime-local" class="form-control" required="" id="formGroupExampleInput" name="end">  
    </div>
    @if($errors->has('end'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('end') }}</p>
      </div>
    @endif
    
    <div class="form-group">
      <label class="control-label col-sm-2">Image:</label>
      <input type="file" class="form-control" required="" id="formGroupExampleInput" name="image">
    </div>
    @if($errors->has('image'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('image') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Description</label><br><br>
      <div style="padding-right: 90px">
      <textarea id="ckeditor" name="des"></textarea>
      </div>
    </div>
    @if($errors->has('des'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('des') }}</p>
      </div>
    @endif

    <div style="text-align: center; margin-left: -150px">
      <button style="margin-top: 15px" type="submit" class="btn btn-success">Save</button>
    </div>

  </form>
  </body>
  @stop
