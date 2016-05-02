@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }} Project Files | The Squire Project</title>
    
    <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>
@endsection

@section('mainBody')
@include('inserts.breadcrumb')
<div class="row">
    <div class="col-md-12">
        <!-- Search -->
        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <!-- Toolbar -->
        <div class="btn-toolbar" role="toolbar" aria-label="File list toolbar">
            <div class="btn-group" role="group" aria-label="File command group">
                <a href="/editor/create/{{ $project->title }}" class="btn btn-default btn-sm">
                    <em class="glyphicon glyphicon-plus"></em> Create
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">


    <section class="col-md-8">
        <!-- Files -->
        @include('editor.filelist')
    </section>
</div>

<div class="project-chat">
    <ul id='project-messages' class="project-chat-messages"></ul>
    
    <footer>
    <input type='text' id='messageInput'  placeholder='Type a message...'>
    </footer>
</div>
    
<script>
    // connect to firebase
    var firebaseUrl = '{{ env('FIREBASE_URL') }}';
    var userName = '{{ $username }}';
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
</script>
@stop