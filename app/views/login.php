<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --bg-1: #eef2ff; /* light indigo */
      --bg-2: #e0e7ff; /* soft periwinkle */
      --card-bg: #ffffff;
      --accent: #6d28d9; /* purple-700 */
      --accent-2: #4f46e5; /* indigo-600 */
      --muted: #6b7280;
    }

    body {
      background: linear-gradient(135deg, var(--bg-1), var(--bg-2));
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      -webkit-font-smoothing: antialiased;
    }

    .login-card {
      background: var(--card-bg);
      border-radius: 16px;
      border: 1px solid rgba(79,70,229,0.08);
      box-shadow: 0 12px 30px rgba(79,70,229,0.08);
      padding: 2rem;
      width: 100%;
      max-width: 420px;
    }

    .login-title {
      color: var(--accent);
      font-weight: 700;
      font-size: 2rem;
      text-align: center;
      margin-bottom: 1.25rem;
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    .form-control,
    .form-select {
      border: 2px solid rgba(79,70,229,0.12);
      border-radius: 10px;
      background-color: #fbfbff;
      padding: 12px 15px;
      font-size: 1rem;
      transition: 0.2s;
      color: #0f172a;
    }

    .form-control::placeholder { color: #94a3b8; }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--accent-2);
      background-color: #ffffff;
      box-shadow: 0 0 0 0.2rem rgba(79,70,229,0.12);
      outline: none;
    }

    .btn-login {
      background: linear-gradient(90deg, var(--accent-2), var(--accent));
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 1.05rem;
      font-weight: 600;
      width: 100%;
      box-shadow: 0 8px 22px rgba(79,70,229,0.18);
      transition: all 0.25s ease;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(79,70,229,0.22);
    }

    .register-link {
      text-align: center;
      margin-top: 1rem;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .register-link a {
      color: var(--accent-2);
      font-weight: 600;
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
      color: var(--accent);
    }

    .alert {
      border-radius: 10px;
      border: 1px solid rgba(79,70,229,0.06);
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
