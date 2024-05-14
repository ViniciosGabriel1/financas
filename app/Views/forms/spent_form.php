<?php $this->extend('layouts/layout_dash'); ?>

<?php echo $this->section('estilos') ?>


<?php echo $this->endSection() ?>


<?php $this->section('content') ?>

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Forms</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('/forms/spent_submit') ?>" method="POST">
                            <?php if (session()->has('success')) : ?>
                                <div class="alert alert-success">
                                    <?= session('success') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->has('error')) : ?>
                                <div class="alert alert-danger">
                                    <?= session('error') ?>
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="amount_spent" class="form-label">Valor do Gasto</label>
                                <input type="number" class="form-control" id="amount_spent" name="amount_spent" placeholder="Digite o valor do gasto">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição do Gasto</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Digite uma descrição para o gasto">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>

                    </div>
                </div>

                <!-- <h5 class="card-title fw-semibold mb-4">Disabled forms</h5>
                <div class="card mb-0">
                    <div class="card-body">
                        <form>
                            <fieldset disabled>
                                <legend>Disabled fieldset example</legend>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Disabled input</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input" />
                                </div>
                                <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">Disabled select menu</label>
                                    <select id="disabledSelect" class="form-select">
                                        <option>Disabled select</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled />
                                        <label class="form-check-label" for="disabledFieldsetCheck">
                                            Can't check this
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>


<?php echo $this->endSection() ?>








<?php echo $this->section('scripts') ?>

<!--Aqui coloco os estilos da view-->
<?php echo $this->endSection() ?>