<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e8f5e8; display:flex; align-items:center; justify-content:center; min-height:100vh; }
        .card { padding:2rem; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.08); background:#fff; width:100%; max-width:420px; }
        .btn-primary { background:#2d5a2d; border:none; }
    </style>
</head>
<body>
    <div class="card">
        <h3 style="color:#2d5a2d; text-align:center; margin-bottom:1rem;">Forgot Password</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= html_escape($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= html_escape($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form action="<?= site_url('auth/forgot_password'); ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Enter your account email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Send reset link</button>
        </form>

        <div style="text-align:center; margin-top:12px;">
            <a href="<?= site_url('auth/login'); ?>">Back to login</a>
        </div>
    </div>
</body>
</html>