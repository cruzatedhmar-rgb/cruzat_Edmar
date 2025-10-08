<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e8f5e8; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card-box { background: white; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); padding: 2rem; width: 100%; max-width: 420px; }
        .title { color: #2d5a2d; font-weight: 700; text-align: center; margin-bottom: 1rem; }
        .btn-submit { background-color: #2d5a2d; border: none; border-radius: 10px; padding: 12px; width: 100%; color: #fff; font-weight: 600; }
        .btn-submit:hover { background-color: #1e3f1e; }
        .back-link { text-align: center; margin-top: 1rem; }
        .back-link a { color: #2d5a2d; text-decoration: none; font-weight: 600; }
        .alert { border-radius: 10px; }
    </style>
    </head>
<body>
    <div class="card-box">
        <h2 class="title">Reset Password</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= html_escape($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/reset-password/' . html_escape($token)); ?>" method="post">
            <div class="mb-3">
                <label class="form-label">New password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter new password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
            </div>
            <button type="submit" class="btn btn-submit">Reset password</button>
        </form>

        <div class="back-link">
            <a href="<?= site_url('auth/login'); ?>">Back to login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


