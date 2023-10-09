<?php 
    session_start();

if(!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}    

function checkAccess(){
    if(!isset($_SESSION['member'])){
        header('Location: login.php');
        exit();
    }
}

function connectDB() {
    $mysqli = new mysqli('localhost', 'root', '', 'feladat_db');
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    return $mysqli;
}


function login($username, $password){
    $mysqli = connectDB();
    
    $stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if(password_verify($password, $hashed_password)){
        session_regenerate_id(true);

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        $_SESSION['member'] = $username;
        header('Location: protected.php');
        exit();
    }else{
        return "Wrong Username or Password!";
    }
}

// function login($username, $password){
//     $mysqli = new mysqli('localhost', 'root', '', 'feladat_db');
//     $sql = "SELECT username, password FROM users WHERE username = '$username' AND password = '$password'";
//     $mysqli->query($sql);

//     if($mysqli->affected_rows == 1){
//         $_SESSION['member'] = $username;
//         header('Location: protected.php');
//         exit();
//     }else{
//         return "Wrong Username or Password!";
//     }
// }

function logout(){
    unset($_SESSION['member']);
    header('Location: index.php');
    exit();
}

function register($username, $password){
    $mysqli = connectDB();
    
    $stmt = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->close();
        return '<span style="color: red;">Username already exist!</span>';
    }
    $stmt->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    
    if($stmt->execute()) {
        return '<span style="color: green;">Registration successful!</span>';
    } else {
        return '<span style="color: red;">Registration failed!</span>';
    }
}

function changeUsername($newUsername) {
    $currentUsername = $_SESSION['member'];
    $mysqli = connectDB();

    $stmt = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $newUsername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        return '<span style="color: red;">This username is already taken!</span>';
    }
    $stmt->close();

    $stmt = $mysqli->prepare("UPDATE users SET username = ? WHERE username = ?");
    $stmt->bind_param("ss", $newUsername, $currentUsername);
    $stmt->execute();

    if ($stmt->affected_rows == 1) {
        $_SESSION['member'] = $newUsername;
        $stmt->close();
        return '<span style="color: green;">Username updated successfully!</span>';
    } else {
        $stmt->close();
        return '<span style="color: red;">Error updating username!</span>';
    }
}

function changePassword($newPassword) {
    $username = $_SESSION['member'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $mysqli = connectDB();

    $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $hashedPassword, $username);
    $stmt->execute();

    if ($stmt->affected_rows == 1) {
        $stmt->close();
        return '<span style="color: green;">Password updated successfully!</span>';
    } else {
        $stmt->close();
        return '<span style="color: red;">Error updating password!</span>';
    }
}

function deleteAccount() {
    $username = $_SESSION['member'];
    $mysqli = connectDB();

    $stmt = $mysqli->prepare("DELETE FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    if ($stmt->affected_rows == 1) {
        $stmt->close();
        logout();
        exit();
    } else {
        $stmt->close();
        return '<span style="color: red;">Error deleting account!</span>';
    }
}

function validateChangeUsername($newUsername) {
    $message = '';

    if (empty($newUsername)) {
        $message = '<span style="color: red;">New Username cannot be empty.</span>';
    } elseif (strlen($newUsername) < 3) {
        $message = '<span style="color: red;">Username must be at least 3 characters long.</span>';
    } elseif (preg_match("/[^a-zA-Z0-9]/", $newUsername)) {
        $message = '<span style="color: red;">Username cannot contain special characters.</span>';
    } elseif (strpos($newUsername, " ") !== false) {
        $message = '<span style="color: red;">Username cannot contain spaces.</span>';
    }

    return $message;
}


function validateChangePassword($newPassword) {
    $message = '';

    if (empty($newPassword)) {
        $message = '<span style="color: red;">New Password cannot be empty.;</span>';
    } elseif (strlen($newPassword) < 6) {
        $message = '<span style="color: red;">Password must be at least 6 characters long.</span>';
    } elseif (!preg_match("/[A-Z]/", $newPassword)) {
        $message = '<span style="color: red;">Password must contain at least one uppercase character.</span>';
    } elseif (!preg_match("/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/", $newPassword)) {
        $message = '<span style="color: red;">Password must contain at least one special character.</span>';
    } elseif (!preg_match("/\d/", $newPassword)) {
        $message = '<span style="color: red;">Password must contain at least one numeric character.</span>';
    }
    return $message;
}



