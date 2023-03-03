<?php
    define('APP_ROOT', dirname(__FILE__, 3));  
    require APP_ROOT.'\configs\include\header_global.php';
?>
    <!-- xử lý việc header che mất thông tin -->
    <div id="carouselExampleIndicators" class="carousel slide">
            
    </div>
    <!-- end -->
    <main class="container-fluid mt-3">
        
        <div>
            <h3 style = "font-family : var(--fontfamily-primary) " class="text-center text-uppercase mb-3 text-primary">TOP bài hát yêu thích</h3>
            <div class="row">
                <?php
                    foreach($searchedlArticle as $article) {

                    
                ?>
                        <div class="col-sm-3">
                            <div class="card mb-2" style="width: 100%;">
                                <img src="<?php echo "assets/". $article->getHinhAnh();?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="index.php?controller=article&action=detail&id=<?= $article->getMaBaiViet() ?>" class="text-decoration-none text-dark rgba-red-strong">
                                        <?php echo $article->getTieude();?>
                                    </a>
                                </div>
                            </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>    
    </main>
<?php
    require 'configs\include\footer_global.php';
?>