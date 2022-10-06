<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="/tours" method="get" class="tours_search_filter_form pb-10">
	<div class="container pt-5">
    <div class="row">

      <div class="col-lg-4 col-md-6 col-sm-6 pt-5">
        <select name="town_from" class="form-control">
          <option value="">Откуда...</option>
          <?php foreach ($arResult->towns_from_list as $key => $value): ?>
            <option <?php if ($_GET['town_from'] == $value['ID']): ?>
            selected
            <?php endif ?> value="<?php echo $value['ID'];?>"><?php echo $value['NAME'];?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-6 pt-5">
        <select name="town_to" class="form-control">
          <option value="">Куда...</option>
          <?php foreach ($arResult->towns_to_list as $key => $value): ?>
            <option <?php if ($_GET['town_to'] == $value['ID']): ?>
            selected
            <?php endif ?> value="<?php echo $value['ID'];?>"><?php echo $value['NAME'];?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-6 pt-5">
        <select name="country" class="form-control">
          <option value="">Страна...</option>
          <?php foreach ($arResult->country_list as $key => $value): ?>
            <option <?php if ($_GET['country'] == $value['ID']): ?>
            selected
            <?php endif ?> value="<?php echo $value['ID'];?>"><?php echo $value['NAME'];?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 pt-10">
        <input <?php if ($_GET['search']): ?>
        value="<?php echo $_GET['search'];?>"
        <?php endif ?> name="search" type="text" class="form-control" placeholder="Название тура">
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6">
        <label class="pt-5">
          <input <?php if ($_GET['tours_type'] == 'combi-aviaturs'): ?>
            checked
          <?php endif ?> type="radio" name="tours_type"  value="combi-aviaturs">
          Сборные авиатуры
        </label>
        <label class="pt-5">
          <input <?php if ($_GET['tours_type'] == 'authors-tours'): ?>
            checked
          <?php endif ?> type="radio" name="tours_type"  value="authors-tours">
          Авторские туры
        </label>
      </div>  

      <div class="col-lg-3 col-md-6 col-sm-6 pt-5">
        <button class="btn btn-primary w-100">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </div>
    </div>

  </div>
</form>