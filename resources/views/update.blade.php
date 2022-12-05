<!DOCTYPE html>
<html>
 <head>
  <title>Update Details</title>
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
  <a href="\index" class="btn btn-primary">Go back home</a>
   </form>
</ul>
 <br/>
 <div class="container box">
   <h3 align="center">Update Details</h3><br/>


   @if ($message = Session::get('message'))
   <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   <form method="post" action="{{ url('/main/updatedetails') }}">
    @csrf
   <input type="hidden" name="id" value="{{$userInfo['id']}}" />
   <div class="form-group">
     <label>Enter Name</label>
     <input type="text" name="name" class="form-control" value="{{$userInfo->name}}" />
    </div>
    <div class="form-group">
     <label>Enter Email</label>
     <input type="email" name="email" class="form-control" value="{{$userInfo->email}}" />
    </div>
    <div class="form-group">
     <input type="submit" name="update" class="btn btn-primary" value="Update" />
    </div>
   </form>
 </div>
  </br>
  </br>
  <div class="container box">
   <h3 align="center">Update Password</h3><br/>
  <form method="post" action="{{ url('/main/updatepassword') }}">
    @csrf
   <input type="hidden" name="id" value="{{$userInfo['id']}}" />
    <div class="form-group">
     <label>Enter new Password</label>
     <input type="password" name="new_password" class="form-control" />
    </div>
    <div class="form-group">
     <label>Confirm Password</label>
     <input type="password" name="confirm_password" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="update" class="btn btn-primary" value="Update Password" />
    </div>
   </form>
    </div>
  </div>
  <br><br>
  @include('footer')
 </body>
</html>