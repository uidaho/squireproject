@extends('layouts.main_layout')

@section('head')
    <title>{{$file->projectname}}/{{$file->filename}} | The Squire Project</title>

    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/javascript/javascript.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/clike/clike.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/firepad.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/base16-light.css') }}" />
    <script src="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/firepad-userlist.css') }}" />
    <script src="{{ URL::asset('js/firepad-userlist.js') }}"></script>
@stop

@section('mainBody')
    @include('inserts.breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <div class="btn-toolbar" role="toolbar" aria-label="Editor toolbar">
                <div class="btn-group" role="group" aria-label="File button group">
                    <a href="/editor/list/{{$file->projectname}}" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-open-file"></em> Open
                    </a>
                    <a href="/editor/create/{{$file->projectname}}" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-plus"></em> Create
                    </a>
                    <a href="/editor/import/{{$file->projectname}}/{{$file->filename}}" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-import"></em> Import
                    </a>
                    <a href="/editor/export/{{$file->projectname}}/{{$file->filename}}" class="btn btn-default btn-sm">
                            <em class="glyphicon glyphicon-export"></em> Export
                    </a>
                    <a href="/editor/rename/{{$file->projectname}}/{{$file->filename}}" class="btn btn-default btn-sm">
                            <em class="glyphicon glyphicon-edit"></em> Rename
                    </a>
                    <a href="/editor/delete/{{$file->projectname}}/{{$file->filename}}" class="btn btn-default btn-sm">
                            <em class="glyphicon glyphicon-trash"></em> Delete
                    </a>
                </div>
                <div class="btn-group" role="group" aria-label="Compiler button group">
                    <a href="#" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-flash"></em> Compile
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-flash"></em> Run
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-indent-right"></em> Syntax Check
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- EDITOR -->
    <div id="firepad-container">
        <div id="userlist"></div>
        <div id="firepad"></div>
    </div>

    <script>
        function init() {
            var userId = '{{ $userid }}';
            var userName = '{{ $username }}';
            var fileId = '{{ $file->id }}';
            var projectId = '{{ $file->project_id }}';
            var firepadRef = new Firebase('https://radiant-torch-8044.firebaseio.com/' + projectId + '/' + fileId);
            var codeMirror = CodeMirror(document.getElementById('firepad-container'), {
                indentUnit: 2,
                smartIndent: true,
                tabSize: 4,
                readOnly: false,
                lineNumbers: true,
                lineWrapping: true,
                theme: 'base16-light',
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