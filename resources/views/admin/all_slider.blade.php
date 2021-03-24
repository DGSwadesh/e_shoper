@extends('admin_layout')
@section('admin_content')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            DataTable Example
        </div>
        <p class="alert-success">
            <?php
            $message = Session::get('message')
            ?>
        @if($message)
        {{ $message }}
        {!! Session::put('message', null) !!}
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Slider Id</th>
                            <th>Slider Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($all_slider_info as $slider)
                        <tbody>
                            <tr>
                                <td>{{ $slider->slider_id }}</td>
                                <td><img src="{{ URL::to($slider->slider_image) }}" style="height: 80px; width: 80px;" alt="prd_image"></td>
                                @if ($slider->publication_status == 1)
                                <td><a href="{{ URL::to('/active_unactive_slider/'.$slider->slider_id.'/'.'1') }}" class="btn btn-success btn-sm">Active</a></td>
                                @else
                                <td><a href="{{ URL::to('/active_unactive_slider/'.$slider->slider_id.'/'.'0') }}" class="btn btn-secondary btn-sm">InActive</a></td>
                                @endif
                                <td>
                               <a href="{{ URL::to('/delete_slider/'.$slider->slider_id) }}" class="btn btn-danger btn-sm" id="delete">delete</a></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
