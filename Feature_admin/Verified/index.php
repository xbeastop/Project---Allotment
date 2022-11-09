<?php include_once "../../Core/Data/Repository/collegePortalRepository.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verified Students</title>
    <link rel="stylesheet" href="../../Core/Style/mdb.min.css">
    <link rel="stylesheet" href="../Partials/sidebar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="../../Core/Script/jquery.main.js"></script>
    <link rel="stylesheet" href="../../Core/Style/dataTables.bootstrap5.min.css">
    <script src="../../Core/Script/jquery.dataTables.min.js"></script>
    <script src="../../Core/Script/dataTables.bootstrap5.min.js"></script>


</head>

<body>
    <?php
    include_once "../Partials/sidebar.php"; ?>
    <script>
        $("#verified").css("background", "#D3E3FD").children().css("color", "#1266f1");
    </script>
    <section class="home-section p-3 d-flex align-items-streach">
        <div class="card bg-white rounded-5 w-100 scroll-y">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <h2>Verified Students</h2>
                    </div>
                    <div class="row">
                        <div class="alert alert-primary d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined">
                                    tips_and_updates
                                </span>
                                Please start the allotment Process only after verifing every students
                            </div>
                            <button id="allocateBtn" class="btn btn-primary d-flex align-items-center gap-2">Allocate</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <table id="table" class="table table-hover align-middle mb-0 bg-white">
                            <thead class="table-white">
                                <tr class="text-nowrap">
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>Nationality</th>
                                    <th>State</th>
                                    <th>Age</th>
                                    <th>Dob</th>
                                    <th>Birth Place</th>
                                    <th>Parent Details</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Account Number</th>
                                    <th>Adhaar</th>
                                    <th>Religion</th>
                                    <th>Discontinue Reason</th>
                                    <th>Stream</th>
                                    <th>Register Number</th>
                                    <th>Chance Taken</th>
                                    <th>Board</th>
                                    <th>Options</th>
                                    <th>Pass Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $repo = CollegePortalRepository::getInstance();
                                $students = $repo->getAllVerifiedStudents();
                                foreach ($students as $student) {
                                    $name = $student['fullName'];
                                    $applicationNumber = $student['applicationNumber'];
                                    $email = $student['email'];
                                    $stream = $repo->getStreamNameById($student['stream']);
                                    $school = $student['nameOfSchool'];
                                    $board = $student['board'];
                                    $age = $student['age'];
                                    $passYear = $student['yearOfPass'];
                                    $options = $repo->getSelectedCoursesByApplicationNumber($applicationNumber);
                                    echo '<tr id="' . $applicationNumber . '">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <p class="fw-bold mb-1">' . $name . '</p>
                                                    <p class="text-muted mb-0">' . $email . '</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>' . $student['sex'] . '</td>
                                        <td>' . $student['nationality'] . '</td>
                                        <td>' . $student['state'] . '</td>
                                        <td>' . $age . '</td>
                                        <td>' . $student['dob'] . '</td>
                                        <td>' . $student['placeOfBirth'] . '</td>
                                        <td>' . $student['parentDetails'] . '</td>
                                        <td>' . $student['address'] . '</td>
                                        <td>' . $student['mobileNumber'] . '</td>
                                        <td>' . $student['bankAccountNumber'] . '</td>
                                        <td>' . $student['adhaar'] . '</td>
                                        <td>' . $student['religion'] . '</td>
                                        <td>' . $student['discontinueReason'] . '</td>
                                        <td>
                                            <p class="fw-bold mb-1">' . $stream . '</p>
                                            <p class="text-muted mb-0">' . $school . '</p>
                                        </td>
                                        <td>' . $student['registerNumber'] . '</td>
                                        <td>' . $student['chanceTaken'] . '</td>
                                        <td>' . $board . ' </td>
                                        <td>
                                            <div class="badge badge-secondary fw-normal rounded-pill d-inline">' . $repo->getCourseNameById($options[0]['courseId']) . " : <mark>" .
                                        $repo->getIndexMarkByApplicationNumberAndOptionNumber($applicationNumber, 1) . "</mark>" .
                                        '</div>
                                            <div class="div mt-1">';
                                    $n = sizeof($options);
                                    for ($i = 1; $i < $n; $i++) {
                                        echo '
                                                <div class="badge fw-normal badge-light rounded-pill d-inline">' . $repo->getCourseNameById($options[$i]['courseId']) . " : <mark>" .
                                            $repo->getIndexMarkByApplicationNumberAndOptionNumber($applicationNumber, $i) . "</mark>" .
                                            '</div>';
                                    }
                                    echo '</div>
                                        </td>
                                        <td>' . $passYear . '</td>
                                    </tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->

    <script src="../../Core/Script/mdb.min.js"></script>
</body>
<script>
    $(document).ready(() => {
        $("#table").dataTable();
        $("#table").parent().addClass("overflow-auto");

    })
    $("#allocateBtn").click(e=>{
        
    })
</script>

</html>