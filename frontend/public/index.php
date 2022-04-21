<?php
if (!isset($_COOKIE["session"])) {
    header("Location: /signup");
    exit();
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
    </div>


</body>

</html>