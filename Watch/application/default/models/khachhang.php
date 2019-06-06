<?php 
use PHPMailer\ PHPMailer\ PHPMailer;
use PHPMailer\ PHPMailer\ Exception;
/* Exception class. */
require 'PHPMailer\src\Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer\src\SMTP.php';
class Default_Models_KhachHang extends Libs_Model{
	public $khachhang_id;
	public $email;
	public $password;
	public $ten;
	public $soDienThoai;
	public $diaChi;

	private $con = null;
	public function __construct($db){
		$this->con = $db;
	}

	// Return TRUE|FALSE
    public function checkKhachHang(){
        $query = "SELECT * FROM khachhang WHERE email=:email AND password=:password";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->password = htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow>=1) {
            return TRUE;
        }else{
            return FALSE;
        }
    } 

    public function checkPasswordKhachHang(){
        $query = "SELECT * FROM khachhang WHERE password=:password";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->password = htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow>=1) {
            return TRUE;
        }else{
            return FALSE;
        }
    } 

    public function updatePasswordKhachHang(){
        // Lấy ra 1 lq  
        $query = "UPDATE khachhang SET password=:password WHERE email=:email"; 
        $stmt = $this->con->prepare($query);        

        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":password",$this->password);
        $stmt->bindParam(":email",$this->email);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }      
    }  

    public function addKhachHang(){
        $query = "INSERT INTO khachhang SET email=:email, password=:password, ten=:ten";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->ten = htmlspecialchars(strip_tags($this->ten));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        //Tiến hành bind các giá trị cho truy vấn
        $stmt->bindParam(":ten",$this->ten);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getKhachHangByInfo(){
        // Lấy ra 1 lq  
        $query = "SELECT * FROM khachhang WHERE email=:email LIMIT 0,1"; 
        $stmt = $this->con->prepare($query);        
        $stmt->bindParam(":email", $this->email);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }     

    public function updateProfileKhachHang(){
        // Lấy ra 1 lq  
        $query = "UPDATE khachhang SET ten=:ten, soDienThoai=:soDienThoai, diaChi=:diaChi WHERE email=:email"; 
        $stmt = $this->con->prepare($query);        

        $this->ten = htmlspecialchars(strip_tags($this->ten));
        $this->soDienThoai = htmlspecialchars(strip_tags($this->soDienThoai));
        $this->diaChi = htmlspecialchars(strip_tags($this->diaChi));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":ten",$this->ten);
        $stmt->bindParam(":soDienThoai",$this->soDienThoai);
        $stmt->bindParam(":diaChi",$this->diaChi);
        $stmt->bindParam(":email",$this->email);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }      
    }  

    public function updateKhachHang()
    {
        $query = "UPDATE khachhang SET gopY=:gopY WHERE email=:email";
        $stmt = $this->con->prepare($query);

        //Làm sạch dữ liệu
        $this->gopY = htmlspecialchars(strip_tags($this->gopY));
        $this->email = htmlspecialchars(strip_tags($this->email));


        //Tiến hành bind các giá trị cho truy vấn   
        $stmt->bindParam(":gopY", $this->gopY);
        $stmt->bindParam(":email",$this->email);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }        
    }
//checkmail
    public function checkEmail(){
        $query = "SELECT * FROM khachhang WHERE email=:email";
        $stmt = $this->con->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return 1;
        }else{
            return 0;
        }
    }
//sendmail
    function sendMail($to){
            // $from = 'awatch83@gmail.com';
            // $passmail = 'Matkhaunay';
            $from = 'vuhyen309@gmail.com';
            $passmail = 'phamthingan309';
            $mail = new PHPMailer( true ); // Passing `true` enables exceptions
            try {
                //Cấu hình máy chủ
                $mail->SMTPDebug = 2; // Enable verbose debug output
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = $from; // SMTP username
                $mail->Password = $passmail; // SMTP password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587; // TCP port to connect to

                //Recipients
                $mail->setFrom( $from, '' );
                $mail->addAddress( $to ); // Add a recipient
                $mail->addReplyTo( $from, '' );
                //Content
                //$mail->isHTML( true ); // Set email format to HTML
                $mail->Subject = 'Register Success!';
                $mail->Body = "Xin chào, $to \n\rCảm ơn bạn đã đăng ký!";
                $mail->AltBody = '';
                $mail->send();
                echo 'Message has been sent';
            } catch ( Exception $e ) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
}
?>