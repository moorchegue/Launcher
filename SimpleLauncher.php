<?php

/**
 * Запуск PHP-приложений из консоли с использованием параметров
 * Поддерживаются короткий (-p=value) и длинный (--parameter=value) форматы
 *
 * @author murchik <moorchegue@psymoorea.ru>
 */
class SimpleLauncher {

	private $_config = array();

	/**
	 * Поехали (цэ)
	 *
	 * @param String $params - массив правил определения параметров
	 * @param array $argv - массив параметров, переданных из консоли
	 *
	 * @return array $this->_config
	 */
	public function getConfig(array $params, array $argv) {
		// отпарсить строку правил
		foreach($params as $k => $v) {
			$keys = explode('|', $k);
			$this->_config[$keys[0]] = ($v) ? $v : '';
			if (array_key_exists(1,$keys))
				$this->_config[$keys[1]] = &$this->_config[$keys[0]];
		}

		// сопоставить с консольным вводом
		foreach ($argv as $v) {
			$kv = explode('=', $v);
			if (count($kv) < 2) continue;
			for ($i=0;$i<2;$i++)
				$kv[0] = (substr($kv[0],0,1)=='-') ? substr($kv[0],1) : $kv[0];
			$this->_config[$kv[0]] = $kv[1];
		}

		return $this->_config;
	}
}
