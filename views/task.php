<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/views/header.php'
?>

<main role="main" class="container">
<div class="form-row my-3">
    <div class="form-group col-md-4">
      <select id="sortFields" class="form-control" name="sortfields">
        <option hidden>Сортировать по:</option>
        <option value="name">Имя</option>
        <option value="email">Email</option>
        <option value="status">Статус</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <select id="sortBy" class="form-control" name="sortby">
        <option hidden>Направление сортировки:</option>
        <option value="desc">Убыванию</option>
        <option value="asc">Возрастанию</option>
      </select>
    </div>  
</div>
    <?php foreach ($tasks as $task): ?>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <?= $task['status'] == '2' ? '<span class="badge badge-warning">Выполнено</span>' : '' ?>
        <?= $task['status_edit'] == '2' ? '<span class="badge badge-success">Отредактировано администратором</span>' : '' ?>
          <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-gray">
              <strong class="d-block text-gray-dark"><?= $task['name'] ?> | <?= $task['email'] ?></strong>
              <?= $task['message'] ?>
            </p>
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
    <div class="bd-example my-3">
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
          <div class="form-group">
            <label>Имя</label>
            <input type="text" class="form-control" placeholder="Имя" name="name">
          </div>
          <div class="form-group">
            <label>E-mail</label>
            <input type="text" class="form-control" placeholder="E-mail" name="email">
          </div>
          <div class="form-group">
            <label>Текст задачи</label>
            <textarea class="form-control" rows="3" name="message"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="send">Отправить</button>
        </form>
    </div>
</main>

<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/views/footer.php'
?>