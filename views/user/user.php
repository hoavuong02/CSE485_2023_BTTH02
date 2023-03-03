<?php
    require 'configs/include/headerAdmin_global.php';

?>


<?php
                if(isset($_GET['error'])){
                ?>
                    <div class="container mt-3">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Error!</strong> <?= $_GET['error'] ?>
                        </div>
                    </div>
<?php  }   ?>

<?php
                if(isset($_GET['success'])){
                ?>
                <div class="container mt-3">
                   <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Success!</strong> <?= $_GET['success'] ?>
                    </div>
                </div>
<?php  }   ?>

<?php ?>

 <script>
        //  document.querySelector(".alert");
        setTimeout(function(){
            document.querySelector(".alert").style.display = "none";
        },5000)
 </script>
<?php ?>

<?php
    

   


?>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <a href="index.php?controller=user&action=add" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên đăng nhập</th>
                            <th scope="col">Mật khẩu</th>
                            <th scope="col">Email</th>
                            <th scope="col">Là admin</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    
                        <tbody>
                        <?php $index = 1;foreach($users as $row) { ?>       
                                <tr>
                                    <th scope="row"><?= $index++;  ?></th>
                                    <td><?= $row->getTenDangNhap();?></td>
                                    <td><?= $row->getMatKhau();?></td>
                                    <td><?= $row->getEmail();?></td>
                                    <td><?= $row->getAdmin();?></td>
                                    <td>
                                        <a href="index.php?controller=user&action=edit&id=<?=$row->getTenDangNhap(); ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td>
                                        <a onclick = "return confirm('Bạn có chắc chắn muốn xóa nguời dùng <?=$row->getTenDangNhap(); ?>?');"  href="index.php?controller=user&action=delete&id=<?=$row->getTenDangNhap(); ?>" > <i class="fa-solid fa-trash"></i> </a>
                                    </td>
                                </tr>
                        <?php } ?>
                    </tbody>

                    
                </table>
            </div>
        </div>
    </main>
<?php
      require 'configs/include/footerAdmin_global.php';
?>