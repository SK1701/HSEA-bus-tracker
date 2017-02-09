<?php
 
  //Create a connection to the database
  $mysqli = new mysqli("localhost", "root", "password", "markers");
 
  //The default result to be output to the browser
  $result = "{'success':false}";
  
  $route = 'Route5';

  //Select everything from the table containing the marker informaton
  $query = "SELECT * FROM {$route}";
 
  //Run the query
  $dbresult = $mysqli->query($query);
 
  //Build an array of markers from the result set
  $markers = array();
 
  while($row = $dbresult->fetch_array(MYSQLI_ASSOC)){
 
    $markers[] = array(
      'id' => $row['stop_id'],
      'name' => $row['stop_name'],
      'lat' => $row['stop_lat'],
      'lng' => $row['stop_long']
    );
  }
 
  //If the query was executed successfully, create a JSON string containing the marker information
  if($dbresult){
    $result = "" . json_encode($markers) . "";        
  }
  else
  {
    $result = "{'success':false}";
  }
 
  //Set these headers to avoid any issues with cross origin resource sharing issues
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
  header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');
 
  //Output the result to the browser so that our Ionic application can see the data
  echo($result);
 
?>