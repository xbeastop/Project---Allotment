<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Core/Style/mdb.min.css">
    <script defer src="../Core/Script/mdb.min.js"></script>
</head>

<body>
    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $appNum = $_POST['applicationNumber'];
            require_once "../Core/Data/Repository/collegePortalRepository.php";
            if ($info = CollegePortalRepository::getInstance()->getAllotmentInfo($appNum)) {
                echo '
                <div class=" top-0 position-absolute start-0 w-100">
            <div class="alert alert-success">Congratulations, you have been alloted to '.$info.'. Please contact your college for more information</div>
            </div>
                ';
            } else {
                echo '
                <div class=" top-0 position-absolute start-0 w-100">
            <div class="alert alert-warning">couln\'t find your result</div>
            </div>
                ';
            }
        }
        ?>

        <div style="height: 90vh;" class="row d-flex align-items-center justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-title m-0">
                        <h3 class="p-3">Check Allotment Status</h3>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="form-outline">
                                <input type="text" name="applicationNumber" id="applicationNumber" class="form-control"></input>
                                <label for="applicationNumber" class="form-label">Application Number</label>
                            </div>

                    </div>
                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary">Check</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

</html>