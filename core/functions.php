<?php
// sanitizing the strings to prevent attack
function sanitize($data) {
    $text = trim($data);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);

    return $text;
}

?>