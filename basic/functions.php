<?php

	use app\models\Company;

    function debug($arr){
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }
    function checkPublic($data) {
        if ($data==1) {
            return 'Да';
        } else {
            return 'Нет';
        }
    } 

 function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',  'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ',' => '_',   ' ' => '_',   "'" => '',
        '"' => '',
    );
    return strtr($string, $converter);
}    
	// function getCompany() {
	// 	// Cчитываем информацию о компании из кеша если она есть
	// 	$company = Yii::$app->cache->get('company');
	// 	if ($company) return $company;
	// 	else {
	// 	$company = Company::findOne(Yii::$app->params['company_id']);
	// 	//Записываем информацию в кеш, если она в кеше отсутствует, запись на 60 секунд
	// 	Yii::$app->cache->set('company', $company, 60); //change
	// 	}
	// }

?>