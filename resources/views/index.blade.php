<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
mark{
background: yellow;
color: black;
}
.box{
    width:1200px;
    margin-top:10%;
    
   }
.btn-primary {
    color: black;
    background-color: #e8e6e6;
    border-color: #999;
}
.btn-link {
    color: black;
    background-color: #e8e6e6;
    border-color: #999;
}
   body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color:black;
    background-color: white;
    }
    .head{
    font-family: 'Akaya Telivigala', cursive;
    font-size:50px;
    text-align:center;
    }
    .heading{
    font-family: 'Akaya Telivigala', cursive;
    font-size:100px;
    text-align:center;
    }
    ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #dddddd;
  }
  li {
    float: right;
  }
  li a {
    color: black;
    display: block;
    padding: 8px;
  }
 </style>
 </head>
 <body>


  <ul>
  <li><a href="\insert"><b>Insert Entry</b></a></li>
  <li><a href="\update"><b>Profile</b></a></li>
   @if(Auth::user()->is_verified !=0)
   <!--<div class="alert alert-danger success-block">-->
     
    
  <li><a href="{{ url('/main/logout') }}"><b>Logout</b></a></li>
  
   @else
    <script>window.location = "/main";</script>
  @endif
  </ul>
  <br>
  <h3 align="center" class= heading >Welcome {{ Auth::user()->name }}!</h3><br/>
  <!--<h3 align="center">Hello There!</h3><br />
  </br>
  <div class="container box">
   <h3 align="center">Hello There!</h3><br />
   <a href="\update" class="button" style="float: right">Profile</a>
   @if(Auth::user()->is_verified !=0)
   <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->name }}</strong>
     <br />
     <a href="{{ url('/main/logout') }}">Logout</a>
    </div>
   @else
    <script>window.location = "/main";</script>
   @endif   -->
   
   
   <form action="/loginserp" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group" style="margin:20px;">
        <input type="text" class="form-control" name="q"
            placeholder="Search"> <span class="input-group-btn">
            <div class="form-group" style="margin-left:2px;">
                <input type="submit" name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" /> 
                </form> 
                </div> 
    </div>
</div>
</br>
  
</br>
 </body>
</html>