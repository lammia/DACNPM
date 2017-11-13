@extends('index')
@section('content')

<body> 

  <h3 style="color: #5a738e" align="center"> EDIT DISCOUNT</h3><br>
  <form action="/updateDiscount/{{$discount->idDiscount}}" method="POST" name="form" style="margin-left: 150px" enctype="multipart/form-data">
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

  <div class="form-group">
    <label class="control-label col-sm-2">ID:</label>
    <input type="text" disabled="disabled" class="form-control" id="formGroupExampleInput" name="id" value="{{$discount->idDiscount}}">
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">Percent Discount:</label>
    <input type="text" required="" class="form-control" id="formGroupExampleInput" name="percent" value="{{$discount->percentDiscount}}">
  </div>        
  @if($errors->has('percent'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('percent') }}</p>
      </div>
  @endif
  
  <div class="form-group">
    <label class="control-label col-sm-2">Time Begin:</label>
    <input type="" class="form-control datetime" required="" readonly="" name="begin" value="{{$discount->timeBeginDiscount}}">
  </div>
  @if($errors->has('begin'))
    <div style="padding-left: 50px;">
    <p style="color:red">{{ $errors->first('begin') }}</p>
    </div>
  @endif

   <div class="form-group">
    <label class="control-label col-sm-2">Time End:</label>
    <input type="" class="form-control datetime" required="" readonly="" name="end" value="{{$discount->timeEndDiscount}}">
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
   @if($errors->has('overlaptime'))
    <div style="padding-left: 150px;">
    <p style="color:red">{{ $errors->first('overlaptime') }}</p>
    </div>
  @endif
  
  <div class="form-group">
      <label class="control-label col-sm-2">Place:</label>
     <select name ="place" class="input-large form-control">
        @foreach( $place as $value)
          @if($value->idPlace == $discount->idPlace)
          <option selected="" value="{{$value->idPlace}}">{{$value->namePlace}}</option>
          @else
        <option value="{{$value->idPlace}}">{{$value->namePlace}}</option>
        @endif
        @endforeach     
      </select>
  </div>            
              
  <div style="text-align: center; margin-left: -150px; margin-bottom: 10px;" >
     <button style="margin-top: 15px" type="submit" class="btn btn-success">Save</button>
  </div>

  </form>                

</body>
@stop          
