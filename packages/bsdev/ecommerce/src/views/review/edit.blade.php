@extends('theme::layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/dropzone/min/dropzone.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Review</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update Review</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Review</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>


            <!-- /.card-header -->
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="font-size: smaller;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="row form" method="post" action="{{ route('productreviews.update',$productReview->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                value="{{ $productReview->name }}">
                        </div>
                        <div class="form-group">
                            <label for="rate">Rate</label>
                            <input type="text" class="form-control" id="rate" name="rate" placeholder="Enter Rate"
                                value="{{ $productReview->rate }}">
                        </div>

                        <div class="form-group">
                            <label>Review</label>
                            <textarea class="form-control" name="review" rows="5"
                                placeholder="Enter Review">{{ $productReview->review }}</textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="productReview">Product</label>
                            <select name="product_id" class="form-control select2" disabled>
                                <option value="">Select Product</option>
                                @foreach(Ecommerce::getProducts() as $product)
                                @if($product->id!=$productReview->id)
                                <option value="{{ $product->id }}"
                                    {{ ($productReview->product_id==$product->id)?'selected':'' }}>
                                    {{ $product->title }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="status" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success"
                                    {{ ($productReview->status)?'checked':'' }}>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-danger float-right" onclick="$('.form')[0].reset()">Reset</a>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </form>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@push('js')
<script src="{{ asset('theme') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="{{ asset('theme') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="{{ asset('theme') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $('.product-menu').removeClass('menu-is-opening menu-open');
        $('.product-menu').addClass('menu-is-opening menu-open');
        $('.product-menu').find('>:first-child').removeClass('active');
        $('.product-menu').find('>:first-child').addClass('active');
    $(function(){
        $('.select2').select2({
        theme: 'bootstrap4'
        })
        $('#description').summernote({
            height:"300px"
        });
        $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        bsCustomFileInput.init();
        $('.file-input').change(function(){
        var file = $(this).get(0).files[0];
        
        if(file){
        var reader = new FileReader();
        
        reader.onload = function(){
        $(".preview").attr("src", reader.result);
        }
        
        reader.readAsDataURL(file);
        }
        else {
            $(".preview").attr("src",'');
        }
        });
    });
</script>
@endpush