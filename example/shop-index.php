<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <script src="js/jquery.js"></script>
        <script src="../jquery.geShoppingCart.js"></script>
        <script src="js/main.js"></script>
        <title>Affär</title>
    </head>
    <body>
        <?php require('bookshop.php'); ?>
        <h1>Bokaffär</h1>
        <div id="cart">
            <div id="cart-heading">
                <h3>Din kundvagn</h3>
            </div>
            <div id='cart-content'></div>
            <div id="cart-total">
                <p>
                    Antal varor: <span id="total-num-of-items">0</span><br/>
                    Att betala: <span id="total-sum">0</span> Kr<br/><br/>
                    <button onclick="location.href = 'paydesk.php';">Till kassan</button>
                    <button class="clear" type="button" name="button">Töm varukorg</button>
                </p>
            </div>
        </div>
        <div id="shop">
            <h3>Böcker</h3>
            <ul>
                <?php foreach($bookshop as $id => $book): ?>
                    <li>
                        <div class="wrapper">
                            <div class="img">
                                <img src="<?= $book['img'] ?>" alt="<?= $book['alt'] ?>" />
                            </div>
                            <div class="content">
                                <div class="heading">
                                    <h4><?= $book['title'] ?></h4>
                                </div>
                                <div class="author">
                                    <span class="small">av <span class="dark-green"><?= $book['author'] ?></span></span>
                                </div>
                                <div class="info">
                                    <?= $book['info'] ?>
                                </div>
                                <div class="price">
                                    <span class="amount"><?= $book['price'] ?></span><span class="dark-green"> Kr</span>
                                </div>
                                <div class="description">
                                    <p><?= $book['description'] ?></p>
                                </div>
                                <div class="button-wrapper">
                                    <button id="<?= $id ?>" class="buy" type="button" name="button">Köp</button>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </body>
</html>
