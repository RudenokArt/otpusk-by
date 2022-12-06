<?php 

$arr_locations_mice_list = [
  'sity-mice',
  'eco-mice',
  'medical-mice',
];



?>
<?php foreach ($arr_locations_mice_list as $key => $value): ?>
  <?php $locations_mice_list = $arResult->locationsList($value); ?>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
      <div class="h4">
        <?php echo $locations_mice_list['section']['NAME']; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="h6">
        <?php echo $locations_mice_list['section']['DESCRIPTION']; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <?php foreach ($locations_mice_list['list'] as $key1 => $value1): ?>
      <a href="?tab=location&id=<?php echo $value1['ID'] ?>" class="col-lg-4 col-md-6 col-sm-6">
        <div style="background-image: url('<?php echo CFile::GetFileArray($value1['PICTURE'])['SRC']; ?>');"
          class="col-lg-12 col-md-12 col-sm-12 locations_list-item-image"></div>
          <div class="text-center h5">
            <?php echo $value1['NAME'] ?>
          </div>
        </a>
      <?php endforeach ?>
    </div>
  <?php endforeach ?>



  <pre><?php print_r($arResult->locationsList('sity-mice')); ?></pre>