@extends('admin_layout')
@section('admin_content')

    {{-- <ul ">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Category</a>

    </li>
</ul> --}}

<p class="alert-success">
    <?php
    $message = Session::get('message')
    ?>
@if($message)
{{ $message }}
{!! Session::put('message', null) !!}
@endif

</p>
    <form action={{ url('/saveSlider') }} method="post">
        @csrf

        <div class="form-group row ">
            <label for="colFormLabelLg" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="colFormLabelLg" name="slider_image">
            </div>
        </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Publication
                    Status</label>
                <div class="col-sm-6 pt-md-2">
                    <input type="checkbox" aria-label="Checkbox for following text input" value="1" name="publication_status">
                </div>
            </div>
            <div class="pl-md-6">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger">Cancel</button>
            </div>

        </div>

    </form>

@endsection
