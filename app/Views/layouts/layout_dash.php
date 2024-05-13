<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Finanças</title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/favicon2.png'); ?>" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css'); ?>" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include('partials/side_bar.php'); ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include('partials/nav_bar.php'); ?>

      <!--  Header End -->
      <?= $this->renderSection('content'); ?>

      

    </div>
  </div>
  <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/sidebarmenu.js'); ?>"></script>
  <script src="<?= base_url('assets/js/app.min.js'); ?>"></script>
  <script src="<?= base_url('assets/libs/apexcharts/dist/apexcharts.min.js'); ?>"></script>
  <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.js'); ?>"></script>
  <script src="<?= base_url('assets/js/dashboard.js'); ?>"></script>


</body>

</html>
