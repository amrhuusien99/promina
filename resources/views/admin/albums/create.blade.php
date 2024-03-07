@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Albums</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <h1 class="page-header">Add New Album</h1>
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/albums/index')}}/0/{{PAGINATION_COUNT}}">Albums</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            @include('flash::message')
            <div class="panel tabbed-panel panel-info">
                @if ($errors->any())
                    <div style="text-align: left; margin: 15px;">
                        <ul dir="ltr">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-heading clearfix">
                    <div class="panel-title pull-left">Albums Form</div>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{url(route('admin/albums/create'))}}" method="post" enctype="multipart/form-data">
                        <div class="tab-content">
                            @csrf
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <input name="name" type="text" class="form-control" placeholder="Album Name" value="{{old('name')}}">
                                <!-- @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror -->
                            </div>
                            <div class="form-group input-group">
                                <button type="button" onclick="addImage(this.form)" class="btn btn-info">Add Image</button>
                            </div>
                            <div class="imageComponentsArea">
                                <div class="col-xs-12 imageComponentArea-1">
                                    <div class="col-xs-8 image-component-area">
                                        <div class="col-xs-5">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" style="color: black;">Img</span>
                                                <span class="input-group-addon" style="color: red;">*</span>
                                                <input name="images[0][image]" type="file" class="form-control" placeholder="Upload Image">
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="form-group input-group">
                                                <span class="input-group-addon" style="color: red;"></span>
                                                <input name="images[0][name]" type="text" class="form-control" placeholder="Image Name">
                                            </div>
                                        </div>
                                        <div class="col-xs-2">
                                            <button type="button" onclick="removeImage('.imageComponentArea-1')" class="btn btn-danger">-</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Submit Button</button>
                            <button type="reset" class="btn btn-primary">Reset Button</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- custom js -->
@section('script')
<script>
    var rowNo = 2;
    function addImage(params) {
        row = `
            <div class="col-xs-12 imageComponentArea-${rowNo}">
                <div class="col-xs-8 variable-component-area">
                    <div class="col-xs-5">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="color: black;">Img</span>
                            <span class="input-group-addon" style="color: red;">*</span>
                            <input name="images[${rowNo}][image]" type="file" class="form-control" placeholder="Upload Image">
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="color: red;"></span>
                            <input name="images[${rowNo}][name]" type="text" class="form-control" placeholder="Image Name">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" onclick="removeImage('.imageComponentArea-${rowNo}')" class="btn btn-danger">-</button>
                    </div>
                </div>
            </div>
        `;
        $('.imageComponentsArea').append(row);
        rowNo++;
    }
    function removeImage(record) {
        $(record).remove();
    }
</script>
@endsection
