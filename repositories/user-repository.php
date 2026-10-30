<?php

require_once __DIR__ . "/../config/database.php";


function getUsers()
{
    global $pdo;

    $stmt = $pdo->query("select id, name, email, role from users order by id");
    return $stmt->fetchAll();
}


function getUser()
{
    $user = [
        "id"    => 2,
        "name"  => "Budi Santoso",
        "email" => "budi.santoso@siswa.ski.sch.id",
        "role"  => "member",
    ];

    return $user;
}


function getProfile()
{
    $profile = [
        "user_id" => 2,
        "phone"   => "0812-3456-7890",
        "address" => "Jl. Merdeka No. 21, Pontianak, Kalimantan Barat",
        "bio"     => "Murid kelas XI TKJ yang gemar membaca novel fiksi dan buku pengembangan diri.",
    ];

    return $profile;
}


function isEmailTaken($email)
{
    global $pdo;

    $query = "select count(id) from users where email = :email";


    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'email' => $email
    ]);

    $isEmailTaken = $stmt->fetchColumn() > 0;
    return $isEmailTaken;
}


function findUserByEmail($email)
{
    global $pdo;

    $query = "select * from users where email = :email";

    
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'email' => $email
    ]);

    $user = $stmt->fetch();
    return $user;
}

?>