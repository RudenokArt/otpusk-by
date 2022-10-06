<? 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult = new ToursList();

/**
 * 
 */
class ToursList {

  public static function getTownByID ($city_id) {
    $src = CIBlockElement::GetList([], [
      'IBLOCK_CODE' => 'city',
      'ID' => $city_id,
    ], false, false, [
      'ID',
      'IBLOCK_ID',
      'NAME',
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr[0];
  }

  function __construct() {
    $this->section_code = $this->getSectionCode();
    $this->tours_routes = $this->getToursRoutes();
      $this->country_list = $this->getContryList();
      $this->towns_from_list = $this->getTownsList($this->tours_routes['town_from']);
      $this->towns_to_list = $this->getTownsList($this->tours_routes['town_to']);
    if (isset($_GET['tour_id'])) {
      $this->detail_item = $this->getDetailItem();
    } else {
      $this->search_filter = $this->getSerarchFilter();
      if ($arParams['MAIN_PAGE_FORM'] != "Y") {
        $this->items_list = $this->getIblocksList();
      }
      if ($_GET['sort_date']) {
        $this->sortItemsByDate();
      }
    }
  }

  function sortItemsByDate () {
    $arr = [];
    foreach ($this->items_list as $key => $value) {
      $this->items_list[$key]['sort_date'] = strtotime($value['PROPERTY_DEPARTURE_VALUE'][0]);
      $arr[$key] =  strtotime($value['PROPERTY_DEPARTURE_VALUE'][0]);
    }
    if ($_GET['sort_date'] == 'desc') {
      arsort($arr);
    } else {asort($arr);}
    foreach ($arr as $key => $value) {
      $arr[$key] = $this->items_list[$key];
    }
    $this->items_list = $arr;
  }

  function getTownsList ($id_arr) {
    $src = CIBlockElement::GetList(['NAME' => 'ASC'], [
      'IBLOCK_CODE' => 'city',
      'ID' => $id_arr,
    ], false, false, [
      'ID',
      'IBLOCK_ID',
      'NAME',
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function getContryList () {
    $src = CIBlockElement::GetList(['NAME' => 'ASC'], [
      'IBLOCK_CODE' => 'country',
      'ID' => $this->tours_routes['country'],
    ], false, false, [
      'ID',
      'IBLOCK_ID',
      'NAME',
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function getDetailItem () {
    $src = CIBlockElement::GetList([], [
      'IBLOCK_CODE' => 'tour',
      'ID' => $_GET['tour_id'],
    ], false, false, [
      'ID',
      'IBLOCK_ID',
      'NAME',
      'DETAIL_TEXT',
      'PREVIEW_TEXT',
      'DETAIL_PICTURE',
      'PROPERTY_HD_DESC',
      'PROPERTY_PICTURES',
      'PROPERTY_POINT_DEPARTURE',
      'PROPERTY_TOWN',
      'PROPERTY_DEPARTURE',
      'PROPERTY_DAYS',
      'PROPERTY_PRICE_INCLUDE',
      'PROPERTY_PRICE_NO_INCLUDE',
      'PROPERTY_NDAYS',
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr[0];
  }

  function getSerarchFilter () {
    if (!$this->section_code) {
      $this->section_code = ['combi-aviaturs', 'authors-tours'];
    }
    if (isset($_GET['search']) and !empty($_GET['search'])) {
      $filter = [
        // 'ACTIVE' => 'Y',
        'IBLOCK_CODE' => 'tour',
        'SECTION_CODE' => $this->section_code,
        [
          "LOGIC" => "OR",
          ["NAME" => '%'.$_GET['search'].'%'],
          ["DETAIL_TEXT" => '%'.$_GET['search'].'%'],
          ["PREVIEW_TEXT" => '%'.$_GET['search'].'%'],
        ]
      ];
    } else {
      $filter = [
        'ACTIVE' => 'Y',
        'IBLOCK_CODE' => 'tour',
        'SECTION_CODE' => $this->section_code,
      ];
    }
    if (isset($_GET['country']) and !empty($_GET['country'])) {
      $filter['PROPERTY_COUNTRY'] = $_GET['country'];
    }
    if ($_GET['nights_from']) {
      $filter['>=PROPERTY_DURATION_DAYS'] = $_GET['nights_from'];
    }
    if ($_GET['nights_to']) {
      $filter['<=PROPERTY_DURATION_DAYS'] = $_GET['nights_to'];
    }
    if ($_GET['town_from']) {
      $filter['PROPERTY_POINT_DEPARTURE'] = $_GET['town_from'];
    }
    if ($_GET['town_to']) {
      $filter['PROPERTY_TOWN'] = $_GET['town_to'];
    }
    return $filter;
  }

  function swichPage ($page) {
    $arr = $_GET;
    $arr['page'] = $page;
    $str = http_build_query($arr);
    return $str;
  }

  function pagination () {
    if (isset($_GET['page'])) {
      $iNumPage = $_GET['page'];
    } else {
      $iNumPage = '1';
    }
    $arr = [
      'nPageSize' => 5,
      'iNumPage' => $iNumPage,
    ];
    return $arr;
  }

  function getIblocksList () {
    $src = CIBlockElement::GetList([
      'SORT' => 'DESC',
      'ID' => 'DESC',
    ], $this->search_filter, false, $this->pagination(), [
      'ID',
      'IBLOCK_ID',
      'NAME',
      'PREVIEW_TEXT',
      'PREVIEW_PICTURE',
      'PROPERTY_POINT_DEPARTURE',
      'PROPERTY_TOWN',
      'PROPERTY_DEPARTURE',
      'PROPERTY_DAYS',
      'PROPERTY_COUNTRY',
      'PROPERTY_DURATION_DAYS',
    ]);
    $this->NavPageCount = $src->NavPageCount;
    $this->NavPageNomer = $src->NavPageNomer;
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function getToursRoutes () {
    $src = CIBlockElement::GetList([
      'SORT' => 'DESC',
      'ID' => 'DESC',
    ], [
      'IBLOCK_CODE' => 'tour',
      'SECTION_CODE' => ['combi-aviaturs', 'authors-tours'],
      'ACTIVE' => 'Y'

    ], false, false, [
      'ID',
      'IBLOCK_ID',
      'NAME',
      'PROPERTY_POINT_DEPARTURE', // город откуда
      'PROPERTY_TOWN', // город куда
      'PROPERTY_COUNTRY', // страна
    ]);
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, [
        'town_from' => $item['PROPERTY_POINT_DEPARTURE_VALUE'],
        'town_to' => $item['PROPERTY_TOWN_VALUE'],
        'country' => $item['PROPERTY_COUNTRY_VALUE'],
      ]);
    }
    $town_from = [];
    $town_to = [];
    $country = [];
    foreach ($arr as $key => $value) {
      if ($value['town_from']) {
        array_push($town_from, $value['town_from'][0]);
      }
      if ($value['town_to']) {
        array_push($town_to, $value['town_to'][0]);
      }
      if ($value['country']) {
        array_push($country, $value['country'][0]);
      }
    }
    $town_from = array_unique($town_from);
    $town_to = array_unique($town_to);
    $country = array_unique($country);
    return [
      'town_from' => $town_from,
      'town_to' => $town_to,
      'country' => $country,
    ];
  }

  function getSectionCode () {
    if (isset($_GET['tours_type'])) {
      return $_GET['tours_type'];
    } else {
      return '';
    }
  }
}


$this->IncludeComponentTemplate();
?>