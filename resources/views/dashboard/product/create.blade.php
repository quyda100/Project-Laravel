@extends('layouts.dashboard')
@section('content')
<div class="row" style="margin-left: 5em">
    <div class="col-md-4">
    <form id='form-content'>
        @csrf
        <div class="form-group">
            <label class="control-label" for="id">Mã sản phẩm</label>
            <input required class="form-control" type="text" id="id" name="id">
            <span id="errorId" class="text-danger error-msg"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="name">Tên sản phẩm</label>
            <input required class="form-control" type="text" name="name" id="name">
            <span id="errorName" class="text-danger error-msg"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="price">Giá tiền:</label>
            <input required class="form-control" type="number" name="price" id="price">
            <span id="errorPrice" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="stock">Số lượng:</label>
            <input required class="form-control" type="number" name="stock" id="stock">
            <span id="errorStock" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Mô tả</label>
            <input required class="form-control" type="text" name="description" id="description">
            <span id="errorDescription" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="category">Loại</label>
            {{-- <input class="form-control" type="category" name="category" id="category"> --}}
            <select class="form-control" name="category" id="category">
                <option value="1">Jordan</option>
                <option value="2">Running</option>
                <option value="3">Basketball</option>
                <option value="4">Football</option>
            </select>
        </div>
        {{-- <div class="card-body">

                <div class="row">
     
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="image" placeholder="Choose image" id="image">
                        @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                </div>     
        </div> --}}
        <div class="form-group">
            <input class="form-control btn-success" id="submit" type="submit" value="Tạo sản phẩm" >
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        $("#submit").click(function (e) { 
        e.preventDefault();
        var form = $('#form-content').serialize()
        console.log(form);
        $.ajax({
            type: "POST",
            url: "../api/products",
            data: form,
            success: function (data) {
                if(data==1){
                    cuteToast({
                        title: "Thông báo",
                        type: "success",
                        message: "Tạo sản phẩm thành công",
                        timer: 3000,
                    })
                    window.setTimeout(function () {
                        $('#form-content').trigger('reset');
                        window.location.href = "../product";//chuyen huong trang "route" 
                    }, 1000);
                }
                else {
                    cuteToast({
                        title: "Thông báo",
                        type: "error",
                        message: "Tạo sản phẩm không thành công",
                        timer: 3000,
                    });
                }
            },
        });
    });
    </script>
@endsection