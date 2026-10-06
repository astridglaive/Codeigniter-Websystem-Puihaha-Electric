<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="mb-0">Customer Accounts</h2>
    <a href="<?= site_url('customers/new') ?>" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i> Add Customer</a>
</div>

<div class="row mb-4">
    <div class="col-md-3"><div class="stats-card card-total"><h3><?= $totalAccounts ?></h3><p>Total Accounts</p></div></div>
    <div class="col-md-3"><div class="stats-card card-active"><h3><?= $activeAccounts ?></h3><p>Active Accounts</p></div></div>
    <div class="col-md-3"><div class="stats-card card-inactive"><h3><?= $inactiveAccounts ?></h3><p>Inactive Accounts</p></div></div>
    <div class="col-md-3"><div class="stats-card card-suspended"><h3><?= $suspendedAccounts ?></h3><p>Suspended Accounts</p></div></div>
</div>

<div class="search-filter-section">
    <form method="get" action="<?= site_url('customers') ?>">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" name="search" placeholder="Search by name, account, email, meter..." value="<?= esc($search) ?>">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="status">
                    <option value="">All Status</option>
                    <?php foreach (['active', 'inactive', 'suspended'] as $status): ?>
                        <option value="<?= $status ?>" <?= $selectedStatus === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="type">
                    <option value="">All Types</option>
                    <?php foreach (['residential', 'commercial', 'industrial'] as $type): ?>
                        <option value="<?= $type ?>" <?= $selectedType === $type ? 'selected' : '' ?>><?= ucfirst($type) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-2"><button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Search</button></div>
        </div>
    </form>
    <?php if ($search || $selectedStatus || $selectedType): ?>
        <div class="mt-2"><a href="<?= site_url('customers') ?>" class="btn btn-sm btn-secondary"><i class="bi bi-x-circle"></i> Clear Filters</a></div>
    <?php endif ?>
</div>

<div class="table-container">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Account Number</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Connection Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($accounts === []): ?>
                <tr><td colspan="7" class="text-center text-muted">No accounts found</td></tr>
            <?php endif ?>
            <?php foreach ($accounts as $account): ?>
                <tr>
                    <td><strong><?= esc($account['account_number']) ?></strong></td>
                    <td><?= esc($account['customer_name']) ?></td>
                    <td><?= esc($account['email']) ?></td>
                    <td><?= esc($account['phone']) ?></td>
                    <td><span class="badge bg-info text-dark"><?= ucfirst(esc($account['connection_type'])) ?></span></td>
                    <td><span class="badge badge-<?= esc($account['status']) ?>"><?= ucfirst(esc($account['status'])) ?></span></td>
                    <td class="text-nowrap">
                        <a href="<?= site_url('customers/' . $account['id']) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <a href="<?= site_url('customers/' . $account['id'] . '/edit') ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                        <form class="d-inline" action="<?= site_url('customers/' . $account['id'] . '/delete') ?>" method="post" onsubmit="return confirm('Delete this customer account?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php if ($pager): ?>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="text-muted">Showing database results in groups of 10</div>
        <div><?= $pager->only(['search', 'status', 'type'])->links('customers') ?></div>
    </div>
<?php endif ?>
<?= $this->endSection() ?>
