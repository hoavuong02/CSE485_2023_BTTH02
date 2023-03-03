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
            
        }

        public function deleteCategorySql(){
            
            // $getId =  $_GET['id'];
            // return $nameCategory;
            
            $dbConn = new DBConnection();
            $conn = $dbConn->getConnection();

            // $delCategorySql = "DELETE FROM theloai WHERE ma_tloai = $getId";
            // $stmt = $conn->prepare($delCategorySql);
            // $stmt->execute();

            $sql2 = "SELECT * FROM theloai";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute();

            $found = false;
            $categorys1 = [];
            while ($row = $stmt2->fetch()) {
                $category = new Category($row['ma_tloai'], $row['ten_tloai']);
                array_push($categorys1,$category); //add category vào mảng
            }

            // print_r($categorys1);

            foreach($categorys1 as $value){
                // print_r($value->getten_tloai());
            }

        }


        
    }

?>