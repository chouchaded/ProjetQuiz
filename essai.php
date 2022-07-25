<?php
$password = "password";
$salt = "help";
$hash = hash_pbkdf2("sha256", $password, $salt, 1, 20);
echo $hash;
