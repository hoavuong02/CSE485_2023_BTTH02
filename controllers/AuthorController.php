<?php
include("services/AuthorService.php");
// include("models/Article.php");

class AuthorController{
    public function index(){
        // require 'configs/include/headerAdmin_global.php';

        $authorService = new AuthorService();
        $authors = $authorService-> getAllAuthor();
        include("views/author/author.php");
        // header("Location: index.php?controller=category");
    }

    //add
    public function add(){
        $authorService = new AuthorService();
        $addAuthor =  $authorService -> addAuthorSql();
        header("Location: index.php?controller=author");
    }

    public function Routeradd(){
        include("views/author/add_author.php");
    }

    //delete
    public function delete(){
        $authorService = new AuthorService();
        $deleteAuthor =  $authorService -> deleteAuthorSql();
        // header("Location: index.php?controller=author");
    }

    //edit

    public function Routeredit(){
        $AuthorService = new AuthorService();
        $editAuthorId = $AuthorService ->editAuthorSql();
        include("views/Author/edit_author.php");
    }

    public function edit(){
        $AuthorService = new AuthorService();
        $processAuthor =  $AuthorService ->processEditAuthor();
        header("Location: index.php?controller=author");
    }



}

?>