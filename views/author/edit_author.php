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
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin Tác Giả</h3>
                <form action="index.php?controller=author&&action=edit" method="post" enctype="multipart/form-data"> <!--gửi dữ liệu đến update_category.php -->
                <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Mã Tác Giả</span>
                        <input type="text" class="form-control" name="txtAuthId" readonly value="<?=$editAuthorId->getMaTacGia(); ?>" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthName">Tên Tác Giả</span>
                        <input type="text" class="form-control" name="txtAuthName" value =  "<?= $editAuthorId->getTenTacGia();?>" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthName">Đường dẫn cũ</span>
                        <input type="text" class="form-control filetg" name="txtAuthFileOld" readonly value = "<?= $editAuthorId->getHinhTacGia(); ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthName">Hình Tác Giả</span>
                        <input style = "margin-left: 10px;" type="file" class="form-control filetg" name="txtAuthFile">
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="index.php?controller=author" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
        
    </main>
<?php
     require 'configs/include/footerAdmin_global.php';
?>