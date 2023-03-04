<?php
     require 'configs/include/auth.php';
?>
<?php
    require 'configs/include/headerAdmin_global.php';
?>
<?php
   


?>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                
            
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin người dùng</h3>
                <form action="index.php?controller=user&action=processEdit" method="post" enctype="multipart/form-data"> <!--gửi dữ liệu đến update_category.php -->
                
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Tên đăng nhập</span>
                        <input type="text" class="form-control" name="txtUserName" readonly value="<?=$userWithId->getTenDangNhap(); ?>" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthName">Mật khẩu</span>
                        <input type="text" class="form-control" name="txtPasword" value =  "<?= $userWithId->getMatKhau(); ?>" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthName">Email đăng ký</span>
                        <input type="text" class="form-control filetg" name="txtEmail" value = "<?= $userWithId->getEmail(); ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthName">Là admin</span>
                        <input type="text" class="form-control filetg" name="txtAdmin" value = "<?= $userWithId->getAdmin(); ?>">
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="index.php?controller=user&action=index" class="btn btn-warning ">Quay lại</a>
                    </div>
               
                </form>

            </div>
        </div>
        
    </main>
<?php
     require 'configs/include/footerAdmin_global.php';
?>