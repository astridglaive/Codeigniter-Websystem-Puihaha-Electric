<?= $this->extend('public/layout') ?>
<?= $this->section('content') ?>
<section class="hero-section"><div class="container"><div class="row align-items-center"><div class="col-lg-7">
    <h1 class="display-4 fw-bold mb-4">Powering Your World with Excellence</h1>
    <p class="lead mb-4">Professional electrical services you can trust. From residential wiring to commercial installations, we deliver safe, reliable, and efficient electrical solutions.</p>
    <div class="d-flex flex-wrap gap-3"><a href="<?= site_url('services') ?>" class="btn btn-primary btn-lg">Our Services</a><a href="<?= site_url('contact') ?>" class="btn btn-outline-light btn-lg">Get a Quote</a></div>
</div><div class="col-lg-5 text-center"><i class="fas fa-bolt hero-bolt"></i></div></div></div></section>
<section class="section-padding bg-light-custom"><div class="container"><div class="section-title"><h2>Why Choose Puihaha Electric?</h2><p>Safe service, dependable support, and practical energy solutions.</p></div><div class="row g-4">
<?php foreach ([['fa-shield-alt','Licensed & Insured','Qualified electricians who put safety first on every project.'],['fa-clock','24/7 Emergency Service','Help is available when urgent electrical problems occur.'],['fa-award','Experienced Team','Knowledgeable professionals for residential and commercial work.'],['fa-tools','Modern Equipment','Reliable tools help us complete work safely and efficiently.'],['fa-leaf','Eco-Friendly Solutions','Energy-efficient and solar options for lower consumption.'],['fa-handshake','Customer Focused','Clear communication and dependable support from start to finish.']] as $feature): ?>
<div class="col-lg-4 col-md-6"><div class="card h-100 text-center p-4 feature-item"><div class="feature-icon"><i class="fas <?= esc($feature[0]) ?>"></i></div><h4><?= esc($feature[1]) ?></h4><p class="text-muted mb-0"><?= esc($feature[2]) ?></p></div></div>
<?php endforeach ?>
</div></div></section>
<section class="section-padding"><div class="container"><div class="section-title"><h2>Our Core Services</h2><p>Complete electrical assistance for different customer needs.</p></div><div class="row g-4">
<?php foreach ([['fa-home','Residential Services','Home wiring, panel upgrades, lighting, repairs, and smart-home installations.'],['fa-building','Commercial Services','Electrical installation and maintenance for offices and businesses.'],['fa-solar-panel','Solar Solutions','Solar panels, battery storage, and energy consultation.'],['fa-triangle-exclamation','Emergency Repairs','Urgent troubleshooting for outages, faults, and electrical hazards.']] as $service): ?>
<div class="col-lg-6"><div class="card h-100 p-4 feature-item service-preview"><div class="feature-icon"><i class="fas <?= esc($service[0]) ?>"></i></div><div><h4><?= esc($service[1]) ?></h4><p class="text-muted mb-0"><?= esc($service[2]) ?></p></div></div></div>
<?php endforeach ?>
</div><div class="text-center mt-5"><a href="<?= site_url('services') ?>" class="btn btn-primary btn-lg">View All Services</a></div></div></section>
<section class="stats-section"><div class="container"><div class="row text-center g-4"><div class="col-md-3"><strong>2,500+</strong><span>Projects Completed</span></div><div class="col-md-3"><strong>25+</strong><span>Years Experience</span></div><div class="col-md-3"><strong>100%</strong><span>Customer Focus</span></div><div class="col-md-3"><strong>24/7</strong><span>Emergency Support</span></div></div></div></section>
<?= $this->endSection() ?>
