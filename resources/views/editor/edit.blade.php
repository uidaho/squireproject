@extends('layouts.main_layout')

@section('head')
    <title>{{$project->title}}/{{$file->filename}} | The Squire Project</title>

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
                    <a href="/project/private/{{ $project->title }}" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-home"></em> Project Home
                    </a>
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
                    <form id="contents-form" action="/editor/compile/{{$file->projectname}}/{{$file->filename}}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="file-contents" id="file-contents" value="asdf">
                        <a type="submit" onclick="submitForm()" class="btn btn-default btn-sm">
                            <em class="glyphicon glyphicon-flash"></em> Compile
                        </a>
                        <a href="#" class="btn btn-default btn-sm">
                            <em class="glyphicon glyphicon-indent-right"></em> Syntax Check
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- EDITOR -->
    <div id="firepad-container">
        <div id="userlist"></div>
        <div id="firepad"></div>
    </div>
    <!-- Chat -->
    <div class="chat-container-right">
        <div id="demo" class="collapse project-chat">
            <ul id='project-messages' class="project-chat-messages"></ul>

            <footer>
                <input type='text' id='messageInput'  placeholder='Type a message...'>
            </footer>
        </div>
        <button class="project-button btn btn-default" data-toggle="collapse" data-target="#demo">Chat <span class="glyphicon glyphicon-comment"></span></button>
    </div>

    <script>
        var userId = '{{ $userid }}';
        var userName = '{{ $username }}';
        var fileId = '{{ $file->id }}';
        var projectId = '{{ $file->project_id }}';
        var firebaseUrl = '{{ env('FIREBASE_URL') }}';
        var firepadRef = new Firebase(firebaseUrl + projectId + '/' + fileId);
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
            }
        });

        function submitForm() {
            if (firepad != null) {
                document.getElementById('file-contents').value = firepad.getText();
            }
            document.getElementById('contents-form').submit()
        }
    </script>

    <script>
<<<<<<< HEAD
        // connect to firebase
        var firebaseUrl = '{{ env('FIREBASE_URL') }}';
        var userName = '{{ $username }}';
        var projectId = '{{ $file->project_id }}';
        var chatRef = new Firebase(firebaseUrl + projectId + '/chat');
        // get DOM elements
        var messageField = $('#messageInput');
        var messageList = $('#project-messages');
        // listen for key event
        messageField.keypress(function (e) {
            if (e.keyCode == 13) {
                var username = userName;
                var message = messageField.val();
                chatRef.push({name:username, text:message});
                messageField.val('');
            }
        });
        // add callback that is triggered for each chat message
        chatRef.limitToLast(10).on('child_added', function (snapshot) {
            // get message data
            var data = snapshot.val();
            var username = data.name || "anonymous";
            var message = data.text;
            // create message elements
            var messageElement = $("<li>");
            var nameElement = $("<strong class='project-chat-username'></strong>")
            nameElement.text(username);
            messageElement.text(message).prepend(nameElement);
            messageList.append(messageElement)
            // scroll to bottom of list
            messageList[0].scrollTop = messageList[0].scrollHeight;
        });
    </script>
@stop
