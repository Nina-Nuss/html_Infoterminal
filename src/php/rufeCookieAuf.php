<?php

// $username = 'Alice';
// // nach setcookie(...)

// setcookie('username', $username, time() + (86400 * 30), "/");
// // damit dieselbe Anfrage das Cookie sieht:
// $_COOKIE['username'] = $username;
$username = 'nico'; // Beispielwert

$remember = true; // Beispielwert, ob "Remember Me" aktiviert

if ($remember) {
    if (isset($_COOKIE['username'])) {
        if ($_COOKIE['username'] !== $username) {
            setcookie('username', $username, time() + (86400 * 30), "/"); // 30 Tage Gültigkeit
            $_COOKIE['username'] = $username; // damit gleiche Anfrage das Cookie sieht
        } else {
            // Cookie ist schon korrekt gesetzt, nichts zu tun
        }
    } else {
        setcookie('username', $username, time() + (86400 * 30), "/"); // 30 Tage Gültigkeit
        $_COOKIE['username'] = $username; // damit gleiche Anfrage das Cookie sieht
    }
} else {
    setcookie('username', '', time() - 3600, "/"); // Cookie löschen
}

if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    echo 'Hallo, ' . htmlspecialchars($_COOKIE['username'], ENT_QUOTES, 'UTF-8');
}
