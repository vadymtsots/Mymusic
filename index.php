<?php
session_start();
$id = $_SESSION['user']['id'];
include 'db_connect.php';

$sql = "SELECT id, artist, album, year, rating  FROM userartists WHERE user_id = '$id'";
$stmt = $connect->prepare($sql);
$stmt -> execute();
$artists = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<?php
$page_title = 'MyMusic';
include 'templates/head.php'
?>

<body>
    <header class="header center ndigo darken-2">
    <?php include 'templates/header.php'; ?>
    </header>
    <h4 class="center">My Music</h4>
    <section class="container"
    <div class="row">


        <?php foreach($artists as $artist) { ?>
             <div class="col md 3">
                 <div class="card z-depth-0">
                     <div class="card-content center
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
        <?php  } ?>

     </div>

    </section>

    <footer
        <?php include 'templates/footer.php'; ?>
    </footer>

</body>
</html>