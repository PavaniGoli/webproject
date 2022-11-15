<!DOCTYPE html>
<html>
 <head>
  <!--<title>Simple Login System in Laravel</title>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin-top:10%;
    border:1px solid #ccc;
   }
   body{
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: black;
    background-color: white;
   }
   .btn-primary {
    color: black;
    background-color: #e8e6e6;
    border-color: #999;
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
.heading{
  font-family: 'Akaya Telivigala', cursive;
  font-size:100px;
  text-align:center;
}
 </style>
 </head>

 <ul>
  <li><a href="/main"><b>Login</b></a></li>

  <li><a href=/register><b>Register</b></a></li>
</ul>
<p class="heading">Search here</p>

<div class="container box">
<form action="/searchword" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group" style="margin:20px;">
        <input type="text" class="form-control" name="q"
            placeholder="Search"> <span class="input-group-btn">
            <div class="form-group" style="margin-left:20px;">
                <input type="submit" name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" /> 
                </form> 
                </div> 
    </div>
</form>
</div>