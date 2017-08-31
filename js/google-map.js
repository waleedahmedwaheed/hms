jQuery(function($) {
  "use strict";
  /* ---------------------------------------------------------------------- */
  /* --------------------------- 17 - Google prettyMaps --------------------*/
  /* ---------------------------------------------------------------------- */
  $('#contact-map').prettyMaps({
	  address: '121 King Street, Melbourne Victoria 3000 Australia',
	  image: 'images/map-icon.png',
	  hue: '#fdb000',
	  saturation: -40,
	  zoom: 14,
	  panControl: true,
	  zoomControl: true,
	  mapTypeControl: true,
	  scaleControl: true,
	  streetViewControl: true,
	  overviewMapControl: true,
	  scrollwheel: false
  });
});  