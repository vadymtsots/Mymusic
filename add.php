<?php
include 'db_connect.php';

$error = [
    'artist' => '',
    'album' => '',
    'year' => '',
    'rating' => '',
    'review' => ''
];

$req = $_REQUEST;

function isValidated($error)
{
    foreach ($error as $name => $value) {
        if (!empty($value)) {
            return false;
        }
    }

    return true;
}

//form validation

if (isset($req['submit'])) {
    $error['artist'] = empty($req['artist']) ? 'Artist cannot be empty <br>' : '';
    $error['album'] = empty($req['album']) ? 'Album cannot be empty <br>' : '';
    $error['review'] = empty($req['review']) ? 'Review cannot be empty <br>' : '';

    $error['year'] = empty($req['year']) ? 'Year cannot be empty <br>' :
        (!is_numeric($req['year']) ? 'Must be a validEd year <br>' : '');

    $error['rating'] = empty($req['rating']) ? 'Rating cannot be empty <br>' :
        (!is_numeric($req['rating']) ? 'Must be a valid rating <br>' : '');

    if (isValidated($error)) {
        // insert data to db
        $sql = "INSERT INTO userartists(artist, album, `year`, rating, review) VALUES (?, ?, ?, ?, ?)";
        $st = $connect->prepare($sql);
        $st->execute([
            $req['artist'],
            $req['album'],
            $req['year'],
            $req['rating'],
            $req['review'],
        ]);
    }
}


?>

<html lang="en">
<?php
    $page_title = 'Add new music';
    include 'templates/head.php'
?>

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

    <?php if (isset($req['submit']) && isValidated($error)): ?>
        <script>
            alert('Success');
        </script>
    <?php endif ?>
</body>
</html>