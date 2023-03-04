<?php
  define('APP_ROOT', dirname(__FILE__, 2));  // lấy đc D:\Box_Code\CodeCNWeb_php\CaidatXampp\htdocs\CSE485_2023_BTTH02\CSE485_2023_BTTH02
  require 'configs/DBConnection.php';
   include("models/Author.php");
  include("models/Article.php");
class AuthorService{
    
    public function getAllAuthor(){
        // Bước 01: Kết nối DB Server
        // try {
        //     $conn = new PDO('mysql:host=localhost;dbname=btth01_cse485;port=3306','root','');
        // } catch (PDOException $e) {
        //     echo $e->getMessage();
        // }

        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        // Bước 02: Truy vấn DL
        $showAllAuthorSql = "SELECT * FROM tacgia order by ma_tgia";
        $stmt = $conn->prepare($showAllAuthorSql);
        $stmt->execute();
        
        $authors = [];
        // Bước 03: Trả về dữ liệu
        while($row = $stmt->fetch()){
            $author = new Author($row['ma_tgia'], $row['ten_tgia'],$row['hinh_tgia']);
            array_push($authors,$author); //add author vào mảng
        }

        return $authors;
    }

     //------------------add
     public function addAuthorSql(){

        $upload_path   = APP_ROOT.'/assets/images/authors/';

        $path_db_uncompleted = 'images/authors/';
        
        function create_filename($filename, $upload_path)              // Function to make filename
        {
            $basename   = pathinfo($filename, PATHINFO_FILENAME);      // Get basename
            $extension  = pathinfo($filename, PATHINFO_EXTENSION);     // Get extension
            $basename   = preg_replace('/[^A-z0-9]/', '-', $basename); // Clean basename
            $filename   = $basename . '.' . $extension;                // Add extension to clean basename
            $i          = 0;                                           // Counter
            while (file_exists($upload_path . $filename)) {            // If file exists
                $i        = $i + 1;                                    // Update counter 
                $filename = $basename . $i . '.' . $extension;         // New filepath
            }
            return $filename;                                          // Return filename
        }
        
        if ($_FILES['txtAuthFile']['error'] == 0) {                          // If no upload errors
          // If there are no errors create the new filepath and try to move the file
            $filename    = create_filename($_FILES['txtAuthFile']['name'], $upload_path);
        
            $destination = $upload_path . $filename;
            $moved       = move_uploaded_file($_FILES['txtAuthFile']['tmp_name'], $destination);
            $path_db_completed = $path_db_uncompleted . $filename;
          
        }

        
        $nameAuthor = $_POST['txtAuthName'];

        $addInfoAuthorSql = "INSERT INTO tacgia(ten_tgia,hinh_tgia) VALUES ('$nameAuthor','$path_db_completed')";

        
        
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $stmt = $conn->prepare($addInfoAuthorSql);
        $stmt->execute();
        
    }

     //--------------delete
     public function deleteAuthorSql(){
            
        $getId =  $_GET['id'];
        
        
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        //phục vụ việc xóa ảnh trong folder

        $upload_path1 = 'assets/';
        $sqlgetlinkImg  = "SELECT hinh_tgia FROM tacgia WHERE ma_tgia = $getId "; 
        $resultlinkImg =  $conn->prepare($sqlgetlinkImg);
        $resultlinkImg->execute();
        $row = $resultlinkImg -> fetch();
        $pathImg = $upload_path1.$row['hinh_tgia'];

        
        $sqlgetlinkImg2  = "SELECT hinhanh FROM baiviet WHERE ma_tgia = $getId "; 
        $resultlinkImg2 =  $conn->prepare($sqlgetlinkImg2);
        $resultlinkImg2->execute();
        
        //.........................
        
        $delAuthorSql = "DELETE FROM tacgia WHERE ma_tgia = $getId";
        $stmt = $conn->prepare($delAuthorSql);
        // $stmt->execute();

        $sql2 = "SELECT * FROM baiviet";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();

        $found = false;
        $articles = [];
        while ($row = $stmt2->fetch()) {
            $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ma_tloai'], $row['ma_tgia']);
            array_push($articles,$article); 
        }

        

        foreach($articles as $value){
            if($value->getMaTacGia() == $getId){
                $found = true;
                break;
             
            }  
           
            // echo $value->getMaBaiViet();
        }

        if($found){

                    $deleteArticle = "DELETE FROM baiviet WHERE ma_tgia = $getId";

                    $deleteAuthorSql = "DELETE FROM tacgia WHERE ma_tgia = $getId";
                    $stmt3 = $conn->prepare($deleteArticle);
                    $stmt3->execute();
                    $stmt4 = $conn->prepare($deleteAuthorSql);
                    $stmt4->execute();

                    if (file_exists($pathImg)) {                       // If image file exists
                        $unlink = unlink($pathImg);                    // Delete image file
                        
                    }
                    //xóa ảnh trong folder baiviet
                    while($row = $resultlinkImg2 -> fetch()){

                        $pathImg2 = $upload_path1.$row['hinhanh'];
                        while(file_exists($pathImg2)){{
                            $unlink2 = unlink($pathImg2);  
                        }}
                    }

                    header("Location: index.php?controller=author&success=Xóa Thành Công!");
        }
        else{
            $stmt->execute();
            if (file_exists($pathImg)) {                       // If image file exists
                $unlink = unlink($pathImg);                    // Delete image file
            }   
            header("Location: index.php?controller=author&success=Xóa Thành Công!");

        }

    } //ngoặc của deleteAuthorSql


    //--------------edit

    public function editAuthorSql(){
        
        
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $getId =  $_GET['id'];

        // Bước 02: Truy vấn DL
        $showAllAuthorSql = "SELECT * FROM tacgia WHERE ma_tgia = $getId";
        $stmt = $conn->prepare($showAllAuthorSql);
        $stmt->execute();
        
        // $categorys = [];
        // Bước 03: Trả về dữ liệu
        $row = $stmt->fetch();
        $author = new Author($row['ma_tgia'], $row['ten_tgia'],$row['hinh_tgia']);
        // array_push($categorys,$category); //add category vào mảng
    
        return $author;
    }

    public function  processEditAuthor(){


        $upload_path   = APP_ROOT.'/assets/images/authors/';

        $path_db_uncompleted = 'images/authors/';
        
        function create_filename($filename, $upload_path)              // Function to make filename
        {
            $basename   = pathinfo($filename, PATHINFO_FILENAME);      // Get basename
            $extension  = pathinfo($filename, PATHINFO_EXTENSION);     // Get extension
            $basename   = preg_replace('/[^A-z0-9]/', '-', $basename); // Clean basename
            $filename   = $basename . '.' . $extension;                // Add extension to clean basename
            $i          = 0;                                           // Counter
            while (file_exists($upload_path . $filename)) {            // If file exists
                $i        = $i + 1;                                    // Update counter 
                $filename = $basename . $i . '.' . $extension;         // New filepath
            }
            return $filename;                                          // Return filename
        }
        
        if ($_FILES['txtAuthFile']['error'] == 0) {                          // If no upload errors
          // If there are no errors create the new filepath and try to move the file
            $filename    = create_filename($_FILES['txtAuthFile']['name'], $upload_path);
        
            $destination = $upload_path . $filename;
            $moved       = move_uploaded_file($_FILES['txtAuthFile']['tmp_name'], $destination);
            $path_db_completed = $path_db_uncompleted . $filename;
          
        }


        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

       $idAuth = $_POST['txtAuthId'];
       $nameAuthor = $_POST['txtAuthName'];
       $updateAuthSql = "UPDATE tacgia SET ten_tgia = '$nameAuthor',hinh_tgia = '$path_db_completed' WHERE ma_tgia = $idAuth ";

        $stmt = $conn->prepare($updateAuthSql);
        $stmt->execute();

        //xóa ảnh cũ khi sửa
        $upload_path1 = 'assets/';
        $linkOld = $_POST['txtAuthFileOld'];
        $pathImg = $upload_path1.$linkOld;
        if (file_exists($pathImg)) {                       // If image file exists
            $unlink = unlink($pathImg);                    // Delete image file
        }   
    }




}

?>