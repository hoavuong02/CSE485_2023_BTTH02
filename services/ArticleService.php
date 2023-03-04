<?php
define('APP_ROOT', dirname(__FILE__, 2));  
include("configs/DBConnection.php");
include("models/Article.php");
include("models/Category.php");
include("models/Author.php");
class ArticleService{

    public function getAllArticles(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT * FROM baiviet INNER JOIN theloai ON theloai.ma_tloai=baiviet.ma_tloai INNER JOIN tacgia ON tacgia.ma_tgia=baiviet.ma_tgia";
        $stmt = $conn->query($sql);

        $articles = [];
        while($row = $stmt->fetch()){
            $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ma_tloai'], $row['ma_tgia']);
            array_push($articles,$article);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $articles;
    }

    public function getDetailArticle(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $id = $_GET['id'];
        // B2. Truy vấn
        $sql = "SELECT * FROM baiviet INNER JOIN theloai ON theloai.ma_tloai=baiviet.ma_tloai INNER JOIN tacgia ON tacgia.ma_tgia=baiviet.ma_tgia WHERE baiviet.ma_bviet = $id";
        $stmt = $conn->query($sql);
        $row = $stmt->fetch();
        $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ma_tloai'], $row['ma_tgia']);

        return $article;
    }

    public function getCategorybyArticle($id){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        // B2. Truy vấn
        $sql = "SELECT * FROM theloai  WHERE ma_tloai = $id";
        $stmt = $conn->query($sql);
        $row = $stmt->fetch();
        $category = new Category($row['ma_tloai'], $row['ten_tloai']);

        return $category;
    }

    public function getALLCategoryExcept($id){

        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql = "SELECT * FROM theloai  WHERE ma_tloai != $id";
        $stmt = $conn->query($sql);

        $categorys = [];
        while($row = $stmt->fetch()){
            $category = new Category($row['ma_tloai'], $row['ten_tloai']);
            array_push($categorys,$category);
        }
        return $categorys;
    }

    public function getAuthorbyArticle($id){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        // B2. Truy vấn
        $sql = "SELECT * FROM tacgia  WHERE ma_tgia = $id";
        $stmt = $conn->query($sql);
        $row = $stmt->fetch();
        $author = new Author($row['ma_tgia'], $row['ten_tgia'] , $row['hinh_tgia']);

        return $author;
    }

    public function getALLAuthorExcept($id){

        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $sql = "SELECT * FROM tacgia  WHERE ma_tgia != $id";
        $stmt = $conn->query($sql);

        $authors = [];
        while($row = $stmt->fetch()){
            $author = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
            array_push($authors,$author);
        }
        return $authors;
    }

    public function getSearchedArticles(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
        $infoSearch= $_POST['search'];
        $sql = "SELECT * FROM baiviet 
        INNER JOIN theloai on theloai.ma_tloai = baiviet.ma_tloai
        INNER JOIN tacgia on tacgia.ma_tgia = baiviet.ma_tgia 
        WHERE tieude Like '%$infoSearch%' 
        OR ten_bhat Like '%$infoSearch%'  
        OR ten_tgia Like '%$infoSearch%' 
        OR ten_tloai Like '%$infoSearch%' 
        ORDER BY ma_bviet DESC";
        $stmt = $conn->query($sql);

        $articles = [];
        while($row = $stmt->fetch()){
            $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ma_tloai'], $row['ma_tgia']);
            array_push($articles,$article);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $articles;
    }

    public function getListArticles(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT * FROM baiviet INNER JOIN theloai ON theloai.ma_tloai=baiviet.ma_tloai INNER JOIN tacgia ON tacgia.ma_tgia=baiviet.ma_tgia ORDER BY ma_bviet";
        $stmt = $conn->query($sql);

        $articles = [];
        while($row = $stmt->fetch()){
            //ma_tgia = ten_tgia;  ma_tloai = ten_tloai
            $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ten_tloai'], $row['ten_tgia']);
            array_push($articles,$article);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $articles;
    }

    public function addArticle(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $tieude = $_POST['tieude'];
        $ten_bhat = $_POST['ten_bhat'];
        $ma_tloai = $_POST['the_loai'];
        $tomtat = $_POST['tomtat'];
        $noidung = $_POST['noidung'];
        $ma_tgia = $_POST['tac_gia'];
        
        $upload_path   = APP_ROOT.'/assets/images/songs/';
        $db_path_uncompleted = '/images/songs/';
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

        if ($_FILES['hinhanh']['error'] == 0) {                          // If no upload errors
        // If there are no errors create the new filepath and try to move the file
            $filename    = create_filename($_FILES['hinhanh']['name'], $upload_path);

            $destination = $upload_path . $filename;
            $db_path_completed =  $db_path_uncompleted . $filename;
            $moved       = move_uploaded_file($_FILES['hinhanh']['tmp_name'], $destination);
        
        }


        $addArticleSql = "INSERT INTO `baiviet` (`ma_bviet`, `tieude`, `ten_bhat`, `ma_tloai`, `tomtat`, `noidung`, `ma_tgia`, `ngayviet`, `hinhanh`)
           VALUES (NULL, '$tieude', '$ten_bhat', '$ma_tloai', '$tomtat', '$noidung', '$ma_tgia', current_timestamp(), '$db_path_completed')";
        $stmt = $conn->prepare($addArticleSql);
        $stmt->execute();
        if($stmt->execute()){
            header("Location: index.php?controller=article&action=list");
        }
    }

    public function processEditArticle(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $ma_bviet = $_POST['ma_bviet'];
        $tieude = $_POST['tieude'];
        $ten_bhat = $_POST['ten_bhat'];
        $ma_tloai = $_POST['the_loai'];
        $tomtat = $_POST['tomtat'];     
        $noidung = $_POST['noidung']; 
        $ma_tgia = $_POST['tac_gia'];  


        $upload_path   = APP_ROOT.'/assets/images/songs/';
        $db_path_uncompleted = '/images/songs/';
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

        if ($_FILES['hinhanh']['error'] == 0) {                          // If no upload errors
        // If there are no errors create the new filepath and try to move the file
            $filename    = create_filename($_FILES['hinhanh']['name'], $upload_path);

            $destination = $upload_path . $filename;
            $db_path_completed =  $db_path_uncompleted . $filename;
            $moved       = move_uploaded_file($_FILES['hinhanh']['tmp_name'], $destination);
        
        }

        //xoa anh trong folder
        $upload_path1 = 'assets/';
        $sqlgetlinkImg  = "SELECT hinhanh FROM baiviet WHERE ma_bviet = $ma_bviet "; 
        $resultlinkImg =  $conn->prepare($sqlgetlinkImg);
        $resultlinkImg->execute();
        $row = $resultlinkImg -> fetch();
        $pathImg = $upload_path1.$row['hinhanh'];

 
        //end


        
        
        $updateArticleSql = "UPDATE baiviet SET tieude = '$tieude', ten_bhat = '$ten_bhat', ma_tloai = '$ma_tloai', tomtat = '$tomtat', noidung = '$noidung'
        , ma_tgia = '$ma_tgia', ngayviet = current_timestamp(), hinhanh = '$db_path_completed'
        where ma_bviet = '$ma_bviet'" ;

        $stmt = $conn->prepare($updateArticleSql);
        if (file_exists($pathImg)) {                       // If image file exists
            $unlink = unlink($pathImg);                    // Delete image file
        }
        $stmt->execute();
        if($stmt->execute()){
            header("Location: index.php?controller=article&action=list");
        }
     }

     public function deleteArticle(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $getId = $_GET['id'];
        //xoa anh trong folder

        $upload_path1 = 'assets/';
        $sqlgetlinkImg  = "SELECT hinhanh FROM baiviet WHERE ma_bviet = $getId "; 
        $resultlinkImg =  $conn->prepare($sqlgetlinkImg);
        $resultlinkImg->execute();
        $row = $resultlinkImg -> fetch();
        $pathImg = $upload_path1.$row['hinhanh'];

        //end

        
        $deleteArticleSql = "DELETE FROM baiviet WHERE ma_bviet = '$getId'  ";
        $stmt = $conn->prepare( $deleteArticleSql);
        $stmt->execute();

        if (file_exists($pathImg)) {                       // If image file exists
            $unlink = unlink($pathImg);                    // Delete image file
        }
        // Bước 03: Trả về dữ liệu
        if($stmt->execute()){
            header("Location: index.php?controller=article&action=list");
        }
        
    }

    public function getAllCategory(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT * FROM theloai";
        $stmt = $conn->query($sql);

        $categorys = [];
        while($row = $stmt->fetch()){
            $category = new Category($row['ma_tloai'], $row['ten_tloai']);
            array_push($categorys, $category);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $categorys;
    }

    public function getAllAuthor(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT * FROM tacgia";
        $stmt = $conn->query($sql);

        $authors = [];
        while($row = $stmt->fetch()){
            $author = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
            array_push($authors, $author);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $authors;
    }
}