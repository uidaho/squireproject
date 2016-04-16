@extends('layouts.main_layout')

@section('head')
    <title>{{$file->projectname}}/{{$file->filename}} | The Squire Project</title>

    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/javascript/javascript.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/clike/clike.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/firepad.css') }}" />
    <script src="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/firepad-userlist.css') }}" />
    <script src="{{ URL::asset('js/firepad-userlist.js') }}"></script>
@stop

@section('mainBody')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="/editor">Home</a> <span class="divider">/</span>
                </li>
                <li>
                    <a href="/editor/{{$file->projectname}}">{{$file->projectname}}</a> <span class="divider">/</span>
                </li>
                <li class="active">
                    <a href="/editor/{{$file->projectname}}/{{$file->filename}}">{{$file->filename}}</a>
                </li>
            </ul>
            <div class="btn-toolbar" role="toolbar" aria-label="Editor toolbar">
                <div class="btn-group" role="group" aria-label="File button group">
                    <a href="/editor/create/{{$file->projectname}}">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-open-file"></em> Open
                        </button>
                    </a>
                    <a href="/editor/create/{{$file->projectname}}">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-plus"></em> Create
                        </button>
                    </a>
                    <a href="/editor/import/{{$file->projectname}}/{{$file->filename}}">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-import"></em> Import
                        </button>
                    </a>
                    <a href="/editor/export/{{$file->projectname}}/{{$file->filename}}">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-export"></em> Export
                        </button>
                    </a>
                    <a href="/editor/rename/{{$file->projectname}}/{{$file->filename}}">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-edit"></em> Rename
                        </button>
                    </a>
                    <a href="/editor/delete/{{$file->projectname}}/{{$file->filename}}">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-trash"></em> Delete
                        </button>
                    </a>
                </div>
                <div class="btn-group" role="group" aria-label="Compiler button group">
                    <a href="#">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-flash"></em> Compile
                        </button>
                    </a>
                    <a href="#">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-flash"></em> Run
                        </button>
                    </a>
                    <a href="#">
                        <button class="btn btn-default" type="button">
                            <em class="glyphicon glyphicon-indent-right"></em> Syntax Check
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

            <div id="firepad-container">
                <div id="userlist"></div>
                <div id="firepad"></div>
            </div>

    <script>
        function hashCode(str) { // java String#hashCode
            var hash = 0;
            for (var i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
            }
            return hash;
        }
        function intToRGB(i){
            var c = (i & 0x00FFFFFF)
                    .toString(16)
                    .toUpperCase();

            return "00000".substring(0, 6 - c.length) + c;
        }
        function init() {
            var userId = '{{$userid}}';
            var userName = '{{$username}}';
            var fileName = '{{$file->filename}}';
            var fileName = fileName.replace(/[.]/gi, "-");
            var projectName = '{{$file->projectname}}';
            var projectName = projectName.replace(/[.]/gi, "-");
            var firepadRef = new Firebase('https://radiant-torch-8044.firebaseio.com/'+projectName+'/'+fileName);
            var codeMirror = CodeMirror(document.getElementById('firepad-container'), {
                indentUnit: 2,
                smartIndent: true,
                tabSize: 4,
                readOnly: false,
                lineNumbers: true,
                lineWrapping: true,
                mode: 'text/x-java'});
            var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror, {
                userId: userId});
            var firepadUserList = FirepadUserList.fromDiv(firepadRef.child('users'), document.getElementById('userlist'), userId, userName);
            firepad.on('ready', function() {
                if (firepad.isHistoryEmpty()) {
                    firepad.setText('{{$file->contents}}');
                }});
        }
        init();
    </script>
@stop