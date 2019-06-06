<?php  
class Admin_Models_ThuongHieu extends Libs_Model{
	public $thuonghieu_id;
	public $ten;

	private $con = null;
	public function __construct($db){
		$this->con = $db;
	}

	public function getAllThuongHieu(){
		$query = "SELECT * FROM thuonghieu";
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		$num = $stmt->rowCount();
		if ($num>0) {
			return $stmt;
		}else{
			return null;
		}
	}

	public function getThuongHieuById(){
		$query = "SELECT * FROM thuonghieu WHERE thuonghieu_id = ? LIMIT 0,1";
		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1,htmlspecialchars(strip_tags($this->thuonghieu_id)));
		$stmt->execute();
		$rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            $result1=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result1;
        }else{
            return null;
        }
	}

	public function addThuongHieu(){
        $query = "INSERT INTO thuonghieu SET ten=:ten";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->ten = htmlspecialchars(strip_tags($this->ten));

        //Tiến hành bind các giá trị cho truy vấn
        $stmt->bindParam(":ten", $this->ten);    
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateThuongHieu()
    {
        $query = "UPDATE thuonghieu SET ten=:ten WHERE thuonghieu_id=:thuonghieu_id";
        $stmt = $this->con->prepare($query);

        //Làm sạch dữ liệu
        $this->ten = htmlspecialchars(strip_tags($this->ten));
        $this->thuonghieu_id = htmlspecialchars(strip_tags($this->thuonghieu_id));


        //Tiến hành bind các giá trị cho truy vấn        
        $stmt->bindParam(":ten", $this->ten);    
        $stmt->bindParam(":thuonghieu_id", $this->thuonghieu_id);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }        
    }

	public function deleteThuongHieuById(){
        $query = "DELETE FROM thuonghieu WHERE thuonghieu_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, htmlspecialchars(strip_tags($this->thuonghieu_id)));
        if($stmt->execute()){
            return true;
        }else{ 
            return false;
        }
    }   
}
?>