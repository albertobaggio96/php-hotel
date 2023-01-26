<?php 
  $hotels = [
      [
          'name' => 'Hotel Belvedere',
          'description' => 'Hotel Belvedere Descrizione',
          'parking' => true,
          'vote' => 4,
          'distance_to_center' => 10.4
      ],
      [
          'name' => 'Hotel Futuro',
          'description' => 'Hotel Futuro Descrizione',
          'parking' => true,
          'vote' => 2,
          'distance_to_center' => 2
      ],
      [
          'name' => 'Hotel Rivamare',
          'description' => 'Hotel Rivamare Descrizione',
          'parking' => false,
          'vote' => 1,
          'distance_to_center' => 1
      ],
      [
          'name' => 'Hotel Bellavista',
          'description' => 'Hotel Bellavista Descrizione',
          'parking' => false,
          'vote' => 5,
          'distance_to_center' => 5.5
      ],
      [
          'name' => 'Hotel Milano',
          'description' => 'Hotel Milano Descrizione',
          'parking' => true,
          'vote' => 2,
          'distance_to_center' => 50
      ],
  ];

  $filteredHotels = [];

  if(isset($_GET["parkingValue"]) && isset($_GET["voteFilter"])){
    foreach ($hotels as $hotel){
      $hotel["parking"] = $hotel["parking"] ? "si" : "no";
      if ($hotel["vote"] >= $_GET["voteFilter"]){
        if ($_GET["parkingValue"] === "yes"){
          if(in_array("si", $hotel)){
            $filteredHotels[] = $hotel;
          }
        } elseif($_GET["parkingValue"] === "no"){
          if(in_array("no", $hotel)){
            $filteredHotels[] = $hotel;
          }
        } else{
          $filteredHotels[] = $hotel;
        }
      }
    }

  } else{
    foreach ($hotels as $hotel){
      $hotel["parking"] = $hotel["parking"] ? "si" : "no";
      $filteredHotels[] = $hotel;
      }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
  <div class="container">

    <h1>Hotel list</h1>

    <form action="./index.php" method="GET" class="mb-3">
      <label for="parking-value">Seleziona se desideri il parcheggio :</label>
      <select name="parkingValue" id="parking-value">
        <option value="optional">opzionale</option>
        <option value="yes">si</option>
        <option value="no">no</option>
      </select>
      <label for="vote-filter">Valutazione minima</label>
      <select name="voteFilter" id="vote-filter">
        <option value="0">Tutti</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <button type="submit">Cerca</button>
    </form>

    <div class="row">
      <?php
        foreach ($hotels[0] as $key => $hotel){
          $key = str_replace('_', ' ', $key);
          echo "<div class='col border border-secondary'> {$key} </div>";
        }
      ?>
    </div>
    
    <?php
      foreach ($filteredHotels as $hotel){
        echo "<div class='row'>";
        foreach($hotel as $element){
          echo "<div class='col border border-secondary'>{$element}</div>";
        }
        echo "</div>";
      }
    ?>
  </div>
  

</body>
</html>