<?php
session_start();
unset($_SESSION['username']);
session_destroy();
?>
<script>
    window.location="login.php";
</script>