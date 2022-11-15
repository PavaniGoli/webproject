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
  <li><a href="\update"><b>Profile</b></a></li>
   @if(Auth::user()->is_verified !=0)
   <!--<div class="alert alert-danger success-block">-->
     
    
  <li><a href="{{ url('/main/logout') }}"><b>Logout</b></a></li>
  
   @else
    <script>window.location = "/main";</script>
  @endif
  <button onclick="history.back()"  class="btn btn-primary"><b>Go Back</b></button>
  </ul>

  <br />
  <p class="heading">Add New Data </p>
  <div class="container box">
 
  <form action="/add_data" method="POST" role="add">
  {{ csrf_field() }}
  <div class="form-group">
     <label>Title</label>
     <input type="text" name="title" class="form-control" />
     </div>
     <br>
     <div class="form-group">
     <label>Author</label>
     <input type="text" name="author" class="form-control" />
     </div>
     <br>
      <div class="form-group">
     <label>Name of the Degree</label>
     <input type="text" name="degree" class="form-control" />
     </div>
     <br>
     <div class="form-group">
     <label>Name of the Program</label>
     <input type="text" name="program" class="form-control" />
     </div>
     <br>
     <div class="form-group">
     <label>University</label>
     <input type="text" name="university" class="form-control" />
     </div>
      <br>
     <div class="form-group">
     <label>Abstract</label>
     <input type="text" name="abstract" class="form-control" />
     </div>
      <br>
      <div class="form-group">
     <label>Advisor</label>
     <input type="text" name="advisor" class="form-control" />
     </div>
     <br>
      <div class="form-group">
     <label>Year</label>
     <input type="text" name="year" class="form-control" />
     </div> 
     <input type = "submit"name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" />
    </form>


    <div class="container mt-5">
        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
          <h3 class="text-center mb-5">Upload your PDF here</h3>
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Files
            </button>
        </form>
    </div>



</body>