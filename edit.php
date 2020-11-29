<?php
//check get request
include 'db_connect.php';

//getting an id of the record

if (isset($_GET["id"]))
{

$id = mysqli_real_escape_string($connect, $_GET["id"]);
//selecting the record with specified id

$sql = "SELECT * FROM userartists WHERE id = $id";

$result = mysqli_query($connect, $sql);

$artists = mysqli_fetch_assoc($result);








}


// edit the record

$artist = $_POST['artist'];
$album = $_POST['album'];
$year = $_POST['year'];
$rating = $_POST['rating'];
$review = $_POST['review'];

if (isset($_POST['submit']))
{

    $edit_sql = "UPDATE userartists SET artist = '$artist', album = '$album', year = '$year', rating = '$rating', review = '$review'
WHERE id = '$id'";

    if (!mysqli_query($connect, $edit_sql)) {
        echo "Failed " . mysqli_error($connect);
    } else {
        echo '<script language="javascript">';
        echo 'alert("Data edited successfully!")';
        echo '</script>';
    }


    mysqli_close($connect);

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
</head>
<body>
    <header>
<?php include 'templates/header.php' ?>
    </header>


<div class="container">

<!-- <?php if ($artists) { ?> -->

<!-- output the record -->

<section class="form">
<form action="edit.php" method="post">


<label for="artist">Artist</label>
<input type="text" id="artist" name="artist" value="<?php  echo $artists["artist"]  ?>"> <br>
<div class="red-text"> <?php echo $error['artist']  ?> </div>

<label for="album">Album</label>
<input type="text" id="album" name="album" value="<?php  echo $artists["album"]  ?>"> <br>
<div class="red-text"> <?php echo $error['album']  ?> </div>


<label for="year">Year</label>
<input type="text" id="year" name="year" value="<?php  echo $artists["year"]  ?>"> <br>
<div class="red-text"> <?php echo $error['year']  ?> </div>


<label for="rating">Rating</label>
<input type="text" id="rating" name="rating" value="<?php  echo $artists["rating"]  ?>"> <br>
<div class="red-text"> <?php echo $error['rating']  ?> </div>



<label for="review">Review</label>
<textarea name="review" id="review" cols="30" rows="10"> <?php  echo $artists["review"] ?> </textarea>
<div class="red-text"> <?php echo $error['review']  ?> </div>

<input type="submit" id="submit" name="submit" class="submit">
    


<!-- 

<?php } else { ?>
    
    
    
    
  <?php } ?>

  -->

</div>


<footer>

    <?php include 'templates/footer.php' ?>
    </footer>



</body>
</html>