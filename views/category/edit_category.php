<?php
     require 'configs/include/auth.php';
?>
<?php
      require 'configs/include/headerAdmin_global.php';
?>

    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin thể loại</h3>
                <form action="index.php?controller=category&&action=edit" method="post"> <!--gửi dữ liệu đến update_category.php -->
                <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Mã thể loại</span>
                        <input type="text" class="form-control" name="txtCatId" readonly value="<?= $editCategoryId->getma_tloai(); ?>" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text" class="form-control" name="txtCatName"  value = "<?= $editCategoryId->getten_tloai(); ?>">
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="index.php?controller=category" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
        
    </main>
<?php
     require 'configs/include/footerAdmin_global.php';
?>