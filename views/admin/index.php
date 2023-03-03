<?php
    session_start();
    if(!isset($_SESSION["user"])){
    header("Location: ../login.php");
    exit(); }
    require '..\configs\include\DBConnection.php';
    $userName = $_SESSION['user'];
    $sql = "SELECT admin FROM `user` WHERE ten_dnhap='$userName'";
    $result = mysqli_query($conn, $sql);        
    $isAdmin =0;
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $isAdmin = $row['admin'];
    }


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<style>
    body {
    display: flex;
    flex-direction: column;
    height: 100vh; /* Set height to 100% of viewport height */
    
  }
    main{
        flex: 1; /*Để lúc nào footer cũng nằm phía dưới*/
    }

</style>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/Category/category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/Author/author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/Article/article.php">Bài viết</a>
                    </li>
                    
                </ul>
                </div>
                <div>
                <button type="button" class="btn btn-primary">
                    <a class="nav-link" href="../logout.php">Đăng xuất</a>

                </button>
                    
                </div>
            </div>
        </nav>

    </header>
    
    
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <?php
            if($isAdmin !=1){  ?>
                <div class="alert alert-warning">
                    <strong>Cảnh báo!</strong> Chỉ có admin mới có thể truy cập vào mục <strong>Người dùng</strong>.
                </div>
        <?php    }
        ?>
        <div class="row">
            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <?php 
                                if($isAdmin ==1){
                                    echo "<a href='../admin/User/user.php' class='text-decoration-none'>Người dùng</a>";
                                } else {
                                    echo "<a href='#' class='text-decoration-none'>Người dùng</a>";
                                }

                            ?>
                        </h5>

                        <h5 class="h1 text-center">
                            <?php
                                $sql = "SELECT COUNT(user.ten_dnhap) FROM `user` ";
                                $result = mysqli_query($conn, $sql);        
                                if(mysqli_num_rows($result) > 0){
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['COUNT(user.ten_dnhap)'];
                                }
                            ?>
                        
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="../admin/Category/category.php" class="text-decoration-none">Thể loại</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
                                $sql = "SELECT COUNT(theloai.ma_tloai) FROM theloai;";
                                $result = mysqli_query($conn, $sql);        
                                if(mysqli_num_rows($result) > 0){
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['COUNT(theloai.ma_tloai)'];
                                }
                            ?>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="../admin/Author/author.php" class="text-decoration-none">Tác giả</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
                                $sql = "SELECT COUNT(tacgia.ma_tgia) FROM tacgia;";
                                $result = mysqli_query($conn, $sql);        
                                if(mysqli_num_rows($result) > 0){
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['COUNT(tacgia.ma_tgia)'];
                                }
                            ?>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="../admin/Article/article.php" class="text-decoration-none">Bài viết</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
                                $sql = "SELECT COUNT(baiviet.ma_bviet) FROM baiviet; ";
                                $result = mysqli_query($conn, $sql);        
                                if(mysqli_num_rows($result) > 0){
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['COUNT(baiviet.ma_bviet)'];
                                }
                            ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
     require '../include/footerAdmin_global.php';
?>