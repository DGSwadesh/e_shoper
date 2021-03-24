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
        <?php $message = Session::get('message'); ?>
        @if ($message)
            {{ $message }}
            {!! Session::put('message', null) !!}
        @endif

    </p>
    <form action={{ url('/saveProduct') }} method="POST" enctype ="multipart/form-data">
        @csrf
        <div class="form-group p-md-5">
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="colFormLabelLg" placeholder="product name" name="product_name"
                        required>
                </div>
            </div>
            <div class="form-group ml-md-6">
            <select class="form-select " name="category_id" aria-label="Default select example">
                <option selected>Product Category</option>
                <?php
                $all_published_category = DB::table('tbl_category')
                ->where('publication_status',1)
                ->get();
                ?>
                @foreach ($all_published_category as $v_category)
                <option value={{ $v_category->category_id }}>{{ $v_category->category_name }}</option>
                @endforeach
            </select>
        </div>
            <div class="form-group ml-md-6">
            <select class="form-select " name="manufacture_id"  aria-label="Default select example">
                <option selected>Manufacture Name</option>
                <?php
                $all_published_manaufacture = DB::table('tbl_manaufacture')
                ->where('publication_status',1)
                ->get();
                ?>
                @foreach ($all_published_manaufacture as $v_manaufacture)
                <option value={{ $v_manaufacture->manaufacture_id }}>{{ $v_manaufacture->manaufacture_name }}</option>
                @endforeach
            </select>
        </div>

            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Product Short Description
                    </label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="product_short_description"
                        required></textarea>
                </div>
            </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Product
                    Long Description</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="product_long_description"
                        required></textarea>
                </div>
            </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Product Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="colFormLabelLg" name="product_price"
                        required>
                </div>
            </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Product Color</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="colFormLabelLg"  name="product_color"
                        required>
                </div>
            </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Product Size</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="colFormLabelLg"  name="product_size"
                        required>
                </div>
            </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" id="colFormLabelLg" name="product_image">
                </div>
            </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Publication
                    Status</label>
                <div class="col-sm-6 pt-md-2">
                    <input type="checkbox" aria-label="Checkbox for following text input" value="1"
                        name="publication_status">
                </div>
            </div>
            <div class="pl-md-6">
                <button type="submit" class="btn btn-success">Add Product</button>
                <button type="button" class="btn btn-danger">Cancel</button>
            </div>

        </div>

    </form>

@endsection
