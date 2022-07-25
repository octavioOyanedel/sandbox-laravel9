<?php

// Filtrar (quitar elementos timestamp, etc) areglo obtenido desde consulta para poblar select
function filtrarArregloParaSelect(&$arreglo, $eliminar)
{
	foreach ($arreglo as $x => &$value) {
		for ($i = 0; $i < count($eliminar); $i++) {
			unset($value[$eliminar[$i]]);		
		}	 
	}
	return $arreglo;
}

// Funcion test
function test()
{
	return "OK desde Helper.php";
}