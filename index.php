<?php
	function binarySearch($file,$found){
		$openfile=fopen($file, "r"); //открываем файл
		while (!feof($openfile)) {  //(цикл while) до конца файла
			$str=fgets($openfile, 4000); //данные только до 4000байт
			 //mb_convert_encoding($str,"utf-8"); //меняем кодировку
			$explstr=explode('\x0A', $str); //разбиваем строку на ключи
			array_pop($explstr); //удаляем последний элемент т.к он пустой
				foreach ($explstr as $key => $value) {
					$arr[] = explode('\t',$value); // ключ и значение отдельные элементы
				}
			$start=0; //начальное значение
			$end=count($arr)-1;
				while ($start <= $end) { 
					$resulthalf = floor(($start+$end)/2); //определяем середину и округляем
					$strcomparison = strnatcmp($arr[$resulthalf][0], $found); //сравниваем с тем что ищем
						if ($strcomparison>0) {
							$end = $resulthalf - 1;
						}
						elseif ($strcomparison<0) {
							$start = $resulthalf + 1;
						}
						else{
							return $arr[$resulthalf][1]; //возращаем значение по ключу
						}
				}
		}
		return 'undef'; //если нет значений
	}
	$found='ключ1';
	$file='1.txt';
	echo binarySearch($file,$found)."<br>";
	echo "Если ключа нет, то : ";
	$found='ключ101';
	echo binarySearch($file,$found)."<br>";
?>