@extends('index')
@section('content')
<body>
  <h3 style="color: #5a738e" align="center"> EDIT USER</h3><br>
  <form action="/updateUser/{{$user->idAccount}}" method="POST" name="form" style="margin-left: 150px" enctype="multipart/form-data">
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">
  <div>
    @if (Session::has('flash_message1'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message1') !!}
      </div>
    @endif
  </div>

    <div class="form-group">
      <label class="control-label col-sm-2">ID:</label>
      <input type="text" disabled="disabled" class="form-control" id="formGroupExampleInput" name="id" value="{{$user->idAccount}}">
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Group:</label>
     <select name ="group" class="input-large form-control">

        @foreach( $group as $value)
          @if($value->idGroup == $member->idGroup)
          <option selected="" value="{{$value->idGroup}}">{{$value->nameGroup}}</option>
          @else
        <option value="{{$value->idGroup}}">{{$value->nameGroup}}</option>
        @endif
        @endforeach        
      </select>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Name:</label>
     <input type="text" class="form-control" required="" maxlength="50" id="formGroupExampleInput" name="name" value="{{$user->nameAccount}}">
    </div>
    @if($errors->has('errorname'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('errorname') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Email:</label>
      <input type="Email" class="form-control" required="" maxlength="50" id="formGroupExampleInput" name="email" value="{{$user->email}}">
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
      <label class="control-label col-sm-2">Phone number:</label>
      <input type="text" class="form-control" required="" minlength="10" maxlength="11" id="formGroupExampleInput" name="phone" value="{{$user->phone}}">
    </div>
    @if($errors->has('phone'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('phone') }}</p>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-sm-2">Province:</label>
      <select class="input-large form-control selectProvince" name="province" id="selectProvince">
          @foreach( $province as $value)
            @if($value->idProvince == $user->idProvince)
              <option selected="" value="{{$value->idProvince}}">{{$value->name}}</option>
            @else
              <option value="{{$value->idProvince}}">{{$value->name}}</option>
            @endif
          @endforeach
        </select>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">District:</label>
      <select class="input-large form-control selectDistrict" name="province" id="selectDistrict">
          @foreach( $district as $value)
            @if($value->idDistrict == $user->idDistrict)
              <option selected="" value="{{$value->idDistrict}}">{{$value->name}}</option>
            @else
              <option value="{{$value->idDistrict}}">{{$value->name}}</option>
            @endif
          @endforeach
        </select>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Image:</label>
      <input type="file" class="form-control" id="formGroupExampleInput" name="image" value="{{$user->img}}">
    </div>
    @if($errors->has('image'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('image') }}</p>
      </div>
    @endif

    <div style="text-align: center; margin-left: -150px; margin-bottom: 10px;" >
      <button style="margin-top: 15px" type="submit" class="btn btn-success">Save</button>
    </div>

  </form>

  <form action="/editpass/{{$user->idAccount}}" method="POST" name="formuser" style="margin-left: 150px" enctype="multipart/form-data">
  <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

  <div>
    @if (Session::has('flash_message3'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message3') !!}
      </div>
    @endif
    @if (Session::has('flash_message4'))
      <div class="alert alert-danger form-feedback" role="alert">
        {!! Session::get('flash_message4') !!}
      </div>
    @endif
  </div>

  <div class="form-group">
      <label class="control-label col-sm-2">New Password:</label>
      <input type="Password" required="" minlength="8" maxlength="30" class="form-control" id="formGroupExampleInput" name="password">
  </div>
    @if($errors->has('password'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('password') }}</p>
      </div>
    @endif

  <div class="form-group">
      <label class="control-label col-sm-2">Confirm Password:</label>
      <input type="Password" required="" class="form-control" minlength="8" maxlength="30" id="formGroupExampleInput" name="cfpassword">
  </div>
    @if($errors->has('cfpassword'))
      <div style="padding-left: 150px;">
      <p style="color:red">{{ $errors->first('cfpassword') }}</p>
      </div>
    @endif

  <div style="text-align: center; margin-left: -150px; margin-top: 5px;" >
      <button type="submit" class="btn btn-success">Save</button>
  </div>

  </form>
  </body>
  @stop



