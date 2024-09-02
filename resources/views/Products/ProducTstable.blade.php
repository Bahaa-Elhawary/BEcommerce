

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>





@extends('Layouts.master')

@section('content')


    <div class="container mt-5 mb-5">

        <div class="text-right">
            <a href="/addproduct" class="cart-btn bg-primary mt-3 mb-3 mr-5">
                <i class="fas fa-plus"></i>
                إضافة منتج
            </a>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>image</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td>{{$item -> id}}</td>
                        <td>{{$item -> name}}</td>
                        <td>{{$item -> price}}</td>
                        <td>{{$item -> quantity}}</td>
                        <td>
                            <img src='{{$item -> imagepath}}' width="100" height="100" >
                        </td>
                        <td>
                            <a href="/removeproduct/{{$item ->id}}" class="cart-btn bg-danger mb-1">
                                <i class="fas fa-trash"></i>
                                حذف المنتج
                            </a>

                            <a href="/editproduct/{{$item ->id}}" class="cart-btn bg-success">
                                <i class="fas fa-pen"></i>
                                تعديل المنتج
                            </a>


                            <a href="/AddProductImages/{{$item ->id}}" class="cart-btn bg-default">
                                <i class="fas fa-image"></i>
                                إضافة صور المنتج
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection



<script>
    $(document).ready( function () {
        let table = new DataTable('#myTable');
        } );
</script>
