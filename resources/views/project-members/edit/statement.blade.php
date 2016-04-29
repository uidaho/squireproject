<section class="r-modal-window">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <legend class="r-legend-sub">Edit Side Box</legend>
    <form name="banner-form" class="form-horizontal" action="/project/edit/statement/{{ $project->getSlugFriendlyTitle() }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PATCH') !!}

        <!-- Statement Area -->
        <fieldset class="r-modal-input">

            <label for="statement-title" class="col-lg-2 control-label">Title</label>
            <div class="col-lg-10">
                <input class="form-control" type="text" id="statement-title" name="statement-title" value="{{ old('statement_title') }}">
            </div>

            @if ($errors->has('statement_title'))
                <span class="error-auth">{{ $errors->first('statement_title') }}</span>
            @endif

            <label for="statement-body" class="col-lg-2 control-label">Body Text</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="statement-body" name="statement-body" rows="5">{{old('statement_body')}}</textarea>
            </div>

            @if ($errors->has('statement_body'))
                <span class="error-auth">{{ $errors->first('statement_body') }}</span>
            @endif

        </fieldset>

        <!-- Buttons Area -->
        <fieldset class="r-modal-buttons">

            <button type="submit" class="btn btn-default">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

        </fieldset>
    </form>
</section>