<?php
require 'db_connection.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Books!app</title>
</head>

<body>
    <h1>Books!app</h1>

    <div class="d-flex">
        <?php
        $dbConnection = OpenCon();

        $stmt = $dbConnection->prepare('SELECT books.title, books.year, GROUP_CONCAT(authors.name SEPARATOR ", "), books.description
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
                    <p class="card-text"><?php echo $small_description ?><span style="display: inline" id="dots<?php echo $i ?>">...</span><span style="display: none" id="more<?php echo $i ?>"><?php echo substr($description, 150, 500); ?></span></p>

                    <button class="btn btn-link p-0" id="btn<?php echo $i ?>" onclick="
                    read_more('dots<?php echo $i ?>', 'more<?php echo $i ?>', 'btn<?php echo $i ?>')
                    ">Read more</button>

                </div>
            </div>

        <?php
            $i++;
        endwhile;
        CloseCon($dbConnection);
        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="read_more.js"></script>
</body>

</html>