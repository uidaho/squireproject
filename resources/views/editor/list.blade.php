@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }} Project Files | The Squire Project</title>
    
    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
    <script src="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.min.js"></script>
@endsection

@section('mainBody')
@include('inserts.breadcrumb')
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div id="compilation-message-banner" class="alert alert-info alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p id="compilation-message"></p>
        </div>
    </div>
    <div class="col-md-12">
        <!-- Toolbar -->
        <div class="btn-toolbar" role="toolbar" aria-label="File list toolbar">
            <div class="btn-group r-dual-buttons" role="group" aria-label="File command group">
                <a href="/project/private/{{ $project->title }}" class="btn btn-default btn-sm">
                    <em class="glyphicon glyphicon-home"></em> Project Home
                </a>
                <a href="/editor/create/{{ $project->title }}" class="btn btn-default btn-sm">
                    <em class="glyphicon glyphicon-plus"></em> Create
                </a>
                <a onclick="compileProject()">
                    <button id="compile-button" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-flash"></em> Compile
                    </button>
                </a>

                <a id="download-link">
                    <button id="download-compilation" class="btn btn-default btn-sm">
                        <em class="glyphicon glyphicon-download"></em> Download
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <section class="col-md-12">
        <!-- Files -->
        @include('editor.filelist')
    </section>
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
    $('#download-compilation').prop('disabled', true);
    var compilationMessageBanner = $('#compilation-message-banner');
    var compilationMessage = $('#compilation-message');
    compilationMessageBanner.hide();


    // connect to firebase
    var firebaseUrl = '{{ env('FIREBASE_URL') }}';
    var userName = '{{ Auth::user()->username }}';
    var projectId = '{{ $project->id }}';
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

    function displayCompilationMessage(message) {
        compilationMessage.text(message);
        compilationMessageBanner.show();
    }

    function compileProject() {
        $('#compile-button').prop('disabled', true);
        var downloadButton = $('#download-compilation');
        downloadButton.prop('disabled', true);

        $.get('/editor/compile/{{ $files[0]->projectname }}', function (data, status) {
            console.log(data);
            var result = JSON.parse(data);
            if (result.status == 'failed') {
                if (result.redirect) {
                    window.location.href = result.redirect;
                }
            } else {
                displayCompilationMessage('Successfully compiled.');
                $('#download-link').attr('href', result.downloadUrl);
                downloadButton.prop('disabled', false);
            }

            $('#compile-button').prop('disabled', false);
        });
    }
</script>
@stop