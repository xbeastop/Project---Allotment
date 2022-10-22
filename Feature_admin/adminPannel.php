<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="../Core/Style/style.css">
</head>
<body>
   <h1>Welcom to Admin pannel</h1> 

   <form action="saveCourseDetails.php" method="post">
        <div class="inputField">
            <div class="label">
                Name of program
            </div>
            <input type="text" name="courseName" id="courseName">
        </div>
        <div class="inputField">
            <div class="label">
                No of seats
            </div>
            <input type="text" name="noOfSeats" id="noOfSeats">
        </div>
        <div class="inputField">
            <div class="label">
                Who can appley
            </div>
            <input type="text" name="whoCanAppley" id="whoCanAppley">
        </div>
        <div class="inputField">
            <div class="label">
                Weightage
            </div>
            <input type="text" name="weightage" id="weightage">
        </div>
        <input type="submit" value="submit">
   </form>
</body>
</html>