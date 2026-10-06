<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
    .info-group { margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; }
    .info-label { font-weight: bold; color: #666; margin-bottom: 5px; }
    .info-value { font-size: 1.1rem; color: #333; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-4 d-flex justify-content-between flex-wrap gap-2">
    <a href="<?= site_url('customers') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
    <a href="<?= site_url('customers/' . $account['id'] . '/edit') ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit Account</a>
</div>

<div class="card">
    <div class="card-header bg-primary text-white"><h4 class="mb-0"><i class="bi bi-person-circle"></i> Account Information</h4></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6"><div class="info-group"><div class="info-label">Account Number</div><div class="info-value"><?= esc($account['account_number']) ?></div></div></div>
            <div class="col-md-6"><div class="info-group"><div class="info-label">Status</div><div class="info-value"><span class="badge badge-<?= esc($account['status']) ?> fs-6"><?= ucfirst(esc($account['status'])) ?></span></div></div></div>
            <div class="col-12"><div class="info-group"><div class="info-label">Customer Name</div><div class="info-value"><?= esc($account['customer_name']) ?></div></div></div>
            <div class="col-12"><div class="info-group"><div class="info-label">Address</div><div class="info-value"><?= esc($account['address']) ?></div></div></div>
            <div class="col-md-6"><div class="info-group"><div class="info-label">Phone</div><div class="info-value"><i class="bi bi-telephone-fill text-primary"></i> <?= esc($account['phone'] ?: 'Not provided') ?></div></div></div>
            <div class="col-md-6"><div class="info-group"><div class="info-label">Email</div><div class="info-value"><i class="bi bi-envelope-fill text-primary"></i> <?= esc($account['email'] ?: 'Not provided') ?></div></div></div>
            <div class="col-md-6"><div class="info-group"><div class="info-label">Meter Number</div><div class="info-value"><?= esc($account['meter_number']) ?></div></div></div>
            <div class="col-md-6"><div class="info-group"><div class="info-label">Connection Type</div><div class="info-value"><span class="badge bg-info text-dark fs-6"><?= ucfirst(esc($account['connection_type'])) ?></span></div></div></div>
            <div class="col-md-6"><div class="info-group"><div class="info-label">Created At</div><div class="info-value"><?= date('F j, Y g:i A', strtotime($account['created_at'])) ?></div></div></div>
            <div class="col-md-6"><div class="info-group"><div class="info-label">Last Updated</div><div class="info-value"><?= date('F j, Y g:i A', strtotime($account['updated_at'])) ?></div></div></div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
