<?php

  $mysqli = new mysqli('localhost', 'root', '', 'pokemontcg');
  // check connection
  if ($mysqli->connect_error) {
    die("Connection Failed: " . $mysqli->connect_error);
  }

  $result = $mysqli->query('SELECT * FROM pokemon_cards');

  $imagesPerPage = 9;
  $totalImages = mysqli_num_rows($result);
  $totalPages = ceil($totalImages / $imagesPerPage);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./main.js" defer></script>
    <script src="https://kit.fontawesome.com/034c94b291.js" crossorigin="anonymous"></script>
</head>
<style>
  img {
    width: 100px;
    height: auto;
  }
</style>
<body>
  <!-- Previous Button -->  
  <button id="prev-btn">
    <i class="fas fa-arrow-circle-left"></i>
  </button>

  <!-- Book -->
  <div id="book1" class="book">
    <!-- Paldea Evolvod -->
    <!-- Paper 1 -->
    <div id="p1" class="paper" style="z-index: 7;" >
        <div class="front">
            <div id="f1" class="front-content">
                <h1>Pokemon TCG</h1>
            </div>
        </div>
        <div class="back">
            <div id="b1" class="back-content">
                <h1>Pokemon 1 - 100</h1>
            </div>
        </div>
    </div>

    <?php
      $pagina = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['id'] % 3 == 1){
          if ($row['id'] % 9 == 0 && $row['id'] % 18 == 0) {
            echo '<tr><td><img src="'.$row['image_location'].'"></td>';
            // echo '<tr><td>'.$row['id'].'</td>';
            echo '</table>';
          }
          elseif ($row['id'] % 9 == 0 && $row['id'] % 18 != 0) {
            echo '<tr><td><img src="'.$row['image_location'].'"></td>';
            // echo '<tr><td>'.$row['id'].'</td>';
            echo '</table>';
          }
          elseif($row['id'] % 9 == 1 && $row['id'] % 18 == 1){
            echo '<table class="links">';
            // echo '<tr><td>'.$row['id'].'</td>';
            echo '<tr><td><img src="'.$row['image_location'].'"></td>';
          }
          elseif($row['id'] % 9 == 1 && $row['id'] % 18 != 1){
            echo '<table class="rechts">';
            // echo '<tr><td>'.$row['id'].'</td>';
            echo '<tr><td><img src="'.$row['image_location'].'"></td>';
          }
          elseif($row['id'] % 9 != 1 && $row['id'] % 18 != 1){
            // echo '<td>'.$row['id'].'</td>';
            echo '<td><img src="'.$row['image_location'].'"></td>';
          }
        }
        elseif ($row['id'] % 3 == 2){
          echo '<td><img src="'.$row['image_location'].'"></td>';
          // echo '<td>'.$row['id'].'</td>';
        }
        elseif ($row['id'] % 3 == 0) {
          echo '<td><img src="'.$row['image_location'].'"></td></tr>';
          // echo '<td>'.$row['id'].'</td></tr>';
        }
      }
    ?>
    
  <!-- Next Button -->
  <button id="next-btn">
    <i class="fas fa-arrow-circle-right"></i>
  </button>

  <script src="./jquery.min.1.7.js"></script>

</body>
</html>