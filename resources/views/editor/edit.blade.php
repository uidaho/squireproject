@extends('layouts.main_layout')

@section('head')
    <title>{{$file->projectname}}/{{$file->filename}} | The Squire Project</title>

    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/clike/clike.js"></script>
    <link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.css" />
    <script src="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.min.js"></script>
    <link rel="stylesheet" href="https://www.firepad.io/examples/firepad-userlist.css" />
    <script src="https://www.firepad.io/examples/firepad-userlist.js"></script>
@stop

@section('mainBody')
    <main class="container editor">
        <div class="row">
            <div class="project-page-elements">
                <a href="/editor/create/{{$file->projectname}}">
                    <button type="button" id="delete">Create</button>
                </a>
            </div>
            <div class="project-page-elements">
                <a href="/editor/rename/{{$file->projectname}}/{{$file->filename}}">
                    <button type="button" id="delete">Rename</button>
                </a>
            </div>
            <div class="project-page-elements">
                <a href="/editor/delete/{{$file->projectname}}/{{$file->filename}}">
                    <button type="button" id="delete">Delete</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div id="firepad-container">
                <div id="userlist"></div>
                <div id="firepad"></div>
            </div>
        </div>
    </main>

    <script>
        function init() {
            var userId = '{{$userid}}';
            var firepadRef = new Firebase('https://radiant-torch-8044.firebaseio.com/{{$file->projectname}}/{{$file->filename}}');
            var codeMirror = CodeMirror(document.getElementById('firepad-container'), {
                lineNumbers: true,
                lineWrapping: true,
                mode: 'clike'});
            var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror, {
                userId: userId,
                userColor: '#333'});
            var firepadUserList = FirepadUserList.fromDiv(firepadRef.child('users'), document.getElementById('userlist'), userId);
            firepad.on('ready', function() {
                if (firepad.isHistoryEmpty()) {
                    firepad.setText('{{$file->contents}}');
                }});
        }
        init();
    </script>
@stop