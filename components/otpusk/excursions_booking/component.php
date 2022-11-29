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
        'PROPERTY_VETLIVA_ID',
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
        'PROPERTY_VETLIVA_ID',
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
        'PROPERTY_VETLIVA_ID',
      ];
    }
    $this->excursions_list = $this->excursionsList();
  }

  function dealAssignedBy ($deal_data) {
    $contact = json_decode($this->checkContact($deal_data), true);
    $contact = $contact['result'][0]['ID'];
    if (!$contact) {
      $contact = json_decode($this->addNewContact($deal_data), true);
      $contact = $contact['result'];
    }
    $str = $this->restApiRequest('user.get.json', ['FILTER' => [
      'ACTIVE' => true,
      'UF_DEPARTMENT' => 42,
      'UF_DEPARTMENT' => 41,
      'CONTACT_ID' => $contact,
    ]]);
    $arr = json_decode($str, true);
    $list = [];
    foreach ($arr['result'] as $key => $value) {
      if ($value['ID']) {
        array_push($list, $value['ID']);
      }
    }
    $deal = $this->addNewDeal($list[array_rand($list)], $deal_data);
    foreach ($list as $key => $value) {
      $this->sendMessage($value, $deal['result']);
    }
    return ['list' => $list, 'assigned' => $list[array_rand($list)], 'deal' => $deal['result']];
  }

  function addNewContact ($deal_data) {
    $contact = $this->restApiRequest('crm.contact.add.json', ['fields' => [
      'NAME' => $deal_data['fio'],
      'PHONE' => [
        ['VALUE' => $deal_data['phone'],
        'VALUE_TYPE' => 'WORK',]
      ],
      'EMAIL' => [
        ['VALUE' => $deal_data['email'],
        'VALUE_TYPE' => 'WORK',]
      ],
    ]]);
    return $contact;
  }

  function checkContact ($deal_data) {
    $contact = $this->restApiRequest ('crm.contact.list.json',['filter' => [
      // 'EMAIL' => $deal_data['email'],
      'EMAIL' => 'test@mail.ru',
    ], 'select' => [
      'ID', 'NAME', 'PHONE', 'EMAIL',
    ],
  ]);
    return $contact;
  }

  function addNewDeal ($assigned, $deal_data) {
    $deal = $this->restApiRequest ('crm.deal.add.json', ['fields' => [
      'TITLE' => 'ТЕСТ Заявка на экскурсию с сайта otpusk.by',
      'CATEGORY_ID' => 0,
      'TYPE_ID' => 'SERVICES',
      'STAGE_ID' => '2',
      'OPENED' => 'Y',
      'ASSIGNED_BY_ID' => $assigned,
      'COMMENTS' => 'ТЕСТ Заявка на экскурсию с сайта otpusk.by <br>
      Экскурсия: '.$this->excursions_list['list'][0]['NAME'].'
      ФИО: '.$deal_data['fio'].'
      тел: '.$deal_data['phone'].'
      email: '.$deal_data['email'],
    ]]);
    // $deal = $this->restApiRequest ('crm.deal.get.json', ['id' => 4280]);
    return json_decode($deal, true);
  }

  function sendMessage ($dialog, $deal) {
    $this->restApiRequest('im.message.add.json', [
      'DIALOG_ID' => $dialog,
      'MESSAGE'  => 'ТЕСТ Заявка на экскурсию с сайта otpusk.by: https://bitrix.vetliva.by/crm/deal/details/'.$deal.'/',
    ]);
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