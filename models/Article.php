<?php
class Article{
    // Thuộc tính
    private $ma_bviet;
    private $tieude;
    private $ten_bhat;
    private $tomtat;
    private $noidung;
    private $hinhanh;
    private $ma_tloai;
    private $ma_tgia;


    public function __construct($ma_bviet, $tieude,$ten_bhat, $tomtat, $noidung, $hinhanh, $ma_tloai, $ma_tgia){
        $this->ma_bviet = $ma_bviet;
        $this->tieude = $tieude;
        $this->ten_bhat = $ten_bhat;
        $this->tomtat = $tomtat;
        $this->noidung = $noidung;
        $this->hinhanh = $hinhanh;
        $this->ma_tloai = $ma_tloai;
        $this->ma_tgia = $ma_tgia;
    }

    // Setter và Getter
    public function getMaBaiViet(){
        return $this->ma_bviet;
    }
    public function getTieude(){
        return $this->tieude;
    }
    public function getTenBaiHat(){
        return $this->ten_bhat;
    }
    public function getTomTat(){
        return $this->tomtat;
    }
    public function getNoiDung(){
        return $this->noidung;
    }
    public function getHinhAnh(){
        return $this->hinhanh;
    }
    public function getMaTheLoai(){
        return $this->ma_tloai;
    }
    public function getMaTacGia(){
        return $this->ma_tgia;
    }



    //set 
    public function setTieude($tieude){
        $this->tieude = $tieude;
    }
    public function setTenBaiHat($ten_bhat){
        $this->ten_bhat = $ten_bhat;
    }
    public function setTomTat($tomtat){
        $this->tomtat = $tomtat;
    }
    public function setNoiDung($noidung){
        $this->noidung = $noidung;
    }
    public function setHinhAnh($hinhanh){
        $this->noidung = $hinhanh;
    }

    
}