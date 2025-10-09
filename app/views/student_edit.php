<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --bg: #f8fbff;
      --card-bg: #ffffff;
      --accent: #6d28d9;
      --accent-2: #4f46e5;
      --muted: #374151;
    }

    body {
      background: linear-gradient(180deg, #ffffff 0%, var(--bg) 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--muted);
    }

    .page-title {
      color: var(--accent-2);
      font-size: 2.4rem;
      font-weight: bold;
      margin: 0;
    }

    .form-container {
      background: var(--card-bg);
      border-radius: 16px;
      padding: 2rem;
      box-shadow: 0 12px 34px rgba(79,70,229,0.06);
      max-width: 600px;
      margin: 2rem auto;
    }

    .form-label {
      color: var(--accent-2);
      font-weight: 600;
      margin-bottom: 8px;
    }

    .form-control {
      border: 2px solid rgba(79,70,229,0.08);
      border-radius: 10px;
      padding: 12px 15px;
      font-size: 1rem;
      background-color: #fbfbff;
      transition: all 0.2s ease;
      color: #0f172a;
    }

    .form-control:focus {
      border-color: var(--accent-2);
      background-color: #ffffff;
      box-shadow: 0 0 0 0.2rem rgba(79,70,229,0.1);
    }

    .btn-update {
      background: linear-gradient(90deg, var(--accent-2), var(--accent));
      color: white;
      border: none;
      border-radius: 10px;
      padding: 12px 30px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 8px 20px rgba(79,70,229,0.14);
    }

    .btn-update:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(79,70,229,0.18);
    }

    .btn-cancel {
      background-color: transparent;
      color: var(--accent-2);
      border: 2px solid var(--accent-2);
      border-radius: 10px;
      padding: 12px 30px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-cancel:hover {
      background-color: var(--accent-2);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(79,70,229,0.12);
    }

    .logout-btn {
      background-color: #ef4444;
      color: white;
      border-radius: 8px;
      padding: 8px 16px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #dc2626;
      transform: translateY(-1px);
      color: white;
    }

    .header-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>
  <div class="container py-4">
    <div class="form-container">
      <div class="header-section">
        <h1 class="page-title">Edit User</h1>
        <a href="<?= site_url('auth/logout'); ?>" class="logout-btn">Logout</a>
      </div>

      <form method="post" action="">
        <div class="mb-4">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="<?= html_escape($student['first_name']); ?>" required />
        </div>
        <div class="mb-4">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="<?= html_escape($student['last_name']); ?>" required />
        </div>
        <div class="mb-4">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= html_escape($student['email']); ?>" required />
        </div>
        <div class="d-flex gap-3">
          <button type="submit" class="btn btn-update">Update User</button>
          <a href="<?= site_url('author'); ?>" class="btn btn-cancel">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
 </html>