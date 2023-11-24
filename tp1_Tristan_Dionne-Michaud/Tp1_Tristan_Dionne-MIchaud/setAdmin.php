<?php
include "models/users.php";
if (isset($_GET["id"])) {
    $Id = (int) $_GET["id"];
    $usersFile = UsersFile(); 
    $user = $usersFile->get($Id); 
    if ($user !== null) {
        if ($user->isAdmin()) {
            $user -> setType(0);
            $usersFile->update($user); 
        } else if (!$user -> isAdmin()) {
            $user -> setType(1);
            $usersFile->update($user); 
    }
}
}
header('Location: manageusers.php');
?>