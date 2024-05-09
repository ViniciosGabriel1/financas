<?php $this->extend('layouts/layout_auth'); ?>

<!--Aqui coloco os estilos da view-->

<?php echo $this->section('estilos') ?>

<?php echo $this->endSection() ?>



<!--content-->
<?php echo $this->section('content') ?>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="<?= base_url('/auth/login_form') ?>" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                            </a>
                            <p class="text-center">Your Social Campaigns</p>
                            <form method="POST" action="<?= base_url('/register/register_submit') ?>">
                                <div class="mb-3">
                                    <label for="exampleInputtext1" class="form-label">Name</label>
                                    <input type="text" name="username" class="form-control" id="exampleInputtext1" aria-describedby="textHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                    <input type="email"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password"  name="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                    <a class="text-primary fw-bold ms-2" href="./authentication-login.html">Sign In</a>
                                </div>
                            </form>

                            <?php if (session()->has('error')) : ?>
                                <div class="alert alert-danger">
                                    <?php echo session()->getFlashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>

<!--Scripts-->

<?php echo $this->section('scripts') ?>

<?php echo $this->endSection() ?>