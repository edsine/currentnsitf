<?php 
require_once ('vendor/autoload.php');


require __DIR__.'/../../classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();


if (isset($_POST["import"])) {

    $allowedFileTypes = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileTypes)) {

        $filePath = "../template_format/uploads/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $filePath);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $stmt = $conn->prepare("INSERT INTO staff_tb (roles, dash_type, firstname, middlename, lastname, gender, branchId, region, phone, staff_email, security_key, status) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $rowCount = 0;
        foreach ($sheetData as $row) {
            if ($rowCount > 0) { // skip header row
               // $staffId = $row[0];
                $roles = $row[1];
                $dashType = $row[2];
                $firstName = $row[3];
                $middleName = $row[4];
                $lastName = $row[5];
                $gender = $row[6];
                $branchId = $row[7];
                $region = $row[8];
                $phone = $row[9];
                $staffEmail = $row[10];
                $securityKey = $row[11];
                $status = $row[12];

                $stmt->execute([$roles, $dashType, $firstName, $middleName, $lastName, $gender, $branchId, $region, $phone, $staffEmail, $securityKey, $status]);
            }
            $rowCount++;
        }
        header("location:../new_staff.php?message=Excel Data Imported into the Database");

    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
        
          header("location:../new_staff.php?message=Invalid File Type. Upload Excel File.");
    }
}




?>