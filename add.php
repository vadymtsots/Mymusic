<?php
include 'db_connect.php';

$error = ['artist' => '', 'album' => '', 'year' => '', 'rating' => '', 'review' => ''];


$artist = $_POST['artist'];
$album = $_POST['album'];
$year = $_POST['year'];
$rating = $_POST['rating'];
$review = $_POST['review'];

//form validation


if (isset($_POST['submit']))
{
    if (empty($artist))
    {
        $error['artist'] =  'Artist cannot be empty <br>';
    }
    
    if (empty($album))
    {
        $error['album'] =  'Album cannot be empty <br>';
    }
    
    if (empty($year))
    {
        $error['year'] =  'Year cannot be empty <br>';
    } else 
    {
      if (!is_numeric($year))
      {
          $error['year'] = 'Must be a vaild year <br>';
      }
    }
    
    if (empty($rating))
    {
        $error['rating'] =  'Rating cannot be empty <br>';
    } else
    {
        $error['rating'] = 'Must be a vaild rating <br>'; 
    }
    
    if (empty($review))
    {
        $error['review'] =  'Review cannot be empty <br>';
    }
// insert data to db
$sql = $connect -> prepare("INSERT INTO userartists(artist, album, year, rating, review) VALUES
('$artist', '$album', '$year', '$rating', '$review')");
    $sql -> execute();


  /*  if (!mysqli_query($connect, $sql))
{
    echo "Failed " . mysqli_error($connect);
} else{
    echo '<script >';
echo 'alert("Data inserted successfully!")';
echo '</script>';
}



mysqli_close($connect);
    */

}


?>


<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<title>Add new music</title>
</head>

<body>
    


<header class="header center"> 
<?php include 'templates/header.php'; ?>
</header>


<!-- input form -->

<section class="form">
<form action="add.php" method="post">


<label for="artist">Artist</label>
<input type="text" id="artist" name="artist"> <br>
<div class="red-text"> <?php echo $error['artist']  ?> </div>

<label for="album">Album</label>
<input type="text" id="album" name="album"> <br>
<div class="red-text"> <?php echo $error['album']  ?> </div>


<label for="year">Year</label>
<input type="text" id="year" name="year"> <br>
<div class="red-text"> <?php echo $error['year']  ?> </div>

<label for="rating">Rating</label>
<input type="text" id="rating" name="rating"> <br>
<div class="red-text"> <?php echo $error['rating']  ?> </div>


<label for="review">Review</label>
<textarea name="review" id="review" cols="30" rows="10"></textarea>
<div class="red-text"> <?php echo $error['review']  ?> </div>

<input type="submit" id="submit" name="submit" class="submit">



</form>
</section>


<footer>
<?php include 'templates/footer.php'; ?>
</footer>


</body>




