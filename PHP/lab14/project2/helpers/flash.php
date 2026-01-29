<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function set_flash($key, $message, $type = 'success') {
    $_SESSION['flash'][$key] = [
        'message' => $message,
        'type' => $type
    ];
}

function get_flash($key) {
    if (isset($_SESSION['flash'][$key])) {
        $flash = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]); 
        return $flash;
    }
    return null;
}
