<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * 
 */
class Otpusk_mice extends B24_class {

  function __construct() {
    $this->tabs = $this->miceTabs();
    $this->currentTab = $this->miceCurrentTab();
    if ($_POST['mice_event_order']) {
      $this->mice_event_order = $this->miceEventOrder();
    }
  }

  function miceEventsList () {
    $arr = [];
    $src = CIBlockElement::GetList (['SORT'=>'DESC', 'ID'=>'ASC'], [
      'ACTIVE' => 'Y',
      'IBLOCK_CODE' => 'mice_ck',
      'SECTION_CODE' => 'mice_events',
    ], false, false, [
      'ID',
      'CODE',
      'NAME',
      'PREVIEW_PICTURE',
      'PREVIEW_TEXT',
      'PROPERTY_MICE',
    ]);
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function ecoMiceList () {
    $arr = [];
    $src = CIBlockElement::GetList (['SORT'=>'DESC', 'ID'=>'ASC'], [
      'ACTIVE' => 'Y',
      'IBLOCK_ID' => 55,
    ], false, false, [
      'ID',
      'CODE',
      'NAME',
      'PREVIEW_PICTURE',
      'PREVIEW_TEXT',
      'PROPERTY_MICE',
    ]);
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function platformList () {
    $arr = [];
    $src = CIBlockElement::GetList (['SORT'=>'DESC', 'ID'=>'ASC'], [
      'ACTIVE' => 'Y',
      'IBLOCK_CODE' => 'hotel',
      'PROPERTY_MICE_VALUE'=>['MICE_CITY', 'MICE_MEDICAL']
    ], false, false, [
      'ID',
      'CODE',
      'NAME',
      'PREVIEW_PICTURE',
      'PREVIEW_TEXT',
      'PROPERTY_MICE',
    ]);
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function miceEventOrder () {
    $event_options = '';
    foreach ($_POST['event_options'] as $key => $value) {
      $event_options = $event_options.', '.$value;
    }
    $deal = $this->restApiRequest('crm.deal.add', [
      'fields' => [
        'TITLE' => 'MICE - заявка на проведение мероприятия',
        'ASSIGNED_BY_ID' => 27427,
        'CATEGORY_ID' => 13,
        'STAGE_ID' => 'C13:NEW',
        'COMMENTS' => 
        'Мероприятие: '.$_POST['event_type'].'<br>'.
        'Дата проведения: '.$_POST['event_date'].'<br>'.
        'Кол-во чел.: '.$_POST['event_people'].'<br>'.
        'Бюджет: '.$_POST['event_budget'].'<br>'.
        'Место проведения: '.$_POST['event_location'].'<br>'.
        'Город (страна): '.$_POST['event_location_text'].'<br>'.
        'Необходимые услуги: '.$event_options.'<br>'.
        'Пожелания: '.$_POST['event_wishes'].'<br>'.
        'ФИО: '.$_POST['event_fio'].'<br>'.
        'Тел.: '.$_POST['event_phone'].'<br>'.
        'Email: '.$_POST['event_email'].'<br>',
      ],
    ]);
    $this->restApiRequest('im.message.add.json', [
      'DIALOG_ID' => 27427,
      'MESSAGE' => 'MICE - заявка на проведение мероприятия 
      <br>https://bitrix.vetliva.by/crm/deal/details/'.json_decode($deal, true)['result'].'/',
    ]);
    return $_POST;
  }

  function miceCurrentTab () {
    if ($_GET['tab']) {
      return $_GET['tab'];
    }
    if ($_GET['page']) {
      return $_GET['page'];
    }
    return 'mice';
  }

  function miceTabs () {
    $arr = [];
    $src = CIBlockElement::GetList([
      'SORT' => 'DESC',
      'ID' => 'ASC'
    ], [
      'ACTIVE' => 'Y',
      'IBLOCK_CODE' => 'mice_ck',
      '!SECTION_CODE' => 'mice_events'
    ], false, false, [
      'ID',
      'CODE',
      'NAME',
      'PREVIEW_TEXT',
      'PREVIEW_PICTURE',
      'DETAIL_TEXT',
      'DETAIL_PICTURE',
    ]);
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

}

$arResult = new Otpusk_mice();

$this->IncludeComponentTemplate();


?>