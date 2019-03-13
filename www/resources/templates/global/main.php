<!DOCTYPE html>
<html>
   <head>
      <title><?php echo SITETITLE . ' - ' . $this->e($title);?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="apple-touch-icon" sizes="57x57" href="resources/favicons/apple-icon-57x57.png">
	  <link rel="apple-touch-icon" sizes="60x60" href="resources/favicons/apple-icon-60x60.png">
	  <link rel="apple-touch-icon" sizes="72x72" href="resources/favicons/apple-icon-72x72.png">
	  <link rel="apple-touch-icon" sizes="76x76" href="resources/favicons/apple-icon-76x76.png">
	  <link rel="apple-touch-icon" sizes="114x114" href="resources/favicons/apple-icon-114x114.png">
	  <link rel="apple-touch-icon" sizes="120x120" href="resources/favicons/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="resources/favicons/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="resources/favicons/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="resources/favicons/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="resources/favicons/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="resources/favicons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="resources/favicons/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="resources/favicons/favicon-16x16.png">
      <link rel="manifest" href="resources/favicons/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="resources/css/main.css">
       <?php
       if ($url === 'create') {
       ?>
       <link href="vendor/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
       <script src="vendor/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
       <script src="vendor/jquery-ui-1.12.1/jquery-ui.js"></script>
       <script src="vendor/touch-punch/jquery.ui.touch-punch.min.js"></script>
       <script src="resources/javascript/create_formation.js"></script>
       <?php
       }
       if ($url === 'register') {
       ?>
       <link href="resources/css/register-form.css" rel="stylesheet">
       <script src="vendor/zxcvbn/zxcvbn.js"></script>
       <script src="resources/javascript/register_form.js"></script>
       <?php
       }
       ?>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   </head>
   <body>
      <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
                     <a class="navbar-brand" href="index.php">
                <img src="resources/favicons/favicon-32x32.png" width="32" height="32" class="d-inline-block align-top" alt="<?php echo $this->e($sitetitle);?> Logo">
                <?php echo $this->e($sitetitle);?>
              </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNav">
               <ul class="navbar-nav ml-auto">
                   <?php
                   $pages = array('index', 'create', 'search', 'login', 'register');
                   $active = array('', '', '', '', '', '');
                   $sr = array('', '', '', '', '', '');
                   $pageIndex = (array_search($url, $pages) === false) ? sizeof($pages) + 1 : array_search($url, $pages);
                   $active[$pageIndex] = 'active';
                   $sr[$pageIndex] = '<span class="sr-only">(current)</span>';
                   ?>
                  <li class="nav-item <?php echo $active[0]; ?>">
                     <a class="nav-link" href="index.php">Home <?php echo $sr[0]; ?></a>
                  </li>
                  <li class="nav-item <?php echo $active[1]; ?>">
                     <a class="nav-link" href="create.php">Create LineUp <?php echo $sr[1]; ?></a>
                  </li>
                  <li class="nav-item <?php echo $active[2]; ?>">
                     <a class="nav-link" href="search.php">Search <?php echo $sr[2]; ?></a>
                  </li>
                   <?php
                   if (isset($_SESSION['nickname'])) {
                   ?>
                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?php echo $this->e($_SESSION['nickname']); ?>
                       </a>
                       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                           <a class="dropdown-item" href="user.php?name=<?php echo urlencode($this->e($_SESSION['nickname'])); ?>">View my profile</a>
                           <a class="dropdown-item" href="#">Edit my profile</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="logout.php">Logout</a>
                       </div>
                   </li>
                   <?php
                   } else {
                   ?>
                   <li class="nav-item <?php echo $active[3]; ?>">
                       <a class="nav-link" href="login.php">Login <?php echo $sr[3]; ?></a>
                   </li>
                   <li class="nav-item <?php echo $active[4]; ?>">
                       <a class="nav-link" href="register.php">Register <?php echo $sr[4]; ?></a>
                   </li>
                   <?php
                   }
                   ?>
               </ul>
            </div>
         </nav>
         <div class="content">
            <h1><?php echo $this->e($title);?></h1>
            <?php echo $this->section('content');?>
         </div>
      </div>
   </body>
</html>

