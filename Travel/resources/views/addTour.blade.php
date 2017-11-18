@extends('index')
@section('content')
<body>
  
  <h3 style="color: #5a738e" align="center"> ADD TOUR</h3><br>
  <form  action="/newtour" method="POST" name="formplace" style="margin-left: 150px" enctype="multipart/form-data"> 
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

    <div class="form-group">
      <label class="control-label col-sm-2">People</label>
      <input type="text" class="form-control" required="" maxlength="10" id="formGroupExampleInput" name="people">
    </div>
    @if($errors->has('errorpeople'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('errorpeople') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Money</label>
      <input type="text" class="form-control" required="" minlength="4" maxlength="10" id="formGroupExampleInput" name="money">
    </div>
    @if($errors->has('money'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('money') }}</p>
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
      <label class="control-label col-sm-2">Place:</label>
      <select name="place[]" class="input-large form-control" id="ex-multiselect" multiple>
        @foreach($place as $value)
          <option value="{{$value->idPlace}}">{{$value->namePlace}}</option>
        @endforeach 
      </select>
    </div>

    <div style="text-align: center; margin-left: -150px">
      <button style="margin-top: 15px" type="submit" class="btn btn-success">Save</button>
    </div>
    
  </form>
  </body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="{{ asset('bootstraps/picker.min.css')}}">
<script src="{{ asset('js/picker.min.js') }}"></script>
<script type="text/javascript">
  $('#ex-multiselect').picker();
</script>
  @stop
