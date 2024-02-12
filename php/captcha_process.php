<?php
session_start();
$_SESSION['captcha'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 6);
?>
<img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('https://dummyimage.com/120x40/000/fff&text='.$_SESSION['captcha'])) ?>">