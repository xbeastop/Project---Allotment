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
                                    <span class="material-symbols-outlined text-danger">
                                        delete
                                    </span>
                                </div>
                                    
                                    <hr>
                                    <div class=" d-flex justify-content-between">
                                        <button type="button" class="btn btn-sm rounded me-3 rounded-5 btn-primary">Edit Name</button>
                                        <button type="button" class="btn btn-sm rounded rounded-5 btn-outline-secondary">Add Subject</button>
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
                                            <h6>Add new stream</h6>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>



    </section>
    <script src="scripts.js"></script>
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
                            <input type="text" name="name" id="form12" class="form-control" />
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

</body>
<script src="../../Core/Script/mdb.min.js"></script>

</html>