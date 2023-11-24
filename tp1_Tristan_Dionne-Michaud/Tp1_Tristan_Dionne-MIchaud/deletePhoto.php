<?php
include 'php/sessionManager.php';
include 'models/photos.php';
include 'models/users.php';
$viewTitle = "Retrait de photo";

$currentUserId = (int) $_SESSION["currentUserId"];
$usersFile = UsersFile(); 
$user = $usersFile->get($currentUserId);
$isAdmin = $user ->isAdmin();
 
userAccess();

if(!isset($_GET["id"]))
    redirect("illegalAction.php");

$id = (int) $_GET["id"];

$photo = PhotosFile()->get($id);
if ($photo == null)
    redirect("illegalAction.php");

if ($photo->OwnerId() != $currentUserId && !$isAdmin)
    redirect("illegalAction.php");

PhotosFile()->remove($id);
redirect("photosList.php");