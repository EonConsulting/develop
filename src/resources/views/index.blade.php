@extends('ph::layouts.app')

@section('content')


 <div id="print-area">
    <p class="print-placeholder">Please use the print option from the
      mind map menu</p>
  </div>
  <!-- DEBUG -->
 <!--  <div id="debug-warning">Running in DEBUG mode.</div> -->
  <!-- /DEBUG -->
  <div id="container">
    <div id="topbar">
      <div id="toolbar">
        <div id="logo" class="logo-bg">
          <span>Mindmap</span>
        </div>

        <div class="buttons">
          <span class="buttons-left"> </span> <span class="buttons-right">
          </span>
        </div>

      </div>
    </div>
    <div id="canvas-container">
      <div id="drawing-area" class="no-select"></div>
    </div>
    <div id="bottombar">
      <div id="about">
        <a href="about.html" target="_blank"></a> <span
          style="padding: 0 4px;"></span> <a style="font-weight: bold"
          href="https://spreadsheets.google.com/a/drichard.org/spreadsheet/viewform?formkey=dEE3VzFWOFp6ZV9odEhhczVBUUdzc2c6MQ"
          target="_blank"></a>
      </div>
      <div id="statusbar">
        <div
          class="buttons buttons-right buttons-small buttons-less-padding"></div>
      </div>
    </div>
  </div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script src="//api.filepicker.io/v0/filepicker.js"></script>

  <!-- DEBUG -->
  <!-- set debug flag for all scripts. Will be removed in production -->
  <script type="text/javascript">
    var mindmaps = mindmaps || {};
    mindmaps.DEBUG = true;
  </script>
  <!-- /DEBUG -->

  <!-- JS:LIB:BEGIN -->
  <script src="vendor/MindMap/js/libs/jquery-ui-1.8.11.custom.min.js"></script>
  <script src="vendor/MindMap/js/libs/dragscrollable.js"></script>
  <script src="vendor/MindMap/js/libs/jquery.hotkeys.js"></script>
  <script src="vendor/MindMap/js/libs/jquery.mousewheel.js"></script>
  <script src="vendor/MindMap/js/libs/jquery.minicolors.js"></script>
  <script src="vendor/MindMap/js/libs/jquery.tmpl.js"></script>
  <script src="vendor/MindMap/js/libs/swfobject.js"></script>
  <script src="vendor/MindMap/js/libs/downloadify.min.js"></script>
  <script src="vendor/MindMap/js/libs/events.js"></script>

  <script src="vendor/MindMap/js/MindMaps.js"></script>
  <script src="vendor/MindMap/js/Command.js"></script>
  <script src="vendor/MindMap/js/CommandRegistry.js"></script>
  <script src="vendor/MindMap/js/Action.js"></script>
  <script src="vendor/MindMap/js/Util.js"></script>
  <script src="vendor/MindMap/js/Point.js"></script>
  <script src="vendor/MindMap/js/Document.js"></script>
  <script src="vendor/MindMap/js/MindMap.js"></script>
  <script src="vendor/MindMap/js/Node.js"></script>
  <script src="vendor/MindMap/js/NodeMap.js"></script>
  <script src="vendor/MindMap/js/UndoManager.js"></script>
  <script src="vendor/MindMap/js/UndoController.js"></script>
  <script src="vendor/MindMap/js/ClipboardController.js"></script>
  <script src="vendor/MindMap/js/ZoomController.js"></script>
  <script src="vendor/MindMap/js/ShortcutController.js"></script>
  <script src="vendor/MindMap/js/HelpController.js"></script>
  <script src="vendor/MindMap/js/FloatPanel.js"></script>
  <script src="vendor/MindMap/js/Navigator.js"></script>
  <script src="vendor/MindMap/js/Inspector.js"></script>
  <script src="vendor/MindMap/js/ToolBar.js"></script>
  <script src="vendor/MindMap/js/StatusBar.js"></script>
  <script src="vendor/MindMap/js/CanvasDrawingTools.js"></script>
  <script src="vendor/MindMap/js/CanvasView.js"></script>
  <script src="vendor/MindMap/js/CanvasPresenter.js"></script>
  <script src="vendor/MindMap/js/ApplicationController.js"></script>
  <script src="vendor/MindMap/js/MindMapModel.js"></script>
  <script src="vendor/MindMap/js/NewDocument.js"></script>
  <script src="vendor/MindMap/js/OpenDocument.js"></script>
  <script src="vendor/MindMap/js/SaveDocument.js"></script>
  <script src="vendor/MindMap/js/MainViewController.js"></script>
  <script src="vendor/MindMap/js/Storage.js"></script>
  <script src="vendor/MindMap/js/Event.js"></script>
  <script src="vendor/MindMap/js/Notification.js"></script>
  <script src="vendor/MindMap/js/StaticCanvas.js"></script>
  <script src="vendor/MindMap/js/PrintController.js"></script>
  <script src="vendor/MindMap/js/ExportMap.js"></script>
  <script src="vendor/MindMap/js/AutoSaveController.js"></script>
  <script src="vendor/MindMap/js/FilePicker.js"></script>
  <!-- JS:LIB:END -->

  <!-- PRODUCTION
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push([ '_setAccount', 'UA-23624804-1' ]);
  _gaq.push([ '_trackPageview' ]);
  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl'
        : 'http://www')
        + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();
</script>
/PRODUCTION -->

@stop