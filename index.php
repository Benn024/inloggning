<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_NAME", "inloggning");
define("DB_PASSWORD", "");

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

$username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'passw', FILTER_SANITIZE_SPECIAL_CHARS);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My name is Scott Malkinson and I got diabetes...</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <h3>
            Inloggning
        </h3>


        <form method="POST">

            <input type="text" name="user" placeholder="Username">
            <br />
            <input type="text" name="passw" placeholder="Password">

            <input type="submit" value="skicka" name="action"> 
        </form>
<?php
if (isset($_POST["action"])) {
    $sql = "SELECT * FROM `saker` WHERE `username`='" . $_POST["user"] . "' AND `password`='" . $_POST["passw"] . "'";


//$sql = "SELECT * FROM saker";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $login = $stmt->fetchAll();
    echo "<br />";
    if ($login != null) {
        echo "Grattis, du har loggat in!";
    } else {
        echo "Du har angett fel användarnamn...";
    }
}
?>

    </body>
</html>