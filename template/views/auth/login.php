<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="robots" content="index, follow"/>

    <!-- Facebook -->
    <meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:locale" content="pt_BR"/>

    <!-- Twitter -->
    <meta name="twitter:title" content=""/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>

    <link rel="stylesheet" href="<?= asset('css/app.min.css') ?>"/>
    <link rel="stylesheet" href="<?= asset('css/toastr.min.css') ?>"/>

    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    <script src="<?= asset('js/toastr.min.js') ?>"></script>

    <?= ie_support_field() ?>

    <!-- JSON LD -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org"

        }
    </script>

    <title>HTML Base</title>
</head>
<body>

<?php if(isset($errors) && $errors != null):
    foreach($errors as $error): ?>
        <script>
            toastr.warning("<?= trim($error) ?>", 'Dados incorretos!');
        </script>
    <?php endforeach;
endif; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?= route('login/authenticable') ?>">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value=""/> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= csrf_field() ?>
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a class="btn btn-link" href="#">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="<?= asset('js/app.min.js') ?>"></script>
</html>