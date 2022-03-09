<?php

include "includes/nav.php";

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Form Elements</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Forms</li>
        <li class="breadcrumb-item active">Elements</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Write A blog</h5>

            <!-- General Form Elements -->
            <form action="blogPoster.php" method="POST" enctype="multipart/form-data" >
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" name="title" class="form-control">
                </div>
              </div>                
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                  <input class="form-control" required type="file" name="photo[]" id="formFile"  multiple  >
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="height: 100px" name="content" ></textarea>
                </div>
              </div>

              <input class="btn btn-lg btn-primary" type="submit" value="Post Blog">


              <?php 
              if(!isset($_SESSION['id'])){
                echo 'yes';
              }

                require_once "./php/adminCrude.php";
                if(isset($_POST['title'], $_POST['content'], $_FILES['photo'])){
                  // echo 'in';
                  $title = $_POST['title'];
                  $content = $_POST['content'];
                  $pid = $_SESSION['id'];
                  // echo 'user d--'.$pid;
                  $fileVar = $_FILES['photo'];

                  $up = $admin->uploadPhotos('blog', $fileVar);
                  if($up[4] == 'work'){
                    $out = $admin->blogAdder($title, $content, $pid, $up[0]);
                    if($out){
                      echo 'Blog Posted';
                    }else{
                      echo 'ERROR';
                    }
                  }

                }
              
              
              ?>

            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>

    </div>
  </section>

</main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Changity</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://keneandigitaltechnology.com/">Kenean digital technology</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>