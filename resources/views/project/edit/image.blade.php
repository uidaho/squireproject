<section class="r-modal-window">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <legend class="r-legend-sub">Import Thumbnail</legend>
    <form name="thumbnail-form" class="form-horizontal" action="/project/edit/image/{{ $project->title }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PATCH') !!}

        <!-- Thumbnail Area -->
        <fieldset class="r-modal-input">

            <input class="form-control" type="file" id="thumbnail" name="thumbnail" value="{{ old('thumbnail') }}}">

            @if ($errors->has('thumbnail'))
                <span class="error-auth">{{ $errors->first('thumbnail') }}</span>
            @endif

        </fieldset>

        <!-- Buttons Area -->
        <fieldset class="r-modal-buttons">

            <button type="submit" class="btn btn-default">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

        </fieldset>
    </form>
</section>
