<title> 36e80ad9 </title>
<a>Please Log In</a>
<?php
    require_once "pdo.php";

    if (empty($_POST['username']) xor empty($_POST['password'])){
        echo("<p><font color = red>Email and password are required</font></p>\n");
    }

    elseif ( isset($_POST['username']) && isset($_POST['password'])  ) {
        if(strpos($_POST['username'], "@") === false){
            echo "<p><font color = red>Email must have an at-sign (@)</font></p>\n";
        }
        else{
            $sql = "SELECT username FROM users 
            WHERE username = :em AND password = :pw";
            $hashedPW = md5(htmlentities($_POST['password']));
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':em' => htmlentities($_POST['username']), 
                ':pw' => $hashedPW));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ( $row === FALSE ) {
                echo "<p><font color = red>Incorrect password.</font></p>\n";
                error_log("Login fail ".$_POST['username']. " $hashedPW");
            } else { 
                error_log("Login success ".$_POST['username']);
                header("Location: autos.php?name=".urlencode($_POST['username']));
            }
        }
    }
    
    
?>
<form method="post">
<p>User Name:
<input type="text" size="40" name="username"></p>
<p>Password:
<input type="text" size="40" name="password"></p>
<p><input type="submit" value="Login"/>
<a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a></p>
</form>
<p>
