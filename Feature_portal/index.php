<?php include_once("registrationPortalUC.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../Core/Style/mdb.min.css">
    <link rel="stylesheet" href="Style/style.css">
    <script src="../Core/Script/jquery.main.js"></script>
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <div class="containerr container">
        <header>Registration</header>

        <form action="saveStudentDetails.php" class=" needs-validation" enctype="multipart/form-data" method="post">
            <div class="form first">
                <div class="details personal">
                    <span class="title">personal Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <lable>Full Name</lable>
                            <input required type="text" name="fullName" id="fullName">
                        </div>

                        <div class="input-field">
                            <lable>Gender</lable>
                            <select required name="sex" class="sex" id="sex">
                                <option disabled selected>Select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <lable>Age</lable>
                            <input required type="number" name="age" id="age">
                        </div>

                        <div class="input-field">
                            <lable>Date of Birth</lable>
                            <input required type="date" name="dob" id="dob">
                        </div>

                        <div class="input-field">
                            <lable>Address</lable>
                            <input required name="address" id="address"></input>
                        </div>

                        <div class="input-field">
                            <lable>Nationality</lable>
                            <input required type="text" name="nationality" id="nationality">
                        </div>

                        <div class="input-field">
                            <lable>State</lable>
                            <input required type="text" name="state" id="state">
                        </div>

                        <div class="input-field">
                            <lable>Place </lable>
                            <input required type="text" name="placeOfBirth" id="placeOfBirth">
                        </div>


                    </div>
                </div>
                <div class="details parent">
                    <span class="title">Parent Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <lable>Parent</lable>
                            <input required name="parentDetails" id="parentDetails"></input>
                        </div>


                        <div class="input-field">
                            <lable>Email Id</lable>
                            <input required type="email" name="email" id="email">
                        </div>
                        <div class="input-field">
                            <lable>Mobile </lable>
                            <input required type="text" name="mobileNumber" id="mobileNumber">
                        </div>

                        <div class="input-field">
                            <lable>Bank account number</lable>
                            <input required type="number" name="bankAccountNumber" id="bankAccountNumber">
                        </div>

                        <div class="input-field">
                            <lable>Adhaar</lable>
                            <input required type="number" name="adhaar" id="adhaar">
                        </div>


                        <div class="input-field">
                            <lable>Religion</lable>
                            <input required type="text" name="religion" id="religion">
                        </div>

                        <div class="input-field">
                            <lable>Caste</lable>
                            <input required type="text" name="caste" id="caste">
                        </div>

                        <div class="input-field">
                            <lable>Discontinue reason</lable>
                            <input type="text" name="discontinueReason" id="discontinueReason"></input>
                        </div>
                    </div>

                    <!-- <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <span class="btnText">Back</span>
                        </div> -->

                </div>

                <div class="details course">
                    <span class="title">AddOn Details</span>

                    <div class="row">
                        <div class="col-8">
                            <label class="form-label">NCC or NSS</label>
                            <input class="form-control" type="file" accept="image/*,.pdf" name="nccOrNss" id="nccOrNss">
                        </div>

                        <div class="col-8">
                            <label class="form-label">Dependent of Ex-service man</label>
                            <input class="form-control" type="file" accept="image/*,.pdf" name="dependentOfExServiceMan" id="dependentOfExServiceMan">
                        </div>

                        <div class="col-8">
                            <label class="form-label">Handicaped</label>
                            <input class="form-control" type="file" accept="image/*,.pdf" name="handicaped" id="handicaped">
                        </div>

                        <div class="col-8">
                            <label class="form-label">Archivements</label>
                            <input class="form-control" type="file" accept="image/*,.pdf" name="achievements" id="achievements">
                        </div>

                        <div class="col-8">
                            <label class="form-label">Plus Two Mark List</label>
                            <input class="form-control main" required type="file" accept="image/*,.pdf" name="plustwoMarkList" id="plustwoMarkList">
                        </div>
                        <div class="nextBtn btn btn-primary d-flex gap-2">
                            Next
                            <i class="uil uil-navigator"></i>
                        </div>



                    </div>
                </div>
            </div>

            <div class="form second">


                <div class="details plustwo">
                    <span class="title">Plus two Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <lable>Name of school</lable>
                            <input required type="text" name="nameOfSchool" id="nameOfSchool">
                        </div>

                        <div class="input-field">
                            <lable>Stream</lable>
                            <select required name="stream" id="stream" onchange="streamChanged(this.value)">
                                <option disabled selected>Select Stream</option>
                                <?php
                                $streams = RegistrationUc::getStreams();
                                foreach ($streams as $stream) {
                                    $id = $stream['id'];
                                    $streamName = $stream['name'];
                                    echo "<option value = $id>$streamName</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-field">
                            <lable>Year of passing</lable>
                            <input required type="number" name="yearOfPass" id="yearOfPass">
                        </div>

                        <div class="input-field">
                            <lable>Register number</lable>
                            <input required type="number" name="registerNumber" id="registerNumber">
                        </div>

                        <div class="input-field">
                            <lable>Chances taken</lable>
                            <input required type="number" name="chanceTaken" id="chanceTaken">
                        </div>

                        <div class="input-field">
                            <lable>Board</lable>
                            <input required type="text" name="board" id="board">
                        </div>

                    </div>
                </div>


                <!-- plus two subject details  -->
                <div class="details plustwo">
                    <span class="title">Mark List</span>
                    <div class="fields">
                        <div class="row">
                            <div class="input-field">
                                <select required name="subject1" id="subject1">
                                    <option disabled selected>Select Subject</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <input name="markObteined_1" id="markObteined_1" required type="number" placeholder="Mark Obteined">
                            </div>
                            <div class="input-field">
                                <input name="markRequired_1" id="markRequired_1" required type="number" placeholder="Mark Required">
                            </div>
                            <div class="input-field">
                                <input name="maxMark_1" id="maxMark_1" required type="number" placeholder="Max Mark">
                            </div>
                            <div class="input-field">
                                <input name="grade_1" id="grade_1" required type="text" placeholder="Grade">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <select name="subject2" required id="subject2">
                                    <option disabled selected>Select Subject</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <input name="markObteined_2" id="markObteined_2" required type="number" placeholder="Mark Obteined">
                            </div>
                            <div class="input-field">
                                <input name="markRequired_2" id="markRequired_2" required type="number" placeholder="Mark Required">
                            </div>
                            <div class="input-field">
                                <input name="maxMark_2" id="maxMark_2" required type="number" placeholder="Max Mark">
                            </div>
                            <div class="input-field">
                                <input name="grade_2" id="grade_2" required type="text" placeholder="Grade">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <select name="subject3" id="subject3">
                                    <option disabled selected>Select Subject</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <input name="markObteined_3" id="markObteined_3" required type="number" placeholder="Mark Obteined">
                            </div>
                            <div class="input-field">
                                <input name="markRequired_3" id="markRequired_3" required type="number" placeholder="Mark Required">
                            </div>
                            <div class="input-field">
                                <input name="maxMark_3" id="maxMark_3" required type="number" placeholder="Max Mark">
                            </div>
                            <div class="input-field">
                                <input name="grade_3" id="grade_3" required type="text" placeholder="Grade">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <select name="subject4" id="subject4">
                                    <option disabled selected>Select Subject</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <input name="markObteined_4" id="markObteined_4" required type="number" placeholder="Mark Obteined">
                            </div>
                            <div class="input-field">
                                <input name="markRequired_4" id="markRequired_4" required type="number" placeholder="Mark Required">
                            </div>
                            <div class="input-field">
                                <input name="maxMark_4" id="maxMark_4" required type="number" placeholder="Max Mark">
                            </div>
                            <div class="input-field">
                                <input name="grade_4" id="grade_4" required type="text" placeholder="Grade">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <select name="subject5" id="subject5">
                                    <option disabled selected>Select Subject</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <input name="markObteined_5" id="markObteined_5" required type="number" placeholder="Mark Obteined">
                            </div>
                            <div class="input-field">
                                <input name="markRequired_5" id="markRequired_5" required type="number" placeholder="Mark Required">
                            </div>
                            <div class="input-field">
                                <input name="maxMark_5" id="maxMark_5" required type="number" placeholder="Max Mark">
                            </div>
                            <div class="input-field">
                                <input name="grade_5" id="grade_5" required type="text" placeholder="Grade">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <select name="subject6" id="subject6">
                                    <option disabled selected>Select Subject</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <input name="markObteined_6" id="markObteined_6" required type="number" placeholder="Mark Obteined">
                            </div>
                            <div class="input-field">
                                <input name="markRequired_6" id="markRequired_6" required type="number" placeholder="Mark Required">
                            </div>
                            <div class="input-field">
                                <input name="maxMark_6" id="maxMark_6" required type="number" placeholder="Max Mark">
                            </div>
                            <div class="input-field">
                                <input name="grade_6" id="grade_6" required type="text" placeholder="Grade">
                            </div>
                        </div>

                        <!-- end of plusTwo subjects -->



                        <div class="input-field">
                            <lable>first option</lable>
                            <select name="firstOption" id="firstOption">
                                <option disabled selected>Select Option</option>
                                <?php
                                // $courses = registrationuc::getcourses();
                                // foreach ($courses as $course) {
                                //     $id = $course['id'];
                                //     $coursename = $course['name'];
                                //     echo "<option value = $id>$coursename</option>";
                                // }
                                ?>
                            </select>
                        </div>

                        <div class="input-field">
                            <lable>Second Option</lable>
                            <select name="secondOption" id="secondOption">
                                <option disabled selected>Select Option</option>
                                <?php
                                // $courses = RegistrationUc::getCourses();
                                // foreach ($courses as $course) {
                                //     $id = $course['id'];
                                //     $courseName = $course['name'];
                                //     echo "<option value = $id>$courseName</option>";
                                // }
                                ?>
                            </select>
                        </div>

                        <div class="input-field">
                            <lable>Third Option</lable>
                            <select name="thirdOption" id="thirdOption">
                                <option disabled selected>Select Option</option>
                                <?php
                                // $courses = RegistrationUc::getCourses();
                                // foreach ($courses as $course) {
                                //     $id = $course['id'];
                                //     $courseName = $course['name'];
                                //     echo "<option value = $id>$courseName</option>";
                                // }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="buttons">
                        <div class="backBtn btn btn-secondary">
                            <i class="uil uil-navigator"></i>
                            Back
                        </div>

                        <button class="submitBtn" type="sumbit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function streamChanged(id) {
            $.ajax({
                type: 'post',
                url: 'ajaxData.php',
                data: {
                    selectedStreamId: id
                },
                success: function(data) {
                    assignSubjects(data);
                }
            })
            getCoursesByStreamId(id);
        }

        function getCoursesByStreamId(id) {
            $.ajax({
                type: 'post',
                url: 'ajaxData.php',
                data: {
                    streamIdForCourse: id
                },
                success: function(data) {
                    assignCourses(data);
                }
            })
        }

        function assignCourses(data) {
            $('#firstOption').html(data);
            $('#secondOption').html(data);
            $('#thirdOption').html(data);
        }

        function assignSubjects(data) {
            $('#subject1').html(data);
            $('#subject2').html(data);
            $('#subject3').html(data);
            $('#subject4').html(data);
            $('#subject5').html(data);
            $('#subject6').html(data);

        }





















        const form = document.querySelector("form"),
            nextBtn = form.querySelector(".nextBtn"),
            backBtn = form.querySelector(".backBtn"),
            allInput = form.querySelectorAll(".first input"),
            first = form.querySelector(".first"),
            second = form.querySelector(".second")


        nextBtn.addEventListener("click", () => {
            let move = [];
            const sex = document.querySelector(".sex")
            if (sex.value == "Select gender") {
                move.push(true)
                sex.style.border = "1px solid red";

            } else {
                sex.style.border = "1px solid #aaa";
            }
            allInput.forEach(input => {

                console.log(input.hasAttribute("required"))
                if (!input.hasAttribute("required") || input.value != "") {
                    input.style.border = "1px solid #aaa";
                    input.classList.remove("error")
                } else {
                    console.log(input)
                    if (input.type == "date" || input.type =="number" || input.type == "text" || input.type == "email" || input.type == "file") {

                        move.push(true);
                        input.style.border = "1px solid red";
                        input.classList.add("error")
                    }
                    // if(input.classList.contains("main") || input.type)
                }
            })
            if (move.length != 0) {
                form.classList.remove('secActive');
                const error = form.querySelector(".error")
                first.scroll(0,error.getBoundingClientRect().bottom + 50);
            } else {
                form.classList.add('secActive');
                second.scroll(0,0)
            }

            move = [];
        })

        backBtn.addEventListener("click", () => {
            form.classList.remove('secActive')
            first.scroll(0, 0);

        });
    </script>
</body>

</html>