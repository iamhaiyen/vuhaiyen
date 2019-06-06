<?php
class Admin_Models_Khachhang extends Libs_Model{
    public $khachhang_id;
    public $email;
    public $password;
    public $ten;
    public $soDienThoai;
    public $diaChi;
    public $gopY;

    private $con = null;
    //....
    
    public function __construct($db) {
        $this->con =$db;
    }
    
    public function getAllKhachHang(){
        $query = "SELECT * FROM khachhang";
        $stmt = $this->con->prepare($query);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
    }

    public function getKhachHangById(){
        $query = "SELECT * FROM khachhang WHERE khachhang_id=? LIMIT 0,1";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,htmlspecialchars(strip_tags($this->khachhang_id)));
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }else{
            return null;
        }
    }

    public function addKhachHang(){
        $query = "INSERT INTO khachhang SET email=:email, password=:password, ten=:ten, soDienThoai=:soDienThoai, diaChi=:diaChi";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->ten = htmlspecialchars(strip_tags($this->ten));
        $this->soDienThoai = htmlspecialchars(strip_tags($this->soDienThoai));
        $this->diaChi = htmlspecialchars(strip_tags($this->diaChi));

        //Tiến hành bind các giá trị cho truy vấn
        $stmt->bindParam(":email", $this->email);        
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":ten",$this->ten);
        $stmt->bindParam(":soDienThoai", $this->soDienThoai);
        $stmt->bindParam(":diaChi", $this->diaChi);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateKhachHang()
    {
        $query = "UPDATE khachhang SET email=:email, password=:password, ten=:ten, soDienThoai=:soDienThoai, diaChi=:diaChi, gopY=:gopY WHERE khachhang_id=:khachhang_id";
        $stmt = $this->con->prepare($query);

        //Làm sạch dữ liệu
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->ten = htmlspecialchars(strip_tags($this->ten));
        $this->soDienThoai = htmlspecialchars(strip_tags($this->soDienThoai));
        $this->diaChi = htmlspecialchars(strip_tags($this->diaChi));
        $this->gopY = htmlspecialchars(strip_tags($this->gopY));
        $this->khachhang_id = htmlspecialchars(strip_tags($this->khachhang_id));


        //Tiến hành bind các giá trị cho truy vấn        
        $stmt->bindParam(":email", $this->email);        
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":ten",$this->ten);
        $stmt->bindParam(":soDienThoai", $this->soDienThoai);
        $stmt->bindParam(":diaChi", $this->diaChi);
        $stmt->bindParam(":gopY", $this->gopY);
        $stmt->bindParam(":khachhang_id", $this->khachhang_id);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }        
    }

    public function deleteKhachHangById(){
        $query = "DELETE FROM khachhang WHERE khachhang_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, htmlspecialchars(strip_tags($this->khachhang_id)));
        if($stmt->execute()){
            return true;
        }else{ 
            return false;
        }
    }
}
