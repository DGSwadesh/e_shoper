@extends('admin_layout')
@section('admin_content')

<p class="alert-success">
    <?php
    $message = Session::get('message')
    ?>
@if($message)
{{ $message }}
{!! Session::put('message', null) !!}
@endif

</p>
    <form action={{ url('/update_manufacture',$manaufacture_info->manaufacture_id) }} method="post">
        @csrf
        <div class="form-group p-md-5">
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Manufacture Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="colFormLabelLg" placeholder="cat name" name="manaufacture_name" value="{{ $manaufacture_info->manaufacture_name }}">
                </div>
            </div>
            <div class="form-group row ">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label">Manufacture
                    description</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="manaufacture_description">{{ $manaufacture_info->manaufacture_description }}s</textarea>
                </div>
            </div>
            <div class="pl-md-6">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger">Cancel</button>
            </div>

        </div>

    </form>

@endsection
