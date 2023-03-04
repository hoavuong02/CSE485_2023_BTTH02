<?php
     require 'configs/include/auth.php';
?>
<?php ?>

 <script>
        //  document.querySelector(".alert");
        setTimeout(function(){
            document.querySelector(".alert").style.display = "none";
        },5000)
 </script>
<?php ?>



<?php
    // require '../../auth.php';
    require 'configs/include/headerAdmin_global.php';
?>


    <main class="container mt-5 mb-5">

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

        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <a href="index.php?controller=category&&action=Routeradd" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên thể loại</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <?php $index = 1;  foreach($categorys as $category) { ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $index++;  ?></th>
                            <td><?= $category->getten_tloai(); ?></td>
                            <td>
                                <a href="index.php?controller=category&&action=Routeredit&id=<?=$category->getma_tloai(); ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a onclick = "return confirm('Bạn có chắc chắn muốn xóa thể loại <?=$category->getten_tloai();?>?');"  href="index.php?controller=category&&action=delete&id=<?=$category->getma_tloai(); ?>" > <i class="fa-solid fa-trash"></i> </a>
                            </td>
                        </tr>

                    </tbody>
                    
                    

                    <?php } ?>
                </table>
            </div>
        </div>
    </main>
<?php
      require 'configs/include/footerAdmin_global.php';
?>