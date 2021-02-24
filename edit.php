<?php

include 'db_connect.php';
$req = $_REQUEST;
$id = $req['id'];
//selecting the record with specified id
$sql = "SELECT * FROM userartists WHERE id = $id";

$stmt = $connect -> prepare($sql);
$stmt-> execute();
$artists = $stmt-> fetch();

?>


<?php

    include 'db_connect.php';

if (isset($req['submit'])) {
    $edit_sql = "UPDATE userartists SET artist = ?, album = ?, `year` = ?, rating = ?, review = ?
WHERE userartists.id = ?";
    $edit_stmt = $connect->prepare($edit_sql);
    $edit_stmt->execute([
        $req['artist'],
        $req['album'],
        $req['year'],
        $req['rating'],
        $req['review'],
        $req['id'],
    ]);
header('Location: review.php');
}


?>

<html lang="en">
<?php
$page_title = 'Edit the review';
include 'templates/head.php'
?>
<body>
    <header>
        <?php include 'templates/header.php' ?>
    </header>

    <div class="container">
        <section class="form">
            <form method="post">


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

                    <input type="hidden" name="id" id="id" value="<?php echo $artists["id"] ?>">

                    <input type="submit" class="submit" id="submit" name="submit">

            </form>
        </section>
    </div>


<footer>

    <?php include 'templates/footer.php' ?>
    </footer>



</body>
</html>