<?php $arResult->mice_events_list = $arResult->miceEventsList();?>
<div class="row">
  <div class="col h5 text-center">
    События
  </div>
</div>
<div class="row mice_locations-list">
  <?php foreach ($arResult->mice_events_list as $key => $value): ?>
    <a href="#"
      class="col-lg-4 col-md-4 col-sm-6 col-12 mice_locations-item border">
      <div class="mice_locations-item_image" style="background-image: url('<?php echo CFile::GetFileArray($value['PREVIEW_PICTURE'])['SRC'];?>')";></div>
      <div class="h5 text-center mice_locations-item_text">
        <?php echo $value['NAME']; ?>
      </div>
    </a>
  <?php endforeach ?>
</div>