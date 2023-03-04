<?php
     require 'configs/include/auth.php';
?>
<?php
    require APP_ROOT.'\configs\include\headerAdmin_global.php';
?>


<main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viếtviết</h3>
                <form action="index.php?controller=article&action=processEdit" method="post" enctype="multipart/form-data">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Mã bài viết</span>
                        <input type="text" class="form-control" name="ma_bviet" readonly value="<?= $detailArticle->getMaBaiViet() ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Tiêu đề</span>
                        <input type="text" class="form-control" name="tieude" value="<?= $detailArticle->getTieude() ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Tên bài hát</span>
                        <input type="text" class="form-control" name="ten_bhat" value="<?= $detailArticle->getTenBaiHat() ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Thể loại</span>
                        <select  name = "the_loai">
                            <option value="<?=$nameCategory->getma_tloai()?>" ><?=$nameCategory->getten_tloai()?></option>
                            <?php
                                foreach($nameCategoryExcept as $category) {  ?>
                                <option value="<?=$category->getma_tloai()?>" ><?=$category->getten_tloai()?></option>
                            <?php    }
                            ?>
                            
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Tóm tắt</span>
                        <textarea type="text" class="form-control" name="tomtat" > <?= $detailArticle->getTomTat() ?></textarea>
                        
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Nội dung</span>
                        <textarea type="text" class="form-control" name="noidung"> <?= $detailArticle->getNoiDung() ?></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Tác giả</span>
                        <select  name = "tac_gia">
                            <option value="<?=$nameAuthor->getMaTacGia()?>" ><?=$nameAuthor->getTenTacGia()?></option>
                            <?php
                                foreach($nameAuthorExcept as $author) {  ?>
                                <option value="<?=$author->getMaTacGia()?>" ><?=$author->getTenTacGia()?></option>
                            <?php    }
                            ?>
                            
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Đường dẫn ảnh cũ</span>
                        <input type="text" class="form-control"  value="<?= $detailArticle->getHinhAnh() ?>">
                        
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" >Hình ảnh</span>
                        <input type="file" class="form-control" id="article_image" name="hinhanh" accept="image/png, image/jpeg">
                    </div>

                    
                    

                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="index.php?controller=article&action=list" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
        
</main>
<?php
    require 'configs\include\footerAdmin_global.php';
?>