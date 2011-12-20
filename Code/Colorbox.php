<?php
class Colorbox extends Extension {
	static $allowed_actions = array(
		'colorboxpage'
	);
	static $selectors = array(
		'colorbox' => 'maxWidth:"90%",maxHeight:"90%",scrolling:false,scalePhotos:true,current: "Image {current} of {total}"',
		'colorboxIframe' => 'width:"600", innerHeight:"500", iframe:true',
		'colorboxPage' => 'href: function() {
				var href = $(this).attr("href");
				var query = "";
				queryStart = href.indexOf("?")
				if(queryStart > -1) {
					var query = href.substring(queryStart);
					var href = href.substring(0, queryStart);
				}
				return href+"/colorboxpage/"+query
			},width:"600px",height:"500px"'
	);
	public function init() {
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery-packed.js');
		Requirements::javascript('colorbox/javascript/jquery.colorbox-min.js');
		$selectors_js = '';
		foreach(self::$selectors as $key => $value) {
			$selectors_js .= '$(\'.'.$key.'\').colorbox({'.$value.'});';
		}
		Requirements::customScript(';(function($) {$(document).ready(function(){'.$selectors_js.'});})(jQuery);');
		Requirements::themedCSS('colorbox');
		return array();
	}
	public function colorboxpage() {
		return $this->owner->renderWith('PopOverPage');
	}
	public function add_selector($name,$selector) {
		self::$selectors[$name] = $selector;
	}
	public function set_selectors($selectors) {
		self::$selectors = $selectors;
	}
}