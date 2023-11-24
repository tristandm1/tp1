<?php
include "models/photos.php";
require 'php/sessionManager.php';
include_once "models/Users.php";
require "php/date.php";

$viewTitle = "information sur la photo ";
$id = (int) $_GET["id"];
$list = PhotosFile()->toArray();

foreach ($list as $photo) {

if($photo->id() == $id){

    $title = $photo->Title();
    $description = $photo->Description();
    $date = $photo->creationDate();
    $image = $photo->Image();
    $owner = UsersFile()->Get($photo->OwnerId());
    $ownerName = $owner->Name();
    $ownerAvatar = $owner->Avatar();
    $formattedDate = formattedDate($photo->CreationDate());
}
}
$sharedIndicator = "";
$editCmd = "";

$photoHTML = <<<HTML


    <div class="photoDetailsTitle">$title</div>
    <div class="photoDetailsDescription">description: $description</div>
    <div class="photoDetailsCreationDate">date de création: $formattedDate</div>

    <div class="photoDetailsOwnerAvatar">
        <div class="UserAvatarSmall transparentBackground" style="background-image:url('$ownerAvatar')" title="$ownerName"></div>
        <div class="photoDetailsOwner">$ownerName</div>
    </div>

    <div class="photoDetailsLargeImage" style="background-image:url('$image')"></div>

               
                
HTML;
$viewContent = $photoHTML;


include "views/master.php";
?>