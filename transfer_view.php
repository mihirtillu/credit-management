<?php
    $conn = require "config.php";
    $a = $_GET["a"];
    $cr_fr = $_GET["b"];
   
    ?>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Credit management-Transfer credits</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/transfer_view.css">
</head>
<body>
<div class="container">
    <div id="box">
    <h1>Transfer credits</h1><br>
    <h4>Tranfer from :<?php echo $a ?></h4>
    <?php
        $str="select name,id from users where id != '$cr_fr' ";
        $res = $conn->query($str);
        if ($res->num_rows > 0) {
            echo "<form method='post' class='form-group'><select name='To'  class='form-control'>";
            while ($row = $res->fetch_assoc()) {
                if ($row["name"]!=$a) {
                    echo '<option value="' . $row["name"] . '"  >' . $row["name"] . '</option>';
                }
            }
            echo "</select><br>";
            echo "<input type='text' id='inp' name='cr_inp' class='form-control' placeholder='Tranasfer credits'><br>";
            echo"<button type='submit' name='btn' value='Submit' class='btn btn-info' id='bt'>Submit</button>";
            echo "</form>";
            if (isset($_POST["btn"])) {
                if (!empty($_POST["To"])) {
                    if ($_POST["cr_inp"]<$cr_fr){
                    $name_id=$_POST["To"];
                    $sql=$conn->query("select credits from users where name='$name_id'");
                    if($sql->num_rows>0){
                        while($row = $sql->fetch_assoc()){
                            $cr_to=$row["credits"];
                        
                        $cr_inp=$_POST["cr_inp"];
                            if($cr_to>=0 && $cr_fr>=0 && $cr_inp>=0 && is_numeric($cr_inp)){
                        $cr_to=$cr_inp+$cr_to;
                        $cr_fr=$cr_fr-$cr_inp;
                                $qu=$conn->query("update users set credits=$cr_to where name='$name_id'");
                                $qv=$conn->query("update users set credits=$cr_fr where name='$a'");
                                if($qu && $qv){
        
                                    header("location:history.php?q=$cr_inp&w=$a&e=$name_id");
                                    echo "<script>alert('Credit transfer successful !')</script>";
                                }
                        }
                        else{
                            ?>
                            <script>
                                alert("Enter a positive integer");
                            </script>
        <?php
                        }
                        }
                        
                        
                    
                    }
                }
                    else{
                        echo "<script>alert('Value not acceptable')</script>";
                    }
        }
              
                
    
               
                else{
                    header('<script>alert("Failed")</script>');
                }
            
            
            }
        }
    ?>
    </div>
</div>
<p>mihir 2020</p>
</body>
</html>

    