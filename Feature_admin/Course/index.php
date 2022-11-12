<?Php include_once "../../Core/Data/Repository/collegePortalRepository.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Course</title>
    <link rel="stylesheet" href="../../Core/Style/mdb.min.css">
    <link rel="stylesheet" href="../Partials/sidebar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="../../Core/Script/jquery.main.js"></script>

</head>

<body>
    <?php
    include_once "../Partials/sidebar.php"; ?>
    <script>
        $("#course").css("background", "#D3E3FD").children().css("color", "#1266f1");
    </script>
    <section class="home-section d-flex align-items-streach" style="padding:1rem 1rem 85px">
        <div class="card bg-white rounded-5 w-100">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1>Create a course</h1>
                        </div>
                        <!-- Tabs navs -->
                        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active fw-bold" id="ex1-tab-1" disabled data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Enter Details</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <div class="nav-link fw-bold overview" disabled id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Overview</div>
                            </li>
                        </ul>
                        <!-- Tabs navs -->

                        <!-- Tabs content -->
                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">

                                <div class="alert alert-primary alert-dismissible fade show" role="alert">Adding a new course will reflect in the course list
                                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                                <form id="addCourseForm" action="#" novalidate>
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
                                                <input type="number" disabled id="' . $id . '" name="' . $id . '" value="0" class="form-control" />
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
                                        <h4 class="h6 text-muted ">Indexing Subjects</h4>
                                        <div class="col-lg-6 col-md-10" id="indexingSubParent">
                                            <div class="row mt-2 indexingSubject">
                                                <div class="col">
                                                    <select class="form-select" name="indexingSubjects[]" aria-label="Default select example">
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
                                    <div class="row pb-1 pe-3 fixed-bottom ">
                                        <div class="col bg-white">
                                            <button type="submit" class="btn btn-lg btn-primary my-2 float-end">
                                                <div class="d-flex align-items-center">
                                                     Create
                                                <span class="material-symbols-outlined ms-1" style="font-size: 1.5rem;">
                                                    arrow_right_alt
                                                </span>
                                                </div>
                                               
                                                </button>
                                        </div>
                                    </div>
                                </form>



                            </div>
                            <div class="tab-pane fade " id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                <div class="alert alert-success" role="alert">
                                    <div class="align-items-center d-flex alert-heading mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                        <h4 class="mb-0">Succesfully Created!</h4>
                                    </div>
                                    <p>Aww yeah, your new course details have been successfully saved. From now on eligible students will be able to apply for this course.</p>
                                    <hr>
                                    <p class="mb-0">For more details go to <a href="http://allotment/Feature_admin/Dashboard/index.php" class="alert-link">Dashboard</a></p>
                                </div>
                                <img src="success.png" class="img-fluid w-" />
                            </div>
                        </div>
                        <!-- Tabs content -->

                    </div>
                    <!-- general -->

                </div>
            </div>
        </div>
    </section>
    <script src="scripts.js"></script>

</body>
<script src="../../Core/Script/mdb.min.js"></script>

</html>

<!-- change from amal satheesh -->