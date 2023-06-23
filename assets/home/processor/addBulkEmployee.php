<?php 
require_once ('../vendor/autoload.php');


require __DIR__.'/classes/Database.php';
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

        $stmt = $conn->prepare("INSERT INTO employer_tb (ecs_number, company_name, rc_number, cac_date, address, postal_address, state, local_gvt, c_email, password, desk_surname, desk_middlename, desk_firstname, desk_phone, desk_position, nin, bussiness_area, branchId, regionId, status, createdAt, updatedAt) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $rowCount = 0;
        foreach ($sheetData as $row) {
            if ($rowCount > 0) { // skip header row
                //$employerId = $row[0];
                $ecsNumber = $row[1];
                $companyName = $row[2];
                $rcNumber = $row[3];
                $cacDate = $row[4];
                $address = $row[5];
                $postalAddress = $row[6];
                $state = $row[7];
                $localGvt = $row[8];
                $cEmail = $row[9];
                $password = $row[10];
                $deskSurname = $row[11];
                $deskMiddlename = $row[12];
                $deskFirstname = $row[13];
                $deskPhone = $row[14];
                $deskPosition = $row[15];
                $nin = $row[16];
                $bussinessArea = $row[17];
                $branchId = $row[18];
                $regionId = $row[19];
                $status = $row[20];
                $createdAt = $row[21];
                $updatedAt = $row[22];

                $stmt->execute([$ecsNumber, $companyName, $rcNumber, $cacDate, $address, $postalAddress, $state, $localGvt, $cEmail, $password, $deskSurname, $deskMiddlename, $deskFirstname, $deskPhone, $deskPosition, $nin, $bussinessArea, $branchId, $regionId, $status, $createdAt, $updatedAt]);
            }
            $rowCount++;
        }
        header("location:../employer.php?message=Excel Data Imported into the Database");

    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
        
          header("location:../employer.php?message=Invalid File Type. Upload Excel File.");
    }
}




?>