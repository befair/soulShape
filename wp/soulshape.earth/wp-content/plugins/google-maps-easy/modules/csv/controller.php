<?php
class csvControllerGmp extends controllerGmp {
	private function _connectCsvLib() {
		importClassGmp('filegeneratorGmp');
		importClassGmp('csvgeneratorGmp');
	}
	private function _getSitePath() {
		return $this->getModel()->getSitePath();
	}
	private function _getKeys($data, $prefix = array()) {
		$keys = array();
		foreach($data as $k => $v) {
			if(is_array($v)) {
				$newPrefix = $prefix;
				$newPrefix[] = $k;
				$keys = array_merge($keys, $this->_getKeys($v, $newPrefix));
			} else {
				$keys[] = empty($prefix) ? $k : implode('.', $prefix). '.'. $k;
			}
		}
		return $keys;
	}
	private function _getKeyVal($data, $key) {
		if(strpos($key, '.')) {
			$keys = explode('.', $key);
			$firstKey = array_shift($keys);
			return isset($data[ $firstKey ]) ? $this->_getKeyVal($data[ $firstKey ], implode('.', $keys)) : '';
		} else {
			return isset($data[ $key ]) ? $data[ $key ] : '';
		}
	}
	private function _setKeyVal(&$data, $key, $val) {
		if(strpos($key, '.')) {
			$keys = explode('.', $key);
			$firstKey = array_shift($keys);
			if(!isset($data[ $firstKey ]))
				$data[ $firstKey ] = array();
			$this->_setKeyVal($data[ $firstKey ], implode('.', $keys), $val);
		} else {
			$data[ $key ] = $val;
		}
	}
	public function exportMaps() {
		$fileDate = str_replace(array('/', '.', ':'), '_', date(GMP_DATE_FORMAT_HIS));
		$fileName = sprintf(__('Maps from %s - %s', GMP_LANG_CODE), get_bloginfo('name'), $fileDate);
		$maps = frameGmp::_()->getModule('gmap')->getModel()->getAllMaps(array());	// Only maps data
		if(empty($maps)) {
			_e('You have no maps for now.', GMP_LANG_CODE);
			exit();
		}

		// Remove unneeded values
		foreach($maps as $key => $val) {
			unset($maps[$key]['original_id']);
			unset($maps[$key]['view_id']);
			unset($maps[$key]['view_html_id']);
			unset($maps[$key]['params']['view_id']);
			unset($maps[$key]['params']['view_html_id']);
			unset($maps[$key]['params']['id']);
		}

		$keys = $this->_getKeys($maps[0]);
		$c = $r = 0;
		$this->_connectCsvLib();
		$csvGenerator = toeCreateObjGmp('csvgeneratorGmp', array($fileName));
		foreach($keys as $k) {
			$csvGenerator->addCell($r, $c, $k);
			$c++;
		}
		$c = 0;
		$r = 1;
		foreach($maps as $map) {
			$c = 0;
			foreach($keys as $k) {
				$mapValue = $this->_prepareValueToExport( $this->_getKeyVal($map, $k) );
				if(is_array($mapValue)) {
					$mapValue = implode(';', $mapValue);
				}
				$csvGenerator->addCell($r, $c, $mapValue);
				$c++;
			}
			$r++;
		}
		$csvGenerator->generate();
		frameGmp::_()->getModule('supsystic_promo')->getModel()->saveUsageStat('csv.export.maps');
		exit();
	}
	private function _prepareValueToExport($val) {
		$sitePath = $this->_getSitePath();
		return htmlspecialchars(str_replace($sitePath, '[GMP_SITE_PATH]', $val));
	}
	private function _prepareValueToImport($val) {
		$sitePath = $this->_getSitePath();
		return str_replace('[GMP_SITE_PATH]', $sitePath, htmlspecialchars_decode($val));
	}
	public function exportMarkers() {
		$fileSiteDate = str_replace(array('/', '.', ':'), '_', esc_html(get_bloginfo('name')). ' - '. date(GMP_DATE_FORMAT_HIS));
		$fileName = sprintf(__('Markers from %s', GMP_LANG_CODE), $fileSiteDate);
		$markers = frameGmp::_()->getModule('marker')->getModel()->getAllMarkers();
		if(empty($markers)) {
			_e('You have no markers for now.', GMP_LANG_CODE);
			exit();
		}
		$this->_connectCsvLib();
		$csvGenerator = toeCreateObjGmp('csvgeneratorGmp', array($fileName));
		$c = $r = 0;
		$keys = $this->_getKeys($markers[0]);
		foreach($keys as $k) {
			$csvGenerator->addCell($r, $c, $k);
			$c++;
		}
		$c = 0;
		$r = 1;
		foreach($markers as $marker) {
			$c = 0;
			foreach($keys as $k) {
				$markerValue = $this->_prepareValueToExport( $this->_getKeyVal($marker, $k) );
				$csvGenerator->addCell($r, $c, $markerValue);
				$c++;
			}
			$r++;
		}
		$csvGenerator->generate();
		frameGmp::_()->getModule('supsystic_promo')->getModel()->saveUsageStat('csv.export.markers');
		exit();
	}
	public function import() {
		@ini_set('auto_detect_line_endings', true);
		$res = new responseGmp();
		$this->_connectCsvLib();
		$csvGenerator = toeCreateObjGmp('csvgeneratorGmp', array(''));
		$type = reqGmp::getVar('type');
        $file = $type == 'maps' ? reqGmp::getVar('csv_import_file_maps', 'file') : reqGmp::getVar('csv_import_file_markers', 'file');
        if(empty($file) || empty($file['size']))
            $res->pushError (__('Missing File', GMP_LANG_CODE));
        if(!empty($file['error']))
            $res->pushError (sprintf(__('File uploaded with error code %s', $file['error'])));
        if(!$res->error()) {
            $fileArray = array();
			$handle = fopen($file['tmp_name'], 'r');
			$csvParams['delimiter'] = $csvGenerator->getDelimiter();
			$csvParams['enclosure'] = $csvGenerator->getEnclosure();
			$csvParams['escape'] = $csvGenerator->getEscape();
			//if(version_compare( phpversion(), '5.3.0' ) == -1) //for PHP lower than 5.3.0 third parameter - escape - is not implemented
				while($row = @fgetcsv( $handle, 0, $csvParams['delimiter'], '"' )) $fileArray[] = $row;
			/*else
				while($row = @fgetcsv( $handle, 0, $csvParams['delimiter'], $csvParams['enclosure'], $csvParams['escape'] )) $fileArray[] = $row;*/
			/*var_dump($fileArray);
			exit();*/
			if(!empty($fileArray)) {
				if(count($fileArray) > 1) {
					//$overwriteSameNames = (int) reqGmp::getVar('overwrite_same_names');
					$keys = array_shift($fileArray);
					switch($type) {
						case 'maps':
							$mapModel = frameGmp::_()->getModule('gmap')->getModel();
							foreach($fileArray as $i => $row) {
								$map = array();
								foreach($keys as $j => $key) {
									$value = $this->_prepareValueToImport($row[ $j ]);
									if(strpos($key, '.')) {
										$realKeys = explode('.', $key);
										$realKey = array_pop( $realKeys );
										$realPreKey = array_pop( $realKeys );
										if($realPreKey == 'map_center') {
											$valueMapCenter = isset($map['map_center']) ? $map['map_center'] : array();
											$valueMapCenter[ $realKey ] = $value;
											$value = $valueMapCenter;
											$realKey = 'map_center';
										}
									} else
										$realKey = $key;
									if($value === '')
										$value = NULL;
									$map[ $realKey ] = $value;
								}
								if(isset($map['id']) && $mapModel->existsId($map['id'])) {
									$mapModel->updateMap($map);
								} else {
									$originalMapId = isset($map['id']) ? $map['id'] : 0;
									if(isset($map['id']))
										unset($map['id']);
									$newMapId = $mapModel->saveNewMap($map);
									if($newMapId && $originalMapId) {
										dbGmp::query("UPDATE @__maps SET id = '$originalMapId' WHERE id = '$newMapId'");
										if($originalMapId > $newMapId)
											dbGmp::setAutoIncrement('@__maps', $originalMapId + 1);
									}
								}
							}
							break;
						case 'markers':
							$markerModel = frameGmp::_()->getModule('marker')->getModel();
							foreach($fileArray as $i => $row) {
								$marker = array();
								foreach($keys as $j => $key) {
									$this->_setKeyVal($marker, $key, $this->_prepareValueToImport($row[ $j ]));
								}
								if(isset($marker['id']) && !$markerModel->existsId($marker['id'])) {
									unset($marker['id']);
								}
								$markerModel->save($marker);
							}
							break;
					}
					/*$importRes = $this->getModel()->import($fileArray, $overwriteSameNames);
					if($importRes) {
						if($importRes['map']['added'])
							$res->addMessage (sprintf(__('Added %s maps', GMP_LANG_CODE), $importRes['map']['added']));
						if($importRes['map']['updated'])
							$res->addMessage (sprintf(__('Updated %s maps', GMP_LANG_CODE), $importRes['map']['added']));
						if($importRes['marker']['added'])
							$res->addMessage (sprintf(__('Added %s markers', GMP_LANG_CODE), $importRes['map']['added']));
						if($importRes['marker']['updated'])
							$res->addMessage (sprintf(__('Updated %s markers', GMP_LANG_CODE), $importRes['map']['added']));
					} else
						$res->pushError ($this->getModel()->getErrors());*/
				} else
					$res->pushError (__('File should contain more then 1 row, at least 1 row should be for headers', GMP_LANG_CODE));
			} else
				$res->pushError (__('Empty data in file', GMP_LANG_CODE));
		}
		frameGmp::_()->getModule('supsystic_promo')->getModel()->saveUsageStat('csv.import');
		$res->ajaxExec();
	}
	private function _toYesNo($val) {
		return empty($val) ? 'No' : 'Yes';
	}
	private function _fromYesNo($val) {
		return $val === 'No' ? 0 : 1;
	}
	
	/**
	 * @see controller::getPermissions();
	 */
	public function getPermissions() {
		return array(
			GMP_USERLEVELS => array(
				GMP_ADMIN => array('exportMaps', 'exportMaps', 'import')
			),
		);
	}
} 