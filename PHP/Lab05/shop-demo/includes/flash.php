<?php
function set_flash($msg) {
    $_SESSION['flash'] = $msg;
}

function get_flash() {
    if (!empty($_SESSION['flash'])) {
        $msg = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $msg;
    }
    return null;
}
