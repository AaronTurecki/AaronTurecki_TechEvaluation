<?php

include "../config/database.php";
include "../config/ShortUrl.php";

try {
    $pdo = new PDO(":host=" . 'localhost' .
        ";dbname=" . 'techeval',
        'root', '');
}
catch (PDOException $e) {
    trigger_error("Error: Failed to establish connection to database.");
    exit;
}

$shortUrl = new ShortUrl($pdo);
try {
    $code = $shortUrl->urlToShortCode($_POST["url"]);
    printf('<p><strong>Short URL:</strong> <a href="%s">%1$s</a></p>',
        'prefix' . $code);
    exit;
}
catch (Exception $e) {
    // log exception and then redirect to error page.
    header("Location: /error");
    exit;
}

?>
