
<div class="container">
  <?php if ($arResult->items_list): ?>
    <?php foreach ($arResult->items_list as $key => $value): ?>
      <div class="row pt-20">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <a href="?tour_id=<?php echo $value['ID'];?>">
              <img src="<?php echo CFile::GetFileArray($value['PREVIEW_PICTURE'])['SRC'] ?>" alt="<?php echo $value['NAME']; ?>">
            </a>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-6">
          <div class="h4">
            <a href="?tour_id=<?php echo $value['ID'];?>">
              <?php echo $value['NAME']; ?>
            </a>
          </div>
          <div class="pt-5">
            <?php echo $value['PREVIEW_TEXT'];?>
            <a href="?tour_id=<?php echo $value['ID'];?>">
              Подробнее...
            </a>
          </div>

          <div class="pt-5">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <?php if ($value['PROPERTY_POINT_DEPARTURE_VALUE']): ?>
              <?php echo ToursList::getTownByID($value['PROPERTY_POINT_DEPARTURE_VALUE'][0])['NAME'];?>
            <?php endif ?>
            ~
            <?php if ($value['PROPERTY_TOWN_VALUE']): ?>
              <?php echo ToursList::getTownByID($value['PROPERTY_TOWN_VALUE'][0])['NAME'];?>
            <?php endif ?>
            || ночей: <?php echo $value['PROPERTY_DAYS_VALUE'];?>
            дней: <?php echo $value['PROPERTY_DAYS_VALUE'] + 1; ?>
          </div>
          <div class="pt-5">
            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            <?php foreach ($value['PROPERTY_DEPARTURE_VALUE'] as $key1 => $value1): ?>
              | <?php echo $value1;?>
            <?php endforeach ?>
          </div>
          <?php $order_tour = $value ?>
          <?php include 'order-button.php';?>
        </div>
      </div>
    <?php endforeach ?>
  <?php else: ?>
    <div class="alert alert-danger mt-50 text-center h6" role="alert">
      По вашему запросу ничего не найдено. Уточните параметры поиска.
    </div>
  <?php endif ?>
  <div class="row">
    <div class="col text-center pb-50 pt-50">
      <?php for ($i=1; $i <= $arResult->NavPageCount; $i++) : ?>
        <a href="?<?php echo $arResult->swichPage($i);?>"
          <?php if ($i == $arResult->NavPageNomer): ?>
            style="color: #EB5019;"
          <?php endif ?>
          class="tours_list_pagination_item">
          <?php echo $i;?>
        </a>
      <?php endfor; ?>
    </div>
  </div>
</div>


