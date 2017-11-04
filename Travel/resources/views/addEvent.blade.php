@extends('index')
@section('content')
<body>
  
  <h3 style="color: #5a738e" align="center"> ADD EVENT</h3><br>
  <form action="/newevent" method="POST" name="formplace" style="margin-left: 150px" enctype="multipart/form-data">
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

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
      <input type="" required="" class=" form-control datetime" readonly="" name="begin">  
    </div>
    @if($errors->has('begin'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('begin') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Time end:</label>
      <input type="" class="form-control datetime" required="" readonly="" name="end">  
    </div>
    @if($errors->has('end'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('end') }}</p>
      </div>
    @endif
    @if($errors->has('errortime'))
        <div style="padding-left: 150px;">
          <p style="color:red">{{ $errors->first('errortime') }}</p>
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
