<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Завдання та проекти | Реєстрація нового користувача</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="static/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="static/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="static/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="index.php" class="h1">Завдання та проекти</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Зареєструватися</p>

            <form action="register.php" method="post">
                <div class="input-group mb-3">
                    <input type="text"  required name="name-register" placeholder="Повне ім'я" class="form-control
            <?=!empty($errors['name-register']) ? ' is-invalid' : ''?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <?=!empty($errors['name-register']) ?
                        '<span id="Name-error" class="error invalid-feedback">' .
                        htmlspecialchars($errors['name-register']) . '</span>' : ''?>
                </div>
                <div class="input-group mb-3">
                    <input type="email"  required name="email-register" placeholder="Email" class="form-control
            <?=!empty($errors['email-register']) ? ' is-invalid' : ''?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <?=!empty($errors['email-register']) ?
                        '<span id="Name-error" class="error invalid-feedback">' .
                        htmlspecialchars($errors['email-register']) . '</span>' : ''?>
                </div>
                <div class="input-group mb-3">
                    <input type="password" required name="password1" placeholder="Пароль" class="form-control
            <?=!empty($errors['password1']) ? ' is-invalid' : ''?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?=!empty($errors['password1']) ?
                        '<span id="Name-error" class="error invalid-feedback">' .
                        htmlspecialchars($errors['password1']) . '</span>' : ''?>
                </div>
                <div class="input-group mb-3">
                    <input type="password" required name="password2" placeholder="Повторіть пароль" class="form-control
            <?=!empty($errors['password2']) ? ' is-invalid' : ''?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?=!empty($errors['password2']) ?
                        '<span id="Name-error" class="error invalid-feedback">' .
                        htmlspecialchars($errors['password2']) . '</span>' : ''?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="icheck-primary<?=!empty($errors['terms-check']) ? ' is-invalid' : ''?>">
                            <input name="terms-check" type="checkbox" id="agreeTerms" value="agree">
                            <label for="agreeTerms">
                                Я згоден(а) з <a href="#">умовами</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-8 offset-2">
                        <button type="submit" name="btn-add-reg" class="btn btn-primary btn-block">Зареєструватися</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="login.html" class="text-center">В мене вже є аккаунт</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>
