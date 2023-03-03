<?php
    include("services/UserService.php");

    class AdminController{
        public function index(){
            $userService = new UserService();
            $checkAdmin = $userService-> userIsAdmin();

            $userCount = $userService->countUser();
            // if( $checkAdmin->isAdmin()==1){
            //     echo 'TRue';
            // }
            include("views/admin/index.php");
        }

        
    }
?>   