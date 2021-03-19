<?php
//check get request
include 'db_connect.php';
$req = $_REQUEST;

//getting an id of the record

if (isset($req["id"])) {
$id = $req["id"];
//selecting the record with specified id
$sql = "SELECT * FROM userartists WHERE id = $id";
$stmt= $connect -> prepare($sql);
$stmt -> execute();
$artists = $stmt -> fetch();

}
?>


<!DOCTYPE html>
<html lang="en">
<?php
$page_title = 'Review';
include 'templates/head.php'
?>
<body>
    <header>
        <?php include 'templates/header.php' ?>
    </header>


        <div class="container">
            <h4> <?php echo 'Artist: ' . htmlspecialchars($artists["artist"])  ?> </h4>
            <h4> <?php echo 'Album: ' . htmlspecialchars($artists["album"])  ?> </h4>
            <h4> <?php echo 'Year: ' . htmlspecialchars($artists["year"])  ?> </h4>
            <h4> <?php echo 'Rating: ' . htmlspecialchars($artists["rating"])  ?> </h4>
            <h4> <?php echo 'Review: ' . htmlspecialchars($artists["review"])  ?> </h4>
        </div>

        <div class="center">
            <a href="edit.php?id=<?php echo $artists['id']?>">Edit the review</a>
        </div>

    <footer>
    <?php include 'templates/footer.php' ?>
    </footer>

</body>
</html>