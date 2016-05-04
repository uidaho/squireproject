<section class="r-modal-window">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <legend class="r-legend-sub">Edit Body</legend>
    <form name="project-body-form" class="form-horizontal" action="/project/edit/body/{{ $project->title }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PATCH') !!}

        <!-- Body Area -->
        <fieldset class="r-modal-input">

            <label class="col-lg-2 control-label">Body Text</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="project-body" name="project-body" rows="10" minlength="{{ \App\Project::attributeLengths()['project-body']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['project-body']['max'] }}" onkeyup="writeCharCount('project-body')">{{old('project-body')}}</textarea>
                <p id="project-body-count"></p>
                @if ($errors->has('project-body'))
                    <span class="error-auth has-error">{{ $errors->first('project-body') }}</span>
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