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
                <h1>Create Post</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Create Post</li>
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
                <h3 class="card-title">Create Post</h3>

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
                <form class="row form" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug"
                                value="{{ old('slug') }}">
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea class="form-control" name="short_description" rows="5"
                                placeholder="Enter Short Description">{{ old('short_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="description" class="form-control" name="description" rows="5"
                                placeholder="Enter Description">{{ old('description') }}</textarea>
                        </div>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Gallery <small><em>Supported Files
                                            jpg,png,gif,jpeg,webp</em></small></h3>
                            </div>
                            <div class="card-body">
                                <div id="dropzone" class="dropzone" style="border:2px dotted black; min-height:100px;">

                                    <div class="fallback">
                                        <input name="file" type="file" accept="image/*" multiple />
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="post_id">Parent Post</label>
                            <select class="form-control select2" name="post_id" id="post_id">
                                <option value="">Choose Post</option>
                                @foreach(Post::getParentPost() as $post)
                                <option value="{{ $post->id }}" {{ ($post->id==old('post_id'))?'selected':'' }}>
                                    {{ $post->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type</label>
                            <select class="form-control select2 type_id" name="type_id" id="type_id">
                                <option value="">Choose Type</option>
                                @foreach(Post::getTypes() as $type)
                                <option value="{{ $type->id }}" {{ ($type->id==old('type_id'))?'selected':'' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select class="form-control select2" name="categories[]" id="categories"
                                multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" class="form-control" id="position" name="position"
                                placeholder="Enter position" value="{{ old('position') }}">
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon <small>(fontawesome only)</small></label>
                            <input type="text" class="form-control" id="icon" name="icon"
                                placeholder="Enter icon code" value="{{ old('icon') }}">
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
                                <img src="" class="preview img-fluid" style="max-height: 200px; max-width:auto;">
                            </div>
                        </div>

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">SEO</h3>
                            </div>
                            <div class="card-body">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="met_title" name="meta_title"
                                    placeholder="Enter Meta Title" value="{{ old('meta_title') }}">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="5"
                                    placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="status" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success" {{ (old('status'))?'checked':'' }}>
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
<script src="{{ asset('theme') }}/plugins/dropzone/min/dropzone.min.js"></script>
<script src="{{ asset('theme') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $('.post-menu').removeClass('menu-is-opening menu-open');
        $('.post-menu').addClass('menu-is-opening menu-open');
        $('.post-menu').find('>:first-child').removeClass('active');
        $('.post-menu').find('>:first-child').addClass('active');
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
    Dropzone.autoDiscover = false
    
    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
   var myDropzone = new Dropzone('#dropzone',{
    
    uploadMultiple: false,
    parallelUploads: 100,
    maxFilesize: 8,
    maxFiles: 10,
    maxFilesize: 1,
    createImageThumbnails: true,
    url: "{{ route('posts.image') }}",
    acceptedFiles: "image/jpeg,image/png,image/gif,video/*",
    dictFileTooBig: 'Image is bigger than 8MB',
    headers: {
    'X-CSRF-TOKEN': "{{ csrf_token() }}",
    },
    
    // The setting up of the dropzone
    init: function () {
    
    this.on("sending", function(file,xhr,formData) {
    //alert("Added file."+$('.postid').val());
    // formData.append("product_id",$('#product_id').val());
    });
    this.on("success", function(file,xhr,formData) {
    $('.form').append('<input type="hidden" name="gallery[]" value='+xhr+'>');
    });
    
    },
    error: function (file, response) {
    
    if ($.type(response) === "string")
    var message = response; //dropzone sends it's own error messages in string
    else
    var message = response.message;
    file.previewElement.classList.add("dz-error");
    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
    _results = [];
    for (_i = 0, _len = _ref.length; _i < _len; _i++) { node=_ref[_i]; _results.push(node.textContent=message); } return
        _results; }, });

$(document).on('change', '.type_id', function(e) {
e.preventDefault(0);
$('#categories')
.find('option')
.remove()
.end();
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
}
});
$.ajax({
url: "{{ route('types.categories') }}",
method: 'post',
data: {
type_id: $(this).val(),
},
success: function(response) {
$.each(response.data, function(key, val) {
$('#categories')
.append($("<option></option>")
.attr("value", val['id'])
.text(val['name']));
});

}
});
});
</script>
@endpush