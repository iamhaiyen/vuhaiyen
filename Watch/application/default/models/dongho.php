<?php
class Default_Models_Dongho extends Libs_Model{
    public $dongho_id;
    public $ma;
    public $ten;
    public $xuatXu;
    public $kieuMay;
    public $kichCo;
    public $chatLieuVo;
    public $day;
    public $chatLieuKinh;
    public $doChiuNuoc;
    public $baoHanh;
    public $giaCu;
    public $giaMoi;
    public $anh;
    public $anhPhu1;
    public $anhPhu2;
    public $anhPhu3;
    public $moTa;
    public $thuonghieu_id;

    private $con = null;
    //....
    
    public function __construct($db) {
        $this->con =$db;
    }
    
    public function getAllDongHo(){
        $query = "SELECT dongho_id, ma, ten, day, anh, giaCu, giaMoi, thuonghieu_id FROM dongho";
        $stmt = $this->con->prepare($query);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
    }

    public function getDongHoKhuyenMai(){
        $query = "SELECT dongho_id, ma, ten, day, anh, giaCu, giaMoi, thuonghieu_id FROM dongho ORDER BY giaMoi DESC LIMIT 5";
        $stmt = $this->con->prepare($query);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
    }

    public function getDongHoGiaRe(){
        $query = "SELECT dongho_id, ma, ten, day, anh, giaCu, giaMoi, thuonghieu_id FROM dongho ORDER BY giaMoi ASC LIMIT 8";
        $stmt = $this->con->prepare($query);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
    }

    public function getDongHoMoiNhat(){
        $query = "SELECT dongho_id, ma, ten, day, anh, giaCu, giaMoi, thuonghieu_id FROM dongho ORDER BY dongho_id DESC LIMIT 8";
        $stmt = $this->con->prepare($query);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
    }

    public function getDongHoGiaCao(){
        $query = "SELECT dongho_id, ma, ten, day, anh, giaCu, giaMoi, thuonghieu_id FROM dongho ORDER BY giaMoi DESC LIMIT 4";
        $stmt = $this->con->prepare($query);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
    }

    public function getDongHoById(){
        $query = "SELECT * FROM dongho WHERE dongho_id=? LIMIT 0,1";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,htmlspecialchars(strip_tags($this->dongho_id)));
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }else{
            return null;
        }
    }

    public function getDongHoByIdToCart(){
        $query = "SELECT * FROM dongho WHERE ma=?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, htmlspecialchars($this->ma));
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }
            return $result;
        }else{
            return null;
        }
    }

    public function getDongHoByIdToSoSanh(){
        $query = "SELECT * FROM dongho WHERE ma=?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, htmlspecialchars($this->ma));
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }
            return $result;
        }else{
            return null;
        }
    }

    public function getAllDongHoByCategory_Id(){
        $query = "SELECT dongho_id, ma, ten, day, anh, giaCu, giaMoi FROM dongho WHERE thuonghieu_id=?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,htmlspecialchars(strip_tags($this->thuonghieu_id)));
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {  
            return $stmt;
        }else{
            return null;
        }
    }
}
