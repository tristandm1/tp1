<?php
include "models/users.php";
if (isset($_GET["id"]) && isset($_GET["action"])) {
    $Id = (int) $_GET["id"];
    $usersFile = UsersFile(); 
    $user = $usersFile->get($Id); 
    if ($user !== null) {
        if ($_GET["action"] == 'block') {
            $usersFile->updateblock($user); 
        } else if ($_GET["action"] == 'unblock') {
            $usersFile->unblock($user); 
    }
}
}
header('Location: manageusers.php');
?>