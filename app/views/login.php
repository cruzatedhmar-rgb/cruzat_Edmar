<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #E8F5E9, #C8E6C9);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid #C8E6C9;
      box-shadow: 0 10px 25px rgba(0, 128, 0, 0.1);
      padding: 2rem;
      width: 100%;
      max-width: 420px;
    }

    .login-title {
      color: #2E7D32;
      font-weight: 700;
      font-size: 2rem;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    .form-control,
    .form-select {
      border: 2px solid #A5D6A7;
      border-radius: 10px;
      background-color: #F1F8F1;
      padding: 12px 15px;
      font-size: 1rem;
      transition: 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #388E3C;
      background-color: #ffffff;
      box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.25);
    }

    .btn-login {
      background-color: #388E3C;
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 1.1rem;
      font-weight: 600;
      width: 100%;
      box-shadow: 0 6px 18px rgba(56, 142, 60, 0.3);
      transition: all 0.25s ease;
    }

    .btn-login:hover {
      background-color: #2E7D32;
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(56, 142, 60, 0.4);
    }

    .register-link {
      text-align: center;
      margin-top: 1rem;
      color: #666;
    }

    .register-link a {
      color: #2E7D32;
      font-weight: 600;
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
      color: #1B5E20;
    }

    .alert {
      border-radius: 10px;
      border: 1px solid #C8E6C9;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2 class="login-title">Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger" role="alert">
        <?= html_escape($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <form action="<?= site_url('auth/login'); ?>" method="post">
      <div class="form-group">
        <label class="form-label">Role</label>
        <select class="form-select" name="role" required>
          <option value="" selected disabled>Select</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>

      <button type="submit" class="btn btn-login">Login</button>
    </form>

    <div class="register-link">
      <a href="<?= site_url('auth/forgot-password'); ?>">Forgot password?</a>
    </div>

    <div class="register-link">
      Don't have an account? <a href="<?= site_url('auth/register'); ?>">Register</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
