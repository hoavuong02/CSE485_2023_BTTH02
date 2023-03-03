<?php
include("services/UserService.php");
class UserController{
    public function index(){
        $userService = new UserService();
        $users = $userService-> getAllUser();
        include("views/user/user.php");
    }


    // public function showAllUser(){
    //     $userService = new UserService();
    //     $user = $userService-> getAllUser();
        
    //     include("views/user/user.php");
    // }
    public function Add(){
       include("views/user/add_user.php");
    }

    public function processAdd(){
        $userService = new UserService();
        $processAdd = $userService-> processAddUser();
       // include("views/user/add_user.php");
    }

    public function edit(){
        $userService = new UserService();
        $userWithId = $userService->selectEditUser();
        include("views/user/edit_user.php");
    }

    public function processEdit(){
        $userService = new UserService();
        $processEdit = $userService-> processEditUser();
        
    }

    public function delete(){
        $userService = new UserService();
        $userDelete = $userService-> deleteUser();
        //include("views/user/user.php");
        
    }
}
?>