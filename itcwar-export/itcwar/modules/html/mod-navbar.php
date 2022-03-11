
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>-->

    <div id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
            <li class="nav-item me-2">
                <a class="nav-link <?=($current_page === "index" ? "active" : "")?>" href="./">Stories</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link <?=($current_page === "add" ? "active" : "")?>" href="./your-story.php">Share your story</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link <?=($current_page === "about" ? "active" : "")?>" href="./about.php">About this project</a>
            </li>

            <?php if(LoggedIn()) { ?>
            <li class="nav-item me-2">
                <a class="nav-link" <?=($current_page === "admin" ? "active" : "")?>" href="./admin.php">Admin page</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="./disconnect.php">Disconnect</a>
            </li>
            <?php } ?>
        </ul>

    </div>
  </div>
</nav>
<div id = "error-div">
<?php
ShowAlert();
?>
</div>