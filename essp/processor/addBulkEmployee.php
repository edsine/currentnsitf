<?php 
session_start();
require_once ('../vendor/autoload.php');


require __DIR__.'/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$employer = $_SESSION['employerId'] ;

if (isset($_POST["import"])) {

    $allowedFileTypes = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileTypes)) {

        $filePath = "../account/template_format/uploads/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $filePath);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($filePath);
        $spreadSheetAry = $spreadsheet->getActiveSheet()->toArray();

       
		$stmt = $conn->prepare("INSERT INTO employees (employer_id, employee_surname, employee_firstname, employee_middlename, employee_address, dob, gender, marital_status, work_id, employment_date, employee_email, job_title, state_origin, lga, lga_town, contact_phone, alternate_phone, identity_means, identity_number, issue_date, next_kin, next_kin_number, dependants_number, monthly_remuneration, status, createdAt, updatedAt) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$rowCount = 0;
foreach ($spreadSheetAry as $row) {
if ($rowCount > 0) { // skip header row
$employerId = $employer;
$employeeSurname = $row[1];
$employeeFirstname = $row[2];
$employeeMiddlename = $row[3];
$employeeAddress = $row[4];
$dob = $row[5];
$gender = $row[6];
$maritalStatus = $row[7];
$workId = $row[8];
$employmentDate = $row[9];
$employeeEmail = $row[10];
$jobTitle = $row[11];
$stateOrigin = $row[12];
$lga = $row[13];
$lgaTown = $row[14];
$contactPhone = $row[15];
$alternatePhone = $row[16];
$identityMeans = $row[17];
$identityNumber = $row[18];
$issueDate = $row[19];
$nextKin = $row[20];
$nextKinNumber = $row[21];
$dependantsNumber = $row[22];
$monthlyRemuneration = $row[23];
$status = $row[24];
$createdAt = date("Y-m-d H:i:s");
$updatedAt = date("Y-m-d H:i:s");

$stmt->execute([$employerId, $employeeSurname, $employeeFirstname, $employeeMiddlename, $employeeAddress, $dob, $gender, $maritalStatus, $workId, $employmentDate, $employeeEmail, $jobTitle, $stateOrigin, $lga, $lgaTown, $contactPhone, $alternatePhone, $identityMeans, $identityNumber, $issueDate, $nextKin, $nextKinNumber, $dependantsNumber, $monthlyRemuneration, $status, $createdAt, $updatedAt]);
}
$rowCount++;
        }
        header("location:../account/employee.php?message=Excel Data Imported into the Database");

    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
        
          header("location:../account/employee.php?message=Invalid File Type. Upload Excel File.");
    }
}




?>