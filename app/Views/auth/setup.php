<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | Puihaha Electric</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="card border-0 shadow-sm mx-auto" style="max-width: 560px;">
            <div class="card-body p-4 p-md-5">
                <h1 class="h3 text-primary mb-2">Puihaha Electric Setup</h1>
                <p class="text-muted">Create the first administrator account for this computer. This page automatically closes after an account is created.</p>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger"><ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $error): ?><li><?= esc($error) ?></li><?php endforeach ?></ul></div>
                <?php endif ?>

                <form action="<?= site_url('setup') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3"><label class="form-label" for="full_name">Full Name</label><input class="form-control" id="full_name" name="full_name" value="<?= old('full_name') ?>" required></div>
                    <div class="mb-3"><label class="form-label" for="username">Username</label><input class="form-control" id="username" name="username" value="<?= old('username') ?>" required></div>
                    <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" type="password" id="password" name="password" minlength="8" required></div>
                    <div class="mb-4"><label class="form-label" for="confirm_password">Confirm Password</label><input class="form-control" type="password" id="confirm_password" name="confirm_password" minlength="8" required></div>
                    <button class="btn btn-primary w-100" type="submit">Create Administrator</button>
                </form>
                <a class="btn btn-link w-100 mt-2" href="<?= site_url('/') ?>">Back to Main Website</a>
            </div>
        </div>
    </main>
</body>
</html>
