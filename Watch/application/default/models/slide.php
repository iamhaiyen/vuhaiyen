<?php  
class Default_Models_Slide extends Libs_Model{
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
}

?>