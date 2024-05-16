<?php $this->extend('layouts/layout_dash'); ?>
namespace App\Views\forms;

<?php echo $this->section('estilos') ?>


<?php echo $this->endSection() ?>


<?php $this->section('content') ?>

<div class="container-fluid ">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Crie seu Porquinho</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('/forms/goal_submit'); ?>" method="POST">
                            <?php if (session()->has('message')) : ?>
                                <div class="alert alert-success">
                                    <?php if (session()->has('message')) : ?>
                                        <?= session('message') ?>

                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->has('error_goal')) : ?>
                                <div class="alert alert-danger">
                                    <?php
                                    $errors = session()->getFlashdata('error_goal');
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
                                <label for="title_goal" class="form-label">Título</label>
                                <input type="text" class="form-control" id="title_goal" name="title_goal" placeholder="Digite o Motivo da Economia" value="<?= isset($existingPiggy) ? $existingPiggy->goal_title : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="goal" class="form-label">Meta Financeira</label>
                                <input type="number" class="form-control" id="goal" name="goal" placeholder="Digite uma meta de economia" value="<?= isset($existingPiggy) ? $existingPiggy->goal : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Até quando quer economizar?</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" value="<?= isset($existingPiggy) ? $existingPiggy->due_date : '' ?>">
                            </div>
                            <?php if (isset($existingPiggy)) : ?>
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            <?php else : ?>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <h5 class="card-title fw-semibold mb-4">Valor Economizado</h5>
                <div class="card mb-0">
                    <div class="card-body">
                        <form action="<?= base_url('/forms/piggy_submit') ?>" method="POST">
                            <?php if (session()->has('success_piggy')) : ?>
                                <div class="alert alert-success">
                                    <?php
                                    $errors = session()->getFlashdata('success_piggy');
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

                            <?php if (session()->has('error_piggy')) : ?>
                                <div class="alert alert-danger">
                                    <?php
                                    $errors = session()->getFlashdata('error_piggy');
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
                                <label for="salario" class="form-label">Economias</label>
                                <input type="number" class="form-control" id="piggy" name="piggy" placeholder="Digite uma meta de economia">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
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