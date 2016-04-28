<section class="r-modal-window">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <legend class="r-legend-sub">Import Banner <small>Recommended size: 1920x550</small></legend>
    <form name="banner-form" class="form-horizontal" action="/project/edit/banner/{{ $project->getSlugFriendlyTitle() }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <!-- Banner Area -->
        <fieldset class="r-modal-input">

            <input class="form-control" type="file" id="banner" name="banner" value="{{ old('banner') }}}">

            @if ($errors->has('banner'))
                <span class="error-auth">{{ $errors->first('banner') }}</span>
            @endif

        </fieldset>

        <!-- Buttons Area -->
        <fieldset class="r-modal-buttons">

            <button type="submit" class="btn btn-default">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

        </fieldset>
    </form>
</section>
