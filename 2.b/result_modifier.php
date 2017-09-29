<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/* --- get Users ID who liked post --- */
	$arSelect = Array("PROPERTY_USERS");
	$arFilter = Array("IBLOCK_ID"=>$num, "ID" => $_REQUEST["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arFields = $ob->GetFields();
	 $arLikedUsersId[] = $arFields;
	}
	
	$filter = array('ID' => implode('|', $arLikedUsersId));
	$arSel = array("LOGIN");
	$rsUsers = CUser::GetList(($by="name"), ($order="asc"), $filter, array("FIELDS"=>$arSel)); // getting users logins
	
	while($arr = $rsUsers->GetNext()) :
		$arLoginList[] = $arr[LOGIN];
	endwhile;
	
	//send data to arResult
	$arResult["LIKED_USERS"]["LOGINS"] = $arLoginList;
	$arResult["LIKED_USERS"]["IDS"] = $arLikedUsersId;
?>