<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * 
 */
class Otpusk_mice extends B24_class {

  function __construct() {
    $this->tabs = $this->miceTabs();
    $this->currentTab = $this->miceCurrentTab();
    if ($_POST['mice_event_order'] and ($_POST['captcha_pass'] == $_POST['captcha_word'])) {
      $this->mice_event_order = $this->miceEventOrder();
    }
  }

  function miceEvents ($section_code) {
    $section_src = CIBlockSection::GetList([
      'SORT' => 'DESC',
      'ID' => 'ASC'
    ], [
      'ACTIVE' => 'Y',
      'CODE' => $section_code,
    ], false, [
      'ID', 'CODE', 'NAME', 'DESCRIPTION',
    ]);
    $section = $section_src->Fetch();

    $src = CIBlockElement::GetList([
      'SORT' => 'DESC',
      'ID' => 'ASC'
    ], [
      'ACTIVE' => 'Y',
      'SECTION_CODE' => $section_code,
    ], false, false, [
      'ID',
      'IBLOCK_ID',
      'NAME',
      'PREVIEW_TEXT',
      'DETAIL_TEXT',
      'IBLOCK_SECTION_ID',
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return ['section' => $section, 'list' => $arr,];
  }

  function miceLocation ($section_id) {
    $section_src = CIBlockSection::GetList([
      'SORT' => 'DESC',
      'ID' => 'ASC'
    ], [
      'ACTIVE' => 'Y',
      'ID' => $section_id,
    ], false, [
      'ID', 'CODE', 'NAME', 'DESCRIPTION',
    ]);
    $section = $section_src->Fetch();

    $src = CIBlockElement::GetList([
      'SORT' => 'DESC',
      'ID' => 'ASC'
    ], [
      'ACTIVE' => 'Y',
      'SECTION_ID' => $section_id,
    ], false, false, [
      'ID',
      'IBLOCK_ID',
      'NAME',
      'PREVIEW_TEXT',
      'DETAIL_TEXT',
      'IBLOCK_SECTION_ID',
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return ['section' => $section, 'list' => $arr,];
  }

  function miceLocProperty ($iblock, $item) {
    $src = CIBlockElement::GetProperty($iblock, $item, [], ['CODE' => 'PHOTO']);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function locationsList ($section_code) {
    $section_src = CIBlockSection::GetList([
      'SORT' => 'DESC',
      'ID' => 'ASC'
    ], [
      'ACTIVE' => 'Y',
      'CODE' => $section_code,
    ], false, [
      'ID', 'CODE', 'NAME', 'DESCRIPTION',
    ]);
    $section = $section_src->Fetch();

    $section_list_src = CIBlockSection::GetList ([], [
      'SECTION_ID' => $section['ID'],
      'ACTIVE' => 'Y',
    ]);

    $list = [];
    while ($item = $section_list_src->Fetch()) {
      array_push($list, $item);
    }

    return ['section' => $section, 'list' => $list];
  }

  function miceEventOrder () {
    $event_options = '';
    foreach ($_POST['event_options'] as $key => $value) {
      $event_options = $event_options.', '.$value;
    }
    $deal = $this->restApiRequest('crm.deal.add', [
      'fields' => [
        'TITLE' => 'MICE - заявка на проведение мероприятия',
        'ASSIGNED_BY_ID' => 29643,
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
      'DIALOG_ID' => 4735,
      'MESSAGE' => 'MICE - заявка на проведение мероприятия 
      <br>https://bitrix.vetliva.by/crm/deal/details/'.json_decode($deal, true)['result'].'/',
    ]);
    return $_POST;
  }

  function miceCurrentTab () {
    if ($_GET['tab']) {
      return $_GET['tab'];
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
      'SECTION_CODE' => '',
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