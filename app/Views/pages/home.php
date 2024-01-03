<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <h1 class="fw-bold">Welcome, <?= $session->get('login_name') ?>!</h1>


<?= $this->endSection() ?>