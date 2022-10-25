<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Rad SOl</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url() ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!-- <link href="<?php echo base_url() ?>assets/css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>  
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Rad O sol</a>
      <ul class="right hide-on-med-and-down">
      <?php if (isset($_SESSION['userlog']) || !empty($_SESSION['userlog'])) { ?>
        <li><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
        <li><a href="<?php echo base_url() ?>categories">Categories</a></li>
        <li><a  class="logout">Logout</a></li>
        <?php } else { ?>
          <li><a href="<?php echo base_url() ?>logIn">Log in</a></li>
        <li><a href="<?php echo base_url() ?>signUp">Sign up</a></li>
          <?php } ?>
      </ul>
      <ul id="nav-mobile" class="sidenav">
        <li><a href="#">Sign up</a></li>
        <li><a href="#">Login</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>