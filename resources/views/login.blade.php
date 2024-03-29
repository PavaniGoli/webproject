<!DOCTYPE html>
<html>
 <head>
  <title>Login System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">

  .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
  }

  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #dddddd;
  }
  

</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<ul>
  <a href="\see" class="btn btn-primary">Go back home</a>
</form>
</ul>
</br>
  <div class="container box">
   <h3 align="center">Login here</h3><br/>

   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if ($message = Session::get('message'))
    <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif

   <form method="post" action="{{ url('/main/checklogin') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <label>Enter Email</label>
     <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group">
     <label>Enter Password</label>
     <input type="password" name="password" class="form-control" />
    </div>
    <div class="form-group">
    <div class="g-recaptcha" data-sitekey="6LeEVEQjAAAAACkaCvrdo7hfqATzqIfYQWy--xCO"></div>    
    </div>
    <div class="form-group">
     <input type="submit" name="login" class="btn btn-primary" value="Login" />
     <a class="btn btn-primary" href="\register">Register</a>
    </div>
   </form>
   <a class="btn-btn-primary" href="\forgotpassword">Forgot Password?</a>
  </div>
</body>
<br><br><br><br><br><br><br>
@include('footer')
</html>
