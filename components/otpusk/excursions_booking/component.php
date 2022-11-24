<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * 
 */
class ExcursionsBooking extends B24_class {

  function __construct() {
    $this->current_page = $this->currentPage();
    
    if ($_GET['detail']) {
      $this->arFilter = [
        'ACTIVE' => 'Y',
        'IBLOCK_CODE' => 'excursion',
        'ID' => $_GET['detail'],
      ];
      $this->arSelectFields = [
        'ID',
        'IBLOCK_ID',
        'NAME',
        'CODE',
        'PROPERTY_HD_DESC',
        'PROPERTY_COUNTRY',
        'PROPERTY_DURATION_TIME',
        'PROPERTY_DEPARTURE_EXC_TEXT',
      ];
    } elseif ($_GET['request']) {
      $this->arFilter = [
        'ACTIVE' => 'Y',
        'IBLOCK_CODE' => 'excursion',
        'ID' => $_GET['request'],
      ];
      $this->arSelectFields = [
        'ID',
        'IBLOCK_ID',
        'NAME',
      ];
    } else {
      $this->arFilter = [
        'ACTIVE' => 'Y',
        'IBLOCK_CODE' => 'excursion',
      ];
      $this->arSelectFields = [
        'ID',
        'IBLOCK_ID',
        'NAME',
        'CODE',
        'PROPERTY_COUNTRY',
        'PROPERTY_DURATION_TIME',
        'PROPERTY_DEPARTURE_EXC_TEXT',
      ];
    }
    $this->excursions_list = $this->excursionsList();
  }

  function currentPage () {
    if ($_GET['page_N']) {
      return $_GET['page_N'];
    } else {
      return 1;
    }
  }

  function getItemByID ($itemId, $iblockCode) {
    $src = CIBlockElement::GetList([],[
      'ID' => $itemId,
      'IBLOCK_CODE' => $iblockCode,
    ], false, false, [
      'ID', 'NAME',
    ]);
    $item = $src->Fetch();
    return $item;
  }

  function getItemProperty ($iblockId, $itemId, $property) {
    $arr = [];
    $src = CIBlockElement::GetProperty($iblockId, $itemId, [], [
      'CODE' => $property,
    ]);
    while ($item = $src->Fetch()) {
      if ($property == 'TOWN') {
        array_push($arr, $this->getItemByID($item['VALUE'], 'city'));
      }
      if ($property == 'PICTURES') {
        array_push($arr, CFile::GetFileArray($item['VALUE'])['SRC']);
      }
    }
    return $arr;
  }

  function excursionsList () {
    $src = CIBlockElement::GetList(['ID' => 'DESC'], $this->arFilter, false, [
      'nPageSize' => 5,
      'iNumPage' => $this->current_page,
    ], $this->arSelectFields);
    $arr = [];
    while ($item = $src->Fetch()) {
      if (!$_GET['request']) {
       $item['PICTURES'] = $this->getItemProperty($item['IBLOCK_ID'], $item['ID'], 'PICTURES');
       $item['TOWN'] = $this->getItemProperty($item['IBLOCK_ID'], $item['ID'], 'TOWN');
       $item['COUNTRY'] = $this->getItemByID($item['PROPERTY_COUNTRY_VALUE'], 'country');
     }
     array_push($arr, $item);

   }
   return [
    'page_count' => $src->NavPageCount, 
    'page_number' => $src->NavPageNomer, 
    'list' => $arr,
  ];
}

}


$arResult  = new ExcursionsBooking();
$this->IncludeComponentTemplate();
?>