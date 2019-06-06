<?php
class Admin_Models_Donhang extends Libs_Model{
    public $donhang_id;
    public $dongho_id;
    public $khachhang_id;
    public $soLuong;
    public $thanhTien;
    public $trangThai;
    private $con = null;
    //....
    
    public function __construct($db) {
        $this->con =$db;
    }
    
    public function getAllDonHang(){
        $query = "SELECT * FROM donhang";
        $stmt = $this->con->prepare($query);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
    }

    public function getDonHangById(){
        $query = "SELECT * FROM donhang WHERE donhang_id=? LIMIT 0,1";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,htmlspecialchars(strip_tags($this->donhang_id)));
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }else{
            return null;
        }
    }
    
    public function updateTrangThaiDonHang()
    {
        $query = "UPDATE donhang SET trangThai=:trangThai WHERE donhang_id=:donhang_id";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->trangThai = htmlspecialchars(strip_tags($this->trangThai));
        $this->donhang_id = htmlspecialchars(strip_tags($this->donhang_id));

        //Tiến hành bind các giá trị cho truy vấn 
        $stmt->bindParam(":trangThai", $this->trangThai);
        $stmt->bindParam(":donhang_id", $this->donhang_id);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }        
    }

    public function deleteDonHangById(){
        $query = "DELETE FROM donhang WHERE donhang_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, htmlspecialchars(strip_tags($this->donhang_id)));
        if($stmt->execute()){
            return true;
        }else{ 
            return false;
        }
    }   

    public function doanhthuNgay(){

    }
}
