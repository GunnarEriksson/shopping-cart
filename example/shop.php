<?php
require('bookshop.php');

// Create the session
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();

// Get incoming on what to do
$action = isset($_GET['action']) ? $_GET['action'] : null;

if ($action == 'clear' || !isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array('totalNumOfItems' => 0, 'totalSum'=>0, 'items'=>array());
}

if ($action == 'add' && !empty($_POST['item'])) {
    $itemId = $_POST['item'];
    $title = isset($bookshop[$itemId]['title']) ? $bookshop[$itemId]['title'] : '';
    $price = isset($bookshop[$itemId]['price']) ? $bookshop[$itemId]['price'] : '0';

    if(isset($_SESSION['cart']['items'][$itemId])) {
        $_SESSION['cart']['items'][$itemId]['numOfItems']++;
        $_SESSION['cart']['items'][$itemId]['sum'] += $price;
    } else {
        $_SESSION['cart']['items'][$itemId] = array('numOfItems' => 1, 'sum' => $price, 'title' => $title);
    }

    $_SESSION['cart']['totalNumOfItems']++;
    $_SESSION['cart']['totalSum'] += $price;
}

// Draw html table of items    by using a view/template file
$items = $_SESSION['cart']['items'];

$rows = null;
foreach($items as $key => $val) {
    $rows .= "<tr><td>{$val['title']}</td><td>{$val['numOfItems']}</td><td>{$val['sum']}</td></tr>\n";
}


$items = $_SESSION['cart']['content'] = <<<EOD
<table>
    <tr><th>Vara</th><th>Antal</th><th>Summa</th></tr>
    {$rows}
</table>

EOD;


// Print out the content of the shopping cart
header('Content-type: application/json');
echo json_encode($_SESSION['cart']);
