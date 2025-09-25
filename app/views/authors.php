<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #43cea2, #185a9d);
            min-height: 100vh;
        }
        .main-header {
            text-align: center;
            padding: 2rem 0 1rem 0;
            color: #fff;
            letter-spacing: 2px;
            font-weight: 700;
            font-size: 2.5rem;
            background: rgba(24,90,157,0.7);
            border-radius: 0 0 1rem 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 16px rgba(24,90,157,0.1);
        }
        .search-form {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(67,206,162,0.08);
            padding: 1rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }
        .search-form input[type="text"] {
            border-radius: 2rem;
            border: 1px solid #43cea2;
            padding-left: 1.2rem;
        }
        .search-form .btn-primary {
            border-radius: 2rem;
            background: linear-gradient(90deg, #43cea2, #185a9d);
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .students-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 2rem;
        }
        .student-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 4px 16px rgba(24,90,157,0.10);
            padding: 2rem 1.5rem 1.5rem 1.5rem;
            transition: transform 0.15s, box-shadow 0.15s;
            border: none;
            position: relative;
        }
        .student-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(24,90,157,0.18);
        }
        .student-card .student-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #185a9d;
            margin-bottom: 0.2rem;
        }
        .student-card .student-email {
            font-size: 0.98rem;
            color: #43cea2;
            margin-bottom: 0.7rem;
        }
        .student-card .student-info {
            font-size: 0.97rem;
            color: #444;
        }
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="main-header d-flex justify-content-between align-items-center">
        <span>Students Directory</span>
        <a href="<?= site_url('author/create'); ?>" class="btn btn-success btn-lg shadow-sm">+ Add Student</a>
    </div>
    <form action="<?= site_url('author'); ?>" method="get" class="search-form">
        <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
        <input class="form-control" name="q" type="text" placeholder="Search students..." value="<?= html_escape($q); ?>">
        <button type="submit" class="btn btn-primary px-4">Search</button>
    </form>
    <div class="students-grid">
        <?php foreach (html_escape($all) as $author): ?>
            <div class="student-card">
                <div class="student-name">
                    <?= $author['first_name']; ?> <?= $author['last_name']; ?>
                </div>
                <div class="student-email">
                    <?= $author['email']; ?>
                </div>
                <div class="student-info mb-2">
                    <strong>Birthdate:</strong> <?= $author['birthdate']; ?><br>
                    <strong>Added:</strong> <?= $author['added']; ?>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= site_url('author/edit/' . $author['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= site_url('author/delete/' . $author['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex pagination">
        <?= $page; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
