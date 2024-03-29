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
        .ellipsis {
          max-width: 40px;
          text-overflow: ellipsis;
          overflow: hidden;
          white-space: nowrap;
        }
      }

    .containerbox{
      margin: 0 auto;
    }

    .sample{
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
    }

    .sample .tooltipt {
    visibility: hidden;
    width: relative;
    background-color: BLACK; 
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 98%;
    left:1px;
    margin-left: -60px;
    
    transition: opacity 0.3s;
    }

    .sample .tooltipt::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
    }

    .sample:hover .tooltipt {
    visibility: visible;
    opacity: 3;
    }

</style>
</head>
<body>
  <ul>
  <li><a href="/main"><b>Login</b></a></li>
  <li><a href=/register><b>Register</b></a></li>
  <button onclick="history.back()"  class="btn btn-primary"><b>Go Back</b></button>
  </ul>

  <div class="containerbox">
  @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
  @endif
  <?php
    header('Content-type: application/pdf');
    require '/Users/pavani/web/vendor/autoload.php';
    $client =  Elastic\Elasticsearch\ClientBuilder::create()->build();
    $params = [
    'index' => 'metadata',
    'from' => 0,
    'size' => 501,
    'type' => '_doc',
    'body' => [
        'query' => [
            'multi_match' => [
                'query' => $q ?? '',
                'fields' => ['$etd_file_id','$pdf','author','$year','university','degree','program','abstract','title','advisor','wiki_terms']

                ]
            ]
        ]
    ];

    function highlightWords($text,$word,$u) {
        $text = preg_replace('#'. preg_quote($word) .'#i', '<div class="sample"> <span style="background-color: #F9F902;">\\0</span> 
        <span class="tooltipt"><a href='.$u.'>'.$u.'</a></span>
      </div> ', $text);
        return $text;
  }

    $response = $client->search($query);

    foreach( $response['hits']['hits'] as $source)
    {
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
        ?>

        <div class="sample">
        <span class="tooltipt"></span>
      </div>

       <?php
      echo "<tr>
      <td><h3>".$title."</h3>
      <br>
      <a href = $url target='_blank'>View PDF</a>
      <br>
      <br>
      <b>PDF :</b> ".$pdf."
      <br>
      <br>
      <b>Author :</b> ".$author."
      <br>
      <br>
      <b>Degree :</b>  ".$degree."
      <br> 
      <br>
      <b>Etd_File_Id :</b>  ".$etd_file_id."
      <br> 
      <br>
      <b>Program :</b>  ".$program."
      <br> 
      <br>
      <b>University :</b> ".$university."
      <br>
      <br>
      <b>Year :</b>  ".$year."
      <br>
      <br>
      <b>Advisor :</b>  ".$advisor."
      <br> 
      <br>
      </td>";
    
    $arr1 = json_decode($wiki_terms, true);
    $terms_arr = array();
    if($arr1!=null){
    foreach ($arr1 as $item)
    {
      $terms_arr[]= $item['term'];
      $url_arr[]=$item['url'];
    }
    $c = count ($terms_arr);
    for( $i = 0; $i < $c; $i++)
    {
      $abstract= highlightWords($abstract, $terms_arr[$i],$url_arr[$i]);
    }

    
  }
    echo "<b>Abstract :</b> ".$abstract."";
  }

  ?>
  <br>
  @include('footer')
  </body>
  </html>