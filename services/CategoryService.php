<?php
  require 'configs/DBConnection.php';
  include("models/Category.php");
class CategoryService{
        // Chứa các hàm tương tác và xử lý dữ liệu

        public function getAllCategory(){
            // Bước 01: Kết nối DB Server
            // try {
            //     $conn = new PDO('mysql:host=localhost;dbname=btth01_cse485;port=3306','root','');
            // } catch (PDOException $e) {
            //     echo $e->getMessage();
            // }

            $dbConn = new DBConnection();
            $conn = $dbConn->getConnection();

            // Bước 02: Truy vấn DL
            $showAllCategorySql = "SELECT * FROM theloai order by ma_tloai";
            $stmt = $conn->prepare($showAllCategorySql);
            $stmt->execute();
            
            $categorys = [];
            // Bước 03: Trả về dữ liệu
            while($row = $stmt->fetch()){
                $category = new Category($row['ma_tloai'], $row['ten_tloai']);
                array_push($categorys,$category); //add category vào mảng
            }

            return $categorys;
        }


        public function addCategorySql(){
            
            $nameCategory= $_POST['txtCatName'];
            // return $nameCategory;
            
            $dbConn = new DBConnection();
            $conn = $dbConn->getConnection();

            $addnameCategorySql = "INSERT INTO theloai(ten_tloai) VALUES ('$nameCategory')";
            $stmt = $conn->prepare($addnameCategorySql);
            $stmt->execute();

            
                // header("Location: index.php?controller=category");
            
        }

        
    }

?>