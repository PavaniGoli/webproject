<!DOCTYPE html>
<html>
 <head>
  <title>Enter Verification Code</title>
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
 </head>
 <body>
 <ul>
  <a href="\main" class="btn btn-primary">Go back home</a>
   </form>
</ul>
  <br />
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

   <form method="get" action="{{ url('/verifyuser') }}">
   @csrf
    <div class="form-group">
     <label>Enter Verification Code Here! </label>
     <input type="text" name="verification_code" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="login" class="btn btn-primary" value="Login" />
    </div>
   </form>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@include('footer')
 </body>
</html>
