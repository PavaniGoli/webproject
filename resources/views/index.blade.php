<!DOCTYPE html>
<html>
 <head>
  <title>Login System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
   .box{ 
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
   .button {
    background-color: #4287f5;
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: right;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    }
    form.example input[type=text] {
      padding: 10px;
      font-size: 17px;
      border: 1px solid grey;
      float: left;
      width: 80%;
      background: #f1f1f1;
    }
    form.example button {
    float: left;
    width: 20%;
    padding: 10px;
    background: #2196F3;
    color: white;
    font-size: 17px;
    border: 1px solid grey;
    border-left: none;
    cursor: pointer;
  }
  form.example button:hover {
  background: #0b7dda;
  }
  form.example::after {
  content: "";
  clear: both;
  display: table;
  }
 </style>
 </head>
 <body>
</br>
  <div class="container box">
   <h3 align="center">Hello There!</h3><br />
   <a href="\update" class="button" style="float: right">Profile</a>
   @if(Auth::user()->is_verfied !=0)
   <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->name }}</strong>
     <br />
     <a href="{{ url('/main/logout') }}">Logout</a>
    </div>
   @else
    <script>window.location = "/main";</script>
   @endif  
   </div>
   </div>
</br>
<form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Search.." name="search2">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>
</br>
  </div>
 </body>
</html>