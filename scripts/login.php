<?php
//login.php
    session_start();

// connection.php
$dbHost = 'mysql';
$dbUser = 'root';
$dbPass = 'qwerty';
$dbName = 'portfolio_db'; //naam van de aangemaakte database in phpmyadmin

try{
    $dbHandler = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass); 
    //Connect to the database with the provided connectstring
} catch(Exception $ex){ //If something goes wrong, catch the error and print it
    echo($ex);
}

    include('functions.php');

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
            try {
                // Prepare a PDO statement to prevent SQL injection
                    $query = "SELECT * FROM users WHERE user_name = :user_name LIMIT 1";
                    $stmt = $dbHandler->prepare($query);
                
                // Bind the parameter
                $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        
                // Execute the query
                $stmt->execute();
        
                // Fetch the result
                if ($stmt->rowCount() > 0) {
                    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        
                    // Verify the password
                    if ($user_data['password'] === $password) {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: ../index.html");
                        die;
                    }
                }
            
                echo "Verkeerde gebruikersnaam of wachtwoord!";
            } catch (PDOException $e) {
                // Handle database errors
                echo "Database error: " . $e->getMessage();
            }
        } else {
            echo "insert valid information";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <div class="box">
            <h1>Welkom!</h1>
            <p>Log in om verder te gaan</p>
            <form method="post" class="loginForm">
                <label for="user_name">Gebruikersnaam:</label>
                <input type="text" name="user_name">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password">
                <input type="submit" value="log in" class="loginButton">
            </form>
        </div>
    </body>
</html>