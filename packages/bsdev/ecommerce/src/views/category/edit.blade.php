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
                <h1>Update Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update Category</li>
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
                <h3 class="card-title">Create Category</h3>

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
                <form class="row form" method="post" action="{{ route('product.categories.update',$category->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                value="{{ $category->name }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug"
                                value="{{ $category->slug }}">
                        </div>

                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea id="description" class="form-control" name="short_description" rows="5"
                                placeholder="Enter Description">{{ $category->short_description }}</textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" value="{{ $category->position }}" name="position" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon <small>(fontawesome only)</small></label>
                            <input type="text" value="{{ $category->icon }}" name="icon" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="category">Parent</label>
                            <select name="category_id" class="form-control select2">
                                <option value="">Select Parent</option>
                                @foreach(Ecommerce::getCategoryTree() as $cat)
                                <option value="{{ $cat->id }}" {{ ($category->category_id==$cat->id)?'selected':'' }}
                                    {{ ($category->id==$cat->id)?'disabled':'' }}>
                                    {{ $cat->name }}
                                </option>
                                @foreach($cat->categories as $child)
                                <option value="{{ $child->id }}"
                                    {{ ($category->category_id==$child->id)?'selected':'' }}
                                    {{ ($category->id==$child->id)?'disabled':'' }}>
                                    --{{ $child->name }}
                                </option>
                                @foreach($child->categories as $grand)
                                <option value="{{ $grand->id }}"
                                    {{ ($category->category_id==$grand->id)?'selected':'' }}
                                    {{ ($category->id==$grand->id)?'disabled':'' }}>
                                    ----{{ $grand->name }}
                                </option>
                                @endforeach
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input file-input"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <img src="{{ asset('storage/'.$category->image) }}" class="preview img-fluid"
                                    style="max-height: 200px; max-width:auto;">
                            </div>
                        </div>

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">SEO</h3>
                            </div>
                            <div class="card-body">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="met_title" name="meta_title"
                                    placeholder="Enter Meta Title" value="{{ $category->seo['meta_title']??'' }}">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="5"
                                    placeholder="Enter Meta Description">{{ $category->seo['meta_description']??'' }}</textarea>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Show In Home</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="show_in_home" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success"
                                    {{ ($category->show_in_home)?'checked':'' }}>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="status" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success"
                                    {{ ($category->status)?'checked':'' }}>
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
    $('.category-menu').removeClass('menu-is-opening menu-open');
        $('.category-menu').addClass('menu-is-opening menu-open');
        $('.category-menu').find('>:first-child').removeClass('active');
        $('.category-menu').find('>:first-child').addClass('active');
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