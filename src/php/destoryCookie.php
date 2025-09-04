<?php
    $cookie_name = $_COOKIE['username'] ?? null;
    echo $cookie_name;
    if ($cookie_name) { 
        unset($_COOKIE[$cookie_name]);
        $res = setcookie($cookie_name, '', time() - 3600);
    }
    $_COOKIE = [];
   
  