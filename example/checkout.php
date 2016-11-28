<?php
// Create the session
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();

// Get incoming on what to do
$action = isset($_GET['action']) ? $_GET['action'] : null;

if ($action == 'getTotalSum') {

    $totalSum = isset($_SESSION['cart']['totalSum']) ? $_SESSION['cart']['totalSum'] : "0";
    header('Content-type: application/json');
    echo json_encode(array('totalSum' => $totalSum));

} else if ($action == 'payment') {

    require('form.php');
    $_POST['submit'] = true;
    $isFormValidated = $form->Check();

    $totalSum = isset($_SESSION['cart']['totalSum']) ? $_SESSION['cart']['totalSum'] : "0";

    if ($isFormValidated == true) {
        sleep(3);
        $output = "<p>Betalningen lyckades. $totalSum kr har dragits från ditt konto.</p>";

        echo json_encode(array(
            'status' => 'success',
            'output' => $output,
            'totalSum' => "0"
        ));

        $_SESSION['cart'] = array('totalNumOfItems' => 0, 'totalSum'=>0, 'items'=>array());

    } else {
       $errors = $form->GetValidationErrors();
       $output = "<p>Felaktigt ifyllt formulär.</p>";
       $output .= "<ul>";
       foreach ($errors as $error) {
          $output .= '<li><strong>'.$error['label'].'</strong> '.$error['message'].'</li>';
       }
       $output .= "</ul>";

        echo json_encode(array(
            'status' => 'failure',
            'output' => $output,
            'totalSum' => $totalSum
        ));
    }
}
