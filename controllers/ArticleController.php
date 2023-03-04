<?php

    include("services\ArticleService.php");
class ArticleController{
    public function index(){
        $service = new ArticleService();
        $service->getAllArticles();
        include("views/article/add_article.php");
    }

    public function detail(){
        $serviceDetail = new ArticleService();
        $detailArticle = $serviceDetail->getDetailArticle();
        $nameCategory = $serviceDetail->getCategorybyArticle($detailArticle->getMaTheLoai());
        $nameAuthor = $serviceDetail->getAuthorbyArticle($detailArticle->getMaTacGia());
        include("views/article/detail_article.php");
    }

    public function search(){
        $serviceSearch = new ArticleService();
        $searchedlArticle = $serviceSearch->getSearchedArticles();
        include("views/article/search_article.php");
    }

    public function list(){
        $serviceDetail = new ArticleService();
        $listArticles = $serviceDetail->getListArticles();
        include("views/article/list_article.php");
    }

    public function edit(){
        $serviceDetail = new ArticleService();
        $detailArticle = $serviceDetail->getDetailArticle();
        $nameCategory = $serviceDetail->getCategorybyArticle($detailArticle->getMaTheLoai());
        $nameAuthor = $serviceDetail->getAuthorbyArticle($detailArticle->getMaTacGia());

        $nameCategoryExcept = $serviceDetail->getALLCategoryExcept($detailArticle->getMaTheLoai());
        $nameAuthorExcept = $serviceDetail->getAllAuthorExcept($detailArticle->getMaTacGia());
        include("views/article/edit_article.php");
    }

    public function processEdit(){
        $articleService = new ArticleService();
        $processEdit = $articleService-> processEditArticle(); 
    }

    public function delete(){
        $articleService = new ArticleService();
        $delete = $articleService-> deleteArticle(); 
    }
    
    public function add(){
        $articleService = new ArticleService();
        $categorys = $articleService->getAllCategory();
        $authors = $articleService->getAllAuthor();
        include("views/article/add_article.php");
    }

    public function processAdd(){
        $articleService = new ArticleService();
        $processAdd = $articleService-> addArticle();
    }
}