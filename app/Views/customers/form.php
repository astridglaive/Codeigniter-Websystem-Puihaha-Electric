<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$value = static function (string $field, array $account): string {
    $oldValue = old($field);
    return esc($oldValue !== null ? $oldValue : ($account[$field] ?? ''));
};
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2><?= $isEdit ? 'Edit Customer Account' : 'Add Customer Account' ?></h2>
    <a href="<?= site_url('customers') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
</div>

<form action="<?= $isEdit ? site_url('customers/' . $account['id']) : site_url('customers') ?>" method="post">
    <?= csrf_field() ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label" for="account_number">Account Number *</label>
            <input class="form-control" id="account_number" name="account_number" value="<?= $value('account_number', $account) ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="meter_number">Meter Number *</label>
            <input class="form-control" id="meter_number" name="meter_number" value="<?= $value('meter_number', $account) ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="customer_name">Customer Name *</label>
            <input class="form-control" id="customer_name" name="customer_name" value="<?= $value('customer_name', $account) ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="address">Address *</label>
            <textarea class="form-control" id="address" name="address" rows="3" required><?= $value('address', $account) ?></textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="phone">Phone</label>
            <input class="form-control" id="phone" name="phone" value="<?= $value('phone', $account) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" value="<?= $value('email', $account) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="connection_type">Connection Type *</label>
            <?php $currentType = old('connection_type') ?? ($account['connection_type'] ?? 'residential'); ?>
            <select class="form-select" id="connection_type" name="connection_type" required>
                <?php foreach (['residential', 'commercial', 'industrial'] as $type): ?>
                    <option value="<?= $type ?>" <?= $currentType === $type ? 'selected' : '' ?>><?= ucfirst($type) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="status">Status *</label>
            <?php $currentStatus = old('status') ?? ($account['status'] ?? 'active'); ?>
            <select class="form-select" id="status" name="status" required>
                <?php foreach (['active', 'inactive', 'suspended'] as $status): ?>
                    <option value="<?= $status ?>" <?= $currentStatus === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="mt-4 text-end">
        <a href="<?= site_url('customers') ?>" class="btn btn-light border">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> <?= $isEdit ? 'Save Changes' : 'Create Account' ?></button>
    </div>
</form>
<?= $this->endSection() ?>
