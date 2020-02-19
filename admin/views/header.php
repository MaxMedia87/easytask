<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title><?= $pagetitle ?></title>
    </head>
    <body class="bg-light">
<header>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="/admin/" class="navbar-brand d-flex align-items-center">
        <strong>Админ панель</strong>
      </a>
      <?php if (isset($_SESSION['auth']['login'])): ?>
          <a class="btn btn-primary" href="?action=logout" role="button">Выйти</a>
      <?php endif ?>
    </div>
  </div>
</header>