
<style type="text/css">
  html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
<?php


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
  </head>

  <body class="text-center">
    
<main class="form-signin">
<?php
    require_once('includes/header.php');
    require_once('php/auth.php');
require_once "php/adminCrude.php";

    //// to trigger the forget password then to present the username and recover input field
    if(isset($_GET['forget'])){
      
      ?>
      <h5>Enter Your Username here. so that we will Send your password to your email.</h5>
      <form action="forgetPassword.php" method="POST">
      <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
      <label for="floatingInput">User name</label>
      
      </div>

      <div id="registerBox">
    <label for="exampleInputEmail1">Password Recovery Keyword</label>
          <input type="email" class="form-control" id="username" 
           name="recover" placeholder="Username">
          <small id="emailHelp" class="form-text text-muted">This here is a key word you have to remember your password when you forget it.</small>
    </div>

    <input type="submit" value="Submit">
      </form>
      <?php
    }


    /////// after user inputs the forgat password field the next step presented by this blok
    if(isset($_POST['username'], $_POST['recover'])){
      $us2 = $_POST['username']; 
      $recover = $_POST['recover'];
      $check = $auth->loginAuth($us2);
      $urow3 = $check->fetch_assoc();
      if($check->num_rows == 0){
          echo 'USERNAME DOESNOT EXIST';
      }elseif($urow3['recover'] == $recover){ //if the recover keyword match
        $uid = $urow3['id'];
        ?>
        <form action="forgetPassword.php" method="POST">
        <input type="text" hidden name="upid" value="<?php echo $uid ?>">
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="r" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <input type="submit" value="Change Password">

      </form>
        
        
        
        <?php
      }elseif($urow3['recover'] != $recover){ /// if the recover keyword dont match
        echo 'Sorry Your Password Recover Keyword Does not Match!';
      }
    }

    //////////// to update the password if it matched the recover keyword
    if(isset($_POST['r'], $_POST['upid'])){
    $hx= $_POST['upid'];
      $pzx = $_POST['r'];
      $puz = $admin->password($pzx,$hx);
      
      if($puz){
        //   echo $h;
        // echo 'this --'.$puz;
        echo 'PASSWORD CHANGED';
        ?>
        <a href="admin.php">Login</a>
        
        <?php
      }else{
        echo 'ERROR';
      }
    }

?>
    </div>
</main>
  </body>