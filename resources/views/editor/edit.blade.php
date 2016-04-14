@extends('layouts.main_layout')

@section('head')
    <title>{{$file->projectname}}/{{$file->filename}} | The Squire Project</title>

    <link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.css" />
    <link rel="stylesheet" href="https://www.firepad.io/examples/firepad-userlist.css" />
    <link rel="stylesheet" href="https://demo.firepad.io/demo.css" />
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

    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/javascript/javascript.js"></script>
    <script src="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.2/ace.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.2/mode-java.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.2/theme-textmate.js"></script>
    <script src="https://www.firepad.io/examples/firepad-userlist.js"></script>

    <script>
        function init() {
            var firepadRef = new Firebase('https://radiant-torch-8044.firebaseio.com/{{$file->projectname}}/{{$file->filename}}');
            var codeMirror = CodeMirror(document.getElementById('firepad-container'), {
                lineNumbers: true,
                lineWrapping: true });
            var userId = '{{$userid}}';
            var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror, {
                richTextToolbar: true,
                richTextShortcuts: true,
                userId: userId });
            var firepadUserList = FirepadUserList.fromDiv(firepadRef.child('users'), document.getElementById('userlist'), userId);
            firepad.on('ready', function() {
                if (firepad.isHistoryEmpty()) {
                    firepad.setText('{{$file->contents}}');
                }});
        }
        init();
    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
@stop