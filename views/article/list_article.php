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
                <a href="index.php?controller=article&action=add" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Tên bài hát</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Tác giả</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <?php $index = 1; foreach($listArticles as $listArticle) { ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $index++;  ?></th>
                            <td><?= $listArticle->getTieude() ?></td>
                            <td><?= $listArticle->getTenBaiHat() ?></td>
                            <!-- ma the loai = ten the loai -->
                            <td><?= $listArticle->getMaTheLoai() ?></td> 
                            <!-- ma tac gia = ten tac gia -->
                            <td><?= $listArticle->getMaTacGia() ?></td>
                            <td>
                                <a href="index.php?controller=article&action=edit&id=<?=$listArticle->getMaBaiViet()?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a onclick = "return confirm('Bạn có chắc chắn muốn xóa bài viết này?');"  href="index.php?controller=article&action=delete&id=<?=$listArticle->getMaBaiViet() ?>" > <i class="fa-solid fa-trash"></i> </a>
                            </td>
                        </tr>

                    </tbody>

                    <?php } ?>
                </table>
            </div>
        </div>
    </main>
<?php
    require 'configs\include\footerAdmin_global.php';
?>