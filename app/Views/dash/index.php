<?php $this->extend('layouts/layout_dash'); ?>

<?php echo $this->section('estilos') ?>


<?php echo $this->endSection() ?>


<?php $this->section('content') ?>


<div class="container-fluid">

    <!-- Na view dash/index.php -->
    <!-- Exibir dados de gastos -->
    <?php
    $totalGastos = 0;

    foreach ($amount_spent as $gasto) {
        // Adicionar o valor do gasto ao total
        $totalGastos += $gasto->value;
    }
    ?>


    <div class="row">

        <div class="col-sm-6 col-xl-4">
            <div class="card text-bg-light-success m-4 hover-scale" style="max-width: 18rem;">
                <div class="card-header  text-success d-flex justify-content-between align-items-center">
                    <strong>
                        <i class="bi bi-currency-dollar"></i> Resumo
                    </strong>
                    <a href="#recentTransactionsTable   " class="badge bg-success rounded-3 fw-semibold">Ver mais</a>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-success"><span class="bi bi-wallet2"></span> Saldo Disponível</h5>
                    <?php
                    // Calcular o saldo disponível
                    $saldo = $salary->value - $totalGastos;

                    // Verificar se o saldo é negativo (indicando déficit)
                    if ($saldo < 0) {
                        // Se for negativo, exibir em vermelho
                    ?>
                        <h5 class="card-title text-danger">R$ <?= number_format($saldo, 2, ',', '.') ?></h5>
                    <?php } else {
                        // Senão, exibir em verde
                    ?>
                        <h5 class="card-title text-success">R$ <?= number_format($saldo, 2, ',', '.') ?></h5>
                    <?php } ?>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-xl-4">
            <div class="card text-bg-light-danger m-4 hover-scale" style="max-width: 18rem;">
                <div class="card-header  text-danger d-flex justify-content-between align-items-center">
                    <strong>
                        <i class="bi bi-wallet2"></i> Renda
                    </strong>
                    <a href="#" class="badge bg-danger rounded-3 fw-semibold">Editar</a>
                </div>
                <div class="card-body">

                    <h5 class="card-title text-danger"><span class="bi bi-cash-stack"></span> Renda Mensal </h5>

                    <?= '<h5 class="text-danger">R$ ' . $salary->value . '</h5>' ?>

                </div>
            </div>
        </div>


        <div class="col-sm-6  mt-8 col-xl-4">
    <?php if (empty($piggy)) : ?>
        <!-- Mensagem de aviso se não houver porquinho -->
        <div class="alert alert-warning" role="alert">
            Você ainda não possui nenhum porquinho criado. <a href="<?= base_url('/forms/piggy_form') ?>" class="alert-link">Crie um agora</a>.
        </div>
    <?php else : ?>
        <?php foreach ($piggy as $item) : ?>
            <div class="card text-bg-light-info m-4 hover-scale" style="max-width: 18rem;">
                <div class="card-header  text-info d-flex justify-content-between align-items-center">
                    <strong>
                        <span class="bi bi-piggy-bank"></span> Porquinho</strong>
                    <a href="#" class="badge bg-info rounded-3 fw-semibold">Editar</a>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-info"><span class="bi bi-piggy-bank"></span><?= $item->goal_title ?></h5>
                    <h5 class="card-text text-info "> <?= ' R$ ' . $item->goal . ' / ' . $item->value ?></h5>
                    <!-- Outras informações do porquinho -->
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


    </div>
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-4 d-flex align-items-strech">
        <div class="card w-100 bg-light-info">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold text-info">Gastos Semanais</h5>
                        </div>
                        <!-- <div>
                            <select class="form-select">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                            </select>
                        </div> -->
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Yearly Breakup -->
                    <!-- <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-9 fw-semibold">Yearly Breakup</h5>
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="fw-semibold mb-3">$36,358</h4>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-up-left text-success"></i>
                                        </span>
                                        <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                        <p class="fs-3 mb-0">last year</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-4">
                                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                            <span class="fs-2">2023</span>
                                        </div>
                                        <div>
                                            <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                                            <span class="fs-2">2023</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="breakup"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-12">
                    <!-- Monthly Earnings -->
                    <!-- <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                                    <h4 class="fw-semibold mb-3">$6,820</h4>
                                    <div class="d-flex align-items-center pb-1">
                                        <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-down-right text-danger"></i>
                                        </span>
                                        <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                        <p class="fs-3 mb-0">last year</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="earning"></div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Recent Transactions</h5>
                    </div>
                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90</div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal">#ML-3467</a>
                            </div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1">Payment was made of $64.95 to Michael</div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal">#ML-3467</a>
                            </div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New arrival recorded
                            </div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1">Payment Done</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->
        <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">

    <h5 class="card-title fw-semibold mb-4 d-flex justify-content-around text-info">Transações Recentes - Saldo: <?= $totalGastos; ?></h5>
            <div class="table-responsive">
                <table id="recentTransactionsTable" class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">ID</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Valor</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Descrição</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Data de Criação</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Os dados serão preenchidos dinamicamente aqui -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    </div>

    <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
    </div>
</div>

<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>

<script> var spentData = <?= json_encode($amount_spent) ?> ;</script> 

<script src="https://cdn.datatables.net/v/bs4/dt-2.0.5/r-3.0.2/datatables.min.js"></script>

<script>
$(document).ready(function() {
    $('#recentTransactionsTable').DataTable({
        ajax: '<?php echo site_url('spent/recoverExpenses'); ?>', // Use a URL correta aqui
        columns: [{
                data: 'id'
            },
            {
                data: 'value'
            },
            {
                data: 'descricao'
            },
            {
                data: 'created_at'
            },
        ],
        "deferRender": true,
        "processing": true,
        "responsive": true,
        "pagingType": $(window).width() < 768 ? "simple" : "simple_numbers"
    });
});

</script>


<!--Aqui coloco os estilos da view-->
<?php echo $this->endSection() ?>