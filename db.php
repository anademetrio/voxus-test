<?php

require 'config.php';
$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
