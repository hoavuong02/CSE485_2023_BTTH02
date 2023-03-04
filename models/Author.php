<?php

class Author{
    private $ma_tgia;
    private $ten_tgia;
    private $hinh_tgia;
   

    // Hàm tạo
    public function __construct($ma_tgia, $ten_tgia, $hinh_tgia){
        $this->ma_tgia = $ma_tgia;
        $this->ten_tgia = $ten_tgia;
        $this->hinh_tgia = $hinh_tgia;
    }

    // Hàm setter và getter;
    public function getMaTacGia(){
        return $this->ma_tgia;
    }

    public function setMaTacGia($ma_tgia){
        $this->ma_tgia = $ma_tgia;
    }
    public function getTenTacGia(){
        return $this->ten_tgia;
    }

    public function setTenTacGia($ten_tgia){
        $this->ten_tgia = $ten_tgia;
    }
    public function getHinhTacGia(){
        return $this->hinh_tgia;
    }

    public function setHinhTacGia($hinh_tgia){
        $this->hinh_tgia = $hinh_tgia;
    }
}
?>