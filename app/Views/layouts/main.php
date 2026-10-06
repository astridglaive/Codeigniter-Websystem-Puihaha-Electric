<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | Puihaha Electric Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 20px auto;
        }
        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .header-section h1 {
            color: #667eea;
            font-weight: bold;
        }
        .stats-card {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            color: white;
        }
        .stats-card h3 {
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }
        .stats-card p {
            margin: 5px 0 0 0;
            opacity: 0.9;
        }
        .card-total { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .card-active { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
        .card-inactive { background: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%); }
        .card-suspended { background: linear-gradient(135deg, #fc4a1a 0%, #f7b733 100%); }
        .search-filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .table-container { overflow-x: auto; }
        .badge-active { background-color: #28a745; }
        .badge-inactive { background-color: #dc3545; }
        .badge-suspended { background-color: #ffc107; color: #000; }
        .pagination { margin-top: 20px; }
        .pagination a,
        .pagination span { margin-right: 8px; }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="header-section">
                <h1><i class="bi bi-lightning-charge-fill text-warning"></i> Puihaha Electric Company</h1>
                <p class="text-muted mb-2">Customer Account Management System</p>
                <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
                    <a class="btn btn-sm btn-outline-primary" href="<?= site_url('/') ?>"><i class="bi bi-globe"></i> View Main Website</a>
                    <small class="text-muted">Signed in as <strong><?= esc(session('fullName')) ?></strong></small>
                    <form action="<?= site_url('logout') ?>" method="post">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </div>
            </div>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $message): ?>
                            <li><?= esc($message) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
