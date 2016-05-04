<section class="r-modal-window">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <legend class="r-legend-sub">Edit Title</legend>
    <form name="title-form" class="form-horizontal" action="/project/edit/title/{{ $project->title }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PATCH') !!}

        <!-- Title Area -->
        <fieldset class="r-modal-input">

            <label class="col-lg-2 control-label">Title</label>
            <div class="col-lg-10">
                <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" minlength="{{ \App\Project::attributeLengths()['title']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['title']['max'] }}" onkeyup="writeCharCount('title')">
                <p id="title-count"></p>
                @if ($errors->has('title'))
                    <span class="error-auth has-error">{{ $errors->first('title') }}</span>
                @endif
            </div>

        </fieldset>

        <!-- Buttons Area -->
        <fieldset class="r-modal-buttons">

            <button type="submit" class="btn btn-default">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

        </fieldset>
    </form>
</section>