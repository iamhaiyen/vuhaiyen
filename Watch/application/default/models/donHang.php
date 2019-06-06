<?php
require "Classes/PHPExcel.php";
class Default_Models_Donhang extends Libs_Model{
    public $donhang_id;
    public $dongho_id;
    public $khachhang_id;
    public $soLuong;
    public $thanhTien;
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

    public function getDonHangByKhachHangId(){
        $query = "SELECT * FROM donhang WHERE khachhang_id=?";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1,htmlspecialchars(strip_tags($this->khachhang_id)));
        $stmt->execute();//Trả về mảng
        $rowCount = $stmt->rowCount();
        if ($rowCount>0) {
            return $stmt;
        }else{
            return null;
        }
    }

    public function addDonHang(){
        $query = "INSERT INTO donhang SET dongho_id=:dongho_id, khachhang_id=:khachhang_id,soLuong=:soLuong,thanhTien=:thanhTien";
        $stmt = $this->con->prepare($query);
        //Làm sạch dữ liệu
        $this->dongho_id = htmlspecialchars(strip_tags($this->dongho_id));
        $this->khachhang_id = htmlspecialchars(strip_tags($this->khachhang_id));
        $this->soLuong = htmlspecialchars(strip_tags($this->soLuong));
        $this->thanhTien = htmlspecialchars(strip_tags($this->thanhTien));

        //Tiến hành bind các giá trị cho truy vấn
        $stmt->bindParam(":dongho_id",$this->dongho_id);
        $stmt->bindParam(":khachhang_id", $this->khachhang_id); 
        $stmt->bindParam(":soLuong", $this->soLuong);   
        $stmt->bindParam(":thanhTien", $this->thanhTien);       
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    //import du lieu vao excel
    public function importDonHang(){
        //get data Don hang
        $data = $this->getAllDonHang();
        //Khởi tạo đối tượng
        $excel = new PHPExcel();
        //Chọn trang cần ghi (là số từ 0->n)
        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Lấy dữ liệu đơn hàng');

        //Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

        //Xét in đậm cho khoảng cột
        $excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        //Tạo tiêu đề cho từng cột
        $excel->getActiveSheet()->setCellValue('A1', 'Đơn Hàng ID');
        $excel->getActiveSheet()->setCellValue('B1', 'Đồng hồ ID');
        $excel->getActiveSheet()->setCellValue('C1', 'Khách Hàng ID');
        $excel->getActiveSheet()->setCellValue('D1', 'Số lượng');
        $excel->getActiveSheet()->setCellValue('E1', 'Thành tiền');
        $excel->getActiveSheet()->setCellValue('F1', 'Trạng Thái');
        // thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
        // dòng bắt đầu = 2
        $numRow = 2;
        foreach ($data as $row) {
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $row[0]);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $row[1]);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $row[2]);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $row[3]);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $row[4]);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $row[5]);
            $numRow++;
        }
        // Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
        // ở đây mình lưu file dưới dạng excel2007
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('dataDonhang.xlsx');
    }

    //ket qua tra ve 1 mang gom cac truong. Muon them vao database thi foreach du lieu ra
    public function exportDonHang($file){
        $objFile = PHPExcel_IOFactory::identify($file);
        $objData = PHPExcel_IOFactory::createReader($objFile);
        //Chỉ đọc dữ liệu
        $objData->setReadDataOnly(true);

        // Load dữ liệu sang dạng đối tượng
        $objPHPExcel = $objData->load($file);

        //Lấy ra số trang sử dụng phương thức getSheetCount();
        // Lấy Ra tên trang sử dụng getSheetNames();

        //Chọn trang cần truy xuất
        $sheet = $objPHPExcel->setActiveSheetIndex(0);

        //Lấy ra số dòng cuối cùng
        $Totalrow = $sheet->getHighestRow();
        //Lấy ra tên cột cuối cùng
        $LastColumn = $sheet->getHighestColumn();

        //Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
        $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

        //Tạo mảng chứa dữ liệu
        $data = [];

        //Tiến hành lặp qua từng ô dữ liệu
        //----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
        for ($i = 2; $i <= $Totalrow; $i++) {
            //----Lặp cột
            for ($j = 0; $j < $TotalCol; $j++) {
                // Tiến hành lấy giá trị của từng ô đổ vào mảng
                $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
            }
        }
    }
}
