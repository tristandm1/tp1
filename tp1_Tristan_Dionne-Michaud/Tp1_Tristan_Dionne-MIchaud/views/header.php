<?php
    $pageTitle = "Photos Cloud";
    if (!isset($viewTitle))
        $viewTitle = "";
    if (!isset($viewHeadCustom))
        $viewHeadCustom = "";

    if (!isset($viewName))
        $viewName = "";

    $loggedUserMenu = "";
    $connectedUserAvatar = "";
    $adminManagerAcess = "";
    $addphoto = "";

    if (isset($_SESSION["isAdmin"]) ) {

        if (($_SESSION["isAdmin"]) ){
            $adminManagerAcess = <<<HTML
            <a href="manageUsers.php" class="dropdown-item">
                <i class="menuIcon fa-solid fa-users-gear"></i> gestion des usagers
            </a>
        HTML;
        }
    }

    if (isset($_SESSION["validUser"]) || isset($_SESSION["validAdmin"])) {
        $avatar = $_SESSION["avatar"];
        $userName = $_SESSION["userName"];
     
        $loggedUserMenu = <<<HTML

            <a href="logout.php" class="dropdown-item">
                <i class="menuIcon fa fa-sign-out mx-2"></i> Déconnexion
            </a>
            <a href="editProfilForm.php" class="dropdown-item">
                <i class="menuIcon fa fa-user mx-2"></i> Modifier votre profil
            </a>
            <a href="usersList.php" class="dropdown-item">
                <i class="menuIcon fa fa-users mx-2"></i> Liste des usagers
            </a>
            <a href="photosList.php" class="dropdown-item">
                <i class="menuIcon fa fa-image mx-2"></i> Liste des photos
            </a>
             $adminManagerAcess;
        HTML;
        
    }
        if(isset($_SESSION["validUser"]))
        {
            $connectedUserAvatar = <<<HTML
            <div class="UserAvatarSmall" style="background-image:url('$avatar')" title="$userName"></div>
        HTML;
        }
       else {
        $loggedUserMenu =  <<<HTML
            <a href="loginForm.php" class="dropdown-item">
                <i class="menuIcon fa fa-sign-in mx-2"></i> Connexion
            </a> 
        HTML;   
        $connectedUserAvatar = <<<HTML
            <div>&nbsp;</div>
        HTML; 
    }

    $viewMenu = "";
    if (strcmp($viewName,"photoList")==0) {
        // toto add more items in popupmenu
        $viewMenu =<<<HTML
         <div class="dropdown-divider"></div>
         <a href="photosList.php?sort=date" class="dropdown-item" id="photosListCmd">
                <i class="menuIcon fa fa-calendar mx-2"></i>Trier les photos par date de création
         </a>
         <a href="photosList.php?sort=username" class="dropdown-item" id="photosListCmd">
                <i class="menuIcon fa fa-users mx-2"></i>Trier les photos par créateur
         </a>
         <a href="photosList.php?sort=currentUser" class="dropdown-item">
                <i class="menuIcon fa fa-image mx-2"></i> vos Photos
            </a>
        HTML;
       $addphoto ='<a href="newPhotoForm.php" class="cmdIcon fa fa-plus" title="Ajouter une photo"></a>';
            
    }
    $viewHead = <<<HTML
        <a href="photosList.php" title="Liste des photos"><img src="images/PhotoCloudLogo.png" class="appLogo"></a>
        <span class="viewTitle">$viewTitle 
            $addphoto
        </span>
        <div class="headerMenusContainer">
            <span>&nbsp</span> <!--filler-->
            <a href="editProfilForm.php" title="Modifier votre profil"> $connectedUserAvatar </a>  
            <!-- popup menu -->       
            <div class="dropdown ms-auto">
                <div data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="cmdIcon fa fa-ellipsis-vertical"></i>
                </div>
                <div class="dropdown-menu noselect">
                    $loggedUserMenu
                    $viewMenu
                    <div class="dropdown-divider"></div>
                    <a href="about.php" class="dropdown-item">
                        <i class="menuIcon fa fa-info-circle mx-2"></i> À propos...
                    </a>
                </div>
            </div>
        </div>
    HTML;

