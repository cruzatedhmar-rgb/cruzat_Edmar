<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#e8f5e8; display:flex; align-items:center; justify-content:center; min-height:100vh;">
    <div class="card" style="padding:2rem; width:100%; max-width:420px;">
        <h3 style="color:#2d5a2d; text-align:center; margin-bottom:1rem;">Reset Password</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= html_escape($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= html_escape($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form action="<?= site_url('auth/reset_password'); ?>" method="post">
            <input type="hidden" name="token" value="<?= html_escape($token ?? ''); ?>">
            <div class="mb-3">
                <label for="password" class="form-label">New password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Reset password</button>
        </form>

        <div style="text-align:center; margin-top:12px;">
            <a href="<?= site_url('auth/login'); ?>">Back to login</a>
        </div>
    </div>
</body>
</html>