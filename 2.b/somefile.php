<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
//get users list
$arSelect = Array("PROPERTY_USERS");
$arFilter = Array("IBLOCK_ID"=>$num, "ID" => $_POST['news_id']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arLikedUsersId[] = $arFields;
}
//check for if in array
if(in_array($_SESSSION['USER']['ID'], $arLikedUsersId)){
	unset($arLikedUsersId[array_search($_SESSSION['USER']['ID'], $arLikedUsersId)]);
}
else{
	$arLikedUsersId[] = $_SESSSION['USER']['ID'];
}
//update element
$el = new CIBlockElement;
$PROP[USERS] = $arLikedUsersId; 
$arLoadProductArray = Array(
  "PROPERTY_VALUES"=> $PROP
  );
$res = $el->Update($_POST['news_id'], $arLoadProductArray);
?>