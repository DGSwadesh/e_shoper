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
    <form action={{ url('/saveCategory') }} method="post">
        @csrf
        <div class="form-group p-md-5">
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="colFormLabelLg" placeholder="cat name" name="category_name" required>
                </div>
            </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Category
                    description</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="category_description" required></textarea>
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
