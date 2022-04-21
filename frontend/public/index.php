<?php
require "sessions.php";
include_once("db.php");

if (!isset($_COOKIE["session"]) || empty(get_user_by_session($_COOKIE["session"]))) {
    header("Location: /signin.php");
    exit();
} else {
    $USER = get_user_by_session($_COOKIE["session"]);
    $USER_STOCKS = run_sql_query("WITH user_stcks AS (SELECT * FROM user_stocks WHERE user_id=$1) SELECT * FROM user_stcks JOIN stocks ON stock_symbol=stocks.symbol", $USER[0]);
    if (empty($USER_STOCKS)) {
        $USER_STOCKS = array();
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
            <a href='/newstock.php'>Track a new stock</button>
                <br>
                <select>
                    <option>--</option>
                    <?php
                    foreach ($USER_STOCKS as $stock) {
                        echo "<option>$stock[0]</option>";
                    }
                    ?>
                </select>
    </div>


</body>

</html>