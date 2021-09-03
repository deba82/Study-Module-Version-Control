<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Aptitude World</title>
</head>
<body>
    <?php
    $con = mysqli_connect("localhost", "root", "","aptitude");
    $message = "";
    $code = "";
    if (isset($_POST["submit"])) {
        $Serial = $_POST["Serial"];
        $Module = $_POST["Module"];
        $Practice = $_POST["Practice"];
        $Exercise = $_POST["Exercise"];
        $con = mysqli_connect("localhost", "root", "", "aptitude");
        $sql = "INSERT INTO `main` (`id`,`Serial`, `Module`, `Practice`, `Exercise`) VALUES (NULL,'$Serial', '$Module', '$Practice', '$Exercise')";
        if (mysqli_query($con, $sql)) {
            $message = "Sucessfully inserted";
            $code = "success";
            unset($_POST);
            //header("refresh:5;location:index.php");
        } else {
            $message = "Error in inserting";
            $code = "danger";
            unset($_POST);
        }
    }
    ?>
    <div class="alert alert-primary text-center h3 mt-3" role="alert">
        ADD NEW CHAPTER <span class="badge bg-light"><a href="index.php">Dashboard</a></span>
    </div>
    <form class="container mt-2" method="post">
        <div class="mb-3">
            <label for="Name" class="form-label">Module Number</label>
            <input type="number" class="form-control" name="Serial">
        </div>
        <div class="mb-3">
            <label for="Name" class="form-label">Module Name</label>
            <input type="text" class="form-control" name="Module">
        </div>
        <div class="mb-3">
            <label for="Name" class="form-label">Number of Practice Question</label>
            <input type="number" class="form-control" name="Practice">
        </div>
        <div class="mb-3">
            <label for="Name" class="form-label">Number of Exercise Question</label>
            <input type="number" class="form-control" name="Exercise">
        </div>
        <input type="submit" value="submit" class="btn btn-primary" name="submit">
        <div class="alert alert-<?php echo $code ?>" role="alert">
            <?php echo $message; ?>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    </script>
</body>

</html>