<?php
class Colorbox extends DataObjectDecorator {
	//shouldn't be neccesary:
	/*function __construct() {
		parent::__construct();
	}*/
	static $allowed_actions = array(
		'colorboxpage'
	);
	static $template;
	public function index() {
		Requirements::css('colorbox/css/colorbox.css');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery-packed.js');
		Requirements::javascript('colorbox/javascript/jquery.colorbox-min.js');
		Requirements::customScript(
			';(function($) {
				$(document).ready(function(){
					$(\'.colorbox\').colorbox({ current: "'._t('Colorbox.Current', 'Image {current} of {total}').'" });
					$(\'.colorboxPage\').colorbox({  
						href: function() {
							return $(this).attr("href")+"/colorboxpage?debug_request=1"
						}
					});
					$(\'.colorboxIframe\').colorbox({ innerWidth:"644", innerHeight:"540", iframe:true });
				});
			})(jQuery);'
		);
		return array();
	}
	public function colorboxpage() {
		/*$ssv=new SSViewer("Page");
      $ssv->setTemplateFile("Layout", "MyTemplateName");
      return $this->renderWith($ssv); */
		return $this->owner->renderWith(array($this->owner->ClassName, 'Page', 'ContentController'));
	}
}