<?Php include_once "../../Core/Data/Repository/collegePortalRepository.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../../Core/Style/mdb.min.css">
    <link rel="stylesheet" href="../Partials/sidebar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="../../Core/Script/jquery.main.js"></script>
    <link rel="stylesheet" href="../../Core/Style/dataTables.bootstrap5.min.css">
    <script src="../../Core/Script/jquery.dataTables.min.js"></script>
    <script src="../../Core/Script/dataTables.bootstrap5.min.js"></script>
    <style>
        #addNewCourse {
            cursor: pointer;
        }
    </style>

</head>

<body>
    <?php
    include_once "../Partials/sidebar.php"; ?>
    <script>
        $("#settings").css("background", "#D3E3FD").children().css("color", "#1266f1");
    </script>
    <section class="home-section d-flex align-items-streach" style="padding:1rem">
        <div class="card bg-white rounded-5 w-100">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2>Streams</h2>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['success'])) {
                        $msg = $_SESSION['success']; ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <div class="div d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined">
                                    task_alt
                                </span>
                                <?php echo $msg; ?>
                            </div>
                            <button type="button" data-mdb-dismiss="alert" class="btn-close" aria-label="Close"></button>
                        </div>
                    <?php
                        unset($_SESSION['success']);
                    } else if (isset($_SESSION['error'])) {
                        $msg = $_SESSION['error'];
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <div class="div d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined">
                                    error
                                </span>
                                <?php echo $msg; ?>
                            </div>
                            <button type="button" data-mdb-dismiss="alert" class="btn-close" aria-label="Close"></button>
                        </div>
                    <?php
                        unset($_SESSION['error']);
                    } ?>


                    <!-- general -->
                    <div class="row mt-2">
                        <?php
                        $streams = CollegePortalRepository::getInstance()->getPlustTwoStreams();
                        foreach ($streams as $stream) {
                            echo '
                         <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                <div class=" d-flex justify-content-between align-items-center">
                                <span class="card-title h5">' . $stream['name'] . '</span>
                                    <a class="deleteBtn text-black" data-mdb-toggle="modal" stream-id="' . $stream['id'] . '" stream-name ="' . $stream['name'] . '" href="#deleteModal" class="text-black">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                    </a>
                                </div>
                                    
                                    <hr>
                                    <div class=" d-flex justify-content-between">
                                        <button type="button" stream-id=' . $stream['id'] . ' class="editNameBtn btn btn-sm rounded me-3 text-nowrap rounded-5 btn-primary">Edit Name</button>
                                        <button type="button" stream-id=' . $stream['id'] . ' class="addSubjectBtn btn btn-sm rounded rounded-5 text-nowrap btn-outline-secondary">Add Subject</button>
                                    </div>
                                </div>
                            </div>
                        </div>       
                                ';
                        }
                        ?>
                        <div class="col-md-3">
                            <div class="card border border-secondary">
                                <div id="addNewCourse" class="card-body"><a data-mdb-toggle="modal" href="#exampleModal">
                                        <div class="d-flex flex-column text-secondary mt-1 align-items-center justify-content-center">
                                            <span style="font-size: 3rem;" class="mb-2 material-symbols-outlined">
                                                add_circle
                                            </span>
                                            <h6>Add PlusTwo Stream</h6>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <h3>All Subjects</h3>
                    </div>
                    <div class="row mt-2">
                        <table id="table" class="table w-100 hover align-middle mb-0 bg-white">
                            <thead class="table-white">
                                <tr class="text-nowrap">
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>BelongsTo</th>
                                    <th>Language</th>
                                    <th class=" text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $allSubjects = CollegePortalRepository::getInstance()->getPlustTwoSubjects();
                                $count = 0;
                                foreach ($allSubjects as $subject) {
                                    $badge = "";
                                    $belongsTo = explode(",", $subject['belongsTo']);
                                    foreach ($belongsTo as $streamId) {
                                        $badge .= '<span class="badge badge-primary p-2 me-2">' . CollegePortalRepository::getInstance()->getStreamNameById($streamId) . '</span>';
                                    }
                                    $count++;
                                    $isLanguage = $subject['isLanguage'] == 0 ? "No" : "Yes";
                                    if ($isLanguage == "Yes") $badge = '<span class = "badge badge-secondary p-2">Everyone</span>';
                                    echo '<tr>
                                            <td>' . $count . '</td>
                                            <td>' . $subject['name'] . '</td>
                                            <td>' . $badge . '</td>
                                            <td>' . $isLanguage . '</td>
                                            <td class="text-end"><a isLanguage="' . $isLanguage . '" belongsTo="' . $subject['belongsTo'] . '" type="button" subject-id="' . $subject['id'] . '" old-name="' . $subject['name'] . '" data-mdb-toggle="modal" href="#addSubjectModal" class="btn btn-outline-primary  renameModalBtn me-2">Edit</a><a type="button" class="text-danger" href="#"><span class="material-symbols-outlined">
                                        delete
                                    </span>
</a></td>
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
    <!-- rename modal -->

    <!-- Modal -->
    <div class="modal fade" id="renameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rename</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="updateSubject.php" method="POST">
                        <input type="hidden" name="id" id="id_renameModal">
                        <div class="form-outline">
                            <input type="text" required name="name" id="name_renameModal" class="form-control" />
                            <label class="form-label" for="form12">Name</label>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-mdb-dismiss="modal">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Stream</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insertStream.php" method="POST">
                        <div class="form-outline">
                            <input type="text" required name="name" id="form12" class="form-control" />
                            <label class="form-label" for="form12">Name</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-mdb-dismiss="modal">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="deleteModalTitle"><span class="material-symbols-outlined">
                            warning
                        </span>Confirm Delete</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete <span id="streamNameModal" class="fw-bold">Stream</span> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-primary" data-mdb-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- add subject model -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subjectModalTitle">New Subject</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insertSubject.php" id="addSubjectForm" method="POST">
                        <input type="hidden" name="type" id="actionType" value="insert">
                        <input type="hidden" name="id" id="subjectIdForUpdate">
                        <div class="form-outline">
                            <input type="text" name="name" id="subjectName" class="form-control" />
                            <label class="form-label" for="form12">Name</label>
                        </div>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" id="isLanguageSwitch" name="isLanguage" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" />
                            <label class="form-check-label" for="flexSwitchCheckDefault">Language</label>
                        </div>
                        <div id="belongsToDiv" class=" d-flex align-items-center justify-content-between">
                            <label class=" nowrap" for="select">belongs to</label>
                            <div class="form-outline w-75 mt-2">
                                <select name="belongsTo[]" class="form-select" multiple id="select">
                                    <?php
                                    foreach ($streams as $stream) {
                                        echo '<option value=' . $stream['id'] . '>' . $stream['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-mdb-dismiss="modal">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="../../Core/Script/mdb.min.js"></script>
<script>
    $("#isLanguageSwitch").change(function() {
        if (this.checked == true)
            $("#belongsToDiv").children().hide(250)
        else
            $("#belongsToDiv").children().show(250)
    })
    $(".renameModalBtn").click(function() {
        $("#addSubjectForm")[0].reset()
        $("#subjectModalTitle").text("Update Subject")
        $("#actionType").val("update")
        $("#subjectName").val($(this).attr("old-name"))
        $("#subjectIdForUpdate").val($(this).attr("subject-id"))
        const belongsTo = $(this).attr("belongsTo").split(",")
        if ($(this).attr("isLanguage") == "Yes") {
            $("#isLanguageSwitch").prop("checked", true)
            $("#belongsToDiv").children().hide()
        } else {
            $("#belongsToDiv").children().show()
        } 

        try {
            belongsTo.forEach(v => $("#select").children(`[value=${v}]`).prop("selected", true))
        } catch(e){}

        // .prop("checked",true) 

    })
    $(".editNameBtn").click(function() {
        var nameSpanParent = $(this).parent().parent().children("div").first()
        const oldParent = $(this).parent().parent()
        const oldHtml = oldParent.html();
        if ($(this).text() != "UPDATE IT") {
            const name = nameSpanParent.children("span").text()
            nameSpanParent.children("span").hide()
            nameSpanParent.children("a").hide()
            nameSpanParent.append(`<input type="text" value="${name}" id="form12" class="form-control" />`)
            $(this).text("UPDATE IT")
            const cancelBtn = $(this).siblings("button");
            cancelBtn.html(`
            <div class="d-flex align-items-center gap-2">
                <span class="material-symbols-outlined">
                    cancel
                </span>
                Cancel
            </div> `)
            cancelBtn.click(function() {
                location.reload()
            })
        } else {
            const newName = nameSpanParent.children("input").val()
            location.href = `updateStream.php?id=${$(this).attr("stream-id")}&name=${newName}`

        }

    })
    $(".deleteBtn").click(function() {
        $("#streamNameModal").text($(this).attr("stream-name"))
        $("#confirmDeleteBtn").attr("stream-id", $(this).attr("stream-id"))
    })
    $("#confirmDeleteBtn").click(function() {
        location.href = `deleteStream.php?id=${$(this).attr("stream-id")}`
    })
    $(".addSubjectBtn").click(function() {
        $("#subjectModalTitle").text("New Subject")
        $("#actionType").val("insert")
        $("#addSubjectForm")[0].reset()
        $("#belongsToDiv").children().show()
        if ($(this).text() == "Add Subject") {
            $("#addSubjectModal").modal("show")
            $("#select").children(`[value=${$(this).attr("stream-id")}]`).prop("selected", true)

        }
    })
    $(document).ready(() => {
        $("#table").dataTable({
            "lengthMenu": [
                [3, 10, 20, -1],
                [3, 10, 20, "All"]
            ]
        });

    })
</script>

</html>