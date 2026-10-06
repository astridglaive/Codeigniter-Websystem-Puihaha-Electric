<?= $this->extend('public/layout') ?>
<?= $this->section('content') ?>
<section class="page-hero"><div class="container text-center"><h1>Contact Puihaha Electric</h1><p>Get in touch with our team for your electrical service needs.</p></div></section>
<section class="section-padding"><div class="container"><div class="row g-4">
    <div class="col-lg-4"><div class="card h-100 text-center p-4"><div class="feature-icon"><i class="fas fa-location-dot"></i></div><h4>Visit Our Office</h4><p class="text-muted mb-0">Contact the local Puihaha service office for in-person assistance.</p></div></div>
    <div class="col-lg-4"><div class="card h-100 text-center p-4"><div class="feature-icon"><i class="fas fa-phone"></i></div><h4>Customer Support</h4><p class="text-muted mb-0">Account, service, and emergency assistance is available through our support team.</p></div></div>
    <div class="col-lg-4"><div class="card h-100 text-center p-4"><div class="feature-icon"><i class="fas fa-clock"></i></div><h4>Business Hours</h4><p class="text-muted mb-0">Monday-Friday: 7:00 AM-6:00 PM<br>Emergency support: 24/7</p></div></div>
</div></div></section>
<section class="section-padding bg-light-custom"><div class="container"><div class="row"><div class="col-lg-8 mx-auto"><div class="card shadow border-0"><div class="card-body p-4 p-md-5">
    <div class="text-center mb-4"><h2 class="text-primary-custom">Get Your Free Quote</h2><p class="text-muted">Your message will be saved securely in the company database.</p></div>
    <?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><i class="fas fa-circle-check me-2"></i><?= esc(session()->getFlashdata('success')) ?></div><?php endif ?>
    <?php $errors = session()->getFlashdata('validation') ?? []; ?>
    <?php if ($errors): ?><div class="alert alert-danger"><strong>Please correct the following:</strong><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach ?></ul></div><?php endif ?>
    <form method="post" action="<?= site_url('contact') ?>" id="contactForm"><?= csrf_field() ?>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label" for="name">Full Name *</label><input class="form-control form-control-lg" id="name" name="name" value="<?= old('name') ?>" required></div>
            <div class="col-md-6"><label class="form-label" for="email">Email Address *</label><input class="form-control form-control-lg" type="email" id="email" name="email" value="<?= old('email') ?>" required></div>
            <div class="col-md-6"><label class="form-label" for="phone">Phone Number *</label><input class="form-control form-control-lg" id="phone" name="phone" value="<?= old('phone') ?>" required></div>
            <div class="col-md-6"><label class="form-label" for="service_type">Service Type *</label><select class="form-select form-select-lg" id="service_type" name="service_type" required><option value="">Select a service</option><?php foreach (['Residential Wiring','Commercial Electrical','Panel Upgrade','Lighting Installation','Solar Installation','Emergency Repair','Maintenance','Other'] as $service): ?><option value="<?= esc($service) ?>" <?= old('service_type') === $service ? 'selected' : '' ?>><?= esc($service) ?></option><?php endforeach ?></select></div>
            <div class="col-12"><label class="form-label" for="message">Project Details *</label><textarea class="form-control" id="message" name="message" rows="5" required><?= old('message') ?></textarea></div>
            <div class="col-12 text-center"><button class="btn btn-primary btn-lg px-5" type="submit"><i class="fas fa-paper-plane me-2"></i>Send Message</button></div>
        </div>
    </form>
</div></div></div></div></div></section>
<?= $this->endSection() ?>
