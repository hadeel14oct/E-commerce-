  
  <nav class="navbar navbar-expand-lg bg-body-tertiary  " style="background-color: #3498db" data-bs-theme="dark" >
  <div class="container">
    <a class="navbar-brand" href="#">Navbar</a>
          <a class="nav-link active brand" aria-current="page" href="#">home</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active " aria-current="page" href="#"><?php echo lang("cat")?> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="members.php">members</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="#">items</a>
        </li> <li class="nav-item">
          <a class="nav-link" href="#">statistcs</a>
        </li> <li class="nav-item">
          <a class="nav-link" href="#">logs</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION["username"]?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="members.php?do=edit&id=<?php echo $_SESSION['id']?>">Edit Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="logout.php">logout</a></li>
          </ul>
        </li>
      
      </ul>
     
    </div>
  </div>
</nav>