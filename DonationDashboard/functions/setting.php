<?php
function dbConnect() {
    $host = 'localhost';
    $db = 'vitacare_db';
    $user = 'root';
    $pass = '';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    
    try {
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function changePassword($email, $oldPassword, $newPassword) {
    $pdo = dbConnect();

    // Fetch the user by email
    $stmt = $pdo->prepare("SELECT password FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        return ['status' => 'error', 'message' => 'User not found'];
    }

    // Verify old password
    if (!password_verify($oldPassword, $user['password'])) {
        return ['status' => 'error', 'message' => 'Old password is incorrect'];
    }

    // Hash the new password
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $updateStmt = $pdo->prepare("UPDATE users SET password = :newPassword WHERE email = :email");
    $updateStmt->execute(['newPassword' => $hashedNewPassword, 'email' => $email]);

    return ['status' => 'success', 'message' => 'Password changed successfully'];
}

function deactivateAccount($email, $reason) {
    $pdo = dbConnect();

    // Update the user's account status to 'deactivated'
    $stmt = $pdo->prepare("UPDATE users SET status = 'deactivated', deactivation_reason = :reason WHERE email = :email");
    $stmt->execute(['reason' => $reason, 'email' => $email]);

    return ['status' => 'success', 'message' => 'Your account has been deactivated'];
}
?>
