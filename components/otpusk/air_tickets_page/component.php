<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * 
 */
class AirTicketsPage  extends B24_class {

  function __construct () {
    $this->arResult = $this->currentTab();
      $this->arResult['advantages'] = $this->advantages();
      $this->arResult['payments'] = $this->payments();
      if ($_POST['ticket_send_request']) {
        $this->arResult['send_request'] = $this->restApiRequest('tasks.task.add', ['fields' => [
          'TITLE' => $this->arResult['ticket_type'],
          'DESCRIPTION' => '<br>Окуда: '.$_POST['from'].
          '<br>Куда: '.$_POST['to'].
          '<br>'.$this->arResult['date_from'].': '.$_POST['date_from'].
          '<br>'.$this->arResult['date_to'].': '.$_POST['date_to'].
          '<br>Кол-во пассажиров: '.$_POST['passanger_qty'].
          '<br>Тел.: '.$_POST['phone'].
          '<br>ФИО: '.$_POST['fio'].
          '<br>Email: '.$_POST['email'],
          'ACCOMPLICES' => [28786, 29160, 29643],
          'RESPONSIBLE_ID' => 25279,
        ]]);
      }
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


  function currentTab () {
    if ($_GET['tab'] == 'train_tickets') {
      return [
        'ticket_type' => 'Заявка на подбор и покупку ЖД билетов',
        'current_tab' => 'train_tickets',
        'date_from' => 'Дата отъезда',
        'date_to' => 'Дата приезда',
      ];
    } else {
     return [
      'ticket_type' => 'Заявка на подбор и покупку авиабилетов',
      'current_tab' => 'air_tickets',
      'date_from' => 'Дата вылета',
      'date_to' => 'Дата прилета',
    ];
  }
}

}

$arResult = (new AirTicketsPage())->arResult;

$this->includeComponentTemplate();
?>