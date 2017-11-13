@extends('index')
@section('content')
<body>
  <h3 style="color: #5a738e" align="center"> ADD USER</h3><br>
  <form action="/newuser" method="POST" name="formuser" style="margin-left: 150px" enctype="multipart/form-data">
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">
    <div class="form-group">
      <label class="control-label col-sm-2">Group:</label>
        <select class="input-large form-control" name="group">
          @foreach( $group as $value)
          <option value="{{$value->idGroup}}">{{$value->nameGroup}}</option>
          @endforeach
        </select>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Name:</label>
     <input type="text" class="form-control" required="" maxlength="50" id="formGroupExampleInput" name="name">
    </div>
    @if($errors->has('errorname'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('errorname') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Email:</label>
      <input type="Email" class="form-control" required="" maxlength="50" id="formGroupExampleInput" name="email">
    </div>
    @if($errors->has('email'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('email') }}</p>
      </div>
    @endif
    @if($errors->has('erroremail'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('erroremail') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Password:</label>
      <input type="Password" class="form-control" required="" minlength="8" maxlength="30" id="formGroupExampleInput" name="password">
    </div>
    @if($errors->has('password'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('password') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Phone number:</label>
      <input type="text" class="form-control" required="" minlength="10" maxlength="11" id="formGroupExampleInput" name="phone">
    </div>
    @if($errors->has('phone'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('phone') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Province:</label>
      <select class="input-large form-control" name="province" id="selectProvince">
          @foreach( $province as $value)
          <option value="{{$value->idProvince}}">{{$value->name}}</option>
          @endforeach
        </select>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">District:</label>
      <select class="input-large form-control" name="province" id="selectDistrict">
          @foreach( $district as $value)
          <option value="{{$value->idDistrict}}">{{$value->name}}</option>
          @endforeach
        </select>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Image:</label>
      <input type="file" class="form-control" id="formGroupExampleInput" name="image">
    </div>
    @if($errors->has('image'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('image') }}</p>
      </div>
    @endif

    <div style="text-align: center; margin-left: -150px">
      <button style="margin-top: 15px" type="submit" class="btn btn-success">Save</button>
    </div>

  </form>
  </body>
  @stop



