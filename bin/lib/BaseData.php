<?php
/**
 * Generated by Haxe 4.3.6
 */

use \php\Boot;
use \haxe\ds\StringMap;
use \tjson\TJSON;

class BaseData {
	/**
	 * @var \SQLite3
	 */
	static public $dbProyectos;

	/**
	 * @return string
	 */
	public static function Home () {
		#src/BaseData.hx:20: characters 9-98
		$resultado = BaseData::$dbProyectos->query("SELECT Nombre, Portada FROM Proyectos");
		#src/BaseData.hx:21: characters 9-56
		$data = new \Array_hx();
		#src/BaseData.hx:22: characters 9-85
		$row = $resultado->fetchArray(1);
		#src/BaseData.hx:23: lines 23-26
		while ($row !== false) {
			#src/BaseData.hx:24: characters 13-27
			$data->arr[$data->length++] = $row;
			#src/BaseData.hx:25: characters 13-16
			$row = $resultado->fetchArray(1);
		}
		#src/BaseData.hx:28: characters 9-47
		$datos = new \Array_hx();
		#src/BaseData.hx:29: lines 29-37
		$_g = 0;
		while ($_g < $data->length) {
			#src/BaseData.hx:29: characters 13-17
			$item = ($data->arr[$_g] ?? null);
			#src/BaseData.hx:29: lines 29-37
			++$_g;
			#src/BaseData.hx:30: characters 13-52
			$Item = new StringMap();
			#src/BaseData.hx:31: characters 31-54
			$data1 = $item;
			$iteradorKey_current = 0;
			$iteradorKey_length = count($data1);
			$iteradorKey_keys = array_keys($data1);
			$iteradorKey_values = array_values($data1);
			#src/BaseData.hx:32: lines 32-35
			while ($iteradorKey_current < $iteradorKey_length) {
				#src/BaseData.hx:33: characters 28-46
				$pair_key = $iteradorKey_keys[$iteradorKey_current];
				$pair_value = $iteradorKey_values[$iteradorKey_current++];
				#src/BaseData.hx:34: characters 17-60
				$key = mb_strtolower($pair_key);
				$Item->data[$key] = $pair_value;
			}
			#src/BaseData.hx:36: characters 13-29
			$datos->arr[$datos->length++] = $Item;
		}
		#src/BaseData.hx:38: characters 9-56
		return \Std::string(TJSON::encode($datos, "fancy"));
	}

	/**
	 * @param string $Nombre
	 * 
	 * @return mixed
	 */
	public static function ListCaps ($Nombre) {
		#src/BaseData.hx:59: lines 59-60
		$consulta = BaseData::$dbProyectos->querySingle("SELECT Capitulos FROM Proyectos WHERE Nombre = '" . ($Nombre??'null') . "'");
		#src/BaseData.hx:61: characters 9-24
		return $consulta;
	}

	/**
	 * @return string
	 */
	public static function Select () {
		#src/BaseData.hx:14: characters 9-150
		$resultado = BaseData::$dbProyectos->querySingle("SELECT Capitulos FROM Proyectos WHERE Nombre ='Aizawa Koharu tiene prisa por morir'");
		#src/BaseData.hx:15: characters 9-48
		error_log(\Std::string($resultado));
		#src/BaseData.hx:16: characters 9-28
		return "Vamos bien";
	}

	/**
	 * @param string $name
	 * 
	 * @return string
	 */
	public static function getProyect ($name) {
		#src/BaseData.hx:42: characters 9-106
		$consulta = BaseData::$dbProyectos->query("SELECT * FROM Proyectos WHERE Nombre = \"" . ($name??'null') . "\"");
		#src/BaseData.hx:43: characters 9-68
		$data = $consulta->fetchArray(1);
		#src/BaseData.hx:44: characters 9-28
		$consulta->finalize();
		#src/BaseData.hx:45: characters 9-46
		$Item = new StringMap();
		#src/BaseData.hx:46: characters 27-50
		$data1 = $data;
		$iteratorKey_current = 0;
		$iteratorKey_length = count($data1);
		$iteratorKey_keys = array_keys($data1);
		$iteratorKey_values = array_values($data1);
		#src/BaseData.hx:47: lines 47-54
		while ($iteratorKey_current < $iteratorKey_length) {
			#src/BaseData.hx:48: characters 24-42
			$pair_key = $iteratorKey_keys[$iteratorKey_current];
			$pair_value = $iteratorKey_values[$iteratorKey_current++];
			#src/BaseData.hx:49: lines 49-53
			if (($pair_key === "Capitulos") || ($pair_key === "Generos")) {
				#src/BaseData.hx:50: characters 21-77
				$key = mb_strtolower($pair_key);
				$value = TJSON::parse($pair_value);
				$Item->data[$key] = $value;
			} else {
				#src/BaseData.hx:52: characters 21-64
				$key1 = mb_strtolower($pair_key);
				$Item->data[$key1] = $pair_value;
			}
		}
		#src/BaseData.hx:55: characters 9-54
		return \Std::string(TJSON::encode($Item, "fancy"));
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$dbProyectos = new \SQLite3("/home/sinherani/PendejosScanBack-Haxe/public/Proyectos.db");
	}
}

Boot::registerClass(BaseData::class, 'BaseData');
BaseData::__hx__init();
