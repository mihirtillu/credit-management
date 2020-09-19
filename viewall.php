<?php
    session_start();
    $conn=require "config.php";
?>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Credit Management-All users</title>

    <link rel="stylesheet" href="css/viewall.css">
    <!--
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script rel="stylesheet" src="bootstrap/js/bootstrap.min.js"></script>
    -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<?php
    $i=1;
    $res=$conn->query("select * from users");
    echo "<h1 align='center'>Users</h1>";
    if($res->num_rows>0) {
        echo "<table class='table table-striped table-dark table-bordered table-hover table-responsive-sm'>";
        echo "<tr id='hrow'><th>ID</th><th>name</th><th>email</th><th>credits</th><th>View me</th></tr>";
        while ($row = $res->fetch_assoc()) {
            
            echo"<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["credits"]."<td><a href='ind.php?v=$i' class='text-danger'> View ".$row['name']."</a></td></tr>";
            $i=$i+1;
        }
        echo "</table>";
    }
?>

<body>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="add_user">
    +
</button>
<form method="post" action="viewall.php">
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add a user</h5>
                    <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="text" placeholder="Name" name="name" class="form-control bg-dark text-white" required><br>
                        <input type="email" placeholder="Email" name="email"  class="form-control bg-dark text-white" required><br>
                        <input type="number" placeholder="Base credits" name="credit" class="form-control bg-dark text-white" required>
                    </form>
                </div>
                <div class="modal-footer">

                    <input type="submit" name="btn" class="btn btn-info">
                    <?php
                        if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["credit"])) {
                            $name = $email = $credit = "";
                            $ins = "insert into users (name,email,credits) values (?,?,?)";
                            $stmt = $conn->prepare($ins);
                            $stmt->bind_param("ssi", $name, $email, $credit);
                            $name = $_POST["name"];
                            $email = $_POST["email"];
                            $credit = $_POST["credit"];
                            $stmt->execute();
                            echo"<script>alert('User added')</script>";
                            echo "<script> location.href='viewall.php'; </script>";
                            exit;
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
</form>
<!--
<form method="post">
<input type="text" placeholder="Name" name="name" required><br>
<input type="email" placeholder="Email" name="email" required><br>
<input type="number" placeholder="Base credits" name="credit" required><br>
<button type="submit" name="btn">Submit</button>
</form>
-->
<a href="history.php?q=-1&w=-1&e=-1" id="hist" class="text-danger text-center">View history</a><p>mihir 2020</p>
</body>
</html>


