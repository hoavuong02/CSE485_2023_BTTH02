
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
                <a href="index.php?controller=author&&action=Routeradd" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Tác Giả</th>
                            <th scope="col">Hình Tác Giả</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <?php $index = 1; foreach($authors as $author) { ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $index++;  ?></th>
                            <td><?= $author->getTenTacGia(); ?></td>
                            <td><img style = "width: 150px;" src="assets/<?= $author->getHinhTacGia(); ?>" alt="Not found image"></td>
                            <td>
                                <a href="index.php?controller=author&&action=Routeredit&id= <?=$author->getMaTacGia();?> "><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                
                                <a  onclick = "return confirm('Bạn có chắc chắn muốn xóa tác giả <?= $author->getTenTacGia();  ?> ?');" href="index.php?controller=author&&action=delete&id=<?=$author->getMaTacGia();?>"   > <i class="fa-solid fa-trash"></i> </a>

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