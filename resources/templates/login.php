<div style="color:red;"><?=$error;?></div>
<div style="width:400px;margin:0 auto;">
<form action="index.php?view=login" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ваш email" name="email" value="<?=$_POST['email']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль" name="password">
  </div>
  <input type="submit" class="btn btn-primary" value="Войти" name="login">&nbsp;&nbsp;&nbsp;<a href="index.php?view=registration">Регистрация</a>
</form>
</div>