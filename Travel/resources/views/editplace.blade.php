@extends('index')
@section('content')

<body> 

  <h3 style="color: #5a738e" align="center"> EDIT PLACE</h3><br>
  <form action="/updatePlace/{{$place->idPlace}}" method="POST" name="form" enctype="multipart/form-data">
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

  <div class="form-group">
      <label class="control-label col-sm-2">ID:</label>
      <input type="text" disabled="disabled" class="form-control" id="formGroupExampleInput" name="id" value="{{$place->idPlace}}">
  </div>
  
  <div class="form-group">
      <label class="control-label col-sm-2">Name:</label>
     <input type="text" class="form-control" required="" maxlength="100" id="formGroupExampleInput" name="name" value="{{$place->namePlace}}">
    </div>
    @if($errors->has('errorname'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('errorname') }}</p>
      </div>
    @endif  

    <div class="form-group">
      <label class="control-label col-sm-2">Money:</label>
     <input type="text" class="form-control" required="" minlength="4" maxlength="10" id="formGroupExampleInput" name="money" value="{{$place->MoneyToTravel}}">
    </div>
    @if($errors->has('money'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('money') }}</p>
      </div>
    @endif        

    <div class="form-group">
      <label class="control-label col-sm-2">Adress:</label>
      <input type="text" class="form-control" required="" maxlength="100" id="address" name="address" value="{{$place->address}}">
    </div>  

    <div class="form-group">
      <div id="map"></div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Latlog:</label>
      <input type="text" class="form-control" required="" id="latlog" name="latlog" value="{{$place->latlog}}">
    </div>
    @if($errors->has('latlog'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('latlog') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Image:</label>
      <input type="file" class="form-control" id="formGroupExampleInput" name="image" value="{{$place->img}}">
    </div>
    @if($errors->has('image'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('image') }}</p>
      </div>
    @endif          
    
    <div class="form-group">
      <label class="control-label col-sm-2">Type:</label>
      <select name ="type" class="input-large form-control">
       
        @foreach( $type as $value)
          @if($value->idType == $place->idType)
          <option selected="" value="{{$value->idType}}">{{$value->nameType}}</option>
          @else
          <option value="{{$value->idType}}">{{$value->nameType}}</option>
          @endif
        @endforeach
      </select>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2">Description</label><br><br>
      <div style="padding-right: 90px">
      <textarea id="ckeditor" name="des" value="{{$place->description}}">{{$place->description}}</textarea>
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