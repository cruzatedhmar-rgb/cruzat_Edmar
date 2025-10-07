<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e8f5e8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 450px;
        }
        .register-title {
            color: #2d5a2d;
            font-weight: bold;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-row { display:flex; gap:12px; }
        .form-row .half { flex:1; }
        .form-label { font-weight:600; color:#495057; margin-bottom:6px; display:block; }
        .btn-register {
            background-color: #2d5a2d;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 1.05rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(45, 90, 45, 0.15);
        }
        .btn-register:hover {
            background-color: #1e3f1e;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45, 90, 45, 0.2);
            color: white;
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
        }
        .login-link a {
            color: #2d5a2d;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            color: #1e3f1e;
            text-decoration: underline;
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h2 class="register-title">Register</h2>
        
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
                <span class="input-icon">👤</span>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            
            <div class="form-group">
                <span class="input-icon">📧</span>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            
            <div class="form-group">
                <span class="input-icon">🔒</span>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            
            <div class="form-group">
                <span class="input-icon">🔒</span>
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <div class="form-group">
                <label for="role" style="display:block; margin-bottom:6px; font-weight:600; color:#6c757d;">Role</label>
                <select name="role" id="role" class="form-control" style="padding-left:15px;">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
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
