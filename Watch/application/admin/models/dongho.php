<?php
class Admin_Models_Dongho extends Libs_Model{
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
    public $anhPhu;
    public $moTa;
    public $baiViet;
    public $thuonghieu_id;

    private $con = null;
    //....
    
    public function __construct($db) {
        $this->con =$db;
    }
    
    public function getAllDongHo(){
        $query = "SELECT * FROM dongho";
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

    public function getAllDongHoByCategory_Id(){
        $query = "SELECT * FROM dongho WHERE thuonghieu_id=?";
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

    public function addDongHo(){
        $query = "INSERT INTO dongho SET ma=:ma, ten=:ten, xuatXu=:xuatXu, anh=:anh,anhPhu=:anhPhu, thuonghieu_id=:thuonghieu_id, kieuMay=:kieuMay, kichCo=:kichCo, chatLieuVo=:chatLieuVo, day=:day, chatLieuKinh=:chatLieuKinh, doChiuNuoc=:doChiuNuoc, giaCu=:giaCu, giaMoi=:giaMoi, baoHanh=:baoHanh, moTa=:moTa, baiViet=:baiViet";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->ma = htmlspecialchars(strip_tags($this->ma));
        $this->ten = htmlspecialchars(strip_tags($this->ten));
        $this->xuatXu = htmlspecialchars(strip_tags($this->xuatXu));
        $this->anh = htmlspecialchars(strip_tags($this->anh));
        $this->anhPhu = htmlspecialchars(strip_tags($this->anhPhu));
        $this->thuonghieu_id = htmlspecialchars(strip_tags($this->thuonghieu_id));
        $this->kieuMay = htmlspecialchars(strip_tags($this->kieuMay));
        $this->kichCo = htmlspecialchars(strip_tags($this->kichCo));
        $this->chatLieuVo = htmlspecialchars(strip_tags($this->chatLieuVo));
        $this->day = htmlspecialchars(strip_tags($this->day));
        $this->chatLieuKinh = htmlspecialchars(strip_tags($this->chatLieuKinh));
        $this->doChiuNuoc = htmlspecialchars(strip_tags($this->doChiuNuoc));
        $this->giaCu = htmlspecialchars(strip_tags($this->giaCu));
        $this->giaMoi = htmlspecialchars(strip_tags($this->giaMoi));
        $this->baoHanh = htmlspecialchars(strip_tags($this->baoHanh));
        $this->moTa = htmlspecialchars(strip_tags($this->moTa));

        //Tiến hành bind các giá trị cho truy vấn
        $stmt->bindParam(":ma",$this->ma);
        $stmt->bindParam(":ten",$this->ten);
        $stmt->bindParam(":xuatXu", $this->xuatXu);
        $stmt->bindParam(":anh", $this->anh);
        $stmt->bindParam(":anhPhu", $this->anhPhu);
        $stmt->bindParam(":thuonghieu_id", $this->thuonghieu_id);
        $stmt->bindParam(":kieuMay", $this->kieuMay);
        $stmt->bindParam(":kichCo", $this->kichCo);
        $stmt->bindParam(":chatLieuVo", $this->chatLieuVo);
        $stmt->bindParam(":day", $this->day);
        $stmt->bindParam(":chatLieuKinh", $this->chatLieuKinh);
        $stmt->bindParam(":doChiuNuoc", $this->doChiuNuoc);
        $stmt->bindParam(":giaCu", $this->giaCu);
        $stmt->bindParam(":giaMoi", $this->giaMoi);
        $stmt->bindParam(":baoHanh", $this->baoHanh);        
        $stmt->bindParam(":moTa", $this->moTa);
        $stmt->bindParam(":baiViet", $this->baiViet);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function updateDongHo()
    {
        $query = "UPDATE dongho SET ten=:ten, xuatXu=:xuatXu, thuonghieu_id=:thuonghieu_id, kieuMay=:kieuMay, kichCo=:kichCo, chatLieuVo=:chatLieuVo, day=:day, chatLieuKinh=:chatLieuKinh, doChiuNuoc=:doChiuNuoc, giaCu=:giaCu, giaMoi=:giaMoi, baoHanh=:baoHanh, moTa=:moTa, baiViet=:baiViet WHERE dongho_id=:dongho_id";
        $stmt = $this->con->prepare($query);

        //Làm sạch dữ liệu
        $this->ten = htmlspecialchars(strip_tags($this->ten));
        $this->xuatXu = htmlspecialchars(strip_tags($this->xuatXu));
        $this->thuonghieu_id = htmlspecialchars(strip_tags($this->thuonghieu_id));
        $this->kieuMay = htmlspecialchars(strip_tags($this->kieuMay));
        $this->kichCo = htmlspecialchars(strip_tags($this->kichCo));
        $this->chatLieuVo = htmlspecialchars(strip_tags($this->chatLieuVo));
        $this->day = htmlspecialchars(strip_tags($this->day));
        $this->chatLieuKinh = htmlspecialchars(strip_tags($this->chatLieuKinh));
        $this->doChiuNuoc = htmlspecialchars(strip_tags($this->doChiuNuoc));
        $this->giaCu = htmlspecialchars(strip_tags($this->giaCu));
        $this->giaMoi = htmlspecialchars(strip_tags($this->giaMoi));
        $this->baoHanh = htmlspecialchars(strip_tags($this->baoHanh));
        $this->moTa = htmlspecialchars(strip_tags($this->moTa));
        $this->dongho_id = htmlspecialchars(strip_tags($this->dongho_id));


        //Tiến hành bind các giá trị cho truy vấn
        $stmt->bindParam(":ten",$this->ten);
        $stmt->bindParam(":xuatXu", $this->xuatXu);
        $stmt->bindParam(":thuonghieu_id", $this->thuonghieu_id);
        $stmt->bindParam(":kieuMay", $this->kieuMay);
        $stmt->bindParam(":kichCo", $this->kichCo);
        $stmt->bindParam(":chatLieuVo", $this->chatLieuVo);
        $stmt->bindParam(":day", $this->day);
        $stmt->bindParam(":chatLieuKinh", $this->chatLieuKinh);
        $stmt->bindParam(":doChiuNuoc", $this->doChiuNuoc);
        $stmt->bindParam(":giaCu", $this->giaCu);
        $stmt->bindParam(":giaMoi", $this->giaMoi);
        $stmt->bindParam(":baoHanh", $this->baoHanh);        
        $stmt->bindParam(":moTa", $this->moTa);
        $stmt->bindParam(":baiViet", $this->baiViet);
        $stmt->bindParam(":dongho_id", $this->dongho_id);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }        
    }

    public function deleteDongHoById(){
        $query = "DELETE FROM dongho WHERE dongho_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, htmlspecialchars(strip_tags($this->dongho_id)));
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }   
    
}
