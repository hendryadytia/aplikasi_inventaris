<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Image Advertising</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/animation/style.css">
  <style>
  #loginContainer{
  height:600px;
  background-color:grey;
  }
  
  </style>
</head>

<body onload="openEyes()">
  <div class="container" id="loginContainer">
   <img src="<?php echo base_url(); ?>assets/dist/img/logo.png" style="max-width:200px; max-height:200px; margin-left:175px" alt="BILBILWEST">


    <div style="width: 100%">

      <div style="margin: 40px 40px;">
        <?php
        echo form_open('auth/login', array('style' => 'text-align:center;'));
        ?>
        <?php $error = $this->session->flashdata('message_name');
        ?>
        <p align="center" style="color:red;"><?php echo $error; ?></p>
        <input onfocus="openEyes();" onblur="movePupilsToCenter();" name="username" id="username" type="text" placeholder="Username">
      </div>
    </div>
    <div style="margin: 40px 40px;">
      <div style="text-align: center">
        <input onfocus="closeEyes();" onblur="openEyes();" name="password" id="password" type="password" placeholder="Password">
      </div>
    </div>
    <div style="margin: 40px 40px;">
      <div style="text-align: center">
        <button type="submit" name="submit">Login</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  <script rel="script" src="<?php echo base_url() ?>assets/plugins/animation/javascript.js"></script>
</body>

</html>