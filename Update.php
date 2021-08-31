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
    <div class="alert alert-primary text-center h3 mt-3" role="alert">
        UPDATE CHAPTER <span class="badge bg-light"><a href="index.php">Dashboard</a></span>
    </div>
    <?php
    $con = mysqli_connect("localhost", "root", "", "aptitude");
    $message = "";
    $code = "";
    $message = "";
    $code = "";
    $id = $_GET['id'];
    if (isset($_POST["update"])) {
        $Serial = $_POST["Serial"];
        $Module = $_POST["Module"];
        $Practice = $_POST["Practice"];
        $Exercise = $_POST["Exercise"];
        $con = mysqli_connect("localhost", "root", "", "aptitude");
        $sql = "UPDATE `main` SET `Serial` = '$Serial',`Module` = '$Module',`Practice` = '$Practice',`Exercise` = '$Exercise' WHERE `main`.`id` = $id";
        if (mysqli_query($con, $sql)) {
            $message = "Sucessfully updated";
            $code = "success";
            unset($_POST);
            header("refresh:3;url=index.php");
        } else {
            $message = "Error in updating";
            $code = "danger";
            unset($_POST);
        }
    }
    if (isset($_GET["id"])) {
        $sql = "select * from `main` where id=$id";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0) {
            header("location:index.php");
        }
        while ($res = mysqli_fetch_assoc($result)) {
    ?>
            <form class="container mt-2" method="post">
                <div class="mb-3">
                    <label for="Name" class="form-label">Module Number</label>
                    <input type="number" class="form-control" name="Serial" value=<?php echo $res["Serial"] ?>>
                </div>
                <div class="mb-3">
                    <label for="Name" class="form-label">Module Name</label>
                    <input type="text" class="form-control" name="Module" value=<?php echo $res["Module"] ?>>
                </div>
                <div class="mb-3">
                    <label for="Name" class="form-label">Number of Practice Question</label>
                    <input type="number" class="form-control" name="Practice" value=<?php echo $res["Practice"] ?>>
                </div>
                <div class="mb-3">
                    <label for="Name" class="form-label">Number of Exercise Question</label>
                    <input type="number" class="form-control" name="Exercise" value=<?php echo $res["Exercise"] ?>>
                </div>
                <input type="submit" value="Update" class="btn btn-primary" name="update">
                <div class="alert alert-<?php echo $code ?>" role="alert">
                    <?php echo $message; ?>
                </div>
            </form>
    <?php
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    </script>
</body>

</html>