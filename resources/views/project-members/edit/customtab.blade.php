<section class="r-modal-window">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <legend class="r-legend-sub">Edit Tab</legend>
    <form name="banner-form" class="form-horizontal" action="/project/edit/customtab/{{ $project->getSlugFriendlyTitle() }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PATCH') !!}

        <!-- Tab Area -->
        <fieldset class="r-modal-input">

            <label class="col-lg-2 control-label">Title</label>
            <div class="col-lg-10">
                <input class="form-control" type="text" id="tab-title" name="tab-title" value="{{ old('tab-title') }}" minlength="{{ \App\ProjectMember::attributeLengths()['tab-title']['min'] }}" maxlength="{{ \App\ProjectMember::attributeLengths()['tab-title']['max'] }}" onkeyup="writeCharCount('tab-title')">
                <p id="tab-title-count"></p>
                @if ($errors->has('tab-title'))
                    <span class="error-auth has-error">{{ $errors->first('tab-title') }}</span>
                @endif
            </div>

            <label class="col-lg-2 control-label">Body Text</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="tab-body" name="tab-body" rows="10" minlength="{{ \App\ProjectMember::attributeLengths()['tab-body']['min'] }}" maxlength="{{ \App\ProjectMember::attributeLengths()['tab-body']['max'] }}" onkeyup="writeCharCount('tab-body')">{{old('tab-body')}}</textarea>
                <p id="tab-body-count"></p>
                @if ($errors->has('tab-body'))
                    <span class="error-auth has-error">{{ $errors->first('tab-body') }}</span>
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