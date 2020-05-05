<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?=URL?>assets/img/logo.png" type="image/icon">
    <title><?=SITE_NAME?></title>

    <!-- Bootstrap, fontawesome, CSS -->
    <link rel="stylesheet" href="<?=URL?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=URL?>assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?=URL?>assets/css/style.css">

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

<header>
    <nav class="navbar bg-primary">
        <div class="container">
            <a href="<?=URL?>" class="nav-link btn btn-outline-light"><i class="fas fa-home mr-2"></i>HOME</a>
            <?php
                if (isset($data['user'])) {                
                    foreach ($data['groups'] as $group) {
                        if ($group['id'] == 1) {
                            echo '<a href="'.URL.'admin" class="nav-link btn btn-outline-light">Admin</a>';
                            echo '<a href="'.URL.'editor" class="nav-link btn btn-outline-light">Szerkesztő</a>';
                            echo '<a href="'.URL.'user" class="nav-link btn btn-outline-light">Felhasználó</a>';
                            break;

                        } else if ($group['id'] == 2)
                            echo '<a href="'.URL.'editor" class="nav-link btn btn-outline-light">Szerkesztő</a>';
                        else if ($group['id'] == 3)
                           echo '<a href="'.URL.'user" class="nav-link btn btn-outline-light">Felhasználó</a>';
                    }
                echo '<a href="'.URL.'logout" class="nav-link btn btn-outline-light">Kilépés</a>';
            } ?>
        </div>
    </nav>
</header>