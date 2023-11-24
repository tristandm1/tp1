<?php
include 'php/sessionManager.php';
include "models/photos.php";
include "models/users.php";
$viewName="photoList";
userAccess();
$viewTitle = "Photos";
$list = PhotosFile()->toArray();
$viewContent = "<div class='photosLayout'>";
$currentUserId = (int)$_SESSION["currentUserId"]; // Assuming this is how you store the current user's ID
$usersFile = UsersFile(); 
$user = $usersFile->get($currentUserId); 


if(isset($_GET["sort"])) {
    switch($_GET["sort"]) {
        case 'username':
            usort($list, array('Photo', 'comparePhotosByOwnerName'));
            break;
        case 'date':
            usort($list, array('Photo', 'compare'));
            break;
        case 'currentUser':
            $list = array_filter($list, function($photo) use ($currentUserId) {
                return $photo->OwnerId() == $currentUserId;
            });
            break;
    }
}

foreach ($list as $photo) {
    $id = strval($photo->id());
    $title = $photo->Title();
    $description = $photo->Description();
    $date = $photo->creationDate();
    $image = $photo->Image();
    $owner = UsersFile()->Get($photo->OwnerId());
    $ownerName = $owner->Name();
    $ownerAvatar = $owner->Avatar();
    $shared = $photo->Shared() == "true";
    $sharedIndicator = "";
    $editCmd = "";
    $visible = ($shared || $user->isAdmin() || $photo->OwnerId() == $currentUserId) ;
    $isblocked = $owner->Blocked();

    if (($user-> isAdmin() || $photo->OwnerId() == $currentUserId)) {
        $visible = true;
        $editCmd = <<<HTML
            <a href="editPhotoForm.php?id=$id" class="cmdIconSmall fa fa-pencil" title="Editer $title"> </a>
            <a href="confirmDeletePhoto.php?id=$id"class="cmdIconSmall fa fa-trash" title="Effacer $title"> </a>
        HTML;
    }
    if ($shared) {
        $sharedIndicator = <<<HTML
            <div class="UserAvatarSmall transparentBackground" style="background-image:url('images/shared.png')" title="partagée"></div>
        HTML;
    } 
    if ($visible && $isblocked == 0) {
    $photoHTML = <<<HTML
        <div class="photoLayout" photo_id="$id">
            <div class="photoTitleContainer" title="$description">
                <div class="photoTitle ellipsis">$title</div> $editCmd</div>
            <a href="infophoto.php?id=$id" target="_blank">
                <div class="photoImage" style="background-image:url('$image')">
                    <div class="UserAvatarSmall transparentBackground" style="background-image:url('$ownerAvatar')" title="$ownerName"></div>
                    $sharedIndicator
                
                </div>

            </a>
        </div>           
        HTML;
        $viewContent = $viewContent . $photoHTML;
    }
}
$viewContent = $viewContent . "</div>";

$viewScript = <<<HTML
    <script src='js/session.js'></script>
    <script defer>
        $("#addphotoCmd").hide();
    </script>
HTML;

include "views/master.php";
