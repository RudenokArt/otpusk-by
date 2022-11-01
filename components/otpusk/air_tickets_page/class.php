<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * 
 */
class TestClass extends CBitrixComponent{

  public function onPrepareComponentParams ($arParams) {
    $arr = $arParams;
    $arr['count'] = count($arParams);
    return $arr;   
  }
  public function executeComponent () {
    if($this->startResultCache()) {
      $this->arResult = $this->currentTab();
      $this->arResult['advantages'] = $this->advantages();
      $this->arResult['payments'] = $this->payments();
      if ($_POST['ticket_send_request']) {
        $this->arResult['send_request'] = $this->sendRequest();
      }
      $this->includeComponentTemplate();
    }
    return $this->arResult;
  }

  function payments () {
    $src = CIBlockElement::GetList([
      'SORT' => 'ASC',
      'ID' => 'ASC',
    ], [
      'IBLOCK_CODE' => 'payment-services',
    ], false, false, [
      'ID', 'NAME','PREVIEW_TEXT', 'DETAIL_TEXT', 'DETAIL_PICTURE',
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function advantages () {
    $src = CIBlockElement::GetList([
      'SORT' => 'ASC',
      'ID' => 'ASC',
    ], [
      'IBLOCK_CODE' => 'advantages',
    ], false, false, [
      'ID', 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE',
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function sendRequest () {
    return true;
  }

  function currentTab () {
    if ($_GET['tab'] == 'train_tickets') {
      return [
        'current_tab' => 'train_tickets',
        'date_from' => 'Дата отъезда',
        'date_to' => 'Дата приезда',
      ];
    } else {
     return [
      'current_tab' => 'air_tickets',
      'date_from' => 'Дата вылета',
      'date_to' => 'Дата прилета',
    ];
  }
}

}


?>