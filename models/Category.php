<?php

class Category{

    private $ma_tloai;
    private $ten_tloai;

    // Hàm tạo
    public function __construct( $ma_tloai, $ten_tloai){
        $this->ma_tloai = $ma_tloai;
        $this->ten_tloai = $ten_tloai;
    }

    // Hàm setter và getter;
    public function getma_tloai(){
        return $this->ma_tloai;
    }

    public function setma_tloai($ma_tloai){
        $this->title = $ma_tloai;
    }
    public function getten_tloai(){
        return $this->ten_tloai;
    }

    public function setten_tloai($ten_tloai){
        $this->title = $ten_tloai;
    }
}

?>