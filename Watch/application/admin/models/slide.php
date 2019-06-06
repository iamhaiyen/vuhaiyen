<?php  
class Admin_Models_Slide extends Libs_Model{
	public $slide_id;
	public $anh;

	private $con = null;
    //....
    
    public function __construct($db) {
        $this->con =$db;
    }
	public function getAllSlide(){
		$query = "SELECT * FROM slide";
		$stmt = $this->con->prepare($query);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
	}

    public function addSlide(){
        $query = "INSERT INTO slide SET anh=:anh";
        $stmt = $this->con->prepare($query);

        //Tiến hành bind các giá trị cho truy vấn
        $stmt->bindParam(":anh", htmlspecialchars(strip_tags($this->anh)));
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteSlideById(){
        $query = "DELETE FROM slide WHERE slide_id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, htmlspecialchars(strip_tags($this->slide_id)));
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }   
}

?>