<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>

  .belavia-search-form-wrapper {
    background-color: #286090;
  }
  .belavia-search-form {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    color: white;
    padding: 5px;
  }
  .belavia-search-form-item-sm,
  .belavia-search-form-item {
    display: flex;
    justify-content: space-between;
    padding: 5px;
    width: 300px;
    position: relative;
  }
  .belavia-search-form-item-sm{
    width: 200px;
  }
  .belavia-search-form button {
    height: 25px;
    outline: none;
    border: none;
    background-color: #286090;
  }
  .belavia-search-form input {
    width: 200px;
    height: 25px !important;
    color: black;
  }
  .belavia-search-form .counter_input {
    width: 50px;
    display: inline-block;
  }
  .belavia-search-form .locations_list {
    position: absolute;
    top: 100%;
    right: 0;
    display: none;
    height: 150px;
    width: 200px;
    overflow: auto;
    background-color: white;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 5px 0px #000000;
    z-index: 10000;
    color: black;
  }
  .belavia-search-form .locations_list p {
    cursor: pointer;
    padding: 10px;
    margin: 0;
  }
  .belavia-search-form .locations_list p:hover {
    background-color: rgba(0, 0, 0, 0.1);
  }
  .belavia-search-form-submit-button {
    /*padding-top: 25px;*/
  }
  .belavia-search-form-submit-button button {
    width: 100px;
    background-color: #EB5019;
  }

</style>

<div class="container belavia-search-form-wrapper">
  <div class="belavia-search-form">

    <div class="belavia-search-form-item">
      <span><?php echo GetMessage('from');?>:</span>
      <input type="text" name="OriginLocation" class="form-control">
      <div id="OriginLocation_list" class="locations_list"></div>
    </div>

    <div class="belavia-search-form-item">
      <span><?php echo GetMessage('where');?>:</span>
      <input type="text" name="DestinationLocation" class="form-control">
      <div id="DestinationLocation_list" class="locations_list">
        <span><?php echo GetMessage('departure_point_warning');?>:</span>
      </div>
    </div>

    <div class="belavia-search-form-item">
     <span><?php echo GetMessage('departure_date');?>:</span>
     <input type="text" name="DepartureDate" class="form-control">
   </div>

   <div class="belavia-search-form-item">
    <span><?php echo GetMessage('return_date');?>:</span>
    <input type="text" name="ReturnDate" class="form-control">
  </div>

  <div class="belavia-search-form-item-sm">
    <span><?php echo GetMessage('adults');?>:</span>
    <div>
      <button name="adults_passanger_delete">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </button>
    <input type="text" value="1" name="adults_passanger_quantity" class="form-control counter_input" readonly>
    <button name="adults_passanger_add">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </button>
    </div>
  </div>

  <div class="belavia-search-form-item-sm">
    <span><?php echo GetMessage('children');?>:</span>
    <div>
      <button name="childrens_passanger_delete">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </button>
    <input type="text" value="0" readonly name="childrens_passanger_quantity" class="form-control counter_input">
    <button name="childrens_passanger_add">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </button>
    </div>
  </div>

  <div class="belavia-search-form-item-sm">
    <span><?php echo GetMessage('infants');?>:</span>
    <div>
      <button name="infants_passanger_delete">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </button>
    <input type="text" value="0" readonly name="infants_passanger_quantity" class="form-control counter_input">
    <button name="infants_passanger_add">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </button>
    </div>
  </div>

  <div class="belavia-search-form-item-sm">
    <div class="belavia-search-form-submit-button">
      <button name="belavia-search-form-submit-button">
        <i class="fa fa-search" aria-hidden="true"></i>
      </button>
    </div>
  </div>

</div>
</div>

<script>
  var BelaviaSearchForm = {};
  BelaviaSearchForm.lang = '<?php echo LANGUAGE_ID; ?>';
  BelaviaSearchForm.locations_list = JSON.parse('<?php echo $arResult["locations_list"]; ?>');
  BelaviaSearchForm.availible_locations = JSON.parse('<?php echo $arResult["availible_locations"]; ?>');
  getAvailableLocations();
  setPassangersQuantity(getPassangersQuantity());

  // $('#belavia-search-form-iframe').attr('src', '');

  $('input[name="DepartureDate"], input[name="ReturnDate"]').datepicker({
    minDate: "+0d",
    dateFormat: "yy-mm-dd",
  });

  $('input[name="DepartureDate"]').change(function () {
    BelaviaSearchForm.DepartureDate = this.value;
  });

  $('input[name="ReturnDate"]').change(function () {
    BelaviaSearchForm.ReturnDate = this.value;
  });

  $('input[name="OriginLocation"]').focusin(function(){
    $('#OriginLocation_list').show();
  });

  $('input[name="DestinationLocation"]').focusin(function(){
    $('#DestinationLocation_list').show();
  });

  $('input[name="OriginLocation"]').focusout(function(){
    setTimeout(function () {
      $('#OriginLocation_list').hide();
    }, 500);
  });

  $('input[name="DestinationLocation"]').focusout(function(){
    setTimeout(function () {
      $('#DestinationLocation_list').hide();
    }, 500);
  });

  $('input[name="OriginLocation"]').bind('input', function () {
    var arr = $('#OriginLocation_list').find('.OriginLocation-item');
    for (var i = 0; i < arr.length; i++) {
      if ($(arr[i]).html().toLowerCase().includes(this.value.toLowerCase())) {
        $(arr[i]).show();
      } else {
        $(arr[i]).hide();
      }
    }
  });

  $('input[name="DestinationLocation"]').bind('input', function () {
    var arr = $('#DestinationLocation_list').find('.DestinationLocation-item');
    for (var i = 0; i < arr.length; i++) {
      if ($(arr[i]).html().toLowerCase().includes(this.value.toLowerCase())) {
        $(arr[i]).show();
      } else {
        $(arr[i]).hide();
      }
    }
  });

  $('body').delegate('.OriginLocation-item','click', function () {
    $('input[name="OriginLocation"]').prop('value', $(this).html());
    BelaviaSearchForm.OriginLocation = $(this).attr('data-OriginLocation');
    getAvailableRoutes(BelaviaSearchForm.availible_locations[BelaviaSearchForm.OriginLocation]);
  });

  $('body').delegate('.DestinationLocation-item','click', function () {
    $('input[name="DestinationLocation"]').prop('value', $(this).html());
    BelaviaSearchForm.DestinationLocation = $(this).attr('data-DestinationLocation');
  });

  $('button[name="adults_passanger_delete"]').click(function () {
    var passengersQuantity = getPassangersQuantity();
    if (passengersQuantity[0] > 1) {
      passengersQuantity[0] = passengersQuantity[0]-1;
    } 
    setPassangersQuantity(passengersQuantity);
  });

  $('button[name="adults_passanger_add"]').click(function () {
    var passengersQuantity = getPassangersQuantity();
    if ((passengersQuantity[0]+passengersQuantity[1]) < 5) {
      passengersQuantity[0] = passengersQuantity[0]+1;
    } 
    setPassangersQuantity(passengersQuantity);
  });

  $('button[name="childrens_passanger_delete"]').click(function () {
    var passengersQuantity = getPassangersQuantity();
    if (passengersQuantity[1] > 0) {
      passengersQuantity[1] = passengersQuantity[1]-1;
    } 
    setPassangersQuantity(passengersQuantity);
  });

  $('button[name="childrens_passanger_add"]').click(function () {
    var passengersQuantity = getPassangersQuantity();
    if ((passengersQuantity[0]+passengersQuantity[1]) < 5) {
      passengersQuantity[1] = passengersQuantity[1]+1;
    } 
    if (passengersQuantity[0] == 1 && passengersQuantity[1] > 3) {
      passengersQuantity[1] = 3;
    }
    setPassangersQuantity(passengersQuantity);
  });

  $('button[name="infants_passanger_delete"]').click(function () {
    var passengersQuantity = getPassangersQuantity();
    if (passengersQuantity[2] > 0) {
      passengersQuantity[2] = passengersQuantity[2]-1;
    } 
    setPassangersQuantity(passengersQuantity);
  });

  $('button[name="infants_passanger_add"]').click(function () {
    var passengersQuantity = getPassangersQuantity();
    if (passengersQuantity[0] > passengersQuantity[2]) {
      passengersQuantity[2] = passengersQuantity[2]+1;
    } 
    setPassangersQuantity(passengersQuantity);
  });

  $('button[name="belavia-search-form-submit-button"]').click(function () {
    BelaviaSearchForm.JourneySpan = 'Rt';
    if (BelaviaSearchForm.ReturnDate) {
      BelaviaSearchForm.JourneySpan = 'Ow';
    }
    if (validationBelaviaSearchForm()) {
      belaviaUrlCreate();
    };
  });
  $('button[name="belavia-search-form-iframe-button"]').click(function () {
    BelaviaSearchForm.JourneySpan = 'Rt';
    if (BelaviaSearchForm.ReturnDate) {
      BelaviaSearchForm.JourneySpan = 'Ow';
    }
    if (validationBelaviaSearchForm()) {
      belaviaIframeShow();
    };
  });


// https://belavia.by/redirect.php?OriginLocation=MSQ&DestinationLocation=MOW&DepartureDate=2022-04-29&lang=ru&JourneySpan=Ow&Adults=1&Infants=1

function belaviaUrlCreate () {
  var url = 'https://belavia.by/redirect.php?'; // редирект на сайт белавиа
  if (BelaviaSearchForm.OriginLocation) {
    url = url + 'OriginLocation=' + BelaviaSearchForm.OriginLocation;
  }
  if (BelaviaSearchForm.DestinationLocation) {
    url = url + '&DestinationLocation=' + BelaviaSearchForm.DestinationLocation;
  }
  if (BelaviaSearchForm.DepartureDate) {
    url = url + '&DepartureDate=' + BelaviaSearchForm.DepartureDate;
  }
  if (BelaviaSearchForm.ReturnDate) {
    url = url + '&ReturnDate=' + BelaviaSearchForm.ReturnDate;
  }
  if (BelaviaSearchForm.JourneySpan) {
    url = url + '&JourneySpan=' + BelaviaSearchForm.JourneySpan;
  }
  if (BelaviaSearchForm.lang) {
    if (BelaviaSearchForm.lang == 'by') {
      BelaviaSearchForm.lang = 'be';
    }
    url = url + '&lang=' + BelaviaSearchForm.lang;
  }
  if (BelaviaSearchForm.Adults) {
    url = url + '&Adults=' + BelaviaSearchForm.Adults;
  }
  if (BelaviaSearchForm.Children) {
    url = url + '&Children=' + BelaviaSearchForm.Children;
  }
  if (BelaviaSearchForm.Infants) {
    url = url + '&Infants=' + BelaviaSearchForm.Infants;
  }
  var counterItem = [
  'from: ' + BelaviaSearchForm.locations_list[BelaviaSearchForm.OriginLocation],
  'to: ' + BelaviaSearchForm.locations_list[BelaviaSearchForm.DestinationLocation],
  'date_from: ' + BelaviaSearchForm.DepartureDate,
  'date_to: ' + BelaviaSearchForm.ReturnDate,
  ];
  console.log(counterItem);
  $.post('/local/components/otpusk/belavia_search_form/clicker_calc.php', {
    belavia_search_form_calc:'belavia_search_form_calc',
    from: BelaviaSearchForm.locations_list[BelaviaSearchForm.OriginLocation],
    to: BelaviaSearchForm.locations_list[BelaviaSearchForm.DestinationLocation],
    date_from: BelaviaSearchForm.DepartureDate,
    date_to: BelaviaSearchForm.ReturnDate,
  }, function (data) {
    console.log(data);
  });

  window.open(url); // открыть в новом окне
}

function validationBelaviaSearchForm () {
  var flag = true;
  if (!BelaviaSearchForm.OriginLocation) {
    $('input[name="OriginLocation"]').css({'border':'1px solid red'});
    flag = false;
  } else {
    $('input[name="OriginLocation"]').css({'border':'1px solid #d5dadc'});
  }
  if (!BelaviaSearchForm.DestinationLocation) {
    $('input[name="DestinationLocation"]').css({'border':'1px solid red'});
    flag = false;
  } else {
    $('input[name="DestinationLocation"]').css({'border':'1px solid #d5dadc'});
  }
  if (!BelaviaSearchForm.DepartureDate) {
    $('input[name="DepartureDate"]').css({'border':'1px solid red'});
    flag = false;
  } else {
    $('input[name="DepartureDate"]').css({'border':'1px solid #d5dadc'});
  }
  return flag;
}

function setPassangersQuantity (passengersQuantity) {
  $('input[name="adults_passanger_quantity"]').prop('value', passengersQuantity[0]);
  $('input[name="childrens_passanger_quantity"]').prop('value', passengersQuantity[1]);
  $('input[name="infants_passanger_quantity"]').prop('value', passengersQuantity[2]);
  BelaviaSearchForm.Adults = passengersQuantity[0];
  BelaviaSearchForm.Children = passengersQuantity[1];
  BelaviaSearchForm.Infants = passengersQuantity[2];
}

function getPassangersQuantity () {
  var adults = $('input[name="adults_passanger_quantity"]').prop('value');
  var childrens = $('input[name="childrens_passanger_quantity"]').prop('value');
  var infants = $('input[name="infants_passanger_quantity"]').prop('value');
  return [Number(adults), Number(childrens), Number(infants)];
}

function getAvailableRoutes (arr) {
  var str = '';
  for (key in arr) {
    str = str + '<p class="DestinationLocation-item" data-DestinationLocation="'+
    arr[key]+'">'+'('+arr[key]+') '+BelaviaSearchForm.locations_list[arr[key]]+''+'</p>';
  }
  $('#DestinationLocation_list').html(str);
}

function getAvailableLocations () {
  var str = '';
  for (key in BelaviaSearchForm.availible_locations) {
    str = str + '<p class="OriginLocation-item" data-OriginLocation="'+
    key+'">'+'('+key+') '+BelaviaSearchForm.locations_list[key]+''+'</p>';
  }
  $('#OriginLocation_list').html(str);
} 
</script>

