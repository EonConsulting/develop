@extends('layouts.lecturer')

@section('site-title')
    Storyline Builder
@endsection

@section('custom-styles')

@endsection

@section('body-class')

@endsection

@section('mini-logo-title')
    Unisa
@endsection

@section('logo-title')
    Unisa
@endsection

@section('page-title')
    Storyline Builder
@endsection

@section('content')
    <div class="col-md-12">
        @if (session('error_message'))
            <div class="alert alert-danger">
                {{ session('error_message') }}
            </div>
        @endif

        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        @if($errors->count() > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <div class="row">
            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"/>
            <div class="container"  id="root">
                <div class="col-xs-6 col-md-4">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                   aria-expanded="true" aria-controls="collapseOne">
                                    <p class="panel-title">Create Content</p>
                                </a>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="menu-name-label howto open-label" for="menu-name">
                                            <span>Storyline</span></label>

                                        {{--<input type="text" class="form-control input-sm" placeholder="Content Title" id="searchField"><br />--}}
                                        <input id="contentCreator" type="submit" class="btn btn-primary btn-sm" value="Add to Content"></div>
                                    </p>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="major-publishing-actions">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label class="menu-name-label howto open-label" for="menu-name">
                                            <span>Storyline</span>
                                            <input name="menu-name" id="menu-name" type="text" class="form-control input-sm"
                                                   title="Enter menu name here" value="{{ $course->title }}" disabled>
                                        </label>
                                        <input type="submit" name="save_menu" id="save_menu_header"
                                               class="btn btn-primary btn-sm" value="Save Storyline"></div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h5>Storyline Structure: <span style="color:#666; font-size:12px; font-style: italic">Drag any item into the Order Preferred, Toggle the Collapse on the Left for More Options</span></h5>
                            <hr />
                            <section>
                                <ol id="component" class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded">

                                </ol>
                                <h3>Try the custom methods:</h3>

                                <p><br>
                                    <input id="serialize" name="serialize" type="submit" value=
                                    "Serialize"></p>
                                <pre id="serializeOutput">
		</pre>

                                <p><input id="toArray" name="toArray" type="submit" value=
                                    "To array"></p>
                                <pre id="toArrayOutput">
		</pre>

                                <p><input id="toHierarchy" name="toHierarchy" type="submit" value=
                                    "To hierarchy"></p>
                                <pre id="toHierarchyOutput">
		</pre>


                            </section>
                        </div>
                        <div class="panel-heading">
                            <form class="form-inline">
                                <div class="form-group">
                                    <input type="submit" name="save_menu" id="save_menu_header"
                                           class="btn btn-primary btn-sm" value="Save Storyline">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('app-js')
    {{--<script src="https://unpkg.com/vue"></script>--}}
    {{--<script src="{{url('/js/storyline_vue.js') }}"></script>--}}
    {{--<script src="{{url('//js/app.js') }}"></script>--}}
@endsection

@section('custom-scripts')
    <script>



        $().ready(function(){

            var ns = $('ol.sortable').nestedSortable({
                forcePlaceholderSize: true,
                handle: 'div',
                helper:	'clone',
                items: 'li',
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                tolerance: 'pointer',
                toleranceElement: '> div',
                maxLevels: 6,
                isTree: true,
                expandOnHover: 700,
                startCollapsed: true,
                excludeRoot: true
            });

            $('.expandEditor').attr('title','Click to show/hide item editor');
            $('.disclose').attr('title','Click to show/hide children');
            $('.deleteMenu').attr('title', 'Click to delete item.');

            $('.disclose').on('click', function() {
                $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
                $(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
            });

            $('.expandEditor, .itemTitle').click(function(){
                var id = $(this).attr('data-id');
                $('#menuEdit'+id).toggle();
                $(this).toggleClass('ui-icon-triangle-1-n').toggleClass('ui-icon-triangle-1-s');
            });

            $('.deleteMenu').click(function(){
                var id = $(this).attr('data-id');
                $('#menuItem_'+id).remove();
            });

            $('#serialize').click(function(){
                serialized = $('ol.sortable').nestedSortable('serialize');
                $('#serializeOutput').text(serialized+'\n\n');
            });

            $('#toHierarchy').click(function(e){
                hiered = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});
                hiered = dump(hiered);
                (typeof($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
                        $('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;
            });

            $('#toArray').click(function(e){
                arraied = $('ol.sortable').nestedSortable('toArray', {
                    startDepthCount: 0
                });
                arraied = dump(arraied);
                (typeof($('#toArrayOutput')[0].textContent) != 'undefined') ?
                        $('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
            });

            $('#contentCreator').click(function(){
                var id = new Date().getTime();
                $('ol.sortable').append('<li class="app-contents" id="item-' + id + '"><span data-id="' + id + '" class="itemTitle">' +
                        '</span><div class="bind-item" data-id="' + id +'"><input name="file-url-concat" type="text" size="20" id="file_url2" /><input type="text" class="form-control input-sm" placeholder="Content Title" id="namefield-'+ id + '"><button onclick="openPopup()" id="CKFinderPopup" class="btn CKFinderPopup btn-default btn-xs">Select file</button></div></li>');
                $('ol.sortable').nestedSortable('refresh');
            });

            $('#savestoryline').click(function(){

            })

        });

        function openPopup() {
            CKFinder.popup( {
                chooseFiles: true,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        document.getElementById( 'file_url2').value = file.getUrl();
//                        console.log('Id for Attr:' + id);
                    } );
                }
            } );

        };

        function dump(arr,level) {
            var dumped_text = "";
            if(!level) level = 0;

            //The padding given at the beginning of the line.
            var level_padding = "";
            for(var j=0;j<level+1;j++) level_padding += "    ";

            if(typeof(arr) == 'object') { //Array/Hashes/Objects
                for(var item in arr) {
                    var value = arr[item];

                    if(typeof(value) == 'object') { //If it is an array,
                        dumped_text += level_padding + "'" + item + "' ...\n";
                        dumped_text += dump(value,level+1);
                    } else {
                        dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
                    }
                }
            } else { //Strings/Chars/Numbers etc.
                dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
            }
            return dumped_text;
        }
    </script>

    <script>

//        function openPopup() {

        }
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
<script src="{{url('/js/ng.js')}}"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
    <script src="{{url('/dist/js/jquery.mjs.nestedSortable.js')}}"></script>
    <script src="{{url('/vendor/filemanager/lib/ckfinder/ckfinder.js') }}"></script>
@endsection