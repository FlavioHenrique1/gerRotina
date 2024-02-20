<?php
@session_start();

$_SESSION['local'] = $_POST['local'];

echo "
<script>
    window.location.href='".DIRPAGE."atividades';
</script>
";
