<?php
    include 'php/sessionManager.php';
    include 'models/users.php';
    $viewTitle = "detruire utilisateur";
    
    userAccess(200);
    
    $id = (int) $_GET["id"];
    

    $viewContent = <<<HTML
    <div class="content loginForm">
        <br>
       <h3> Voulez-vous vraiment effacer ce compte? </h3>
        <div class="form">
            <a href="deleteUser.php?id=$id"><button class="form-control btn-danger">detruire utilisateur</button>
            <br>
            <a href="manageUsers.php" class="form-control btn-secondary">Annuler</a>
        </div>
    </div>
    HTML;
    $viewScript = <<<HTML
        <script defer>
            $("#addPhotoCmd").hide();
        </script>
    HTML;
    include "views/master.php";