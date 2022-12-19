  <?php $mice_location = $arResult->miceLocation($_GET['id']); ?>
  <div class="row">
    <div class="col-12 text-center h3">
      <?php echo $mice_location['section']['NAME']; ?>    
    </div>
  </div>
  <?php foreach ($mice_location['list'] as $key => $value): ?>
    <div class="row pt-5">
    <div class="col-lg-6 col-md-6 col-sm-12 mice-location-slider">
      <?php foreach ($arResult->miceLocProperty($value['IBLOCK_ID'], $value['ID']) as $key1 => $value1): ?>
        <div style="background-image: url('<?php echo CFile::GetFileArray($value1['VALUE'])['SRC'];?>');"
          class="mice-location-slider-item"></div>
      <?php endforeach ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
      <div class="h4">
        <?php echo $value['NAME'] ?>
        <div class="h6">
          (<?php echo $value['PREVIEW_TEXT'] ?>)
        </div>
      </div>
      <div class="">
        <?php echo $value['DETAIL_TEXT'] ?>
      </div>
    </div>
  </div>
  <?php endforeach ?>

<script>
  $('.mice-location-slider').slick();
</script>
