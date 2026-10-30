<?php


session_start();
require_once __DIR__ . "/../../validations/auth-validation.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['login'])) {
    header('Location: ../../pages/auth/login.php');
    exit;
}




$request = getLoginRequest($_POST);
$errors = validateLogin($request);

if ($errors !== []) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = ['email' => $request['email']];
    header('Location: ../../pages/auth/login.php');
    exit;
}




$user = findUserByEmail($request['email']);
if (!$user || !password_verify($request['password'], $user['password'])) {
    $_SESSION['errors'] = ['login' => 'Email atau kata sandi salah'];
    $_SESSION['old'] = ['email' => $request['email']];
    header('Location: ../../pages/auth/login.php');
    exit;
}




session_regenerate_id(true);
$_SESSION['user'] = [
    'id' => $user['id'],
    'name' => $user['name'],
    'email' => $user['email'],
    'role' => $user['role'],
];

header('Location: ../../pages/books/index.php');
exit;

?>