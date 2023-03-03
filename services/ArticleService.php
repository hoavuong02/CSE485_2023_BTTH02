<?php
define('APP_ROOT', dirname(__FILE__, 2));  
include("configs/DBConnection.php");
include("models/Article.php");
class ArticleService{
    public function getAllArticles(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM baiviet INNER JOIN theloai ON theloai.ma_tloai=baiviet.ma_tloai INNER JOIN tacgia ON tacgia.ma_tgia=baiviet.ma_tgia";
        $stmt = $conn->query($sql);

        $articles = [];
        while($row = $stmt->fetch()){
            $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ten_tloai'], $row['ten_tgia']);
            array_push($articles,$article);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $articles;
    }

    public function getDetailArticle(){
        $id = $_GET['id'];

       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM baiviet INNER JOIN theloai ON theloai.ma_tloai=baiviet.ma_tloai INNER JOIN tacgia ON tacgia.ma_tgia=baiviet.ma_tgia WHERE baiviet.ma_bviet = $id";
        $stmt = $conn->query($sql);
        $row = $stmt->fetch();
        $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ten_tloai'], $row['ten_tgia']);

        return $article;
    }

    public function getSearchedArticles(){
        $infoSearch= $_POST['search'];

       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();
        // B2. Truy vấn
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
            $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['tomtat'], $row['noidung'], $row['hinhanh'], $row['ten_tloai'], $row['ten_tgia']);
            array_push($articles,$article);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $articles;
    }

    public function addArticle($tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_thloai, $ma_tgia){
        
        $upload_path   = APP_ROOT.'/assets/images/songs/';

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
            $moved       = move_uploaded_file($_FILES['hinhanh']['tmp_name'], $destination);
        
        }


        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "INSERT INTO `baiviet` (`ma_bviet`, `tieude`, `ten_bhat`, `ma_tloai`, `tomtat`, `noidung`, `ma_tgia`, `ngayviet`, `hinhanh`)
           VALUES (NULL, '$tieude', '$ten_bhat', '$ma_tloai', '$tomtat', '$noidung', '$ma_tgia', current_timestamp(), '$destination')";
        $stmt = $dbConn->getConnect()->prepare($sql);
        $stmt->execute();
        
    }
}