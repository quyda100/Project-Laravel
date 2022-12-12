@extends('layouts.dashboard')
@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Chi Tiết Hóa Đơn</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hóa Đơn</h6>
            </div>
            
            <div class="card-body">
                <input type="hidden" id="id" value="{{$id}}">
                <div class="table-responsive">
                    {{-- <a href={{route('dashboard.order.orders')}} class="btn btn-success btn-detail" style="margin-bottom: 1em">Chi tiết</a> --}}
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã Hóa Đơn</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng </th>
                                <th>Giá Tiền</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Mã Hóa Đơn</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá Tiền</th>
                            </tr>
                        </tfoot>
                        <tbody id="table-data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
    <!-- Page level custom scripts -->
    @section('scripts')
    <script>
        $('#table-data').html('');
        var aab = $("#id").val();
        $.ajax({
            type: "GET",
            url: "../api/orderdetails/"+aab,
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(response.length > 0){
                    $.each(response, function (indexInArray, value) { 
                         $('#table-data').append(
                            '<tr>'+
                                '<td>'+value.SKU+'</td>'+
                                '<td>'+value.Name+'</td>'+
                                '<td>'+value.quantity+'</td>'+
                                '<td>'+value.Price+'</td>'+
                                // '<td>  <a href ="./orders/edit '+value.id+'" class="btn btn-info btn-detail">Chi Tiết </a></td>'+
                            '</tr>'
                        );
                    });
                }
            }
        });
    </script>

    <script src="{{asset("vendor/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>
    {{-- <script src="{{asset("js/demo/datatables-demo.js")}}"></script> --}}
    @endsection