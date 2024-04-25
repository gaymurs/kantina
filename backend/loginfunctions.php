<?php
class loginfunctions {
    public static function signup(string $username, string $email, string $password, string $confirm_password)
    {
        if ($password !== $confirm_password) {
            header("Location: index.php?error=passwordsDontMatch");
        }
        include_once "backend/checkPost.php";
        try {
            include_once "backend/database.php";
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password_hash);
            $stmt->execute();

            loginfunctions::login($email, $password);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    public static function login(string $email, string $password)
    {
        include_once "backend/checkPost.php";
        try {
            include_once "backend/database.php";

            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump(!password_verify($password, $user['password']));
            if (!password_verify($password, $user['password'])) {
                header("Location: index.php?error=invalidLoginPassword");
                die();
            }
            session_start();
            $_SESSION['user'] = $user;


            header("Location: index.php?login=true");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    public static function logout()
    {
        session_start();
        $_SESSION['user'] = null;
        header("Location: index.php?login=logout");
    }
}
