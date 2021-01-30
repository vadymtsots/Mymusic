<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>MyMusic</title>
</head>



<body>
    

<header class="header center ndigo darken-2">
<?php include 'templates/header.php'; ?>
</header>



<?php  
include 'db_connect.php';

//selection query
/* $sql = "SELECT artist, album, year, rating, id FROM userartists";

$result = mysqli_query($connect, $sql);

$artists = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($connect);
*/

$data_query = $connect->prepare("SELECT id, artist, album, year, rating  FROM userartists");
$data_query -> execute();
$artists = $data_query->fetchAll(PDO::FETCH_ASSOC);

?>
<h4 class="center">My Music</h4>
<section class="container">

<div class="row">


<?php foreach($artists as $artist) { ?>
 <div class="col md 3">
  <div class="card z-depth-0">
   <div class="card-content center">
  <h5 class="center"><?php echo htmlspecialchars($artist["artist"])  ?> </h5>
  <h5><?php echo "Album: " . htmlspecialchars($artist["album"])  ?> </h5>
  <h5><?php echo "Year: " . htmlspecialchars($artist["year"])  ?> </h5>
  <h5><?php echo "Rating: " . htmlspecialchars($artist["rating"])  ?> </h5>

  <div class="card-action right-align">
  <a class= "brand-text" href="review.php?id=<?php echo $artist['id']?>">Review</a>
  </div>
  
  
   </div>

   </div>


  </div>

</div>


<?php  } ?>

</section>


<footer>
<?php include 'templates/footer.php'; ?>

</footer>


</body>








</html>