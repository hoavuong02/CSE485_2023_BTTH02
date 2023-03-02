<?php
    //require '../../auth.php';
    require 'configs/include/headerAdmin_global.php';
?>

<main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới thể loại</h3>
                <form action="process_add_user.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lbUserName">Tên Đăng Nhập</span>
                        <input type="text" class="form-control" name="txtUserName" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUserPass">Mật Khẩu</span>
                        <input type="password" class="form-control" name="txtUserPass" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUserEmail">Email</span>
                        <input type="email" class="form-control" name="txtUserEmail" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUserEmail">Admin</span>
                        <input type="text" class="form-control" name="txtUserAdmin" >
                    </div>
            
                    <div class="form-group  float-end ">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="index.php?controller=user&action=showAllUser" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php
     require 'configs/include/footerAdmin_global.php';
?>