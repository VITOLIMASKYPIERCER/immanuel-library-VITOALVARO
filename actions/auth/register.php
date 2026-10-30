<?php

session_start();

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/auth-validation.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['register'])) {
    header('Location: ../../pages/auth/register.php');
    exit;
}


$request = getRegisterRequest($_POST);
$errors = validateRegister($request);

if ($errors !== []) {
    $_SESSION['errors'] = $errors;
    unset($request['password'], $request['password_confirmation']);
    $_SESSION['old'] = $request;
    header('Location: ../../pages/auth/register.php');
    exit;
}


try {
    $pdo->beginTransaction();


    $query = "insert into users (name, email, password, role)
              values (:name, :email, :password, :role)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => password_hash($request['password'], PASSWORD_BCRYPT),
        'role' => 'member'
    ]);


    $pdo->commit();
    $_SESSION['success'] = "Akun berhasil dibuat. Silakan masuk untuk melanjutkan.";
    header('Location: ../../pages/auth/login.php');
    exit;


} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    throw $e;
}

?>