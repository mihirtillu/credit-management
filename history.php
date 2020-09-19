<?php
    $conn = require "config.php";
?>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Credit Management-History</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/history.css">
</head>
<body>
    <h1 align="center">Transfer history</h1>
    <table class='table table-striped table-dark table-bordered table-hover'>
    <tr id="trd"><th>From</th><th>To</th><th>Credits</th></tr>
        <?php
            if($_GET["q"]>=0 && $_GET["w"]!=-1 && $_GET["e"]!=-1){
                $from = $_GET["w"];
                $to = $_GET["e"];
                $credit = $_GET["q"];
                $ins = "insert into history (f,t,c) values (?,?,?)";
                $stmt = $conn->prepare($ins);
                $stmt->bind_param("ssi", $from, $to, $credit);
                $stmt->execute();
            }
            $res=$conn->query("select * from history");
            if ($res->num_rows>0){
                while($row = $res->fetch_assoc()){
                    echo "<tr><td>".$row["f"]."</td><td>".$row["t"]."</td><td>".$row["c"]."</td></tr>";
                }
            }
            
        ?>
    </table>
    <a href="viewall.php">
        <button class="btn btn-info">View all</button>
    </a>
    <p>mihir 2020</p>
</body>
</html>
