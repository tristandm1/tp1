<?php
include 'php/sessionManager.php';
include_once "models/Users.php";

adminAccess();

$currentUser = $_SESSION["currentUserId"];
$viewTitle = "gestion des usager";
$list = UsersFile()->toArray();
$viewContent = "";

foreach ($list as $User) {
    
    //permet de ne pas afficher le current user de la session
    if($currentUser != $User->id()) {
    $id = strval($User->id());
    $name = $User->name();
    $email = $User->Email();
    $avatar = $User->Avatar();
    $destroye = "fa-sharp fa-solid fa-user-slash ";

    $isAdmin = $User->isAdmin() ? 'fa fa-user-gear icon-admin ' : "fa-solid fa-user icon-user" ;
    $isBlocked = $User->isBlocked() ? "fa fa-circle-xmark icon-block" : "fa fa-circle icon-notblocked";
    $blockAction = $User->isBlocked() ? 'unblock' : 'block';

    $UserHTML = <<<HTML
    <div class="UserRow" User_id="$id">
        <div class="UserContainer noselect">
            <div class="UserLayout">
                <div class="UserAvatar" style="background-image:url('$avatar')"></div>
                <div class="UserInfo">
                    <span class="UserName">$name</span>
                    <a href="mailto:$email" class="UserEmail" target="_blank">$email</a>
                </div>
                
                <div class="IconContainer">

                    <a href="setAdmin.php?id=$id"  class="dropdown-item">
                    <i class="<menuIcon $isAdmin"></i>
                    </a>

                    <a href="blockUser.php?id=$id &action=$blockAction" class="dropdown-item" >
                        <i class=" $isBlocked"></i>
                        
                     </a>
                     <a href="confirmeDeleteUser.php?id=$id" class="dropdown-item">
                        <i class="menuIcon $destroye"></i>
                        
                     </a>
                </div>
            </div>
        </div>
    </div>
    HTML;
    $viewContent = $viewContent . $UserHTML;
}
}

$viewScript = <<<HTML
    <script src='js/session.js'></script>
    <script defer>
        $("#addPhotoCmd").hide();
    </script>
HTML;

include "views/master.php";
?>