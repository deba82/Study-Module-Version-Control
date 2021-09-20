<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #saveform {
            display:flex;
            justify-content: center;
        }
    </style>
    <title>Practice</title>
</head>

<body>
    <?php
    $display = "";
    if (isset($_POST['Submit'])) {
        $display = "none";
        $Number = $_POST['Number'];
        if (isset($_POST['Shuffle'])) {
            $Shuffle = 100;
        } else {
            $Shuffle = 0;
        }
        if ($Number == "" or $Number <= 1) {
            $Number = 10;
        }
        $con = mysqli_connect("localhost", "root", "", "aptitude");
        $sql = "Select * from `main` where main.Status=1 ORDER BY `main`.`Serial` ASC";
        $res = mysqli_query($con, $sql);
        $list = array();
        if (mysqli_num_rows($res) > 0) {
            while ($result = mysqli_fetch_assoc($res)) {
                for ($i = 1; $i <= $result['Practice']; $i++) {
                    $item = $result['Serial'] . "P" . $i . " [" . $result['Module'] . "]";
                    array_push($list, $item);
                }
                for ($i = 1; $i <= $result['Exercise']; $i++) {
                    $item = $result['Serial'] . "E" . $i . " [" . $result['Module'] . "]";
                    array_push($list, $item);
                }
                for ($i = 1; $i <= $result['SpExercise']; $i++) {
                    $item = $result['Serial'] . "E" . $i . " [" . $result['Module'] . "]";
                    array_push($list, $item);
                }
            }
            $sql = "SELECT * FROM `options` where `options`.`id`=1 ";
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) > 0) {
                $result = mysqli_fetch_assoc($res);
                $exlist = explode(",", $result['value']);
                $list = array_diff($list, $exlist);
            }
        } else {
    ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    No Module Found. Redirecting....
                </div>
            </div>
        <?php
            header("refresh:3;url=index.php");
            die();
        }
        for ($i = 0; $i < $Shuffle; $i++) {
            shuffle($list);
        }
        $flist = array_rand($list, $Number);
        $slist = array();
        for ($i = 0; $i < count($flist); $i++) {
            $index = $flist[$i];
            array_push($slist, $list[$index]);
        }
        ?>
    <?php
    }
    ?>
    <div class="alert alert-primary text-center h3 mt-3" role="alert">
        Practice <span class="badge bg-light"><a href="index.php">Dashboard</a></span>
    </div>
    <form class="container" method="post" style="display:<?php echo "$display" ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter number of questions</label>
            <input type="number" name="Number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Practice and exercise start with their initial</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Enter time required in minutes</label>
            <input type="number" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="Shuffle" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Shuffle</label>
        </div>
        <input type="submit" value="Give random questions" name="Submit" class="btn btn-primary">
    </form>
    <?php
    if (isset($_POST['Submit'])) {

    ?>
        <table class="table container table-stripped table-dark">
            <thead>
                <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">Number AND Module</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($slist); $i++) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $i + 1; ?></th>
                        <td><?php echo $slist[$i]; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
            </tbody>
        </table>
        <?php
        if (isset($slist)) {
        ?>
            <form id="saveform" method="post">
                <input class="form-control" id="Savelist" type="hidden" aria-label="readonly input example" readonly value="<?php $savelist = implode(",", $slist);
                                                                                                                            echo $savelist; ?>" name="Savelist">
                <input type="submit" class=" btn btn-success mb-2 mx-2" value="Save These Questions">
            </form>
        <?php
        }
        ?>
        <?php
        if (isset($Number)) {
        ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Good Luck!</h4>
                <p>Total Number of questions given <?php echo $Number ?>
                    </br>Total Time required is <?php echo $Number * 3 ?> minutes</p>
                <hr>
                <p class="mb-0">For Randomize again, plaese reload this web page</p>
            </div>
        <?php
        }
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $("#saveform").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "save.php",
                    data: $("#saveform").serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response == 1) {
                            $("#saveform").hide();
                        }
                    }
                });

            });
        </script>
</body>

</html>