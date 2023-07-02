<?php
session_start();

$employer = 1004033022;
require_once '../classes/manage.php';
$query = new Manage();

?>

<div class="card">
    <h5 class="card-header" style="font-size: 30px;">Unapprove Employers</h5>
    <div class="card-body">
        <div id="investors" class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Employer</th>
                        <th>ECS Number</th>
                        <th>RC Number</th>
                        <th>Bussiness Type</th>
                        <th>Date Registered</th>
                    </tr>
                </thead>
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

