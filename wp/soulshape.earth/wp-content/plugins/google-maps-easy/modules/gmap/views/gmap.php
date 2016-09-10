<?php
class gmapViewGmp extends viewGmp {
	//private $_gmapApiUrl = "https://maps.googleapis.com/maps/api/js?&sensor=false&=";
	private $_gmapApiUrl = '';
	private static $_mapsData;
	private $_mapsObj = array();
	private $_mapStyles = array();
	private $_displayColumns = array();
	// Used to compare rand IDs and original IDs on preview
	
	public function getApiUrl() {
		if(empty($this->_gmapApiUrl)) {
			$urlParams = dispatcherGmp::applyFilters('gApiUrlParams', array('key' => $this->getApiKey()));
			$this->_gmapApiUrl = 'https://maps.googleapis.com/maps/api/js?'. http_build_query($urlParams);
		}
		return $this->_gmapApiUrl;
	}
	public function getApiKey() {
		$apiKey = 'AIzaSyCh33wsMPd4zTjqSkqEm0_giCOi-78XZN8';

		if($userApiKey = frameGmp::_()->getModule('options')->get('user_api_key')) {
			$apiKey = $userApiKey;
		}
		return $apiKey;
	}
	public function addMapData($params){
		if(empty(self::$_mapsData)) {
			self::$_mapsData = array();
		}
		if(!empty($params))
			self::$_mapsData[] = $params;
	}
	public function getMapsObj() {
		if(empty($this->_mapsObj)) {
			$mapsInPosts = $this->getModule()->getMapsInPosts();

			foreach($mapsInPosts as $mapId) {
				$mapObj = frameGmp::_()->getModule('gmap')->getModel()->getMapById($mapId);

				if(empty($mapObj)) continue;

				$mapObj['isDisplayed'] = false;
				$this->_mapsObj[$mapObj['view_id']] = $mapObj;
			}
		}
		return $this->_mapsObj;
	}
	public function addMapStyles($mapViewId) {
		$mapObj = is_array($mapViewId) ? $mapViewId : $this->_mapsObj[$mapViewId];
		$this->assign('currentMap', $mapObj);
		array_push($this->_mapStyles, $mapObj['view_id']);

		parent::display('gmapMapStyles');
	}
	public function drawMap($params) {
		$mapObj = array();

		foreach($this->_mapsObj as $view_id => $map) {
			if($map['id'] == $params['id'] && !$map['isDisplayed']) {
				$this->_mapsObj[$view_id]['isDisplayed'] = true;
				$mapObj = $this->_mapsObj[$view_id];
				break;
			}
		}

		$mapObj = $mapObj ? $mapObj : frameGmp::_()->getModule('gmap')->getModel()->getMapById($params['id']);

		if(empty($mapObj)) return _e('Map not found', GMP_LANG_CODE);

		$shortCodeHtmlParams = array('width', 'height', 'align');
		$paramsCanNotBeEmpty = array('width', 'height');
		$shortCodeMapParams = $this->getModel()->getParamsList();
		$mapMarkersGroupsList = array();

		if(isset($params['map_center']) && is_string($params['map_center'])) {
			if(strpos($params['map_center'], ';')) {
				$centerXY = array_map('trim', explode(';', $params['map_center']));
				$params['map_center'] = array(
					'coord_x' => $centerXY[0],
					'coord_y' => $centerXY[1],
				);
			} elseif(is_numeric($params['map_center'])) {	// Map center - is coords of one of it's marker
				$params['map_center'] = (int) trim($params['map_center']);
				$found = false;

				if(!empty($mapObj['markers'])) {
					foreach($mapObj['markers'] as $marker) {
						if($marker['id'] == $params['map_center']) {
							$params['map_center'] = array(
								'coord_x' => $marker['coord_x'],
								'coord_y' => $marker['coord_y'],
							);
							$found = true;
							break;
						}
					}
				}
				// If no marker with such ID were found - just unset it to prevent map broke
				if(!$found) {
					unset($params['map_center']);
				}
			} else {
				// If it is set, but not valid - just unset it to not break user map
				unset($params['map_center']);
			}
		}
		if(!empty($mapObj['markers'])) {
			foreach($mapObj['markers'] as $marker) {
				if($marker['marker_group_id']) {
					if(in_array($marker['marker_group_id'], $mapMarkersGroupsList)) continue;

					array_push($mapMarkersGroupsList, $marker['marker_group_id']);
				}
			}
		}
		foreach($shortCodeHtmlParams as $code) {
			if(isset($params[$code])){
				if(in_array($code, $paramsCanNotBeEmpty) && empty($params[$code])) continue;
				$mapObj['html_options'][$code] = $params[$code];
			}
		}
		foreach($shortCodeMapParams as $code){
			if(isset($params[$code])) {
				if(in_array($code, $paramsCanNotBeEmpty) && empty($params[$code])) continue;
				$mapObj['params'][$code] = $params[$code];
			}
		}
		if(isset($params['display_as_img']) && $params['display_as_img']) {
			$mapObj['params']['map_display_mode'] = 'popup';
			$mapObj['params']['img_width'] = isset($params['img_width']) ? $params['img_width'] : 175;
			$mapObj['params']['img_height'] = isset($params['img_height']) ? $params['img_height'] : 175;
		}
		if(isset($params['display_as_img']) && $params['display_as_img']) {
			$mapObj['params']['map_display_mode'] = 'popup';
		}
		if($mapObj['params']['map_display_mode'] == 'popup') {
			frameGmp::_()->addScript('jquery-ui-dialog', '', array('jquery'));
			frameGmp::_()->getModule('templates')->loadJqueryUi();
			frameGmp::_()->addStyle('supsystic-uiGmp', GMP_CSS_PATH. 'supsystic-ui.css');
			frameGmp::_()->getModule('templates')->loadFontAwesome();
		}
		if(empty($mapObj['params']['map_display_mode'])){
			$mapObj['params']['map_display_mode'] = 'map';
		}
		if($mapMarkersGroupsList) {
			$mapObj['marker_groups'] = frameGmp::_()->getModule('marker_groups')->getModel()->getMarkersGroupsByIds($mapMarkersGroupsList);
		}

		$mapObj['params']['markers_list_type'] = isset($params['markers_list_type'])
			? $params['markers_list_type']
			: (isset($mapObj['params']['markers_list_type']) && !empty($mapObj['params']['markers_list_type']))
				? $mapObj['params']['markers_list_type']
				: '';
		$mapObj = dispatcherGmp::applyFilters('mapDataRender', $mapObj);

		$this->connectMapsAssets( $mapObj['params'] );
		$this->addMapData(dispatcherGmp::applyFilters('mapDataToJs', $mapObj));

		frameGmp::_()->addScript('frontend.gmap', $this->getModule()->getModPath(). 'js/frontend.gmap.js', array('jquery'), false, true);

		$this->assign('markersDisplayType', $mapObj['params']['markers_list_type']);
		$this->assign('currentMap', $mapObj);

		if(!in_array($mapObj['view_id'], $this->_mapStyles)) {
			$this->addMapStyles($mapObj);
		}
		return parent::getInlineContent('gmapDrawMap');
	}
	public function addMapDataToJs(){
		frameGmp::_()->addJSVar('frontend.gmap', 'gmpAllMapsInfo', self::$_mapsData);
	}
	public function getDisplayColumns() {
		if(empty($this->_displayColumns)) {
			$this->_displayColumns = array(
				'id'				=> array('label' => __('ID'), 'db' => 'id'),
				'title'				=> array('label' => __('Title'), 'db' => 'title'),
				'list_html_options'	=> array('label' => __('Html options'), 'db' => 'html_options'),
				'list_markers'		=> array('label' => __('Markers'), 'db' => 'markers'),
				'operations'		=> array('label' => __('Operations'), 'db' => 'operations'),
			);
		}
		return $this->_displayColumns;
	}
	public function getListMarkers($map) {
		$this->assign('map', $map);
		return parent::getContent('gmapListMarkers');
	}
	public function getListOperations($map) {
		$this->assign('map', $map);
		$this->assign('editLink', $this->getModule()->getEditMapLink( $map['id'] ));
		return parent::getContent('gmapListOperations');
	}
	public function getTabContent() {
		frameGmp::_()->getModule('templates')->loadJqGrid();
		frameGmp::_()->addScript('admin.gmap', $this->getModule()->getModPath(). 'js/admin.gmap.js');
		frameGmp::_()->addScript('admin.gmap.list', $this->getModule()->getModPath(). 'js/admin.gmap.list.js');
		frameGmp::_()->addJSVar('admin.gmap.list', 'gmpTblDataUrl', uriGmp::mod('gmap', 'getListForTbl', array('reqType' => 'ajax')));
		frameGmp::_()->addStyle('admin.gmap', $this->getModule()->getModPath(). 'css/admin.gmap.css');
		
		$this->assign('addNewLink', frameGmp::_()->getModule('options')->getTabUrl('gmap_add_new'));
		return parent::getContent('gmapAdmin');
	}
	public function getEditMap($id = 0) {
		$editMap = $id ? true : false;
		$isPro = frameGmp::_()->getModule('supsystic_promo')->isPro();
		$gMapApiParams = array('language' => '');
		$allStylizationsList = $this->getModule()->getStylizationsList();
		$allMarkerGroupsList = frameGmp::_()->getModule('marker_groups')->getModel()->getAllMarkerGroups();
		$markerLists = $this->getModule()->getMarkerLists();
		$positionsList = $this->getModule()->getControlsPositions();
		$stylizationsForSelect = array('none' => __('None', GMP_LANG_CODE),);
		$markerGroupsForSelect = array('0' => __('None', GMP_LANG_CODE),);

		frameGmp::_()->getModule('templates')->loadJqGrid();
		frameGmp::_()->addScript('jquery-ui-sortable');
		frameGmp::_()->addScript('wp.tabs', GMP_JS_PATH. 'wp.tabs.js');
		frameGmp::_()->addScript('admin.gmap', $this->getModule()->getModPath(). 'js/admin.gmap.js');
		frameGmp::_()->addScript('admin.gmap.edit', $this->getModule()->getModPath(). 'js/admin.gmap.edit.js');
		frameGmp::_()->addScript('admin.marker.edit', frameGmp::_()->getModule('marker')->getModPath(). 'js/admin.marker.edit.js');

		frameGmp::_()->addStyle('admin.gmap', $this->getModule()->getModPath(). 'css/admin.gmap.css');

		frameGmp::_()->addJSVar('admin.gmap.edit', 'gmpMapShortcode', GMP_SHORTCODE);
		frameGmp::_()->addJSVar('admin.gmap.edit', 'gmpAllStylizationsList', $allStylizationsList);
		frameGmp::_()->addJSVar('admin.gmap.edit', 'gmpMapsListUrl', frameGmp::_()->getModule('options')->getTabUrl('gmap'));

		// jqGrid tables urls
		$gmpMarkersTblDataUrl =  uriGmp::mod('marker', 'getListForTbl', array('reqType' => 'ajax', 'map_id' => $id));
		frameGmp::_()->addJSVar('admin.gmap.edit', 'gmpMarkersTblDataUrl', $gmpMarkersTblDataUrl);
		frameGmp::_()->addJSVar('admin.marker.edit', 'gmpMarkersTblDataUrl', $gmpMarkersTblDataUrl);

		if($isPro) {
			$gmpShapesTblDataUrl =  uriGmp::mod('shape', 'getListForTbl', array('reqType' => 'ajax', 'map_id' => $id));
			frameGmp::_()->addJSVar('admin.gmap.edit', 'gmpShapesTblDataUrl', $gmpShapesTblDataUrl);
			frameGmp::_()->addJSVar('admin.shape.edit', 'gmpShapesTblDataUrl', $gmpShapesTblDataUrl);
		}
		foreach($allMarkerGroupsList as $key => $value) {
			$markerGroupsForSelect[ $value['id'] ] = $value['title'];
		}
		foreach($allStylizationsList as $styleName => $json) {
			$stylizationsForSelect[ $styleName ] = $styleName;	// JSON data will be attached on js side
		}
		if($editMap) {
			$map = $this->getModel()->getMapById( $id );
			$gMapApiParams = $map['params'];
			$mapMarkersGroupsList = array();
			$mapMarkersGroups = array();

			if($map['markers'] && !empty($map['markers'])) {
				foreach($map['markers'] as $marker) {
					if($marker['marker_group_id']) {
						if(in_array($marker['marker_group_id'], $mapMarkersGroupsList)) continue;

						array_push($mapMarkersGroupsList, $marker['marker_group_id']);
					}
				}
			}
			if($mapMarkersGroupsList) {
				foreach($allMarkerGroupsList as $group) {
					if(in_array($group['id'], $mapMarkersGroupsList)) array_push($mapMarkersGroups, $group);
				}
				$map['marker_groups'] = $mapMarkersGroups;
			}

			$this->assign('map', $map);

			frameGmp::_()->addJSVar('admin.gmap.edit', 'gmpMainMap', $map);
		}

		$this->connectMapsAssets($gMapApiParams, true);

		$this->assign('editMap', $editMap);
		$this->assign('isPro', $isPro);
		$this->assign('icons', frameGmp::_()->getModule('icons')->getModel()->getIcons(array('fields' => 'id, path, title')));
		$this->assign('stylizationsForSelect', $stylizationsForSelect);
		$this->assign('positionsList', $positionsList);
		$this->assign('mainLink', frameGmp::_()->getModule('supsystic_promo')->getMainLink());
		$this->assign('markerLists', $markerLists);
		$this->assign('markerGroupsForSelect', $markerGroupsForSelect);
		$this->assign('viewId', $editMap ? $map['view_id'] : 'preview_id_'. mt_rand(1, 9999));
		$this->assign('promoModPath', frameGmp::_()->getModule('supsystic_promo')->getModPath());

		return parent::getContent('gmapEditMap');
	}
	public function connectMapsAssets($params, $forAdminArea = false) {
		$params['language'] = isset($params['language']) && !empty($params['language']) ? $params['language'] : utilsGmp::getLangCode2Letter();

		frameGmp::_()->addScript('google_maps_api', $this->getApiUrl(). '&language='. $params['language']);
		frameGmp::_()->addScript('core.gmap', $this->getModule()->getModPath(). 'js/core.gmap.js');
		frameGmp::_()->addScript('core.marker', frameGmp::_()->getModule('marker')->getModPath(). 'js/core.marker.js');
		if((isset($params['marker_clasterer']) && $params['marker_clasterer'] != 'none') || $forAdminArea) {
			//frameGmp::_()->addScript('core.markerclusterer', $this->getModule()->getModPath(). 'js/core.markerclusterer.min.js');
			frameGmp::_()->addScript('core.markerclusterer', $this->getModule()->getModPath(). 'js/core.markerclusterer.js', array(), '1.0');
		}

		frameGmp::_()->addStyle('core.gmap', $this->getModule()->getModPath(). 'css/core.gmap.css');

		dispatcherGmp::doAction('afterConnectMapAssets', $params, $forAdminArea);
	}
}
