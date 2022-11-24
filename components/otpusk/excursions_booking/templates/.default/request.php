<?php $value = $arResult->excursions_list['list'][0]; ?>
<pre><?php print_r($_POST); ?></pre>

<br>
<?php if ($_POST['request']): ?>
  <div class="alert alert-success text-center h5" role="alert">
    Ваша заявка приянята. Наш менеджер свяжется с вами.
  </div>
  <?php echo '<meta http-equiv="refresh" content="5; url=?page_N=1" />'; ?>
<?php else: ?>
  <form action="" method="post" class="row">
    <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 border">
      <div class="h4 text-center">
        Заявка на экскурсию
      </div>
      <div class="h3 text-center">
        <?php echo $value['NAME']; ?>
      </div>
      <div>
        ФИО:
        <input type="text" name="fio" class="form-control" required>
      </div>
      <div>
        тел.:
        <input type="text" name="phone" class="form-control" required>
      </div>
      <div>
        email:
        <input type="email" name="email" class="form-control" required>
      </div>
      <br>
      <div class="text-center">
        <a href="?detail=<?php echo $_GET['request'];?>" title="Отмена" class="btn btn-primary">
          <i class="fa fa-times" aria-hidden="true"></i>
          Отмена
        </a>
        <button name="request" value="Y" class="btn btn-primary">
          <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
          Отправить заявку
        </button>
      </div>
      <br>
    </div>
  </form>
<?php endif ?>


<br>