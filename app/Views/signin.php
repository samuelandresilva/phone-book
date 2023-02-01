<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title><?= lang('General.siteTitle') ?></title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-3 mt-5">

                <h2 class="text-center"><?= lang('General.signin.title') ?></h2>
                <p class="text-center"><?= lang('General.signin.description') ?></p>

                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-warning">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo base_url(); ?>/signin/loginAuth" method="post">
                    <div class="form-group mb-3">
                        <input type="text" name="email" placeholder="<?= lang('General.signin.emailField') ?>" value="<?= set_value('email') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" placeholder="<?= lang('General.signin.passField') ?>" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success"><?= lang('General.signin.signinButton') ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>
