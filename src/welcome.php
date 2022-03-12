<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: src/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <h3 class="my-3">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h3>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <h1>Books!app</h1>

    <div class="d-flex">
        <?php

        require '../config/dbconnection.php';
        $stmt = $mysqli->prepare('SELECT books.title, books.year, GROUP_CONCAT(authors.name SEPARATOR ", "), books.description
        FROM books
        JOIN bookauthors ON books.bookid = bookauthors.bookid
        JOIN authors ON bookauthors.authorid = authors.authorid
        GROUP BY books.title
        ');
        $stmt->execute();
        $result = $stmt->get_result();

        $i = 1;
        while ($row = $result->fetch_assoc()) :

            $title = $row['title'];
            $name = $row['GROUP_CONCAT(authors.name SEPARATOR ", ")'];
            $description = $row['description'];
            $small_description = substr($description, 0, 150);
        ?>
            <div class="card m-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $title ?> </h5>
                    <h6 class="card-title"> <?php echo $name ?> </h6>
                    <p class="card-text"><?php echo $small_description ?><span style="display: inline" id="dots<?php echo $i ?>">...</span><span style="display: none" id="more<?php echo $i ?>"><?php echo substr($description, 150); ?></span></p>
                    <button class="btn btn-link p-0" id="btn<?php echo $i ?>" onclick="
                    read_more('dots<?php echo $i ?>', 'more<?php echo $i ?>', 'btn<?php echo $i ?>')
                    ">Read more</button>

                </div>
            </div>

        <?php
            $i++;
        endwhile;
        $mysqli->close();
        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../resources/js/read_more.js"></script>
</body>

</html>