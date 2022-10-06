<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
</div></div></div>
<form action="" method="get">
	<div class="container pt-5 mt-5 pb-5 border-bottom">
		<div class="row pt-5">
      <div class="col-lg-6 col-md-12 col-sm-12 pt-10">
        Поиск тура:
        <input <?php if ($_GET['search']): ?>
          value="<?php echo $_GET['search'];?>"
        <?php endif ?> name="search" type="text" class="form-control" placeholder="Название тура">
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 pt-10">
        Продолжительность (ночей) от:
        <input <?php if ($_GET['nights_from']): ?>
          value="<?php echo $_GET['nights_from'] ?>"
        <?php endif ?> type="text" name="nights_from" class="form-control tours_list_filter-nights">
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 pt-10">
        Продолжительность (ночей) до:
        <input <?php if ($_GET['nights_to']): ?>
          value="<?php echo $_GET['nights_to'] ?>"
        <?php endif ?> type="text" name="nights_to" class="form-control tours_list_filter-nights">
      </div>
      <div class="col-lg-3 col-md-4 col-sm-4 pt-10">
        <select name="town_from" class="form-control">
          <option value="">Откуда...</option>
          <?php foreach ($arResult->towns_from_list as $key => $value): ?>
            <option <?php if ($_GET['town_from'] == $value['ID']): ?>
              selected
            <?php endif ?> value="<?php echo $value['ID'];?>"><?php echo $value['NAME'];?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-4 pt-10">
        <select name="town_to" class="form-control">
          <option value="">Куда...</option>
          <?php foreach ($arResult->towns_to_list as $key => $value): ?>
            <option <?php if ($_GET['town_to'] == $value['ID']): ?>
              selected
            <?php endif ?> value="<?php echo $value['ID'];?>"><?php echo $value['NAME'];?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-4 pt-10">
        <select name="country" class="form-control">
          <option value="">Страна...</option>
          <?php foreach ($arResult->country_list as $key => $value): ?>
            <option <?php if ($_GET['country'] == $value['ID']): ?>
              selected
            <?php endif ?> value="<?php echo $value['ID'];?>"><?php echo $value['NAME'];?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 pt-10">
        <button class="btn btn-primary w-100">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </div>

		</div>
    <div class="row pt-5">
      <div class="col-lg-3 col-md-6 col-sm-6 pt-10">
        <label class="pt-5">
          <input <?php if ($_GET['tours_type'] == 'combi-aviaturs'): ?>
            checked
          <?php endif ?> type="radio" name="tours_type"  value="combi-aviaturs">
          Сборные авиатуры
        </label>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 pt-10">
        <label class="pt-5">
          <input <?php if ($_GET['tours_type'] == 'authors-tours'): ?>
            checked
          <?php endif ?> type="radio" name="tours_type"  value="authors-tours">
          Авторские туры
        </label>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 pt-10">
        Сортировка по дате: 
        <button <?php if ($_GET['sort_date'] == 'desc'): ?>
          style="color: blue;"
        <?php endif ?> name="sort_date" value="desc" class="tours_list_filter-sort">
          <i class="fa fa-sort-desc" aria-hidden="true"></i>
        </button>
        <button <?php if ($_GET['sort_date'] == 'asc'): ?>
          style="color: blue;"
        <?php endif ?> name="sort_date" value="asc" class="tours_list_filter-sort">
          <i class="fa fa-sort-asc" aria-hidden="true"></i>
        </button>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 pt-10">
        <a class="btn btn-primary" href="?">
          <i class="fa fa-times" aria-hidden="true"></i>
        </a>
      </div>
    </div>
	</div>
</form>
<?php if (isset($_POST['order_tour'])): ?>
	<?php include_once 'order-result.php'; ?>
<?php elseif (isset($_GET['order_tour'])): ?>
	<?php include_once 'order-form.php';?>
<?php elseif (isset($_GET['tour_id'])): ?>
	<?php include_once 'detail-page.php'; ?>
<?php else: ?>
	<?php include_once 'list-page.php'; ?>
<?php endif ?>
