<title> Jerick Lim </title>
<h1>Tracking Autos for</h1>
<?php
    require_once "pdo.php";
    if (!isset($_GET['name']) ){
        die("Name parameter missing");
    } 

    if(isset($_POST['logoutButton'])){
        header('Location: index.php');
    }

?>
<h1> <?php echo $_GET['name'] ?> </h1>
<?php
    if(empty($_POST['make']) && isset($_POST['mileage']) && isset($_POST['year']) ){
        echo "<p><font color = red>Make is Required</font></p>\n";
    }
    else if(isset($_POST['year']) || isset($_POST['mileage'])){
        if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
            echo "<p><font color = red>Mileage and year must be numeric</font></p>\n";
        } 
    }
    
    if(isset($_POST['year']) && isset($_POST['mileage']) && !empty($_POST['make'])){
        $stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(array(
            ':mk' => htmlentities($_POST['make']),
            ':yr' => htmlentities($_POST['year']),
            ':mi' => htmlentities($_POST['mileage']))
        );
        echo "<p><font color = green>Record inserted</font></p>\n";
    }

?>
<form method="post">
<p>Make:
<input type="text" size="40" name="make"></p>
<p>Year:
<input type="text" size="40" name="year"></p>
<p>Mileage:
<input type="text" size="40" name="mileage"></p>
<p><input type="submit" value="Add"/>
<input type="submit" name="logoutButton" value = "Logout"/></p>
</form>
<h1>Automobiles</h1>
<?php
    $stmt = $pdo->query("SELECT * from autos");
    if($stmt->rowCount() !== 0){
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ( $rows as $row ){
            echo '<li>' . $row['year'] . " " . $row['make'] . "/" . $row['mileage'] ."</li>";
        }
    }
    
?>