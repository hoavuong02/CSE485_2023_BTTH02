<?php
    require "configs/DBConnection.php";
    require "models/User.php";
    class UserService{
        // Chứa các hàm tương tác và xử lý dữ liệu

        public function getAllUser(){
            // Bước 01: Kết nối DB Server
            //require db
            $conn = new DBConnection();
            // Bước 02: Truy vấn DL
            $showAllUserSql = "SELECT * FROM user order by ten_dnhap";
            $stmt = $conn->getConnection()->prepare($showAllUserSql);
            $stmt->execute();
            $users = [];
            while($row = $stmt->fetch()){
                $user = new User($row['ten_dnhap'], $row['mat_khau'], $row['email'], $row['ngay_dki'], $row['admin']);
                array_push($users,$user);
            }
        
            
            return $users;
        }

        public function processAddUser(){
 
            $conn = new DBConnection();
            $txtUserName= $_POST['txtUserName'];
            $txtUserPass= $_POST['txtUserPass'];
            $txtUserEmail= $_POST['txtUserEmail'];
            $txtUserAdmin= $_POST['txtUserAdmin'];           
            $addUserSql = "INSERT INTO user(ten_dnhap,mat_khau,email,ngay_dki,admin) VALUES ('$txtUserName','$txtUserPass','$txtUserEmail',current_timestamp(), '$txtUserAdmin')";
            $stmt = $conn->getConnection()->prepare($addUserSql);
            if($stmt->execute()){
                header("Location: index.php?controller=user&action=index");
    
              echo "OK";
            }
         
         }

        public function selectEditUser(){
            // Bước 01: Kết nối DB Server
            //require db
            $conn = new DBConnection();
            // Bước 02: Truy vấn DL
            $getId = $_GET['id'];            
            $showUserWithId = "SELECT * FROM user WHERE ten_dnhap = '$getId'";
            
            $stmt = $conn->getConnection()->prepare($showUserWithId);
            $stmt->execute();
            $userWithId = $stmt->fetch();
            $user = new User($userWithId['ten_dnhap'], $userWithId['mat_khau'], $userWithId['email'], $userWithId['ngay_dki'], $userWithId['admin']);
            return $user;

        }

        public function processEditUser(){
 
            $conn = new DBConnection();
            $userName = $_POST['txtUserName'];
            $password = $_POST['txtPasword'];
            $email = $_POST['txtEmail'];
            $admin = $_POST['txtAdmin'];           
            $updateUserSql = "UPDATE user SET mat_khau = '$password', email = '$email', admin = '$admin' WHERE ten_dnhap =  '$userName'";
            $stmt = $conn->getConnection()->prepare($updateUserSql);
            $stmt->execute();
            if($stmt->execute()){
                header("Location: index.php?controller=user&action=index");
            }

            
            
         }

        public function deleteUser(){
            // Bước 01: Kết nối DB Server
            //require db
            $conn = new DBConnection();
            // Bước 02: Truy vấn DL
            $getId = $_GET['id'];
            $deleteCategorySql = "DELETE FROM user WHERE ten_dnhap = '$getId'  ";
            $stmt = $conn->getConnection()->prepare( $deleteCategorySql);
            $stmt->execute();
            // Bước 03: Trả về dữ liệu
            if($stmt->execute()){
                header("Location: index.php?controller=user&action=index");
            }
            
            
        }

        public function userLogin(){
            // Bước 01: Kết nối DB Server
            //require db
            $conn = new DBConnection();
            // Bước 02: Truy vấn DL
            session_start();
            if(isset($_POST['txtUser'])) 
            {
                $user = $_POST['txtUser'];
                $password = $_POST['txtPassword'];           
            //tìm trong db bản ghi có tên đăng nhập và mật khẩu giống với người dùng nhập vào
                $getUserPassword = "SELECT ten_dnhap, mat_khau FROM `user` WHERE ten_dnhap = '$user ' AND mat_khau = '$password'";
                $stmt = $conn->getConnection()->prepare( $getUserPassword);
                // Bước 03: Trả về dữ liệu               
                if($stmt->execute()){
                    $_SESSION['user'] = $user;
                    header("Location: index.php?controller=admin&action=index");
                }
                else {
                    header("Location: index.php?controller=login&action=index&error=invalid user or password");
                }
                if(!empty($_POST["remember"])) {
                    setcookie ("username",$user,time()+ 3600);
                    setcookie ("password",$password,time()+ 3600);
                } else {
                    setcookie("username","");
                    setcookie("password","");
                }
            }
            
        }
        public function userIsAdmin(){
            // Bước 01: Kết nối DB Server
            //require db
            $conn = new DBConnection();
            // Bước 02: Truy vấn DL
            session_start();
            $userName = $_SESSION['user'];
            $isAdminSql = "SELECT * FROM `user` WHERE ten_dnhap='$userName'";
            
            $stmt = $conn->getConnection()->prepare($isAdminSql);
            $stmt->execute();
            $userLogin = $stmt->fetch();
            $user = new User($userLogin['ten_dnhap'], $userLogin['mat_khau'], $userLogin['email'], $userLogin['ngay_dki'], $userLogin['admin']);
            return $user;
            // $isAdmin = $userLogin['admin'];
            // return $isAdmin;
        }

        public function countUser(){
            $conn = new DBConnection();           
            $countUserSql = "SELECT COUNT(user.ten_dnhap)  FROM `user` ";
            $stmt = $conn->getConnection()->prepare($countUserSql);
            $userCounted = $stmt->fetch();
            $stmt->execute();
            $userCounted = $stmt->fetchColumn();
            return $userCounted;
            
        }

        public function signUpUser(){
            $conn = new DBConnection();       
            if(isset($_POST['txtUser'])) 
            {
            $txtUserNameSU = $_POST['txtUser'];
            $txtUserPassSU = $_POST['txtPassword'];
            $txtEmailSU = $_POST['txtEmail'];                  
            $checkExitUserSql = "SELECT * FROM user";
            $stmt = $conn->getConnection()->prepare($checkExitUserSql);
            $row = $stmt->fetchAll();
            $stmt->execute();
            $foundName = false;
            $foundEmail = false;
            $users = [];
            while($row = $stmt->fetch()){
                $user = new User($row['ten_dnhap'], $row['mat_khau'], $row['email'], $row['ngay_dki'], $row['admin']);
                array_push($users,$user);
            }
                // if($row['ten_dnhap']==$txtUserNameSU){
                //     $foundName = true; // trùng lặp đánh dấu true
            //var_dump( $users);
                // }
            foreach($users as $value) {
                //echo $value->getTenDangNhap();
                if ($value->getTenDangNhap() == $txtUserNameSU ) {
                    $foundName = true; // trùng lặp đánh dấu true
                    break ; // thoát khỏi cả hai vòng lặp while và foreach
                }
                
                if ($value->getEmail() == $txtEmailSU ) {
                    $foundEmail = true; // trùng lặp đánh dấu true
                    break ; // thoát khỏi cả hai vòng lặp while và foreach
                }
                }
                echo $foundName;
                // foreach ($row['email'] as $key => $value) {
                //     // echo $row[$key];
                //     if ($value == $txtUserName ) {
                //         $found = true; // trùng lặp đánh dấu true
                //         break 2; // thoát khỏi cả hai vòng lặp while và foreach
                //     }
                // }
            
           

            if($foundName){                   
                echo "<script>
                    alert('Tên đăng nhập đã tồn tại');
                    window.location.href = 'index.php?controller=signUp&action=index';
                </script> " ;
            }              
            if ($foundEmail) { 
                echo "<script>
                    alert('Tên đăng nhập đã tồn tại');
                    window.location.href = 'index.php?controller=signU&action=index';
                </script> " ;
            }
            
            // else{
            //     $pushUserSql = "INSERT INTO user(ten_dnhap,mat_khau,email,ngay_dki) VALUES ('$txtUserNameSU','$txtUserPassSU','$txtEmailSU',current_timestamp())";
            //     $stmt = $conn->getConnection()->prepare($pushUserSql);
            //     if($stmt->execute()){
            //         header("Location: index.php?controller=login&action=index");
            //     }
                
            //     }
           
        }
        }
    }

?>
