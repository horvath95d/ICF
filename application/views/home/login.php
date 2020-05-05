<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card my-5">
                <div class="card-body">
                    <h1>Bejelentkezés</h1>
                    <?php if (isset($_SESSION['message'])) :?>
                    <div class="alert alert-info alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fas fa-times fa-xs"></i></a>
                        <?=$_SESSION['message']?>
                    </div>
                    <?php unset($_SESSION['message']); endif; ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="identity">Felhasználónév</label>
                            <input type="text" name="identity" id="identity" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Jelszó</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <?php if ($data['captcha']) :?>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Let0PIUAAAAAIKmcuF8CLe39Sm9YYlX-yj_JixT"></div>
                        </div>
                        <?php endif ?>
                        <button type="submit" class="btn btn-primary w-100">Belépés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>