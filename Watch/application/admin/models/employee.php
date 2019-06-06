<?php
class Admin_Models_Employee extends Libs_Model{
    public $employee_id;
    public $name;
    public $emailAdmin;
    public $password;

    private $con = null;
    //....
    
    public function __construct($db) {
        $this->con =$db;
    }
    
    // Return TRUE|FALSE
    public function checkEmployee(){
        $query = "SELECT * FROM employees WHERE emailAdmin=:emailAdmin AND password=:password";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->password = htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(":emailAdmin", $this->emailAdmin);
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow>=1) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getEmployeeByInfo(){
        // Lấy ra 1 lq  
        $query = "SELECT * FROM employees WHERE emailAdmin=:emailAdmin LIMIT 0,1"; 
        $stmt = $this->con->prepare($query);        
        $stmt->bindParam(":emailAdmin", $this->emailAdmin);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }     
}
