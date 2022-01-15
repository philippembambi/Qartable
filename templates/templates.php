<?php include("../database.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue templates</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./templates.css">
    <link rel="stylesheet" href="./css/animate.css">
    <script src="../vue.js"></script>
</head>
<body>
    <div class="container" style="margin-top: -2%;">

<?php include("template_header.php"); ?>        
    
<div id="cmp-application">

    <app-admin></app-admin>
    <app-my-server></app-my-server>
    <app-qr-code></app-qr-code>

</div>
</div>

<?php include("./template_admin.php"); ?>
<?php include("./template_customer.php"); ?>
<?php include("./template_form.php"); ?>
<?php include("./template_QR_generator.php"); ?>

<?php include("./template_sever.php"); ?>
<?php include("./template_status.php"); ?>
<?php include("./tamplate_game.php"); ?>


<!--Fichier contenant les scripts javascripts-->
<?php include("./main.php"); ?>
</body>
</html>