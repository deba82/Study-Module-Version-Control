<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Aptitude World</title>
    <style>
        .table th,
        .table td {
            text-align: center;
        }

        .update a,
        .delete a {
            text-decoration: none;
            color: orange;
        }

        .delete a {
            color: red;
        }

        h2 span a {
            color: red;
            border: 2px solid black;
            border-radius: 5px;
            padding: 5px;
            animation: deba 1s infinite linear;
        }

        @keyframes deba {
            from {
                color: red;
            }

            to {
                color: lightgreen;
            }
        }
    </style>
</head>

<body>
    <h2 class="mt-2 d-flex justify-content-center"><span class="badge bg-light"><a href="practice.php">Practice</a></span></h2>
    <div class="alert alert-primary text-center h3" role="alert">
        List of Aptitude Chapters <span class="badge bg-light"><a href="Add.php">Add New</a></span>
    </div>
    <?php
            $con = mysqli_connect("localhost", "root", "", "aptitude");
            $sql = "select * from main where main.Status=1 ORDER BY `main`.`Serial` ASC";
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) > 0) {
                ?>
    <table class="table container table-dark table-hover table-striped">
        <thead class="container-fluid">
            <th>Serial</th>
            <th>Module Name</th>
            <th>Practice</th>
            <th>Exercise</th>
            <th class="update">Update</th>
            <th class="delete">Disable</th>
        </thead>
        <tbody>
            <?php
                while ($result = mysqli_fetch_assoc($res)) {
            ?><tr>
                        <td><?php echo $result["Serial"] ?></td>
                        <td><?php echo $result["Module"] ?></td>
                        <td><?php echo $result["Practice"] ?></td>
                        <td><?php echo $result["Exercise"] ?></td>
                        <td class="update"><a href="Update.php?id=<?php echo $result["id"] ?>">U</a></td>
                        <td class="delete"><a href="Disable.php?id=<?php echo $result["id"] ?>">D</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>

    </table>
    <?php
            $con = mysqli_connect("localhost", "root", "", "aptitude");
            $sql = "select * from main where main.Status=0 ORDER BY `main`.`Serial` ASC";
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) > 0) {
                ?>
    <table class="table container table-dark table-hover table-striped">
        <thead class="container-fluid">
            <th>Disabled Module Name</th>
            <th class="delete">Enable</th>
        </thead>
        <tbody>
            <?php
                while ($result = mysqli_fetch_assoc($res)) {
            ?><tr>
                        <td><?php echo $result["Module"] ?></td>
                        <td class="delete"><a href="Enable.php?id=<?php echo $result["id"] ?>">E</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>

    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
</body>

</html>