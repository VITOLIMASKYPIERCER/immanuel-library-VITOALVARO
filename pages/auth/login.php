<?php

// session_start();
// $errors = $_SESSION['errors'] ?? [];
// $old = $_SESSION['old'] ?? [];
// unset($_SESSION['errors'], $_SESSION['old']);

require_once __DIR__ . "/../../middleware/auth.php";
session_start();
requireGuest();

$success = $_SESSION['success'] ?? '';
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['success'], $_SESSION['errors'], $_SESSION['old']);

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/auth/login.css">
</head>

<body>

  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">
        <span class="logo-badge">PD</span>
        Perpustakaan Digital
      </div>
      <h1>Selamat Datang Kembali</h1>
      <p class="auth-subtitle">Masuk untuk mengelola koleksi buku perpustakaan.</p>


      <!-- <?php if ($success !== ''): ?>
        <p style="color: green; font-size: 12px; margin-bottom: 12px;">
          <?= $success ?>
        </p>
      <?php endif; ?> -->

      <?php if ($success !== ''): ?>
        <p style="color: green; font-size: 12px; margin-bottom: 12px;">
          <?= $success ?>
        </p>
      <?php endif; ?>


      <?php if (isset($errors['login'])): ?>
        <p style="color: red; font-size: 12px; margin-bottom: 12px;">
          <?= $errors['login'] ?>
        </p>
      <?php endif; ?>


      <!-- <form method="" action=""> -->
      <form method="POST" action="../../actions/auth/login.PHP">
        
        <div class="form-group">
          <label for="email">Email</label>
          <!-- <input type="email" id="email" name="email" placeholder="nama@sekolah.sch.id"> -->
          <input value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" type="email" id="email" name="email" placeholder="nama@sekolah.sch.id">
          
          <?php if (isset($errors['email'])): ?>
            <p style="font-size:12px; margin-top:4px; color: red;">
              <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?>
            </p>
          <?php endif; ?>
        </div>


        <div class="form-group">
          <label for="password">Kata Sandi</label>
          <input type="password" id="password" name="password" placeholder="Masukkan kata sandi">
          
          <?php if (isset($errors['password'])): ?>
            <p style="font-size:12px; margin-top:4px; color: red;">
              <?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?>
            </p>
          <?php endif; ?>
        </div>


        <!-- <button type="submit" class="btn btn-primary btn-block">Masuk</button> -->
        <button name="login" type="submit" class="btn btn-primary btn-block" style="margin-top: 15px;">Masuk</button>

      </form>

      <p class="form-footer-link">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
      </p>
    </div>
  </div>

</body>
</html>