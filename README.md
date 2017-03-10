# CKEDITOR Laravel Lti Plugin V1.0

This Plugin can only be used with Tsugi LTI Launcher and Laravel.
The CkEditor LTI Plugin can also be used as a basis of setting up your LTI Launcher on the Ck Editor.
Please note for tool to work it has to be launched from an LTI Hosting Container

### Pre Installation Check

    <ul>
    <li>Laravel 5+</li>
    <li>LaravelLTI Base Package</li>
    <li>PHP 5.4+ and MySQL</li>
    <li>Tsugi Library </li>
    </ul>
    
   [Laravel LTI Base Package](https://github.com/EonConsulting/laravel-lti)
   [Tsugi LTI Library](https://tsugi.org)

### The Following required Modules are included in the Assets Directory of the Plugin

    <ul>
    <li>CK Editor 4+:</li>
    <li>CK Editor Dialog Plugin</li>
    <li>JQuery and Bootstrap :: Included as CDN</li>
    </ul>
    
All the documentation on how to install a Package of this Nature can be found here: [Installation](https://github.com/EonConsulting/PHPStencil/wiki/Installation)

This Link serves as an example only

## Introduction

This is a CK LTI Plugin built on Top of the Laravel Framework, The Plugin can be used to insert LTI Tools from different Providers to structure content within the Content Editor.
        
    An example would be to insert a Google Maps Content from a specific content provider.

Also Note the Plugin is still in Development Mode.

### Lets Start the Engines 
Create a Folder in the root of your LaravelProject and name it Packages
an example on how to install Laravel Packages can be found here:
[Laravel Package Installation Instructions](https://github.com/EonConsulting/PHPStencil/wiki/Installation)

1. Download or Clone the CKEditorPlugin
2. Register the Service Provider and Facade Instructions[Installation Instructions](https://github.com/EonConsulting/PHPStencil/wiki/Installation)

## How to use the Plugin
Once the Service Provider has been registered an Icon written LTI will appear on the Editor, open and launch it.

#### Required Launch Parameters 

launch_url : required
key : optional
secret: optional

### Named Routes
To be Launched from the Tsugi Management Console
1. ltiCKEditor 

Once the Launch is Initialised click the OK Button on the Dialog and Insert the tool to the Body of the editor on the caret position.
Insert the LTI into your editor, this will load an Iframe Generated by Tsugi with the Launch content and all parameters.

### The Final Step
Publish All Assets to the vendor folder using the following command:

    php artisan vendor:publish --tag=public --force


#### The Road ahead
     This Version of the plugin launches and creates an instance of a Tool.
     
     The Second version of the plugin [Version 2](https://github.com/EonConsulting/ck-editor-plugin-v2)
     lists all LTI Components, The user will just select a component from
     
