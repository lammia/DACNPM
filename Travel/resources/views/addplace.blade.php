@extends('index')
@section('content')
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script>
  <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVope279d5hItMMKRXz6hym9Ku5aG0UL0&libraries=places"></script>
  <script src="{{ asset('js/map.js')}}"></script> -->
<body>
  
  <h3 style="color: #5a738e" align="center"> ADD PLACE</h3><br>
  <form action="/newplace" method="POST" name="formplace" enctype="multipart/form-data"> 
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

    <div class="form-group">
      <label class="control-label col-sm-2">Name:</label>
      <input type="text" class="form-control" required="" maxlength="50" id="formGroupExampleInput" name="name">
    </div>
    @if($errors->has('errorname'))
      <div >
      <p style="color:red">{{ $errors->first('errorname') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Money:</label>
      <input type="text" class="form-control" required="" minlength="4" maxlength="10" id="formGroupExampleInput" name="money">
    </div>
    @if($errors->has('money'))
      <div>
      <p style="color:red">{{ $errors->first('money') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Adress:</label>
      <input type="text" id="address" class="form-control" required="" maxlength="100" id="formGroupExampleInput" name="address" onblur="codeAddress();">
    </div>
    @if($errors->has('address'))
      <div>
      <p style="color:red">{{ $errors->first('address') }}</p>
      </div>
    @endif
    
    <div class="form-group">
      <div id="map"></div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2">Type:</label>
        <select class="input-large form-control" name="type">
          @foreach( $type as $value)
          <option value="{{$value->idType}}">{{$value->nameType}}</option>
          @endforeach
        </select>
    </div>
    @if($errors->has('type'))
      <div>
      <p style="color:red">{{ $errors->first('type') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Latlog</label>
      <input type="text" required="" class="form-control" id="latlog" name="latlog">
    </div>
    @if($errors->has('latlog'))
      <div>
      <p style="color:red">{{ $errors->first('latlog') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Image:</label>
      <input type="file" class="form-control" id="formGroupExampleInput" name="image">
    </div>
    @if($errors->has('image'))
      <div>
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
      <div >
      <p style="color:red">{{ $errors->first('des') }}</p>
      </div>
    @endif

    <div style="text-align: center; margin-left: -150px">
      <button style="margin-top: 15px" type="submit" class="btn btn-success">Save</button>
    </div>
    
  </form>

  </body>

  @stop
