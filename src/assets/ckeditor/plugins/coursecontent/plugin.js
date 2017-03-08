/*
 * @example An iframe-based dialog with frame window fit dialog size.
 */
( function() {
    CKEDITOR.plugins.add( 'coursecontent',
        {
            requires: [ 'iframedialog' ],
            init: function( editor )
            {
                var height = 210, width = 500;
                var formsuri = '/forms';
                CKEDITOR.dialog.addIframe(
                    'coursecontentDialog',
                    'Insert an LTI Tool',
                    formsuri, width, height,
                    function()
                    {
                        // Iframe loaded callback.
                    },

                    {
                        onOk : function()
                        {
                            // Dialog onOk callback funtion.
                            var dialog = this
                            $.ajax({
                            url: 'launchUrlEditor',
                            dataType: 'html',
                            type: 'GET',
                                success: function(data) {
                                    editor.insertHtml(data);
                                 }
                             })
                        }
                    }

                );

                editor.addCommand( 'coursecontentDialogCmd', new CKEDITOR.dialogCommand( 'coursecontentDialog' ) );

                editor.ui.addButton( 'coursecontentDialog',
                    {
                        label: 'LtiTools',
                        command: 'coursecontentDialogCmd',
                        icon: this.path + 'icons/content.png'
                    } );

            }
        } );

} )();

var toolbar = CKEDITOR.config.toolbarButtons;
//toolbar[toolbar.length-1].items.push( 'coursecontentDialog' );