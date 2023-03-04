<?php
    include("services/UserService.php");
    define('APP_ROOT', dirname(__FILE__, 2));  
    class AdminController{
        public function index(){
            $userService = new UserService();
            $checkAdmin = $userService-> userIsAdmin();
            $userCount = $userService->countUser();
            $articleCount = $userService->countArticle();
            $authorCount = $userService->countAuthor();
            $categoryCount = $userService->countCategory();
           
            // if( $checkAdmin->isAdmin()==1){
            //     echo 'TRue';
            // }
            include("views/admin/index.php");
        }

        
    }
?>   