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

    
}