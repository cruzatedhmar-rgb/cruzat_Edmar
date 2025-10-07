<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Profile View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e8f5e8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-title {
            color: #2d5a2d;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .create-btn {
            background-color: #2d5a2d;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(45, 90, 45, 0.3);
            transition: all 0.3s ease;
        }
        
        .create-btn:hover {
            background-color: #1e3f1e;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(45, 90, 45, 0.4);
            color: white;
        }
        
        .profile-table {
            background: white;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .table-header {
            background-color: #2d5a2d;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .table-header th {
            border: none;
            padding: 15px;
            font-size: 0.9rem;
        }
        
        .table-body tr:nth-child(odd) {
            background-color: #f0f8f0;
        }
        
        .table-body tr:nth-child(even) {
            background-color: white;
        }
        
        .table-body td {
            border: none;
            padding: 15px;
            color: #333;
            vertical-align: middle;
        }
        
        .action-btn {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            border: none;
            margin: 0 3px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        
        .edit-btn {
            background-color: #28a745;
            color: white;
        }
        
        .edit-btn:hover {
            background-color: #218838;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
            color: white;
        }
        
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        
        .delete-btn:hover {
            background-color: #c82333;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
            color: white;
        }
        
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border-radius: 8px;
            padding: 8px 16px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-1px);
        }
        
        .search-container {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .search-btn {
            background-color: #2d5a2d;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
        }
        
        .search-btn:hover {
            background-color: #1e3f1e;
            color: white;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <h1 class="page-title">Welcome to Profile View</h1>
    
    <div class="search-container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <form action="<?= site_url('author'); ?>" method="get" class="d-flex">
                    <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                    <input class="form-control me-2" name="q" type="text" placeholder="Search..." value="<?= html_escape($q); ?>" style="border-radius: 8px;">
                    <button type="submit" class="btn search-btn">Search</button>
                </form>
            </div>
            <div class="col-md-2 text-center">
                <a href="<?= site_url('student/create'); ?>" class="btn create-btn">&#43; Create New User</a>
            </div>
            <div class="col-md-2 text-end">
                <a href="<?= site_url('auth/logout'); ?>" class="logout-btn">Logout</a>
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
                            <a href="<?= site_url('student/edit/'.$author['id']); ?>" class="btn action-btn edit-btn">Edit</a>
                            <a href="<?= site_url('student/delete/'.$author['id']); ?>" class="btn action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
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
