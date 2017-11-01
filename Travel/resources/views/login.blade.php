<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8">
	<link href="css/login.css" rel="stylesheet"/>
</head>
<body>
	<form action="{{ url('login') }}" method="post">
		<h1>Login</h1>
  		      
      <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                
      <input placeholder="Email" type="Email"" name="email" required="" value="{{ old('email') }}" class="text">
          
      @if($errors->has('email'))
      <p style="color:red; margin-left: 20px" >{{ $errors->first('email') }}</p>
      @endif    
      
      <input placeholder="Password" type="password" name="password" required="">
          
      @if($errors->has('password'))
      <p style="color:red; margin-left: 20px">{{ $errors->first('password') }}</p>
      @endif

      @if($errors->has('errorlogin'))
        <div class="alert alert-danger">
          <p style="margin-left: 20px;color:red">{{ $errors->first('errorlogin') }}</p>
        </div>
      @endif

      <div class="p-container">            
        <input type="submit" value="SIGN IN">
          {!! csrf_field() !!}
        <div class="clear"> </div>
      </div>

</form>

</body>
</html>