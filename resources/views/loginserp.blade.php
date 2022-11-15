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
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
      color: black;
    }
    .dataTables_wrapper .dataTables_filter input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: #e8e6e6;
    color: black;
    margin-left: 3px;
}
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: white;
    color: black;
    padding: 4px;
}
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    background-color: white;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0.5em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    cursor: hand;
    color: white;
    background-color: white;
    border: 1px solid transparent;
    border-radius: 2px;
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

  <a href="\index" float="left" class="btn btn-primary"><b>Go back home</b></a>
  </ul>

  
 
  <div class="container box">
   <h3 align="center" class= heading >Search</h3><br/>
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
</div>
</br>

<div class="container box">
<form action="/loginserp" method="POST" role="search" name="searchform">
    {{ csrf_field() }}
    <div class="input-group" style="margin:20px;">
        <input type="text" class="form-control" name="q" value="<?php echo $query_string?>"
            placeholder="Search"> <span class="input-group-btn">
            <div class="form-group" style="margin-left:20px;">
                <input type="submit" name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" /> 
                </form> 
                </div> 
    </div>
</form>
</div>
</br>
<div class="container box">
<?php
  require '/Users/pavani/web/vendor/autoload.php';
  $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
  $client = Elastic\Elasticsearch\ClientBuilder::create()->build();
  $word = strip_tags($_POST['q']);
  $params = [
      'index' => 'metadata',
      'from' => 0,
      'size' => 501,
      'type' => '_doc',
      'body' => [
          'query' => [
              'multi_match' => [
                  'query' => $q,
                  'fields' => ['$etd_file_id','author','$year','university','degree','program','abstract','title','advisor','wiki_terms']

                  ]
              ]
          ]
      ];

  $response = $client->search($params);
  $total = $response['hits']['total']['value'];
  if ($total == 0){
    echo'<div style="text-align:center;" class="alert alert-danger success-block">';
    echo '<h5>No Results Found..!</h5>';
    echo '<script>alert("Not a valid Search")</script>';
    }
    else{
    $score = $response['hits']['hits'][0]['_score'];
    echo
    "<div>
    <h3><b><i>$total search results for $word</b></i><h3>
    </div>";
    echo 
    '<table class="table table-stripped" id="dt1">
    <thead>
    <th>Title</th>
    <th></th>
    </thead>
    <tbody>';
    foreach( $response['hits']['hits'] as $source){
      $etd_file_id = (isset($source['_source']['etd_file_id'])? $source['_source']['etd_file_id'] : "");
      $year= (isset($source['_source']['year'])? $source['_source']['year'] : "");
      $author= (isset($source['_source']['author'])? $source['_source']['author'] : "");
      $university = (isset($source['_source']['university']) ? $source['_source']['university'] : "");
      $degree = (isset($source['_source']['degree']) ? $source['_source']['degree'] : "");
      $program = (isset($source['_source']['program']) ? $source['_source']['program'] : ""); 
      $abstract = (isset($source['_source']['abstract']) ? $source['_source']['abstract'] : ""); 
      $title = (isset($source['_source']['title']) ? $source['_source']['title'] : ""); 
      $advisor = (isset($source['_source']['advisor']) ? $source['_source']['advisor'] : ""); 
      $pdf = (isset($source['_source']['pdf']) ? $source['_source']['pdf'] : ""); 
      $wiki_terms = (isset($source['_source']['wiki_terms']) ? $source['_source']['wiki_terms'] : ""); 
      $url = asset('storage/PDF/'.$pdf.'');

    // $path = "/Users/pavani/web/storage/app/public/PDF/";
    // $dir =scandir($path);
    // foreach($dir as $file){
    // $fname=$path.$file;
    // }

    $abs = strip_tags($abstract);
      if (strlen($abs) > 500) {
      $stringCut = substr($abs, 0, 500);
      $endPoint  = strrpos($stringCut, ' ');
      $abs = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
      $abs .= '...';
    }
    
      echo "<tr>
      <td>
      <h4><b><a href = $url target='_blank'> {$title} </a></h4></b><br>
      <b>Author(s):</b> ".$author." <br>
      <b>University:</b> ".$university." <br>
      <b>Year:</b> ".$year." <br>
      <br> 
      ".$abs."
      <br>
      <form action='/loginsummary' method='GET' role='summary'>
        <input type='hidden' name='q' value='".$pdf."' />
        <input type='submit' class='btn btn-primary' value='View more' style='font-weight:bold' /> 
      </form>
      <form method='GET' action='/download'>
      <input type='hidden' name='q' value='".$pdf."' />
      <td></td>
    </form>
    </td>";
    
    echo"</tr>";
  }
      echo "</tbody></table>";
}
    ?>
    </div>

<script src="https://cdn.jsdelivr.net/mark.js/7.0.0/jquery.mark.min.js"></script>
<script>
$(document).ready( function () {
  var table = $('#dt1').DataTable( {
    "initComplete": function( settings, json ) {
    $("body").unmark().mark("{{$query_string}}"); 
    }
  });
  table.on( 'draw.dt', function () {
    $("body").unmark().mark("{{$query_string}}");
  }); 
} );
$("#searchform").submit(function(e) {
    e.preventDefault();
});
</script>
