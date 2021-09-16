<!DOCTYPE html>
<html lang="en">

    <head>
        <?= $this->include('_layout/user/_meta') ?>

        <!-- Title -->
        <title>ITLG (Information Technology Laboratory Group) - <?= $title; ?> </title>

        <!-- Favicon -->
        <link rel="icon" href="<?= base_url(); ?>/assets/academy/img/core-img/favicon.ico">
        
        <!-- CSS -->
        <?= $this->include('_layout/user/_css') ;?>

    </head>

    <body>

        <!-- Preloader -->
        <?= $this->include('_layout/user/_preloader') ?>
        
        <!-- Header -->
        <?= $this->include('_layout/user/_header') ;?>

        <!-- Content -->
        <?= $this->renderSection('content') ?>

        <!-- Footer -->
        <?= $this->include('_layout/user/_footer') ?>
        
        <!-- JS -->
        <?= $this->include('_layout/user/_js') ?>
    </body>

</html>