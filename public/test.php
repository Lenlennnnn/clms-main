<?php
$text = "ictoffice";
$hash = password_hash($text, PASSWORD_DEFAULT);

echo "The hash of '$text' is: $hash";
?>
