<?= $this->extend('layouts/login_base') ?>

<?= $this->section('content') ?>
<h2 class="text-center py-5 text-white"><?= env('system_name') ?></h2>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-6 col-md-9">
            <?php if($session->getFlashdata('error')): ?>
                <div class="alert alert-danger rounded-0">
            <?= $session->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if($session->getFlashdata('success')): ?>
                <div class="alert alert-success rounded-0">
            <?= $session->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if($session->getFlashdata('error_role')): ?>
                <div class="alert alert-success rounded-0">
            <?= $session->getFlashdata('error_role') ?>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center">

<div class="col-xl-6 col-lg-12 col-md-9">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-12 d-none d-lg-block bg-login-image"></div>
        <div class="col-lg-12">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"Create New Account</h1>
            </div>
            <form class="user" method="post" action="simpan_masyarakat.php">
              <div class="form-group">
                <input type="text" name="Postal Code" class="form-control form-control-user" placeholder="Nik">
              </div>
                 <div class="form-group">
                <input type="text" name="name" class="form-control form-control-user" placeholder="Nama">
              </div>
              <div class="form-group">
                <input type="text" name="email" class="form-control form-control-user" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="text" name="cpassword" class="form-control form-control-user" placeholder="Nome Telepon">
              </div>
              <input type="submit" value="Daftar" class="btn btn-primary btn-user btn-block">
              </a>
            </form>
            <hr>
            <div class="text-center">
              Sudah punya akun?<a class="medium" href="login.php">Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

</div>
            </div>
<?= $this->endSection() ?>