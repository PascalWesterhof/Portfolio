<?php
// function.php
function check_login($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    
        try {
            // Prepare a PDO statement to prevent SQL injection
            $query = "SELECT * FROM users WHERE user_id = :user_id LIMIT 1";
            $stmt = $con->prepare($query);
    
            // Bind the parameter
            $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the result
            if ($stmt->rowCount() > 0) {
                $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
                return $user_data;
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Database error: " . $e->getMessage();
        }
    }
    //redirect to login
    header("location: login.php");
    die;
}

function random_num($length)
{
    $text="";
    if($length < 5)
    {
        $length = 5; 
    }

    $len = rand(4, $length);
    
    for($i = 0; $i < $len; $i++)
    {
        $text .= rand(0, 9);
    }
    return $text;
}