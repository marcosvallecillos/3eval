<?php
require_once "autoloader.php";
$connection = new Security();
$conn = $connection->crearUsuario();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $conn = new mysqli('db', 'root', 'test', "login_demo");


    $userld = $_POST["userld"];
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];
    $securePassword = $_POST["securePassword"];

    $query = "INSERT INTO users (userld, userName, userPassword, securePassword)
VALUES ('$userld','$userName','$userPassword','$securePassword')";
    mysqli_query($conn, $query);
    mysqli_close($conn);



    header("location: index.php");


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            color: #000;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #000;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #000;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
        }

        button:hover {
            background-color: #111;
        }
    </style>

</head>

<body>
    <form id="form_x" class="class_x" method="post" action="insertar.php">
        
        <label for="userName">Usuario:</label>
        <input type="text" id="userName" name="userName" value="">
        <label for="userPassword">Investment:</label>
        <input type="number" id="userPassword" name="userPassword" value="">
        <button type="submit">Insert</button>
    </form>
</body>

</html>