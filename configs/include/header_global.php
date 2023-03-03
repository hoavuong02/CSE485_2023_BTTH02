<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./include/cssGlobal/styleHeaderGlobal.css">
    <link rel="stylesheet" href="./include/cssGlobal/styleFooterGlobal.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
                    <a class="navbar-brand" href="#">
                        <img src="./images/logoPrimary.png" alt="" class="img-fluid-header">
                    </a>
                </div>
                <button class="navbar-toggler navbar-toggler_2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=login&action=index">Đăng nhập</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="GET" action="">
                    <input class="form-control me-2" type="search" placeholder="Nội dung cần tìm" aria-label="Search" name="search">
                    <input class="btn-search" type="submit" name="submit_search" value="Tìm">
                </form>
                </div>
            </div>
        </nav>
    </header>