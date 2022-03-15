<?php

session_start();
include('include/connection.php');
$display = $conn->query("SELECT id,machine_name,description FROM tbl_machine where is_delete = 0");

$col = isset($_SESSION['color']) ? $_SESSION['color'] : "";

$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
unset($_SESSION['msg']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Record</title>
</head>

<body>
    <div class="container mx-auto" style="margin-top: 8%;">
        <a class="btn btn-success" href="formdata.php" style="float: right; margin-bottom: 2%;">Add New Record</a>
        <h2 style="margin-bottom: 2%;">User Data</h2>
        <h4 class="<?php if ($col) {
                        echo 'text-success';
                    } else {
                        echo 'text-danger';
                    }
                    ?> mb-2"><?= $msg ?></h4>
        <table class="table table-striped">

            <tr>
                <th>Id</th>
                <th>Machine Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php
            if (mysqli_num_rows($display)) {
                while ($row = $display->fetch_assoc()) { ?>
                    <tr>
                        <td scope="col"><?= $row['id']; ?></td>
                        <td scope="col"><?= $row['machine_name']; ?></td>
                        <td scope="col"><?= $row['description'] ?></td>
                        <td><a href="formdata.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_data.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
</body>

</html>