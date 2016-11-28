<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <script src="js/jquery.js"></script>
        <script src="../jquery.geShoppingCart.js"></script>
        <script src="js/main.js"></script>
        <title>Betala</title>
    </head>
    <body>
        <?php require('form.php'); ?>
        <div id="paydesk">
            <h1>Betalning</h1>
            <p>Följande summa kommer att dras från ditt kreditkort: <span id="payment-amount">0</span> kr</p>
            <div id="output"></div>
            <?= $form->GetHTML(array('id' => 'paydesk-form', 'columns' => 2)); ?>
        </div>
    </body>
</html>
