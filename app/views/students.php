<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome to Profile View</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  /* 🌈 Background and overall look */
  body {
    background: linear-gradient(135deg, #a8c0ff, #3f2b96);
    background-attachment: fixed;
    font-family: 'Poppins', sans-serif;
    color: #333;
  }

  .page-title {
    color: #ffffff;
    font-size: 2.8rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
    text-shadow: 1px 2px 4px rgba(0,0,0,0.3);
  }

  /* 🌟 Glassmorphism container */
  .container {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    padding: 30px;
  }

  /* 🔍 Search Bar & Button */
  .search-container {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 25px;
  }

  .form-control {
    border-radius: 10px;
    border: none;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
  }

  .search-btn {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: 600;
    padding: 10px 16px;
    transition: all 0.3s ease;
  }

  .search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,117,252,0.4);
  }

  /* 🧑‍💼 Create, Edit, Delete, Logout Buttons */
  .create-btn, .edit-btn, .delete-btn, .logout-btn {
    border: none;
    border-radius: 8px;
    padding: 8px 18px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .create-btn {
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    color: white;
  }

  .create-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,114,255,0.4);
  }

  .edit-btn {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: white;
  }

  .edit-btn:hover {
    transform: scale(1.05);
  }

  .delete-btn {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    color: white;
  }

  .delete-btn:hover {
    transform: scale(1.05);
  }

  .logout-btn {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    color: white;
    border-radius: 8px;
    text-decoration: none;
  }

  .logout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255,75,43,0.4);
  }

  /* 📋 Table design */
  .profile-table {
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
  }

  .table {
    border-collapse: collapse;
    width: 100%;
    margin: 0;
  }

  .table-header {
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    color: white;
    text-transform: uppercase;
    font-weight: 600;
  }

  .table-header th {
    padding: 15px;
    border: none;
  }

  .table-body tr:nth-child(odd) {
    background-color: rgba(255,255,255,0.5);
  }

  .table-body tr:nth-child(even) {
    background-color: rgba(255,255,255,0.7);
  }

  .table-body tr:hover {
    background-color: rgba(255,255,255,0.9);
    transform: scale(1.01);
    transition: all 0.2s ease;
  }

  .table-body td {
    padding: 14px;
    color: #333;
    border: none;
  }

  .text-muted {
    color: #666 !important;
  }
</style>
</head>

<body>
<div class="container my-4">
  <h1 class="page-title">Welcome to Profile View</h1>

  <div class="search-container">
    <div class="row align-items-center">
      <div class="col-md-8">
        <form action="<?= site_url('author'); ?>" method="get" class="d-flex">
          <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
          <input class="form-control me-2" name="q" type="text" placeholder="Search..." value="<?= html_escape($q); ?>">
          <button type="submit" class="btn search-btn">Search</button>
        </form>
      </div>
      <div class="col-md-2 text-center">
        <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['user', 'admin'])): ?>
          <a href="<?= site_url('student/create'); ?>" class="btn create-btn">+ Create User</a>
        <?php endif; ?>
      </div>
      <div class="col-md-2 text-end">
        <a href="<?= site_url('auth/logout'); ?>" class="btn logout-btn">Logout</a>
      </div>
    </div>
  </div>

  <div class="profile-table">
    <table class="table mb-0">
      <thead class="table-header">
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-body">
        <?php foreach (html_escape($all) as $index => $author): ?>
          <tr>
            <td><?= $index + 1; ?></td>
            <td><?= $author['first_name'] . ' ' . $author['last_name']; ?></td>
            <td><?= $author['email']; ?></td>
            <td>
              <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="<?= site_url('student/edit/'.$author['id']); ?>" class="btn edit-btn">Edit</a>
                <a href="<?= site_url('student/delete/'.$author['id']); ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
              <?php else: ?>
                <span class="text-muted">No actions</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="text-center mt-3">
    <?= $page; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
