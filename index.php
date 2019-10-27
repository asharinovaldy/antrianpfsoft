<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/bootstrap.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1&display=swap" rel="stylesheet">
    <script>
        window.history.forward();

        function noBack() {
            window.history.forward();
        }
    </script>
</head>


<body>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card o-hidden border-0 shadow-lg my-5 rounded-pill">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b> Silahkan Login </b> dengan Cara <b> Memasukkan Nomor BPJS, Nomor Rekam Medis </b> atau <b>Nomor KTP</b> Anda. </h1>
                                    </div>
                                    <form class="user" action="pages/proses-login.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="bpjs" name="bpjs" placeholder="Masukkan Nomor BPJS, No Rekam Medis atau Nomor KTP"><span id="pesan"></span>
                                        </div>
                                        <!-- <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="rekam_medis" name="rekam_medis" placeholder="Masukkan Nomor Rekam Medis (JIKA ADA)"><span id="pesan"></span>
                                        </div> -->
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="pass" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script src="asset/js/script.js"></script>

</body>

</html>