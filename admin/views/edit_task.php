<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/header.php'
?>

<main role="main" class="container">
    <div class="bd-example my-3">
      <h1>Редактирование записи</h1>
        <?php if (isset($errors)): ?>
          <?php foreach ($errors as $error): ?>
              <div class="alert alert-danger" role="alert">
                <?= $error ?>
              </div>          
          <?php endforeach ?>
        <?php endif ?>      
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
          <div class="form-group">
            <label>Имя</label>
            <input type="text" class="form-control" placeholder="Имя" name="name" value="<?= $task['name'] ?>">
          </div>
          <div class="form-group">
            <label>E-mail</label>
            <input type="text" class="form-control" placeholder="E-mail" name="email" value="<?= $task['email'] ?>">
          </div>
          <div class="form-group">
            <label>Текст задачи</label>
            <textarea data-status="1" class="form-control" rows="3" name="message"><?= $task['message'] ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="send">Сохранить</button>
        </form>
    </div>
</main>
<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/footer.php'
?>