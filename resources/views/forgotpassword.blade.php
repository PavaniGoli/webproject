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
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Reset Password</h3><br/>

   @if(isset(Auth::user()->email))
    <script>window.location="/main/successlogin";</script>
   @endif

   @if ($message = Session::get('error_message'))
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

   <form method="post" action="{{ url('main/forgot_password') }}">
   @csrf
    <div class="form-group">
     <label>Enter your email</label>
     <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="Reset Password" class="btn btn-primary" value="Reset Password" />
    </div>
   </form>
   <a class="btn btn-primary" href="\main">Go back home</a>
 </body>
</html>