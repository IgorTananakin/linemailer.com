<?php
//post-message.php

if(isset($_REQUEST["author"]) && isset($_REQUEST["message"]) ){
    require __DIR__ . '/db.php';
    $pdo = db();
    $sql = "INSERT INTO messages (author, message) VALUES (:author, :message)";
    $messageSvr = $pdo->prepare($sql);
    $messageSvr->bindParam(':author', $_REQUEST["author"]);
    $messageSvr->bindParam(':message', $_REQUEST["message"]);

    if (!$messageSvr->execute()) {
        throw new \Exception("Cannot save message");
    }
} else {
    throw new \Exception("There is no author or message");
}