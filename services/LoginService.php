<?php
    require "configs/DBConnection.php";
    class LoginService{
        // Chứa các hàm tương tác và xử lý dữ liệu

        public function processLogin(){
            // Bước 01: Kết nối DB Server
            //require db
            $conn = new DBConnection();
            // Bước 02: Truy vấn DL
            if(isset($_POST['txtUser'])) 
            {
                $user = $_POST['txtUser'];
                $password = $_POST['txtPassword'];
                
                //tìm trong db bản ghi có tên đăng nhập và mật khẩu giống với người dùng nhập vào
                $getUserPassword = "SELECT ten_dnhap, mat_khau FROM `user` WHERE ten_dnhap = '$user ' AND mat_khau = '$password'";

                $stmt = $conn->getConnection()->prepare($showAllUserSql);
                $stmt->execute();
                $checkUser = $stmt->fetchAll();
                //không tìm thấy bản ghi trùng khớp --> sai tên dnh hoặc mk
                if(!$checkUser){
                    header("Location: login.php?error=invalid user or password");
                }
                else {
                    $_SESSION['user'] = $user;
                    header('Location: admin/index.php');
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

      
    }

?>