<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/header.php'
?>

<main role="main" class="container">
	<div class="col col-lg-4">
		<h1>Авторизация</h1>
	    <?php if (isset($errors)): ?>
	      <?php foreach ($errors as $error): ?>
	          <div class="alert alert-danger" role="alert">
	            <?= $error ?>
	          </div>          
	      <?php endforeach ?>    
	    <?php endif ?>
	    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
	      <div class="form-group">
	        <label>Логин</label>
	        <input type="text" class="form-control" placeholder="Логин" name="login">
	      </div>
	      <div class="form-group">
	        <label>Пароль</label>
	        <input type="password" class="form-control" placeholder="Пароль" name="password">
	      </div>
	      <button type="submit" class="btn btn-primary" name="send">Войти</button>
	    </form>
	</div>
</main>
<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/footer.php'
?>