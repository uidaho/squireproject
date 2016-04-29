<section class="r-modal-window">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <legend class="r-legend-sub">Edit Tab</legend>
    <form name="banner-form" class="form-horizontal" action="/project/edit/customtab/{{ $project->getSlugFriendlyTitle() }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PATCH') !!}

        <!-- Tab Area -->
        <fieldset class="r-modal-input">

            <label for="tab-title" class="col-lg-2 control-label">Title</label>
            <div class="col-lg-10">
                <input class="form-control" type="text" id="tab-title" name="tab-title" value="{{ old('tab_title') }}">
            </div>

            @if ($errors->has('tab_title'))
                <span class="error-auth">{{ $errors->first('tab_title') }}</span>
            @endif

            <label for="tab-body" class="col-lg-2 control-label">Body Text</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="tab-body" name="tab-body" rows="10">{{old('tab_body')}}</textarea>
            </div>

            @if ($errors->has('tab_body'))
                <span class="error-auth">{{ $errors->first('tab_body') }}</span>
            @endif

        </fieldset>

        <!-- Buttons Area -->
        <fieldset class="r-modal-buttons">

            <button type="submit" class="btn btn-default">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

        </fieldset>
    </form>
</section>