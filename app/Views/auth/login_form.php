<?php $this->extend('layouts/layout_auth'); ?>

<?php echo $this->section('estilos') ?>

<!--Aqui coloco os estilos da view-->
<?php echo $this->endSection() ?>

<?php $this->section('content') ?>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="<?= base_url('/auth/login_form') ?>" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="<?= base_url('assets/images/logos/dark-logo.svg'); ?>" width="180" alt="">
                            </a>


                            <?php if (session()->has('login')) : ?>
                                    <div class="alert alert-info">
                                        <?php
                                        $errors = session()->getFlashdata('login');
                                        if (is_array($errors)) {
                                            foreach ($errors as $error) {
                                                echo $error . '<br>'; // ou qualquer formato que você deseja usar para exibir as mensagens de erro
                                            }
                                        } else {
                                            echo $errors; // Se for apenas uma mensagem de erro única, imprima-a diretamente
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            <p class="text-center">Your Social Campaigns</p>
                            <form method="POST" action="<?= base_url('/auth/login_submit') ?>">
                            <?php if (session()->has('msg')) : ?>
                                    <div class="alert alert-danger">
                                        <?php
                                        $errors = session()->getFlashdata('msg');
                                        if (is_array($errors)) {
                                            foreach ($errors as $error) {
                                                echo $error . '<br>'; // ou qualquer formato que você deseja usar para exibir as mensagens de erro
                                            }
                                        } else {
                                            echo $errors; // Se for apenas uma mensagem de erro única, imprima-a diretamente
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>


                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="senha" class="form-control" id="exampleInputPassword1">
                                </div>

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="form-check-label text-dark" for="flexCheckChecked">
                                            Remember this Device
                                        </label>
                                    </div>
                                    <a class="text-primary fw-bold" href="<?= base_url('/auth/') ?>">Forgot Password ?</a>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                                    <a class="text-primary fw-bold ms-2" href="<?= base_url('/register/register_form') ?>">Create an account</a>
                                </div>
                                <?php if (session()->has('error')) : ?>
                                    <div class="alert alert-danger">
                                        <?php
                                        $errors = session()->getFlashdata('error');
                                        if (is_array($errors)) {
                                            foreach ($errors as $error) {
                                                echo $error . '<br>'; // ou qualquer formato que você deseja usar para exibir as mensagens de erro
                                            }
                                        } else {
                                            echo $errors; // Se for apenas uma mensagem de erro única, imprima-a diretamente
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </form>

                            <!-- Exibir mensagem de erro -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>

<!--Aqui coloco os estilos da view-->
<?php echo $this->endSection() ?>