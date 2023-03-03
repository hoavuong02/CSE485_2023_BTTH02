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
        include("views/article/detail_article.php");
    }

    public function search(){
        $serviceSearch = new ArticleService();
        $searchedlArticle = $serviceSearch->getSearchedArticles();
        include("views/article/search_article.php");
    }

    public function list(){
        // Nhiệm vụ 1: Tương tác với Services/Models
        // echo "Tương tác với Services/Models from Article";
        // Nhiệm vụ 2: Tương tác với View
        include("views/article/list_article.php");
    }
}