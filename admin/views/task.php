<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/header.php'
?>
<main role="main" class="container">
    <?php foreach ($tasks as $task): ?>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <?= $task['status'] == '2' ? '<span class="badge badge-warning">Выполнено</span>' : '' ?>
        <?= $task['status_edit'] == '2' ? '<span class="badge badge-success">Отредактировано администратором</span>' : '' ?>
          <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-gray">
              <strong class="d-block text-gray-dark"><?= $task['name'] ?> | <?= $task['email'] ?></strong>
              <?= $task['message'] ?>
            </p>
            <a href="edit/?task=<?= $task['id']?>">Редактировать</a>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" data-id="<?= $task['id']?>" class="custom-control-input" name="checkbox<?= $task['id']?>" id="customCheck<?= $task['id']?>" <?= $task['status'] == '2' ? 'checked' : '' ?>>
            <label class="custom-control-label" for="customCheck<?= $task['id']?>">Выполнено</label>
          </div>
      </div>      
    <?php endforeach ?>
    <?php if ($countPages > 1): ?>
    <ul class="pagination">
      <?= $pagination ?>
    </ul>
    <?php endif ?>
    <?php if (isset($errors)): ?>
      <?php foreach ($errors as $error): ?>
          <div class="alert alert-danger" role="alert">
            <?= $error ?>
          </div>          
      <?php endforeach ?>    
    <?php endif ?>
    <?php if (isset($_SESSION['task']['success'])): ?>
      <div class="alert alert-success" role="alert">
        <?= $_SESSION['task']['success'] ?>
      </div>      
    <?php endif ?>
</main>

<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/footer.php'
?>