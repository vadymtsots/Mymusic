<?php
//check get request
include 'db_connect.php';

//getting an id of the record

if (isset($_GET["id"]))
{

$id = $_GET["id"];

//selecting the record with specified id

$sql = $connect -> prepare("SELECT * FROM userartists WHERE id = $id");
$sql -> execute();
$artists = $sql -> fetch();









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

    <h4> <?php echo 'Artist: ' . htmlspecialchars($artists["artist"])  ?> </h4>
    <h4> <?php echo 'Album: ' . htmlspecialchars($artists["album"])  ?> </h4>
    <h4> <?php echo 'Year: ' . htmlspecialchars($artists["year"])  ?> </h4>
    <h4> <?php echo 'Rating: ' . htmlspecialchars($artists["rating"])  ?> </h4>
    <h4> <?php echo 'Review: ' . htmlspecialchars($artists["review"])  ?> </h4>
    


<!-- 

<?php } else { ?>
    
    
    
    
  <?php } ?>

  -->

</div>

<div class="center">
<a href="edit.php?id=<?php echo $artists['id']?>">Edit the review</a>

</div>

    <footer>

    <?php include 'templates/footer.php' ?>
    </footer>



</body>
</html>