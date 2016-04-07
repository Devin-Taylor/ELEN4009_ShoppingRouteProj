<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="index,follow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSRec - Shopping Route Recommender</title>
    <link href="../css/maps.css" rel="stylesheet" type="text/css">

    <link href="../css/1140.css" rel="stylesheet" type="text/css">
  <link href="../css/style.css" rel="stylesheet" type="text/css">
  <link href="../css/sidenav.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>

  </head>
  <body>

          <nav>
            
            <a href="#" class="nav-toggle-btn"> Menu</a>
            
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Help</a></li>
            </ul>
            </nav>

<div class="container12">
<header>

      <div class="row">

        <div class="column7" id="header-nav">

          <a href="http://localhost:3000"><img src="../images/logo.png" ></a>

        </div>

        <div class="column5">
          <ul>
            <li><a href="./login.htm">Login</a></li>
          </ul>
        </div>

      </div>

    </header>
    <h1 id="home"> Shopping Route Recommender</h1> <br><br>
  </div>



       <div id="right-panel"></div>
      <div id="map"></div>
      <script type = "text/javascript">
       
        var x = -26.138975;
        // document.getElementById('optimisation')
        var y = 28.082176;
        var location = [];
               

          <?php
          //////////////////////////////////////////GETTING FROM DATABASE

          // create database connection
            $host       = "host = localhost";
            $port       = "port = 5432";
            $dbname     = "dbname = srrec";
            $credentials  = "user=postgres password=srrec";
            // echo "Hello";
            
            // $db = pg_connect("$host $port $dbname $credentials");
            $db = pg_connect("host=localhost port=5432 dbname=srrec user=postgres password=srrec") or die("didnt connect");  
            echo "Hello";
             if(!$db){
                echo "Error : Unable to open database\n";
             } else {
                echo "Opened database successfully\n";
             }
            // get only the stores variables from the table created in database_permutations.php
              $ret = pg_query($db, "SELECT m_shop, s_shop, t_shop FROM MATCHES");
            $num_rows = pg_num_rows($ret);
            $num_cols = pg_num_fields($ret);
            // create empty array to populate
            $allCoords = [[]];
            // iterate over all routes and get geolocation of store from database 
            // i represents a route
            // j represents a stop/waypoint on that route
            for($i = 0; $i < $num_rows; $i++){
              // get next row from table --> successive calls means next row is obtained
              $rows = pg_fetch_array($ret);
              for($j = 0; $j < $num_cols; $j++){
                // convert to correct format for postgresqp
                $item = (string)$rows[$j];
                $it = trim($item);
                $params = array($it);
                // get geolocation
                $test = pg_query_params($db, "SELECT location FROM SHOPS WHERE name = $1", $params);
                // get corresponding geolocation from database
                $temp = pg_fetch_result($test, 0, 0);
                // add location to array
                $allCoords[$i][$j] = $temp;
              }
            }
            // close the database connection
              pg_close($db);

          $allCoords = [[]];
          $allCoords[0][0] = '(-26.147240,28.0882437)';
          $allCoords[0][1] = '(-26.1389,28.082176)';
          $allCoords[0][2] =  '(-26.131746,28.089679)';
          $allCoords[0][3] = '(-26.133446,28.0896589)';


          ?>

          location[0] = <?php echo $allCoords[0][0]; ?>; //origin
          location[1] = <?php echo $allCoords[0][1]; ?>; //point1...
          location[2] = <?php echo $allCoords[0][2]; ?>;
          location[3] = <?php echo $allCoords[0][3]; ?>;

          var origin = location[0].replace('(','');
          origin = origin.replace(')','');
          origin = origin.split(',');
 
          var point1 = location[1].replace('(','');
          point1 = point1.replace(')','');
          point1 = point1.split(',');

          var point2 = location[1].replace('(','');
          point2 = point2.replace(')','');
          point2 = point2.split(',');

          var point3 = location[1].replace('(','');
          point3 = point3.replace(')','');
          point3 = point3.split(',');
          





        function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 41.85, lng: -87.65}
        });

        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('right-panel'));
          
          calculateAndDisplayRoute(directionsService, directionsDisplay);

      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var start = document.getElementById('start').value;
        var end = document.getElementById('end').value;
        var start = {lat: parseFloat(origin[0]), lng: parseFloat(origin[1]};
        var end = {lat: parseFloat(origin[0]), lng: parseFloat(origin[1]};


        directionsService.route({
          origin: start,
          destination: end,
          waypoints: [
          {
          location:{lat: parseFloat(point1[0]), lng: parseFloat(point1[1]},
          stopover:true
          },{
          location: {lat: parseFloat(point2[0]), lng: parseFloat(point2[1]},
          stopover:true
          },{
          location: {lat: parseFloat(point3[0]), lng: parseFloat(point3[1]},
          stopover:true
          }],
          travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
          if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
      </script>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    
    (function() {
        
        var bodyEl = $('body'),
            navToggleBtn = bodyEl.find('.nav-toggle-btn');
        
        navToggleBtn.on('click', function(e) {
            bodyEl.toggleClass('active-nav');
            e.preventDefault();
        });
    })(); 
    
</script>



    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCt7OeQ0Z5MYP6ym6ZzkGLt-pgQmInsgo0&callback=initMap">
    </script>
  </body>
</html>