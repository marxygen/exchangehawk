<?php
require "sessions.php";
include_once("db.php");

$STOCK = null;

if (!isset($_COOKIE["session"]) || empty(get_user_by_session($_COOKIE["session"]))) {
    header("Location: /signin.php");
    exit();
} else {
    $USER = get_user_by_session($_COOKIE["session"]);
    $USER_STOCKS = fetch_rows("WITH user_stcks AS (SELECT * FROM user_stocks WHERE user_id=$1) SELECT symbol FROM user_stcks JOIN stocks ON stock_symbol=stocks.symbol", $USER[0]);
    if (empty($USER_STOCKS)) {
        $USER_STOCKS = array();
    }

    # If some stock is in query params, open it
    if (isset($_GET["symbol"]) && run_sql_query("SELECT EXISTS (SELECT * FROM stocks WHERE symbol = $1)", $_GET["symbol"])[0] == 't') {
        echo "Symbol selected";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div id="header">
        <h1>Exchange <span id='hawk'>Hawk</span></h1>
        <span><b>User</b>: <?php echo $USER[0] ?></span><br>
        <span><b>Stocks tracked</b>: <?php echo count($USER_STOCKS) ?></span>
        <br>
        <small>Please select stock from the list below to view its price change
            <br>
            <a href='/newstock.php'>Track a new stock</a>
            <br>
            <br>
            <select style="width: 120px; height: 50px; font-size: 20px;" onchange="location = '?symbol=' + this.value;">
                <option>--</option>
                <?php
                foreach ($USER_STOCKS as $stock) {
                    echo "<option value='" . $stock["symbol"] . "'>" . $stock["symbol"] . "</a></option>";
                }
                ?>
            </select>
    </div>


</body>

</html>