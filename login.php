<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:html/index.html");
}
include("koneksi.php");
$username = "";
$password = "";
$gagal = "";
if (isset($_POST['login'])) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    if ($username == '' or $password == '') {
        $gagal .= "<li>Silakan masukkan username dan password</li>";
    }
    if (empty($gagal)) {
        $_SESSION['username'] = $username;
        $_SESSION['admin_akses'] = $akses;
        header("location:login.php");
        exit();
    }
    if (empty($gagal)) {
        $sql1 = "select * from login where username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if ($r1['password'] != $password) {
            $gagal .= "<li>Akun tidak ditemukan</li>";
        }
    }
    if (empty($gagal)) {
        $login_id = $r1['login_id'];
        $sql1 = "select * from admin_akses where login_id = '$login_id'";
        $q1 = mysqli_query($koneksi, $sql1);
        while ($r1 = mysqli_fetch_array($q1)) {
            $akses[] = $r1['akses_id']; //spp, guru, siswa
        }
        if (empty($akses)) {
            $gagal .= "<li>Kamu tidak punya akses ke halaman admin</li>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIGILIB TELKOM | Login</title>
    <link rel="icon" type="image/x-icon" href="./img/logo-notext.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/login.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <script src="./js/jquery-3.6.4.js"></script>
    <script>
        $(function () {
            $("i.bx").click(function () {
                $(this).toggleClass('bx-hide bx-show');
                if ($("input#password").attr('type') === 'text') {
                  $("input#password").attr('type', 'password');
                } else if ($("input#password").attr('type') === 'password') {
                  $("input#password").attr('type', 'text');
                };
            });
        });
    </script>
    
</head>

<body>
    <?php
        if ($gagal) {
            echo "<ul>$gagal</ul>";
        }
    ?>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="https://main.polines.ac.id/id/" target="blank" class="app-brand-link gap-2">
                    <span class="app-brand-logo"><img src="./img/logo-text.png" alt=""></span>
                    <span class="app-brand-logo polines"><img src="./img/polines.png" alt=""></span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Selamat Datang.. &#128075;&#127995;</h4>
              <p class="mb-4">Tolong masuk ke akun anda terlebih dahulu !</p>

              <form id="formAuthentication" class="mb-3" action="" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Username</label>
                  <input
                    type="text"
                    value="<?php echo $username ?>"
                    class="form-control"
                    id="email"
                    name="username"
                    placeholder="Masukkan NIP / NIK"
                    autofocus 
                    required
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <!-- <a href="auth-forgot-password-basic.html">
                      <small>Forgot Password?</small>
                    </a> -->
                  </div>
                <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      autofocus
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <!-- <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div> -->
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit" name="login">Masuk</button>
                </div>
              </form>

              <p class="text-center">
                <span>Beberapa laporan membolehkan akses tamu</span>
                <a href="tamu.html">
                  <span>Masuk Sebagai Tamu</span>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>