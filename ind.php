<?php
    session_start();
$conn = require "config.php";
?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        
        <title>
            Credit Management-Credits
        </title>
        <link rel="stylesheet" href="css/ind.css">
        
    </head>
    <body>
<?php
$vid=$_GET['v'];
$sql="select name,email,credits from users where id=$vid";
$res = $conn->query($sql);
if($res->num_rows>0){
    while($row = $res->fetch_assoc()) {
        echo("<div id='box'>");
        echo "<img src='css/avtar1.png'><br>";
        echo "<div id='inner'>";
        echo"Name : ".$row["name"]."<br><br>";
        echo"Email : ".$row["email"]."<br><br>";
        echo"credits : ".$row["credits"]."<br><br>";
        
        $a=$row["name"];
        $b=$row["credits"];
        echo "<p>To transfer credits <a class='text-danger' href='transfer_view.php?a=$a&b=$b'>click here</a>";
        echo "</div>";
        echo("</div>");

    }
}


?>
<p>mihir 2020</p>
    </body>
    </html>