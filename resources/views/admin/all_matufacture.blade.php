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
                            <th>Manufacture Id</th>
                            <th>Manufacture Name</th>
                            <th>Manufacture Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($all_manaufacture_info as $v_manaufacture)
                        <tbody>
                            <tr>
                                <td>{{ $v_manaufacture->manaufacture_id }}</td>
                                <td>{{ $v_manaufacture->manaufacture_name }}</td>
                                <td>{{ $v_manaufacture->manaufacture_description }}</td>

                                @if ($v_manaufacture->publication_status == 1)
                                <td><a href="{{ URL::to('/active_unactive_manufacture/'.$v_manaufacture->manaufacture_id.'/'.'1') }}" class="btn btn-success btn-sm">Active</a></td>
                                @else
                                <td><a href="{{ URL::to('/active_unactive_manufacture/'.$v_manaufacture->manaufacture_id.'/'.'0') }}" class="btn btn-secondary btn-sm">InActive</a></td>
                                @endif

                                <td><a href="{{ URL::to('/edit_manufacture/'.$v_manaufacture->manaufacture_id) }}" class="btn btn-primary btn-sm">edit</a>
                               <a href="{{ URL::to('/delete_manufacture/'.$v_manaufacture->manaufacture_id) }}" class="btn btn-danger btn-sm" id="delete">delete</a></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
