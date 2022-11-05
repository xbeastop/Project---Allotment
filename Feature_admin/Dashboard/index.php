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
    <script src="../../Core/Script/jquery.main.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>

<body class="text-dark">
    <?php
    include_once "../Partials/sidebar.php"; ?>
    <script>
        $("#dashboard").css("background", "#D3E3FD").children().css("color", "#1266f1");
    </script>

    <section class="home-section p-3 d-flex align-items-streach">
        <div class="card bg-white rounded-5 w-100 scroll-y">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2>All Courses</h2>
                        </div>
                        <div class="col text-end">
                            <a type="button" role="button" href="../Course/index.php" class="btn btn-rounded btn-outline-primary" data-mdb-ripple-color="dark">
                                <div class="d-flex align-items-center gap-1">
                                    Add More
                                    <span class="material-symbols-outlined" style="font-size: 1.1rem;">
                                        switch_access_shortcut_add
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex col scroll-x pt-2 pb-4">
                        <?php
                        $courses = CollegePortalRepository::getInstance()->getAllCourses();
                        function formatedNumber($n)
                        {
                            return $n < 10 ? "0$n" : $n;
                        }
                        foreach ($courses as $course) {
                            $name = $course['name'];
                            $noOfSeat = $course['noOfSeat'];
                            $id = $course['id'];
                            $whoCanApply = $course['whoCanApply'];
                            $noOfRequests = formatedNumber(CollegePortalRepository::getInstance()->getNumberOfRequestForCourse($course['id']));
                            echo '
                            <div id=' . $id . ' class="mx-2">
                                <div class="card shadow shadow-3 " style="min-width:270px">
                                <div class="card-body p-3">
                                <div class="row">
                                    <div class="col"><h6>' . $name . '</h6></div>
                                    <div class="col text-primary text-end dropend">
                                    
                                        <button class="btn btn-sm shadow-0 p-0 text-primary" data-mdb-toggle = "dropdown" aria-expanded = "false">
                                        <span class="material-symbols-outlined">
                                            tune
                                        </span>
                                        </button>
                                        <ul class="dropdown-menu">
                                                <li><h6 class="dropdown-header">More options</h6></li>
                                                <li>
                                                    <a course-name = "' . $name . '" course-id = ' . $id . ' class="dropdown-deleteBtn dropdown-item d-flex align-items-center gap-2 fs-6" data-mdb-toggle="modal" href="#confirmDelete">
                                                        <span class="material-symbols-outlined">
                                                            delete
                                                        </span>
                                                        Delete
                                                    </a>
                                                </li>
                                                <li>
                                                    <a course-name = "' . $name . '" course-id = ' . $id . ' class="dropdown-editBtn dropdown-item d-flex align-items-center gap-2 fs-6" data-mdb-toggle="modal" href="#editCourse">
                                                        <span class="material-symbols-outlined">
                                                            edit
                                                        </span>
                                                        Edit
                                                    </a>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                    
                                    <div class="row mt-2">
                                        <div class="col ps-3 d-flex gap-1 align-items-baseline mt-2">
                                            <div class="fs-1  m-0">' . $noOfSeat . '</div>Seats 
                                        </div>
                                        <div class="col shadow shadow-3 gap-1 d-flex align-items-baseline rounded rounded-5 me-2 p-2 ps-3">
                                            <div class=" fs-1 m-0">' . $noOfRequests . '</div>Request
                                            </div>
                                        </div>
                                        <hr class="hr-blurry">
                                        <div class="scroll-x">
                                        ';

                            $whoCanApply = explode(',', $whoCanApply);
                            foreach ($whoCanApply as $id) {
                                $subName = CollegePortalRepository::getInstance()->getStreamNameById($id);
                                echo '<div class="badge rounded-pill fw-normal mx-1 p-2 badge-success">' . $subName . '</div>';
                            }
                            echo '
                                </div>
                                    </div>
                                </div>
                            </div>';
                        } ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php if(!CollegePortalRepository::getInstance()->isPortalActive()) { ?>
                    <div class="col">
                        <div class="alert alert-light border border-dark text-black d-flex align-items-center justify-content-between ">
                            <div class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined">
                                    info
                                </span>
                                Student portal is currently closed. Tap to activate portal

                            </div>
                            <a href="activatePortal.php" type="button" class="btn btn-rounded btn-outline-secondary rounded-5 btn-sm">Activate </a>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="col">
                        <div class="alert alert-success d-flex align-items-center justify-content-between ">
                            <div class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined">
                                    insights
                                </span>
                                Student portal is Open. Tap to close portal

                            </div>
                            <a href="closePortal.php" class="btn btn-rounded btn-light rounded-5 btn-sm ">Close</a>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <h2>Requests</h2>
                    </div>
                    <div class="col text-end">
                        <a type="button" role="button" href="../Request/index.php" class="btn btn-primary btn-rounded" data-mdb-ripple-color="primary">
                            <div class="d-flex align-items-center gap-1">
                                view all
                                <span class="material-symbols-outlined" style="font-size: 1.1rem;">
                                    chevron_right

                                </span>
                            </div>


                        </a>
                    </div>
                </div>
                <div class="row scroll-x">
                    <table class="table table-hover align-middle mb-0 bg-white">
                        <thead class="table-white">
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Stream</th>
                                <th>Board</th>
                                <th>Options</th>
                                <th>Pass Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $repo = CollegePortalRepository::getInstance();
                            $students = $repo->getAllNonVerifiedStudents();
                            foreach ($students as $student) {
                                $name = $student['fullName'];
                                $email = $student['email'];
                                $stream = $repo->getStreamNameById($student['stream']);
                                $school = $student['nameOfSchool'];
                                $board = $student['board'];
                                $age = $student['age'];
                                $passYear = $student['yearOfPass'];
                                $options = $repo->getSelectedCoursesByApplicationNumber($student['applicationNumber']);
                                echo '<tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <p class="fw-bold mb-1">' . $name . '</p>
                                                    <p class="text-muted mb-0">' . $email . '</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>' . $age . '</td>
                                        <td>
                                            <p class="fw-normal mb-1">' . $stream . '</p>
                                            <p class="text-muted mb-0">' . $school . '</p>
                                        </td>
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
    <!-- Modal Delete -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert alert-danger">
                    <h5 class="modal-title d-flex align-items-center gap-2"><span class="material-symbols-outlined">
                            delete
                        </span>Confirm Delete</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete <strong class="dialoge-course-name text-danger"> Course name</strong> from the courses, all the students who applied to this course will be fucked up</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-grayish" data-mdb-dismiss="modal">Close</button>
                    <button type="button" id="model-deleteBtn" data-mdb-dismiss="modal" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="editCourse" tabindex="-1" aria-labelledby="editCourseLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelEditTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="editModalBody" class="modal-body">

                    <form id="editForm" action="#" novalidate>
                        <input type="hidden" id="courseId" name="courseId">
                        <div class="row mt-3">
                            <h4 class="h6 text-muted ">General</h4>
                            <div class="col-md-8 col-lg-4  mt-1 pb-2">
                                <div class="form-outline">
                                    <input type="text" id="courseName" name="courseName" class="form-control courseName" required />
                                    <label class="form-label" for="courseName">Course Name</label>
                                    <div class="invalid-feedback">
                                        Please provide a Course Name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3 mt-1">
                                <div class="form-outline">
                                    <input type="number" id="noOfSeat" name="noOfSeat" class="form-control noOfSeat" required />
                                    <label class="form-label" for="noOfSeat">No of seat</label>
                                    <div class="invalid-feedback">
                                        Please enter a number.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- general - end -->


                        <!-- who can apply -->
                        <div class="row">
                            <div class="col-md-12 col-lg-7 mt-4">
                                <div class="card form-control whoCanApplyCard">
                                    <div class="card-body p-2 ps-3">
                                        <div class="row">
                                            <div class="col-5 ps-3">
                                                <h4 class="h6 text-muted ">Applicable to</h4>
                                            </div>
                                            <div class="col-5">
                                                <h4 class="h6 text-muted ">Weightage</h4>
                                            </div>
                                        </div>
                                        <?php
                                        $streams = CollegePortalRepository::getInstance()->getPlustTwoStreams();
                                        foreach ($streams as $stream) {
                                            $id = $stream['id'];
                                            $name = $stream['name'];
                                            echo '<div class="row my-3 ps-2">
                                        <div class="col-sm-5">
                                            <div class="form-check">
                                                <input class="form-check-input checkBox" type="checkbox" value="' . $id . '" id="' . $name . '" name="whoCanApply[]" />
                                                <label class="form-check-label pb-2" for="' . $name . '">' . $name . '</label>
                                            </div>

                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-outline">
                                                <input type="number" disabled id="' . $id . '" name="' . $id . '" value="0" class="form-control weight" />
                                                <label class="form-label" for="' . $id . '">Mark</label>
                                            </div>
                                        </div>
                                    </div>';
                                        }

                                        ?>

                                    </div>
                                </div>
                                <div class="invalid-feedback">Please select a Stream</div>
                            </div>
                            <div class="col-md-12 col-lg-5 mt-4">
                                <div class="row">
                                    <div class="col ps-3">
                                        <h4 class="h5 ">Indexing Type</h5>
                                            <div class="alert alert-secondary">On selecting Grand Total, total mark is used for indexing. Core Total will exclude the marks of languages </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <!-- Default checked radio -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="GRAND_TOTAL" name="indexingType" id="grandtotal" checked />
                                            <label class="form-check-label" for="grandtotal">Grand total</label>
                                        </div>
                                        <!-- Default radio -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="CORE_TOTAL" name="indexingType" id="coreTotal" />
                                            <label class="form-check-label" for="coreTotal">Core Total</label>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- who can apply end -->
                        <!-- indexing Subjects -->
                        <div class="row mt-4">
                            <div class="row">

                                <div class="col-lg-8 col-md-12 d-flex justify-content-between">
                                    <h4 class="h6 d-inline-block text-muted ">Indexing Subjects</h4>
                                    <button type="button" onclick="clearIndexingSubjects()" class="btn me-xl-5 text-danger btn-link gap-1 d-flex align-items-center">
                                        <span class="material-symbols-outlined">
                                            cancel
                                        </span>
                                        Clear All
                                    </button>
                                </div>


                            </div>

                            <div class="col-lg-6 col-md-10" id="indexingSubParent">
                                <div class="row mt-2 indexingSubject">
                                    <div class="col">
                                        <select id="select" class="form-select" name="indexingSubjects[]" aria-label="Default select example">
                                            <option disabled selected>Select Option</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 col-lg-1 mt-1 d-flex align-items-end justify-content-end justify-content-md-start">
                                <button type="button" id="moreBtn" class="btn align-bottom btn-secondary">MORE</button>
                            </div>

                        </div>
                        <!-- indexing Subjects end -->

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" id="modal-saveChanges" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../Core/Script/mdb.min.js"></script>
    <script src="script.js"></script>
    <script>
        $("#modal-saveChanges").click(() => {

            const courseNameValidity = validateCourseName()
            const noOfSeatValidity = validateNoOfSeat()
            const canAnyoneApply = validateWhoCanApply()
            if (courseNameValidity && noOfSeatValidity && canAnyoneApply) {
                $.ajax({
                    method: "post",
                    url: "updateCourse.php",
                    data: $("#editForm").serialize(),
                    success: function(data) {
                        location.reload(true)
                    }
                });
            }
        });




        $(".dropdown-deleteBtn").click(function() {
            $(".dialoge-course-name").text($(this).attr("course-name"))
            $("#model-deleteBtn").attr("course-id", $(this).attr("course-id"))
        })

        $(".dropdown-editBtn").click(function() {
            const id = $(this).attr("course-id")
            $("#modelEditTitle").text($(this).attr("course-name"))
            $("#modal-saveChanges").attr("course-id", id)
            getAllCourses(data => existingCourseNames = data)
            populateData(id)


        })

        $("#model-deleteBtn").click(function() {
            const id = $(this).attr("course-id")
            $.ajax({
                method: "post",
                url: "deleteCourse.php",
                data: {
                    courseId: id
                },
                success: function() {
                    $(`#${id}`).hide(500)
                }
            })
        })

        var course = null

        /*used to prevent exicuting below function more than once 
              (otherwise new select fields will added on each select box change)*/
        var isSelectedIndexingSubjetsSet = false

        function setSelectedIndexingSubject() {
            if (!isSelectedIndexingSubjetsSet) {
                const subjects = course.indexingSubjects.split(",")
                for (let i = 0; i < subjects.length - 1; i++) {
                    $("#moreBtn").click()
                }
                subjects.forEach((v, i) => {
                    $("select").eq(i).val(v).change()
                })
                isSelectedIndexingSubjetsSet = true
            }
        }

        function populateData(id) {
            $.ajax({
                method: "post",
                url: "courseDetails.php",
                data: {
                    courseId: id
                },
                success: function(data) {
                    course = JSON.parse(data)[0]
                    setField("courseId", course.id)
                    setField("courseName", course.name)
                    setField("noOfSeat", course.noOfSeat)
                    existingCourseNames = existingCourseNames.filter((v) => v != course.name.toLowerCase())

                    //reseting form
                    $("[name='whoCanApply[]']:checked").prop("checked", false);
                    $(".weight").prop("value", 0).attr("disabled", true)
                    clearIndexingSubjects()
                    isSelectedIndexingSubjetsSet = false



                    $(`input[type="radio"][value=${course.indexingType}`).prop("checked", "checked")

                    course.whoCanApply.split(",").forEach((v, i) => {
                        // window.alert(v)
                        $(`input:checkbox[name="whoCanApply[]"][value="${v}"]`).prop("checked", true);
                        $(`input[type="number"][name="${v}"]`).removeAttr("disabled").prop("value", course[v])
                    })
                    allSelected()

                }
            })
        }


        function clearIndexingSubjects() {
            $(".indexingSubject").not(":eq(0)").remove()
            $("#select")[0].selectedIndex = 0
        }


        function setField(id, value) {
            $(`#${id}`).attr("value", value)
        }
    </script>
</body>

</html>