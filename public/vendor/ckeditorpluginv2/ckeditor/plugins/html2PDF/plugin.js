/**
 * @license Copyright (c) 2017 Peace Ngara. All rights reserved.
 * The Ability to Get Contents of an Editor Instance and Print to PDF
 */

/**
 * @fileOverview HTML2PDF Plugin
 */

CKEDITOR.plugins.add( 'html2PDF', {
	// jscs:disable maximumLineLength
	lang: 'af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn', // %REMOVE_LINE_CORE%
	// jscs:enable maximumLineLength
	icons: 'html2PDF,', // %REMOVE_LINE_CORE%
	init: function( editor ) {
		// Print plugin isn't available in inline mode yet.
		if ( editor.elementMode == CKEDITOR.ELEMENT_MODE_INLINE )
			return;

		var pluginName = 'html2PDF';

		// Register the command.
		editor.addCommand( pluginName, CKEDITOR.plugins.html2PDF );

		// Register the toolbar button.
		editor.ui.addButton && editor.ui.addButton( 'Html2PDF', {
			label: 'Save as PDF',
			command: pluginName
			// toolbar: 'document,50'
		} );
	}
} );
//Execute AJAX Request
CKEDITOR.plugins.html2PDF = {
	exec: function( editor ) {
		var urlins = '/html2PDF';
		CKEDITOR.instances.ltieditorv2inst.updateElement();
		// var data = editor.$('#ltieditorv2inst').val();
		CKEDITOR.getFullHTMLContent = function(editor){
			var cnt = "";
			editor.once('contentPreview', function(e){
				cnt = e.data.dataValue;
				return false;
			});
			editor.execCommand('preview');

			return cnt;
		};
		// var data = editor.value=encodeURIComponent(CKEDITOR.instances.ltieditorv2inst.getData());
		var rawdata = editor.value=encodeURIComponent(CKEDITOR.getFullHTMLContent(editor));

		var data = editor.dataProcessor.toDataFormat( rawdata );


		function submit(action, method, values) {
			var form = $('<form/>', {
				action: action,
				method: method
			});
			$.each(values, function() {
				form.append($('<input/>', {
					type: 'hidden',
					name: this.name,
					value: this.value,

				}));
			});
			form.appendTo('body').submit();
		}

		submit(urlins, 'POST', [
			{ name: 'data', value: data },

		]);
	},
	canUndo: false,
	readOnly: 1,
	modes: { wysiwyg: 1 }
};
