<?php
include("services/CategoryService.php");
// include("models/Article.php");

class CategoryController{
    public function index(){
        // require 'configs/include/headerAdmin_global.php';

        $categoryService = new CategoryService();
        $categorys = $categoryService-> getAllCategory();
        include("views/category/category.php");
    }

    
   
    public function add(){
        $categoryService1 = new CategoryService();
        $nameCategory = $categoryService1 -> addCategorySql();
        header("Location: index.php?controller=category");
    }

    public function Routeradd(){
        include("views/category/add_category.php");
    }

}
// echo "đây là ArticleController";
?>