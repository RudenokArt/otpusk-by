<?php $events_mice_list = $arResult->miceEvents('mice-events'); ?>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 text-center h4">
    <?php echo $events_mice_list['section']['NAME'] ?>
  </div>
</div>
<div class="row">
  <?php foreach ($events_mice_list['list'] as $key => $value): ?>
    <?php 
    $event_mice_images_arr = [];
    foreach ($arResult->miceLocProperty($value['IBLOCK_ID'], $value['ID']) as $key1 => $value1) {
      array_push($event_mice_images_arr, CFile::GetFileArray($value1['VALUE'])['SRC']);
    }
    ?>
    <div data-json=<?php echo json_encode($event_mice_images_arr) ?> class="col-lg-4 col-md-6 col-sm-12 pt-5 mice-events-list-item">
      <div style="background-image: url('<?php echo $event_mice_images_arr[0];?>')"
        class="mice-events-list-item-img"></div>
        <div class="h6 text-center">
          <?php echo $value['NAME']; ?>
        </div>
      </div>
    <?php endforeach ?>
  </div>

  <div class="mice-events-popup-wrapper" id="mice-events-popup-wrapper">
    <div class="mice-events-popup">
      <div class="mice-events-popup-close text-right text-danger">
        <i class="fa fa-times" aria-hidden="true"></i>
      </div>
       <div class="mice-events-popup-slider" id="mice-events-popup-slider"></div>
      </div>
    </div>


    <script>
      $('.mice-events-list-item').click(function () {
        $('#mice-events-popup-wrapper').css({'display':'flex'});
        var json = $(this).attr('data-json');
        var arr = JSON.parse(json);
        var str = '';
        for (var i = 0; i < arr.length; i++) {
          str = str + '<div style="background-image: url('+arr[i]+');" class="mice-events-popup-slider-item"></div>';
          console.log(arr[i]);
        }
        $('#mice-events-popup-slider').html(str);
        $('#mice-events-popup-slider').slick();
      });
      $('.mice-events-popup-close').click(function (e) {
        e.stopPropagation();
        $('#mice-events-popup-wrapper').css({'display':'none'});
        $('#mice-events-popup-slider').slick('unslick');
      });
    </script>