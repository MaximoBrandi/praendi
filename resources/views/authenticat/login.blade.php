<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">
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

  <script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js"></script>

  <link rel="stylesheet" href="/assets/css/magnific-popup.css">
  <style>
    .preloader{background-color:#f7f7f7;width:100%;height:100%;position:fixed;top:0;left:0;right:0;bottom:0;z-index:999999;-webkit-transition:.6s;-o-transition:.6s;transition:.6s;margin:0 auto}.preloader .preloader-circle{width:100px;height:100px;position:relative;border-style:solid;border-width:1px;border-top-color:#ff2143;border-bottom-color:transparent;border-left-color:transparent;border-right-color:transparent;z-index:10;border-radius:50%;-webkit-box-shadow:0 1px 5px 0 rgba(35,181,185,0.15);box-shadow:0 1px 5px 0 rgba(35,181,185,0.15);background-color:#ffffff;-webkit-animation:zoom 2000ms infinite ease;animation:zoom 2000ms infinite ease;-webkit-transition:.6s;-o-transition:.6s;transition:.6s}.preloader .preloader-circle2{border-top-color:#0078ff}.preloader .preloader-img{position:absolute;top:50%;z-index:200;left:0;right:0;margin:0 auto;text-align:center;display:inline-block;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);padding-top:6px;-webkit-transition:.6s;-o-transition:.6s;transition:.6s}.preloader .preloader-img img{max-width:55px}.preloader .pere-text strong{font-weight:800;color:#dca73a;text-transform:uppercase}@-webkit-keyframes zoom{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg);-webkit-transition:.6s;-o-transition:.6s;transition:.6s}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg);-webkit-transition:.6s;-o-transition:.6s;transition:.6s}}@keyframes zoom{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg);-webkit-transition:.6s;-o-transition:.6s;transition:.6s}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg);-webkit-transition:.6s;-o-transition:.6s;transition:.6s}}
  </style>

  <script>
    async function web3Login() {
        if (!window.ethereum) {
            alert('MetaMask not detected. Please install MetaMask first.');
            return;
        }

        const provider = new ethers.providers.Web3Provider(window.ethereum);

        let response = await fetch('/web3-login-message');
        const message = await response.text();

        await provider.send("eth_requestAccounts", []);
        const address = await provider.getSigner().getAddress();
        const signature = await provider.getSigner().signMessage(message);

        response = await fetch('/web3-login-verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'address': address,
                'signature': signature,
                '_token': '{{ csrf_token() }}'
            })
        });
        const data = await response.text();

        if (data) {
            location.href='/'
        }
    }
</script>
</head>

<body class="bg-gray-200">

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
            <nav style="background-color: rgba(0, 0, 0, 0.4) !important;" class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-12 mx-4">
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
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center">
                    <button onclick="web3Login();" type="button" class="btn bg-gradient-primary w-100 my-4 mb-2">Login with Metamask</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start"><script>
                  document.write(new Date().getFullYear())
                </script>
                <a href="{{route('index')}}" class="font-weight-bold text-white">Prændi™</a></div>
            </div>
            <div class="col-12 col-md-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="{{route('about')}}" class="nav-link text-white">Prændi</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('terms')}}" class="nav-link text-white">Terms and conditions</a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
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
