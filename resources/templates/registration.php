<div style="color:red;"><?=$error;?></div>
<div style="color:red;"><?=$msg;?></div>
<div style="width:400px;margin:0 auto;">
<form action="index.php?view=registration" method="post">
  <div class="form-group">
    <label for="exampleInputName">Имя</label>
    <input type="text" class="form-control" id="exampleInputName" name="name" maxlength="15" placeholder="Ваше имя" value="<?=$_POST['name']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputAddress">Email</label>
    <input type="email" class="form-control" id="exampleInputAddress" name="email" maxlength="25" placeholder="Ваш email" value="<?=$_POST['email']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" maxlength="15" placeholder="Пароль 3-15 символов">
  </div>
  <input type="submit" class="btn btn-primary" value="Регистрация" name="registration">
</form>
</div>
