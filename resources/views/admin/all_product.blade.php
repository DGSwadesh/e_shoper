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
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Product Image</th>
                            <th>Product Price</th>
                            <th>Category Name</th>
                            <th>Manaufacture Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($all_product_info as $product)
                        <tbody>
                            <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_short_description }}</td>
                                <td><img src="{{ URL::to($product->product_image) }}" style="height: 80px; width: 80px;" alt="prd_image"></td>
                                <td class="center">{{ $product->product_price }}</td>
                                <td class="center">{{ $product->category_name }}</td>
                                <td class="center">{{ $product->manaufacture_name }}</td>

                                @if ($product->publication_status == 1)
                                <td><a href="{{ URL::to('/active_unactive_product/'.$product->product_id.'/'.'1') }}" class="btn btn-success btn-sm">Active</a></td>
                                @else
                                <td><a href="{{ URL::to('/active_unactive_product/'.$product->product_id.'/'.'0') }}" class="btn btn-secondary btn-sm">InActive</a></td>
                                @endif

                                <td><a href="{{ URL::to('/edit_product/'.$product->product_id) }}" class="btn btn-primary btn-sm">edit</a>
                               <a href="{{ URL::to('/delete_product/'.$product->product_id) }}" class="btn btn-danger btn-sm" id="delete">delete</a></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
