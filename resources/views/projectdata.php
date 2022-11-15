<?php
require '/Users/pavani/web/vendor/autoload.php';
//require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;

$client = Elasticsearch\ClientBuilder::create()->build();

$extension="json";
// $folder_name=11042;

$main_dir= new RecursiveDirectoryIterator('Users/pavani/web/metadata_abstract_wikifier.csv');

foreach (new RecursiveIteratorIterator($main_dir) as $key => $folder_name) {

    $ext = pathinfo($folder_name, PATHINFO_EXTENSION);
    if($ext == $extension) {
        // $file = '11042/11042.json';
        $json = file_get_contents($folder_name);
        // print($json);
        $params = [
  'index' => 'metadata',
  'body'  => $json
        ];

        try{
            $response = $client->index($params);
        } catch(Exception $e) {

            }
        }
    }
      function sendResponseToElasticSearch($params){
          $client = $GLOBALS["client"];
          print_r($client);
      }
?>