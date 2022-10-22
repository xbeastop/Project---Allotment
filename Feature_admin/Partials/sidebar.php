<?php
 session_start();
 if(!isset($_SESSION['adminId'])){
    header("location: http://allotment/index.php");
    die();
 }
?>
<style>
  #log_out{
    cursor: pointer;
  }
</style>
<div class="sidebar open">
  <script>
    if ($(window).width() < 960) {
      $('.sidebar').removeClass("open");
    }
  </script>
  <div class="logo-details">
    <div class="logo_name">Allotment System</div>
    <span id="btn" class="material-symbols-outlined">
      menu
    </span>
  </div>
  <ul class="nav-list p-0">
    <li>
      <a id="dashboard" href="../Dashboard/index.php">
        <span class="material-symbols-outlined">
          dashboard
        </span>
        <span class="links_name">Dashboard</span>
      </a>
      <span class="tooltip">Dashboard</span>
    </li>
    <li>
      <a id="request" href="../Request/index.php">
        <span class="material-symbols-outlined">
          groups
        </span>
        <span class="links_name">Pending Request</span>
      </a>
      <span class="tooltip">Pending Request</span>
    </li>
    <li>
      <a id="verified" href="../Verified/index.php">
        <span class="material-symbols-outlined">
          verified
        </span>
        <span class="links_name">Verified Students</span>
      </a>
      <span class="tooltip">Verified Students</span>
    </li>
    <li>
      <a id="course" href="../Course/index.php">
        <span class="material-symbols-outlined">
          save_as
        </span>
        <span class="links_name">Create Course</span>
      </a>
      <span class="tooltip">Create Course</span>
    </li>
    <hr class="my-4">
    <li>
      <a id="course" href="../Course/index.php">
        <span class="material-symbols-outlined">settings</span>
        <span class="links_name">PlusTwo Settings</span>
      </a>
      <span class="tooltip">PlusTwo Settings</span>
    </li>
    <li class="profile">
      <div class="profile-details">
        <!--<img src="profile.jpg" alt="profileImg">-->
        <div class="name_job">
          <div class="name"><?php echo $_SESSION['name']?></div>
          <div class="job">Log out</div>
        </div>
      </div>
      <span id="log_out" class="material-symbols-outlined">
        logout
      </span>
    </li>
</div>


</li>
</ul>
</div>
<script>
  function adjustSideBar() {
    if ($(window).width() < 960) {
      $('.sidebar').removeClass("open");
    }
  }
  $(window).resize(adjustSideBar);
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
  });

  $("#log_out").on("click",()=>{
    if(window.confirm("Are you sure you want to log out?"))
     location.href = "../Login/logout.php";
  })
</script>