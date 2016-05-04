<table class="table table-striped table-hover">
    <thead>
        <tr>
          <th>File Name</th>
          <th>Description</th>
          <th>Creator</th>wq
          <th>Created at</th>
          <th>Updated at</th>
          <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($files as $file)
            <tr>
                <td><a href="/editor/edit/{{ $file->projectname }}/{{ $file->filename }}">{{ $file->filename }}</a></td>
                <td>{{ $file->description }}</td>
                <td><a href="/profile/view/{{ $file->user_id }}">{{ $file->author()->first()->username }}</a></td>
                <td>{{ $file->created_at }}</td>
                <td>{{ $file->updated_at }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="File action button group">
                        @if($file->user_id == $userid)
                            <a href="/editor/delete/{{ $file->projectname }}/{{ $file->filename }}" class="btn btn-default btn-sm">
                                <em class="glyphicon glyphicon-trash"></em> Delete
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
