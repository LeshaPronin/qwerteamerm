<?php
    session_destroy();
    clearstatcache();
    echo '<script>window.location.href = "index.php";</script>';
?>