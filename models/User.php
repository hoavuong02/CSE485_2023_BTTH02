<?php

class User{
    private $ten_dnhap;
    private $mat_khau;
    private $email;
    private $ngay_dki;
    private $admin;

    // Hàm tạo
    public function __construct($ten_dnhap, $mat_khau, $email, $ngay_dki, $admin){
        $this->ten_dnhap = $ten_dnhap;
        $this->mat_khau = $mat_khau;
        $this->email = $email;
        $this->ngay_dki= $ngay_dki;
        $this->admin= $admin;
    }

    // Hàm setter và getter;
    public function getTenDangNhap(){
        return $this->ten_dnhap;
    }

    public function setTenDangNhap($ten_dnhap){
        $this->ten_dnhap = $ten_dnhap;
    }
    public function getMatKhau(){
        return $this->mat_khau;
    }

    public function setMatKhau($mat_khau){
        $this->mat_khau = $mat_khau;
    }
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    public function getNgayDangKi(){
        return $this->ngay_dki;
    }

    public function setNgayDangKi($ngay_dki){
        $this->ngay_dki = $ngay_dki;
    }
    public function getAdmin(){
        return $this->admin;
    }

    public function setAdmin($admin){
        $this->admin = $admin;
    }


}
?>