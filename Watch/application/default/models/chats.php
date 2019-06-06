<?php  
class Default_Models_Chats extends Libs_Model{
	public $chatid;
	public $khachhang_id;
	public $noidung;
	public $createat;

	private $con = null;
    //....
    
    public function __construct($db) {
        $this->con =$db;
    }

    public function luu(){
            $sql = "INSERT INTO chats (noidung, khachhang_id) VALUES (:noidung, :khachhang_id)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':noidung', $noidung);
            $stmt->bindParam(':khachhang_id', $khachhang_id);
            $stmt->execute();              
        }
        public function in(){
            $conn = Database::connect();
            $sql = "SELECT accounts.username, chats.message, chats.createat FROM accounts INNER JOIN chats on accounts.ID = chats.usernameID ORDER BY createat ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll() as $k => $v){
                echo "<div class='noidung'>";
                echo $v['username'].": ".$v['message']."<br>";
                echo "</div>";
                echo "<div class='thoigian'>";
                echo $v['createat'];
                echo "</div>";
                echo "<br>";
            }            
        }
}
?>