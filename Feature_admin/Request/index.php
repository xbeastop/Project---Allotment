<?php include_once "../../Core/Data/Repository/collegePortalRepository.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        $("#request").css("background", "#D3E3FD").children().css("color", "#1266f1");
    </script>
    <section class="home-section p-3 d-flex align-items-streach">
        <div class="card bg-white rounded-5 w-100 scroll-y">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <h2>Requests</h2>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-primary d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined">
                                    help
                                </span>
                                Verify the information provided by students, including their grades and addresses
                            </div>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $repo = CollegePortalRepository::getInstance();
                                $students = $repo->getAllNonVerifiedStudents();
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
                                            <div class="badge badge-secondary fw-normal rounded-pill d-inline">' . $repo->getCourseNameById($options[0]['courseId']) . '</div>
                                            <div class="div mt-1">';
                                    $n = sizeof($options);
                                    for ($i = 1; $i < $n; $i++) {
                                        echo '
                                                <div class="badge fw-normal badge-light rounded-pill d-inline">' . $repo->getCourseNameById($options[$i]['courseId']) . '</div>';
                                    }
                                    echo '</div>
                                        </td>
                                        <td>' . $passYear . '</td>
                                        <td>
                                            <button onclick=updateModel("' . $applicationNumber . '")
                                             type="button" data-mdb-toggle="modal" data-mdb-target="#exampleModal" id = "trigger" class="btn btn-primary">Verify</button>
                                        </td>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verify Details</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid">
                    <iframe src="" width="100%" height="400px" frameborder="0"></iframe>
                    <div class="alert alert-warning d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
                        <span class="material-symbols-outlined">
                            privacy_tip
                        </span>
                        Verifiy if the given details matches with the provided document
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <table id="marklist" class="table w-100 border border-2 table-sm">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Mark</th>
                                <th>Grade</th>
                                <th>Required Mark</th>
                                <th>Maximum Mark</th>
                            </tr>
                        </thead>
                    </table>



                    <div class="row mt-5">
                        <div class="col">
                            <h5>Other Documents</h5>
                        </div>
                    </div>
                    <hr class=" hr-blurry mt-1">
                    <div class="row otherDocuments">
                        <!-- injext documents here -->

                    </div>
                    <div class="row my-2">
                        <h5 class="mb-0">Grace Mark</h5>
                    </div>
                    <div class="alert d-flex align-items-center gap-2 alert-primary"><span class="material-symbols-outlined">
                            info
                        </span>Validate whether the student is eligible for any grace mark based on the uploaded documents</div>

                    <div class="row">
                        <div class="col-5">
                            <div class="form-outline">
                                <input type="number" min="0" class="form-control" name="graceMark" value="0" id="graceMark">
                                <label class="form-label" for="graceMark">Grace mark</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" id="verifyStudent" data-mdb-dismiss="modal" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../Core/Script/mdb.min.js"></script>
</body>
<script>
    let appNumber = null

    function updateModel(id) {
        appNumber = id
        const body = $(".modal-content .modal-body")
        $.ajax({
            method: "post",
            url: "getDocuments.php",
            data: {
                studentId: id,
                type: "all"
            },
            success: function(data) {
                data = JSON.parse(data)
                try {
                    const path = data.filter(v => v.documentType == 'plustwoMarkList')[0].path
                    body.children('iframe').prop('src', `<?php echo SITE_URL . "Core/Data/Data_source/Documents/" ?>${path}`)
                    data.filter(v => v.documentType != 'plustwoMarkList').forEach(v => {
                        console.log(`${v.documentType}: Core/Data/Data_source/Documents/${v.path}`)
                        $(".otherDocuments").append(
                            `<div class="col-md-6">
                                <h6>${v.documentType}</h6>
                                <iframe width = "100%" height="300px" src = "<?php echo SITE_URL . "Core/Data/Data_source/Documents/" ?>${v.path}"
                            </div>
                            `
                        )
                        console.log($(".otherDocuments").add());
                    })


                } catch (e) {
                    body.children('iframe').prop('src', `<?php echo SITE_URL . "Core/Data/Data_source/Documents/" ?>`)
                    $(".otherDocuments").html("");
                }
            }
        })
        $('#marklist').DataTable({
            destroy: true,
            paging: false,
            ordering: false,
            info: false,
            ajax: {
                method: "post",
                url: "getMarklist.php",
                data: {
                    applicationNumber: appNumber
                },
                dataSrc: '',
            },

            columns: [{
                    data: 'subject'
                },
                {
                    data: 'mark'
                },
                {
                    data: 'grade'
                },
                {
                    data: 'requiredMark'
                },
                {
                    data: 'maxMark'
                },
            ]
        });

    }

    $("#verifyStudent").click(() => {
        $.ajax({
            method: "post",
            url: "verifyStudent.php",
            data: {
                applicationNumber: appNumber,
                graceMark: $("#graceMark").val()
            },
            success: function(data) {
                $(`#${appNumber}`).hide(350)
            }
        })
    })
    $(document).ready(() => {
        $("#table").dataTable();
        $("#table").parent().addClass("overflow-auto");

    })
</script>

</html>