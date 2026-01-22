<?php
function set_flash($msg, $type = 'success') {
    $_SESSION['flash'] = ['msg' => $msg, 'type' => $type];
}

function show_flash() {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        echo "<p style='color:" . ($f['type']=='error'?'red':'green') . "'>"
            . htmlspecialchars($f['msg']) . "</p>";
        unset($_SESSION['flash']);
    }
}
