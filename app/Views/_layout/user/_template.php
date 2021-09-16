<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('_layout/user/_meta') ?>

    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>ITLG (Information Technology Laboratory Group) - <?= $title; ?> </title>

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url(); ?>/assets/academy/img/core-img/favicon.ico">

    <?= $this->include('_layout/user/_css') ;?>

</head>

<body>
    <?= $this->include('_layout/user/_preloader') ?>
    
    <!-- ##### Header Area Start ##### -->
    <?= $this->include('_layout/user/_header') ;?>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Content ##### -->
    <?= $this->renderSection('content') ?>
    <!-- ##### Content End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?= $this->include('_layout/user/_footer') ?>
    <!-- ##### Footer Area End ##### -->

    <?= $this->include('_layout/user/_js') ?>

</body>

</html>