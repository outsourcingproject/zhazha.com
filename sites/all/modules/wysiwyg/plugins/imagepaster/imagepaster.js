(function($) {
	Drupal.wysiwyg.plugins['imagepaster'] = {
		invoke: function(data, settings, instanceId) {
			console.log(data);
			console.log(settings);
			console.log(instanceId);
			pasterMgr.PasteManual();
		}
	}
})(jQuery)