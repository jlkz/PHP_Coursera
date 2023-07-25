<title> Jerick Lim </title>
<?php
require_once "pdo.php";

if ( isset($_POST['username']) && isset($_POST['password'])) {
    $sql = "INSERT INTO users (username, password) 
              VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $hash_default_salt = md5(htmlentities($_POST['password']));
    $stmt->execute(array(
        ':username' => htmlentities($_POST['username']),
        ':password' => $hash_default_salt));
}

if ( isset($_POST['delete']) && $_POST['username'] ) {
    $sql = "DELETE FROM users WHERE username = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['username']));
}

$stmt = $pdo->query("SELECT username, password FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head></head><body><table border="1">
<?php
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['username']);
    echo("</td><td>");
    echo($row['password']);
    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('name="username" value="'.$row['username'].'">'."\n");
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>
</table>
<p>Add A New User</p>
<form method="post">
<p>User Name:
<input type="text" name="username" size="40"></p>
<p>Password:
<input type="password" name="password"></p>
<p><input type="submit" value="Add New"/></p>
</form>
</body>
