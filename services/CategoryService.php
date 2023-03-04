<?php
  require 'configs/DBConnection.php';
  include("models/Category.php");
  include("models/Article.php");
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

        //add
        public function addCategorySql(){
            
            $nameCategory= $_POST['txtCatName'];
            // return $nameCategory;
            
            $dbConn = new DBConnection();
            $conn = $dbConn->getConnection();

            $addnameCategorySql = "INSERT INTO theloai(ten_tloai) VALUES ('$nameCategory')";
            $stmt = $conn->prepare($addnameCategorySql);
            $stmt->execute();
            
        }

        //delete
        public function deleteCategorySql(){
            
            $getId =  $_GET['id'];
            // return $nameCategory;
            
            $dbConn = new DBConnection();
            $conn = $dbConn->getConnection();

            $delCategorySql = "DELETE FROM theloai WHERE ma_tloai = $getId";
            $stmt = $conn->prepare($delCategorySql);
            // $stmt->execute();

            $sql2 = "SELECT * FROM baiviet";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute();

            $found = false;
            $articles = [];
            while ($row = $stmt2->fetch()) {
                $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ma_tloai'], $row['ma_tgia']);
                array_push($articles,$article); //add category vào mảng
            }

            // print_r($categorys1);

            foreach($articles as $value){
                if($value->getMaTheLoai() == $getId){
                    $found = true;
                    break;
                 
                }  
               
                // echo $value->getMaBaiViet();
            }

            if($found){

                        $deleteArticle = "DELETE FROM baiviet WHERE ma_tloai = $getId";

                        $deleteCategorySql = "DELETE FROM theloai WHERE ma_tloai = $getId";
                        $stmt3 = $conn->prepare($deleteArticle);
                        $stmt3->execute();
                        $stmt4 = $conn->prepare($deleteCategorySql);
                        $stmt4->execute();
                        header("Location: index.php?controller=category&success=Xóa Thành Công!");
            }
            else{
                $stmt->execute();
                header("Location: index.php?controller=category&success=Xóa Thành Công!");
            }

        } //ngoặc của deleteCategorySql

    //edit

    public function editCategorySql(){
        
        
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $getId =  $_GET['id'];

        // Bước 02: Truy vấn DL
        $showAllCategorySql = "SELECT * FROM theloai WHERE ma_tloai = $getId";
        $stmt = $conn->prepare($showAllCategorySql);
        $stmt->execute();
        
        // $categorys = [];
        // Bước 03: Trả về dữ liệu
        $row = $stmt->fetch();
        $category = new Category($row['ma_tloai'], $row['ten_tloai']);
        // array_push($categorys,$category); //add category vào mảng
    
        return $category;
    }

    public function  processEditCategory(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $nameCategory = $_POST['txtCatName'];
        $idCategory = $_POST['txtCatId'];
        $updateCategorySql = "UPDATE theloai SET ten_tloai = '$nameCategory' WHERE ma_tloai =  $idCategory";
        $stmt = $conn->prepare($updateCategorySql);
        $stmt->execute();
    }

     }// ngoặc của class
?>