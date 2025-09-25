<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($action === 'edit') ? 'Edit Student' : 'Add Student' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(120deg, #43cea2, #185a9d); min-height: 100vh;">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <?= ($action === 'edit') ? 'Edit Student' : 'Add Student' ?>
                    </h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= ($action === 'edit') ? site_url('author/update/' . $author['id']) : site_url('author/store') ?>">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required value="<?= isset($author['first_name']) ? html_escape($author['first_name']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required value="<?= isset($author['last_name']) ? html_escape($author['last_name']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= isset($author['email']) ? html_escape($author['email']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" required value="<?= isset($author['birthdate']) ? html_escape($author['birthdate']) : '' ?>">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('author') ?>" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">
                                <?= ($action === 'edit') ? 'Update' : 'Add' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
