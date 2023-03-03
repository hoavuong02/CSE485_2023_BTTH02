<?php
    define('APP_ROOT', dirname(__FILE__, 3));  
    require APP_ROOT.'\configs\include\header_global.php';
?>

        <img src="C:\xampp\htdocs\CSE485_2023_BTTH02\assets\images\slideshow\slide01.jpg" alt="" srcset="">
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <?php   
                    for($i =1; $i<=3; $i++) {
                ?>
                    <div class="carousel-item active">
                    <img src="<?php echo "assets\images\slideshow\slide0$i.jpg" ?>" class="d-block w-100" alt="...">

                    </div>
                    <?php
                }
                ?>
                
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <!-- </header> -->
    <main class="container-fluid mt-3">
        
        <div>
            <h3 style = "font-family : var(--fontfamily-primary) " class="text-center text-uppercase mb-3 text-primary">TOP bài hát yêu thích</h3>
            <div class="row">
                <?php
                    foreach($articles as $article) {

                    
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