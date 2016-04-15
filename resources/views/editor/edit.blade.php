@extends('layouts.main_layout')

@section('head')
    <title>{{$file->projectname}}/{{$file->filename}} | The Squire Project</title>

    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/javascript/javascript.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/clike/clike.js"></script>
    <link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.css" />
    <script src="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.min.js"></script>
    <link rel="stylesheet" href="https://www.firepad.io/examples/firepad-userlist.css" />
    <script src="/js/firepad-userlist.js"></script>
@stop

@section('mainBody')
    <main class="container editor">
        <div class="row">
            <div class="project-page-elements">
                <a href="/editor/create/{{$file->projectname}}">
                    <button type="button" id="delete">Create</button>
                </a>
                <a href="/editor/rename/{{$file->projectname}}/{{$file->filename}}">
                    <button type="button" id="delete">Rename</button>
                </a>
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