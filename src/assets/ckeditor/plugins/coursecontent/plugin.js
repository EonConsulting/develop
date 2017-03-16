/**
 * @Author Peace Ngara
 * @Ck Editor Version 1 Plugin - Alias coursecontent
 * @file Overview CK Editor LTI Insert from an LTI Link or Config file
 *
 */

/**
 * Fired When the User clicks the LTI Button on the Toolbar
 * @since 1.0
 * @event click
 * @member CKEDITOR.editor
 *
 */
( function() {
    CKEDITOR.plugins.add( 'coursecontent',
        {
            init: function( editor )
            {


                CKEDITOR.dialog.add('coursecontentDialog', function ()
                {
                    return {
                        title : 'LTI Insert',
                        minWidth  : 450,
                        minHeight : 200,
                        contents  : [
                        {
                            // Initialise and Open TAB

                            id: 'ltitab',
                            label: 'Insert LTI Component',
                            title: 'Insert an LTI Component',
                            expand: true,
                            padding: 5,
                            elements : [{
                                type: 'vbox',
                                widths: [null, null],
                                styles: ['vertical-align-top'],
                                children: [
                                    {
                                        type: 'text',
                                        id: 'launch_url',
                                        label: 'Launch or Config URL',
                                        style: 'margin-top:5px',
                                        validate: function () {
                                            if ( !this.getValue()) {
                                                alert('Launch or Config URL can not be empty');
                                            return false;
                                            }
                                        }
                                    },{
                                        type: 'text',
                                        id: 'launchkey',
                                        label: 'Launch KEY',
                                        style: 'margin-top:5px',
                                        validate: function () {

                                        },
                                    },{
                                        type: 'text',
                                        id: 'launchsecret',
                                        label: 'Launch Secret',
                                        style: 'margin-top:5px',
                                        validate: function () {

                                        },
                                    },{
                                        type: 'text',
                                        id: 'height',
                                        label: 'Iframe Height',
                                        style: 'margin-top:5px',
                                        width: '100px',
                                        validate: function () {

                                        },
                                    },
                                ],

                            }]
                        }
                    ],

                        onOk : function () {

                            // Write a function that check if a certain character exists
                            // First lets get the Field
                            var dialog = CKEDITOR.dialog.getCurrent();
                            var launch_url = dialog.getContentElement('ltitab', 'launch_url').getInputElement().getValue();
                            var key = dialog.getContentElement('ltitab', 'launchkey').getInputElement().getValue();
                            var secret = dialog.getContentElement('ltitab', 'launchsecret').getInputElement().getValue();
                            var uheight = dialog.getContentElement('ltitab', 'height').getInputElement().getValue();
                            var erorlogNum = 'XD0000000CK111';

                            //Writing a Conditional Statement
                            //If Value Contains an Index of .xml -> Send Config File to Server

                            $.ajax({
                                url: '/ajresponse',
                                type: 'GET',
                                success: function(launchparams) {
                                    // var dialog = CKEDITOR.dialog.getCurrent();

                                    if (launch_url.indexOf('.xml') > -1) {
                                            $.ajax({
                                                url: '/xmltransport',
                                                type: 'post',
                                                data: {launch_url: launch_url, key: key, secret: secret},
                                                success: function (configparams) {
                                                    if (configparams.status == 'domainerror') {
                                                        var domainExistsUrl = "/cklaunch?launch_url="+configparams.launch_url ;
                                                        var propHeight = dialog.getContentElement('ltitab', 'height').getInputElement().getValue();
                                                        var propDiv = new CKEDITOR.dom.element('div');
                                                        var propIframe = new CKEDITOR.dom.element('iframe');
                                                        propDiv.setAttributes({
                                                            'class': 'iframeCover',
                                                        });
                                                        propIframe.setAttributes({
                                                            'width': '100%',
                                                            'height': propHeight,
                                                            'type': 'text/html',
                                                            'src': domainExistsUrl,
                                                            'frameborder': 0,
                                                            'class': 'ckeditorframe',
                                                        });

                                                        editor.insertElement(propDiv, propDiv.append(propIframe));

                                                    } else {
                                                    // console.log(configparams);
                                                    var url = "/cklaunch?launch_url="+configparams.launch_url ;
                                                    var uheight = dialog.getContentElement('ltitab', 'height').getInputElement().getValue();
                                                    var div = new CKEDITOR.dom.element('div');
                                                    var iframe = new CKEDITOR.dom.element('iframe');
                                                    // Set Div Attributes
                                                    div.setAttributes({
                                                        'class': 'iframeCover',
                                                    });
                                                    iframe.setAttributes({
                                                        'width': '100%',
                                                        'height': uheight,
                                                        'type': 'text/html',
                                                        'src': url,
                                                        'frameborder': 0,
                                                        'class': 'ckeditorframe',

                                                    });
                                                    editor.insertElement(div, div.append(iframe));
                                                }
                                                    if (config.status == 'Error') {
                                                        alert('There was an Error Processing this Request' + erorlogNum)
                                                        return false;
                                                    }
                                            }

                                            })

                                         }
                                    else {
                                        $.ajax({
                                            url: '/launchtransport',
                                            type: 'post',
                                            data: {launch_url: launch_url, key:key, secret:secret},
                                            success: function (config) {
                                                    if (config.status == 'success') {
                                                        var url = "/cklaunch?launch_url="+launch_url ;
                                                        var div =       new CKEDITOR.dom.element('div');
                                                        var iframe =    new CKEDITOR.dom.element('iframe');
                                                        div.setAttributes({
                                                            'class': 'iframeCover',
                                                        });
                                                        iframe.setAttributes({
                                                            'width' :'100%',
                                                            'height': uheight,
                                                            'type'  : 'text/html',
                                                            'src': url,
                                                            'allowtransparency': 'true',
                                                            'frameborder': 0,
                                                            'class': 'ckeditorframe',

                                                        });

                                                        editor.insertElement(div, div.append(iframe));
                                                    }
                                                    else {
                                                        console.log(config);
                                                        var domainExistsUrl = "/cklaunch?launch_url="+ launch_url ;
                                                        var propHeight = dialog.getContentElement('ltitab', 'height').getInputElement().getValue();
                                                        var propDiv = new CKEDITOR.dom.element('div');
                                                        var propIframe = new CKEDITOR.dom.element('iframe');
                                                        propDiv.setAttributes({
                                                            'class': 'iframeCover',
                                                        });
                                                        propIframe.setAttributes({
                                                            'width': '100%',
                                                            'height': propHeight,
                                                            'type': 'text/html',
                                                            'src': domainExistsUrl,
                                                            'frameborder': 0,
                                                            'class': 'ckeditorframe',
                                                        });

                                                        editor.insertElement(propDiv, propDiv.append(propIframe));
                                                    }

                                                    // if (config.status == 'Error') {
                                                    //     alert('There was an Error Processing this Request' + erorlogNum)
                                                    //     return false;
                                                    // }
                                            }

                                        });
                                    }

                                    }

                            });

                            // Set Iframe Attributes

                        }
                    };

                });

                editor.addCommand( 'coursecontentDialogCmd', new CKEDITOR.dialogCommand( 'coursecontentDialog' ) );

                editor.ui.addButton( 'coursecontentDialog',
                    {
                        label: 'LtiTools',
                        command: 'coursecontentDialogCmd',
                        icon: this.path + 'icons/content.png'
                    } );

            }
        } );
    //
    // var csdialogDefinition = function (editor) {
    //     var openMsgDialog = function () {
    //         alert('This Launch URI can not be empty');
    //     }
    //     var dialogDefinition =
    //
    //     return dialogDefinition;
    //
    // }
})();

var toolbar = CKEDITOR.config.toolbarButtons;
//toolbar[toolbar.length-1].items.push( 'coursecontentDialog' );