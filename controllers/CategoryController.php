<?php
include("services/CategoryService.php");
// include("models/Article.php");

class CategoryController{
    public function index(){
        // require 'configs/include/headerAdmin_global.php';

        $categoryService = new CategoryService();
        $categorys = $categoryService-> getAllCategory();
        include("views/category/category.php");
        // header("Location: index.php?controller=category");
    }

    
   
    public function add(){
        $categoryService = new CategoryService();
        $nameCategory = $categoryService -> addCategorySql();
        header("Location: index.php?controller=category");
    }

    public function Routeradd(){
        include("views/category/add_category.php");
    }

    public function delete(){
        $categoryService = new CategoryService();
        $delcategory = $categoryService -> deleteCategorySql();
        // header("Location: index.php?controller=category");
    }

}
// echo "đây là ArticleController";
?>