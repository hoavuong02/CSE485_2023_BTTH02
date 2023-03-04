<?php
    if(!isset($_SESSION["user"])){
        header("Location: index.php?controller=login&action=index");
        exit(); }
    $userName = $_SESSION['user']; 
?>
<?php require 'configs/include/headerAdmin_global.php'; ?>

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
    
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <?php
             if($checkAdmin->getAdmin()!=1){  ?>
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
                                if($checkAdmin->getAdmin() ==1){
                                    echo "<a href='index.php?controller=user&action=index' class='text-decoration-none'>Người dùng</a>";
                                } else {
                                    echo "<a href='#' class='text-decoration-none'>Người dùng</a>";
                                }

                            ?>
                        </h5>

                        <h5 class="h1 text-center">
                            <?php                                     
                                if($userCount > 0){                                
                                    echo $userCount;
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
                            <a href="index.php?controller=category&action=index" class="text-decoration-none">Thể loại</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
                                if($categoryCount > 0){                                
                                    echo $categoryCount;
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
                            <a href="index.php?controller=author&action=index" class="text-decoration-none">Tác giả</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
                                if($authorCount > 0){                                
                                    echo $authorCount;
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
                            <a href="index.php?controller=article&action=list" class="text-decoration-none">Bài viết</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
                                if($articleCount > 0){                                
                                    echo $articleCount;
                                }
                            ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
     require 'configs/include/footerAdmin_global.php';
?>