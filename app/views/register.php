<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* 🌈 Background */
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
      padding: 1rem;
    }

    /* 💎 Glassmorphism Card */
    .register-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      padding: 2.5rem;
      width: 100%;
      max-width: 470px;
      color: #fff;
    }

    /* 🧾 Title */
    .register-title {
      font-weight: 700;
      font-size: 2.2rem;
      text-align: center;
      margin-bottom: 1.5rem;
      color: #fff;
      text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    /* 📋 Inputs */
    .form-group {
      margin-bottom: 1.3rem;
    }

    .form-control,
    .form-select {
      border: none;
      border-radius: 12px;
      padding: 12px 16px;
      font-size: 1rem;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: #e3e3e3;
    }

    .form-control:focus,
    .form-select:focus {
      background: rgba(255, 255, 255, 0.3);
      border-color: transparent;
      box-shadow: 0 0 8px rgba(255, 255, 255, 0.4);
      color: #fff;
    }

    .form-select option {
      color: #333;
    }

    /* 🌟 Register Button */
    .btn-register {
      background: linear-gradient(135deg, #43cea2, #185a9d);
      border: none;
      border-radius: 12px;
      padding: 14px;
      font-size: 1.1rem;
      font-weight: 600;
      color: white;
      width: 100%;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(24, 90, 157, 0.5);
    }

    .btn-register:hover {
      background: linear-gradient(135deg, #5ef0c8, #2575fc);
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(37, 117, 252, 0.6);
    }

    /* 💬 Alerts */
    .alert {
      border-radius: 10px;
      border: none;
      font-weight: 500;
      text-align: center;
    }

    .alert-danger {
      background-color: rgba(255, 99, 132, 0.8);
      color: #fff;
    }

    .alert-success {
      background-color: rgba(75, 192, 192, 0.8);
      color: #fff;
    }

    /* 🔗 Login Link */
    .login-link {
      text-align: center;
      margin-top: 1.5rem;
      color: #e0e0e0;
      font-size: 0.95rem;
    }

    .login-link a {
      color: #00ffe0;
      text-decoration: none;
      font-weight: 600;
    }

    .login-link a:hover {
      text-decoration: underline;
      color: #ffffff;
    }

    /* ✨ Input glow on focus */
    .form-control:focus,
    .form-select:focus {
      outline: none;
      box-shadow: 0 0 10px rgba(0, 255, 240, 0.6);
    }

    /* 🎬 Smooth transitions */
    * {
      transition: all 0.25s ease;
    }
  </style>
</head>

<body>
  <div class="register-card">
    <h2 class="register-title">Create Account</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger" role="alert">
        <?= html_escape($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success" role="alert">
        <?= html_escape($_SESSION['success']); ?>
        <?php unset($_SESSION['success']); ?>
      </div>
    <?php endif; ?>

    <form action="<?= site_url('auth/register'); ?>" method="post">
      <div class="form-group">
        <label class="form-label text-light fw-semibold">Role</label>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <select class="form-select" name="role" required>
            <option value="" selected disabled>Select</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        <?php else: ?>
          <select class="form-select" name="role" required>
            <option value="" selected disabled>Select</option>
            <option value="user">User</option>
          </select>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
      </div>

      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
      </div>

      <button type="submit" class="btn btn-register">Register</button>
    </form>

    <div class="login-link">
      Already have an account? <a href="<?= site_url('auth/login'); ?>">Login</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
