<?php
$pdo = new PDO('mysql:host=localhost;dbname=one', 
   'jer', 'ick');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



