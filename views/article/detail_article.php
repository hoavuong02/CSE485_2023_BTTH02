<?php
    define('APP_ROOT', dirname(__FILE__, 3));  
    require APP_ROOT.'\configs\include\header_global.php';
?>
<main class="container mt-5" style="margin-top:200px!important" >
        <div class="row mb-5">
            <div class="col-sm-4">
                <img src="<?php echo "assets/". $detailArticle->getHinhAnh();?>" class="img-fluid" alt="...">
            </div>
            <div class="col-sm-8">
                <h5 class="card-title mb-2">
                    <a href="" class="text-decoration-none"><?php echo $detailArticle->getTieude();?></a>
                </h5>
                <p class="card-text"><span class=" fw-bold">Bài hát: </span><?php echo $detailArticle->getTenBaiHat();?></p>
                <p class="card-text"><span class=" fw-bold">Thể loại: </span><?php echo "category->getTenTheLoai";?></p>
                <p class="card-text"><span class=" fw-bold">Tóm tắt: </span><?php echo $detailArticle->getTomTat();?></p>
                <p class="card-text"><span class=" fw-bold">Nội dung: </span><?php echo $detailArticle->getNoiDung();?></p>
                <p class="card-text"><span class=" fw-bold">Tác giả: </span><?php echo "Author->getTenTacGia";?></p>

            </div>          
        </div>
</main>

<?php
    require 'configs\include\footer_global.php';
?>