<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Praendi
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />

  <link rel="stylesheet" href="/assets/css/magnific-popup.css">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="">

    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="/assets/img/logo/LogoA80.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
          <div class="col-12">
            <!-- Navbar -->
            <nav  class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-12 end-0 mx-4">
              <div class="container-fluid ps-2 pe-0">
                        <!-- Logo -->
                        <div class="col-xl-3 col-lg-3 col-md-3 d-none d-md-block">
                            <div class="logo">
                                <a href="/"><img src="/assets/img/logo/Logo40.png" alt=""></a>
                            </div>
                        </div>
                        <!-- Ad -->
                        <!-- <div class="col-xl-9 col-lg-9 col-md-9">
                            <div class="header-banner f-right ">
                                <img src="/assets/img/gallery/header_card.png" alt="">
                            </div>
                        </div> -->
              </div>
            </nav>
            <!-- End Navbar -->
          </div>
        </div>
      </div>

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Welcome!</h4>
                  <p class="mb-0">Create your new profile so everyone could know you better</p>
                </div>
                <div class="card-body">
                  <form enctype="multipart/form-data" method="post" action="{{ route('profile')}}" role="form">
                    @csrf
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Username</label>
                      <input name="name" type="text" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <textarea name="bio" placeholder="Biography" type="text" class="form-control"></textarea>
                    </div>
                    <div class="input-group">
                        <label>Upload a profile photo</label>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <input name="photo" type="file" class="form-control">
                    </div>
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Community rules</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <input type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" value="Continue">
                    </div>
                  </form>

                    @isset($errors)
                        @php
                            foreach ($errors->all() as $message) {echo $message;}
                        @endphp
                    @endisset
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>

  <script src="/assets/js/vendor/jquery-1.12.4.min.js"></script>
  <script src="/assets/js/slick.min.js"></script>

  <script src="/assets/js/wow.min.js"></script>
  <script src="/assets/js/animated.headline.js"></script>
  <script src="/assets/js/jquery.magnific-popup.js"></script>
  <script src="/assets/js/main.js"></script>
</body>

</html>
