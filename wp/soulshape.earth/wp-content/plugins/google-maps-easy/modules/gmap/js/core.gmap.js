// Maps
function gmpGoogleMap(elementId, params) {
	if(typeof(google) === 'undefined') {
		alert('Please check your Internet connection - we need it to load Google Maps Library from Google Server');
		return false;
	}
	params = params ? params : {};
	var defaults = {
		center: new google.maps.LatLng(40.69847032728747, -73.9514422416687)
	,	zoom: 8
	//,	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	if(params.map_center && params.map_center.coord_x && params.map_center.coord_y) {
		params.center = new google.maps.LatLng(params.map_center.coord_x, params.map_center.coord_y);
	}
	if(params.zoom) {
		params.zoom = parseInt(params.zoom);
	}
	if (typeof(elementId) === 'string') {
		elementId = jQuery(elementId)[0];
	}
	this._elementId = elementId;
	this._mapParams = jQuery.extend({}, defaults, params);
	this._mapObj = null;
	this._markers = [];
	this._shapes = [];
	this._heatmap = [];
	this._clasterer = null;
	this._clastererEnabled = false;
	this._eventListeners = {};
	this._layers = {};
	this.init();
}
gmpGoogleMap.prototype.init = function() {
	this._beforeInit();
	this._mapObj = new google.maps.Map(this._elementId, this._mapParams);
	this._afterInit();
};
gmpGoogleMap.prototype._beforeInit = function() {
	if(typeof(this._mapParams.type_control) !== 'undefined') {
		if(typeof(google.maps.MapTypeControlStyle[ this._mapParams.type_control ]) !== 'undefined') {
			this._mapParams.mapTypeControlOptions = {
				style: google.maps.MapTypeControlStyle[ this._mapParams.type_control ]
			};
			this._mapParams.mapTypeControl = true;
		} else {
			this._mapParams.mapTypeControl = false;
		}
	}
	if(typeof(this._mapParams.zoom_control) !== 'undefined') {
		if(typeof(google.maps.ZoomControlStyle[ this._mapParams.zoom_control ]) !== 'undefined') {
			this._mapParams.zoomControlOptions = {
				style: google.maps.ZoomControlStyle[ this._mapParams.zoom_control ]
			};
			this._mapParams.zoomControl = true;
		} else {
			this._mapParams.zoomControl = false;
		}
	}
	if(typeof(this._mapParams.street_view_control) !== 'undefined') {
		this._mapParams.streetViewControl = parseInt(this._mapParams.street_view_control) ? true : false;
	}
	if(typeof(this._mapParams.pan_control) !== 'undefined') {
		this._mapParams.panControl = parseInt(this._mapParams.pan_control) ? true : false;
	}
	if(typeof(this._mapParams.overview_control) !== 'undefined') {
		if(this._mapParams.overview_control !== 'none') {
			this._mapParams.overviewMapControlOptions = {
				opened: this._mapParams.overview_control === 'opened' ? true : false
			};
			this._mapParams.overviewMapControl = true;
		} else {
			this._mapParams.overviewMapControl = false;
		}
	}
	if(typeof(this._mapParams.dbl_click_zoom) !== 'undefined') {
		this._mapParams.disableDoubleClickZoom = parseInt(this._mapParams.dbl_click_zoom) ? false : true;	// False/true in revert order - because option actually is for disabling this feature
	}
	if(typeof(this._mapParams.mouse_wheel_zoom) !== 'undefined') {
		this._mapParams.scrollwheel = parseInt(this._mapParams.mouse_wheel_zoom) ? true : false;
	}
	if(typeof(this._mapParams.map_type) !== 'undefined' 
		&& typeof(google.maps.MapTypeId[ this._mapParams.map_type ]) !== 'undefined'
	) {
		this._mapParams.mapTypeId = google.maps.MapTypeId[ this._mapParams.map_type ];
	}
	if(typeof(this._mapParams.map_stylization_data) !== 'undefined' 
		&& this._mapParams.map_stylization_data
	) {
		this._mapParams.styles = this._mapParams.map_stylization_data;
	}
	jQuery(document).trigger('gmapBeforeMapInit', this);
};
gmpGoogleMap.prototype.getParams = function(){
	return this._mapParams;
};
gmpGoogleMap.prototype.getParam = function(key){
	return this._mapParams[ key ];
};
gmpGoogleMap.prototype.setParam = function(key, value){
	this._mapParams[ key ] = value;
	return this;
};
gmpGoogleMap.prototype._afterInit = function() {
	if(typeof(this._mapParams.marker_clasterer) !== 'undefined' && this._mapParams.marker_clasterer) {
		this.enableClasterization(this._mapParams.marker_clasterer);
	}
	if(typeof(this._mapParams.zoom_min) !== 'undefined' && typeof(this._mapParams.zoom_max) !== 'undefined') {
		this._setMinZoomLevel();
		this._setMaxZoomLevel();
		this._fixZoomLevel();
	}
	jQuery(document).trigger('gmapAfterMapInit', this);
};
gmpGoogleMap.prototype._setMinZoomLevel = function() {
	var minZoom = parseInt(this._mapParams.zoom_min) ? parseInt(this._mapParams.zoom_min) : null;
	this.getRawMapInstance().setOptions({maxZoom: minZoom});
	if(this.getRawMapInstance().zoom < minZoom)
		this.getRawMapInstance().setOptions({zoom: minZoom});
};
gmpGoogleMap.prototype._setMaxZoomLevel = function() {
	var maxZoom = parseInt(this._mapParams.zoom_max) ? parseInt(this._mapParams.zoom_max) : null;
	this.getRawMapInstance().setOptions({maxZoom: maxZoom});
	if(this.getRawMapInstance().zoom > maxZoom)
		this.getRawMapInstance().setOptions({zoom: maxZoom});
};
gmpGoogleMap.prototype._fixZoomLevel = function() {
	var eventHandle = this._getEventListenerHandle('zoom_changed', 'zoomChanged');
	if(!eventHandle) {
		eventHandle = google.maps.event.addListener(this.getRawMapInstance(), 'zoom_changed', jQuery.proxy(function(){
			var minZoom = parseInt(this.getParam('zoom_min'))
			,	maxZoom = parseInt(this.getParam('zoom_max'));
			if (this.getZoom() < minZoom) {
				this.setZoom(minZoom);
				if(GMP_DATA.isAdmin && this._getEventListenerHandle('idle', 'enableClasterization'))
					google.maps.event.trigger(this.getRawMapInstance(), 'idle');
			}
			if (this.getZoom() > maxZoom) {
				this.setZoom(maxZoom);
				if(GMP_DATA.isAdmin && this._getEventListenerHandle('idle', 'enableClasterization'))
					google.maps.event.trigger(this.getRawMapInstance(), 'idle');
			}
		}, this));
		this._addEventListenerHandle('zoom_changed', 'zoomChanged', eventHandle);
	}
};
gmpGoogleMap.prototype.enableClasterization = function(clasterType, needTrigger) {
	var needTrigger = needTrigger ? needTrigger : false;

	switch(clasterType) {
		case 'MarkerClusterer':	// Support only this one for now
			var self = this;

			var eventHandle = google.maps.event.addListenerOnce(self.getRawMapInstance(), 'idle', function(a, b, c){
				var clasterIcon = GMP_DATA.modPath + 'gmap/img/m1.png'
				,	oldDefClasterIcon = 'https://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m1.png'		// Prevent to use old default claster icon cdn icon because it is missing
				,	iconWidth = 53
				,	iconHeight = 52;

				clasterIcon = self.getParam('marker_clasterer_icon') && self.getParam('marker_clasterer_icon') != oldDefClasterIcon
						? self.getParam('marker_clasterer_icon')
						: clasterIcon;
				iconWidth = self.getParam('marker_clasterer_icon_width') ? self.getParam('marker_clasterer_icon_width') : iconWidth;
				iconHeight = self.getParam('marker_clasterer_icon_height') ? self.getParam('marker_clasterer_icon_height') : iconHeight;

				var clusterStyles = [ { url: clasterIcon, width: iconWidth, height: iconHeight } ];

				// Enable clasterization
				var mcOptions = {
					styles: clusterStyles
				};
				var allMapMarkers = self.getAllRawMarkers()
				,	allVisibleMapMarkers = [];
				for(var marker in allMapMarkers) {
					if(allMapMarkers[marker].getVisible()) {
						allVisibleMapMarkers.push(allMapMarkers[marker]);
					}
				}
				if(self._clasterer){
					self._clasterer.clearMarkers();
					self._clasterer.addMarkers( allVisibleMapMarkers );
					var styles = self._clasterer.getStyles();
					styles[0]['url'] = clusterStyles[0]['url'];
					styles[0]['width'] = clusterStyles[0]['width'];
					styles[0]['height'] = clusterStyles[0]['height'];
					self._clasterer.resetViewport();
					self._clasterer.redraw();
				} else
					self._clasterer = new MarkerClusterer(self.getRawMapInstance(), allVisibleMapMarkers, mcOptions);
			});
			this._addEventListenerHandle('idle', 'enableClasterization', eventHandle);
			if(GMP_DATA.isAdmin || needTrigger) {
				google.maps.event.trigger(self.getRawMapInstance(), 'idle');
			}
			this._clastererEnabled = true;
			break;
	}
};
gmpGoogleMap.prototype.disableClasterization = function() {
	var eventHandle = this._getEventListenerHandle('idle', 'enableClasterization');
	if(eventHandle) {
		if(this._clasterer) {
			this._clasterer.clearMarkers();
			var markers = this.getAllRawMarkers();
			for(var i = 0; i < markers.length; i++) {
				markers[i].setMap( this.getRawMapInstance() );
			}
		}
		google.maps.event.removeListener( eventHandle );
		google.maps.event.trigger(this.getRawMapInstance(), 'idle');
		this._clastererEnabled = false;
	}
};
/**
 * Should trigger after added or modified markers
 */
gmpGoogleMap.prototype.markersRefresh = function() {
	if(this._clastererEnabled && this._clasterer) {
		this._clasterer.clearMarkers();
		this._clasterer.addMarkers( this.getAllRawMarkers() );
	}
	jQuery(document).trigger('gmapAfterMarkersRefresh', this);
};
gmpGoogleMap.prototype._addEventListenerHandle = function(event, code, handle) {
	if(!this._eventListeners[ event ])
		this._eventListeners[ event ] = {};
	this._eventListeners[ event ][ code ] = handle;
};
gmpGoogleMap.prototype._getEventListenerHandle = function(event, code) {
	return this._eventListeners[ event ] && this._eventListeners[ event ][ code ]
		? this._eventListeners[ event ][ code ]
		: false;
};
gmpGoogleMap.prototype.getRawMapInstance = function() {
	return this._mapObj;
};
gmpGoogleMap.prototype.setCenter = function (lat, lng) {
	if(typeof lng == 'undefined'){
		this.getRawMapInstance().setCenter(lat);
	}else
		this.getRawMapInstance().setCenter(new google.maps.LatLng(lat, lng));
	return this;
};
gmpGoogleMap.prototype.getCenter = function () {
	return this.getRawMapInstance().getCenter();
};
gmpGoogleMap.prototype.setZoom = function (zoomLevel) {
	this.getRawMapInstance().setZoom(parseInt(zoomLevel));
};
gmpGoogleMap.prototype.getZoom = function () {
	return this.getRawMapInstance().getZoom();
};
gmpGoogleMap.prototype.addMarker = function(params) {
	var newMarker = new gmpGoogleMarker(this, params);
	this._markers.push( newMarker );
	return newMarker;
};
gmpGoogleMap.prototype.addShape = function(params) {
	var newShape = new gmpGoogleShape(this, params);
	this._shapes.push( newShape );
	return newShape;
};
gmpGoogleMap.prototype.addHeatmap = function(params) {
	var heatmap = new gmpGoogleHeatmap(this, params);
	this._heatmap.push( heatmap );
	return heatmap;
};
gmpGoogleMap.prototype.getMarkerById = function(id) {
	if(this._markers && this._markers.length) {
		for(var i in this._markers) {
			if(this._markers[ i ].getId() == id)
				return this._markers[ i ];
		}
	}
	return false;
};
gmpGoogleMap.prototype.getShapeById = function(id) {
	if(this._shapes && this._shapes.length) {
		for(var i in this._shapes) {
			if(this._shapes[ i ].getId() == id)
				return this._shapes[ i ];
		}
	}
	return false;
};
gmpGoogleMap.prototype.getHeatmap = function() {
	if(this._heatmap && this._heatmap.length) {
		// There is only one heatmap layer on the map
		return this._heatmap[0];
	}
	return false;
};
gmpGoogleMap.prototype.removeMarker = function(id) {
	var marker = this.getMarkerById( id );
	if(marker) {
		marker.removeFromMap();
	}
};
gmpGoogleMap.prototype.removeShape = function(id) {
	var shape = this.getShapeById( id );

	if(shape) {
		shape.removeFromMap();
	}
};
gmpGoogleMap.prototype.getAllMarkers = function() {
	return this._markers;
};
gmpGoogleMap.prototype.getAllShapes = function() {
	return this._shapes;
};
/**
 * Retrive original Map marker objects (Marker objects from Google API)
 */
gmpGoogleMap.prototype.getAllRawMarkers = function() {
	var res = [];
	if(this._markers && this._markers.length) {
		for(var i = 0; i < this._markers.length; i++) {
			res.push( this._markers[i].getRawMarkerInstance() );
		}
	}
	return res;
};
gmpGoogleMap.prototype.setMarkersParams = function(markers) {
	if(this._markers && this._markers.length) {
		for(var i = 0; i < this._markers.length; i++) {
			for(var j = 0; j < markers.length; j++) {
				if(this._markers[i].getId() == markers[j].id) {
					this._markers[i].setMarkerParams( markers[j] );
					break;
				}
			}
		}
	}
	
};
gmpGoogleMap.prototype.get = function(key) {
	return this.getRawMapInstance().get( key );
};
// Set option for RAW MAP
gmpGoogleMap.prototype.set = function(key, value) {
	this.getRawMapInstance().set( key, value );
	return this;
};
gmpGoogleMap.prototype.clearMarkers = function() {
	if(this._markers && this._markers.length) {
		for(var i = 0; i < this._markers.length; i++) {
			this._markers[i].setMap( null );
		}
		this._markers = [];
	}
};
gmpGoogleMap.prototype.clearShapes = function() {
	if(this._shapes && this._shapes.length) {
		for(var i = 0; i < this._shapes.length; i++) {
			this._shapes[i].setMap( null );
		}
		this._shapes = [];
	}
};
gmpGoogleMap.prototype.getViewId = function() {
	return this._mapParams.view_id;
};
gmpGoogleMap.prototype.getViewHtmlId = function() {
	return this._mapParams.view_html_id;
};
gmpGoogleMap.prototype.getId = function() {
	return this._mapParams.id;
};
gmpGoogleMap.prototype.refresh = function() {
	return google.maps.event.trigger(this.getRawMapInstance(), 'resize');
};
gmpGoogleMap.prototype.fullRefresh = function() {
	this.refresh();
	this.checkMarkersParams(this._markers, false);
	this.setCenter( this._mapParams.center );
};
gmpGoogleMap.prototype.checkMarkersParams = function(markers, needToShow) {
	if(markers && markers.length) {
		for (var i = 0; i < markers.length; i++) {
			var markerParams = markers[i].getMarkerParam('params');
			if(parseInt(markerParams.show_description) || needToShow) {
				//markers[i].hideInfoWnd();
				markers[i].showInfoWnd( true );
			}
		}
	}
};
// Common functions
var g_gmpGeocoder = null;
jQuery.fn.mapSearchAutocompleateGmp = function(params) {
	params = params || {};
    jQuery(this).keyup(function(event){
		// Ignore tab, enter, caps, end, home, arrows
		if(toeInArrayGmp(event.keyCode, [9, 13, 20, 35, 36, 37, 38, 39, 40])) return;
		var address = jQuery.trim(jQuery(this).val());
		if(address && address != '') {
			if(typeof(params.msgEl) === 'string')
				params.msgEl = jQuery(params.msgEl);
			params.msgEl.showLoaderGmp();
			var self = this;
			jQuery(this).autocomplete({
				source: function(request, response) {
					var geocoder = gmpGetGeocoder();
					geocoder.geocode( { 'address': address}, function(results, status) {
						params.msgEl.html('');
						if (status == google.maps.GeocoderStatus.OK && results.length) {
							var autocomleateData = [];
							for(var i in results) {
								autocomleateData.push({
									lat: results[i].geometry.location.lat()
								,	lng: results[i].geometry.location.lng()
								,	label: results[i].formatted_address
								});
							}
							response(autocomleateData);
						} else {
							var notFoundMsg = toeLangGmp('Google can\'t find requested address coordinates, please try to modify search criterias.');
							if(jQuery(self).parent().find('.ui-helper-hidden-accessible').size()) {
								jQuery(self).parent().find('.ui-helper-hidden-accessible').html( notFoundMsg );
							} else {
								params.msgEl.html( notFoundMsg );
							}
						}
					});
				}
			,	select: function(event, ui) {
					if(params.onSelect) {
						params.onSelect(ui.item, event, ui);
					}
				}
			});
			// Force imidiate search right after creation
			jQuery(this).autocomplete('search');
		}
	});
};
function gmpGetGeocoder() {
	if(!g_gmpGeocoder) {
		g_gmpGeocoder = new google.maps.Geocoder();
	}
	return g_gmpGeocoder;
}
function changeInfoWndBgColor(map) {
	g_gmpMarkerBgColorTimeoutSet = false;
	var color = map.getParam('marker_infownd_bg_color');

	//This is a standart google maps api class
	var infowndContent = jQuery('#'+ map._elementId.id).find('.gm-style-iw');

	if(infowndContent && infowndContent.length) {
		infowndContent.each(function() {
			jQuery(this).prev().children().last().css('background-color', color);
			jQuery(this).prev().children(':nth-child(3)').children().last().prev().children().last().css('background-color', color);
			jQuery(this).prev().children(':nth-child(3)').children().last().children().css('background-color', color);
		});
	}
}