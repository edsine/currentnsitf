<?php
session_start();

$employer = 1004033022;
require_once '../classes/manage.php';
$query = new Manage();

$dsn = "mysql:host=localhost;dbname=ebsdb";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}

$perpage = 20;

// Define pagination parameters
$recordsPerPage = $perpage; // Number of records to display per page

// Determine the total number of records
$sql = "SELECT COUNT(*) AS total_count FROM employer_tb";
$stmt = $pdo->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Retrieve the total count value
$totalRecords = $result['total_count'];

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

$currentpage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the query parameters
$currentpage = max(1, min($currentpage, $totalPages)); // Ensure the current page is within the valid range

$chunkSize = $perpage; // Number of page links to display in a chunk
$chunkOffset = floor($chunkSize / 2); // Offset to center the current page link in the chunk

$startPage = max(1, $currentpage - $chunkOffset);
$endPage = min($startPage + $chunkSize - 1, $totalPages);

// Calculate the offset and retrieve the records for the current page
$offset = ($currentpage - 1) * $recordsPerPage;

$sql = "SELECT company_name, ecs_number, rc_number, bussiness_area, createdAt FROM employer_tb limit $offset, $perpage";
$stmt = $pdo->query($sql);
$currentPageRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <h5 class="card-header" style="font-size: 30px;">Unapprove Employers</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Employer</th>
                        <th>ECS Number</th>
                        <th>RC Number</th>
                        <th>Bussiness Type</th>
                        <th>Date Registered</th>
                        <th>Tag</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($currentPageRecords as $row) { ?>
                        <tr>
                            <td>
                                <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $row['company_name'] ?></strong>
                            </td>
                            <td><?php echo $row['ecs_number'] ?></td>
                            <td><?php echo $row['rc_number'] ?></td>
                            <td><?php echo $row['bussiness_area'] ?></td>
                            <td><?php echo $row['createdAt'] ?></td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                                    </li>
                                </ul>
                            </td>
                            <td><span class="badge bg-label-primary me-1">Active</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center">
                    <?php
                    // Generate the "Previous" link
                    if ($currentpage > 1) {
                        echo '<li class="page-item"><a class="page-link" href="unapproved_employers.php?page=' . ($currentpage - 1) . '">Previous</a></li>';
                    }

                    // Generate the page links
                    for ($page = $startPage; $page <= $endPage; $page++) {
                        $isActive = ($page == $currentpage) ? "active" : "";
                        echo '<li class="page-item ' . $isActive . '"><a class="page-link" href="unapproved_employers.php?page=' . $page . '">' . $page . '</a></li>';
                    }

                    // Generate the "Next" link
                    if ($currentpage < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="unapproved_employers.php?page=' . ($currentpage + 1) . '">Next</a></li>';
                    }
                    ?>
                </ul>
            </nav>
            <!-- End Pagination -->
        </div>
    </div>
</div>

<?php
// Close the database connection
$pdo = null;
?>