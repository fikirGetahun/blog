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
  <form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="POST" >
    
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
      <label for="floatingInput">User name</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <!-- <input type="checkbox" value="remember-me"> Remember me -->
      </label>
    </div>
      <input class="btn btn-lg btn-primary" type="submit" value="Sign In">
    <div>
      <a href="forgetPassword.php?forget=true" ><p>Forgat Password?</p></a>
    <?php
    require_once('includes/header.php');
    require_once('php/auth.php');


    if(isset($_POST['username'], $_POST['password'])){
        $us = $_POST['username'];
        $pa = $_POST['password'];
        $check = $auth->loginAuth($us);
      
        if($check->num_rows == 0){
            echo 'Wrong User Name';
            $login = 'NOT_USER';

        }elseif($check->num_rows > 0){
          $row = $check->fetch_assoc();  
          // echo $pa;
          // echo $row['password'];
            $f = $row['password'];
                if($pa == $f){
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['firstName'].' '.$row['lastName'];
                    $_SESSION['fname'] = $row['firstName'];
                    $_SESSION['lname'] = $row['lastName'];
                    $_SESSION['auth'] = $row['auth'];
                    $_SESSION['photo'] = $row['photoPath1'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['username'] = $us;
                    $_SESSION['lastLogedIn'] = $row['lastLogedIn'];
                    $_SESSION['reg'] = $row['registerdDate'];
                    $_SESSION['password'] = $pa;
                    
                    header('Location: admin.php');
                }else{
                  echo 'Password Incorrect';
                }

            

        }
        
    }
?>
    <p class="mt-5 mb-3 text-muted">&copy; Chengity</p>
  </form>
</main>


    
  </body>
</html>
