@extends('theme::layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/dropzone/min/dropzone.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('theme') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
    integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg=="
    crossorigin="anonymous" />
@livewireStyles
<style type="text/css">
    .bootstrap-tagsinput {
        width: 100%;
    }

    .label-info {
        background-color: #17a2b8;

    }

    .label {
        display: inline-block;
        padding: .25em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out,
            border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update Product</li>
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
                <h3 class="card-title">Update Product</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>


            <!-- /.card-header -->
            <div class="card-body">
                <div class="alert alert-danger" style="display: none;">
                    <ul>

                    </ul>
                </div>
                <form class="row form product-form" method="post" action="{{ route('products.update',$product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                value="{{ $product->title }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price"
                                value="{{ $product->price }}">
                        </div>
                        <div class="form-group">
                            <label for="cost_price">Cost Price</label>
                            <input type="number" class="form-control" id="cost_price" name="cost_price"
                                placeholder="Enter Cost Price" value="{{ $product->cost_price }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity <small>(total quantity)</small></label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Enter quantity" value="{{ $product->quantity }}">
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount <small>(in percentage)</small></label>
                            <input type="number" class="form-control" id="discount" name="discount"
                                placeholder="Enter Discount" value="{{ $product->discount }}">
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight <small>(in kg)</small></label>
                            <input type="number" class="form-control" id="weight" name="weight"
                                placeholder="Enter Weight" value="{{ $product->weight }}">
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea class="form-control" name="short_description" rows="5"
                                placeholder="Enter Short Description">{{ $product->short_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="description" class="form-control" name="description" rows="5"
                                placeholder="Enter Description">{{ $product->description }}</textarea>
                        </div>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Images <small><em>Supported Files
                                            jpg,png,gif,jpeg,webp</em></small></h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    @foreach($product->images as $image)
                                    <div>
                                        <img src="{{ asset('storage/'.$image) }}" width="150px" style="margin: 10px;"
                                            onclick="
                                                                if(confirm('Are you sure want to delete?')){
                                                                    this.parentNode.remove();
                                                                }
                                                                ">
                                        <input type="hidden" value="{{ $image }}" name="images[]">
                                    </div>
                                    @endforeach
                                </div>
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
                            <label for="brand_id">Brand</label>
                            <select class="form-control select2 type_id" name="brand_id" id="type_id">
                                <option value="">Choose Brand</option>
                                @foreach(Ecommerce::getBrands() as $brand)
                                <option value="{{ $brand->id }}" {{ ($brand->id==$product->brand_id)?'selected':'' }}>
                                    {{ $brand->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            @php($oldval = \Session::getOldInput()??'[]')
                            <label for="categories">Categories <small>(Changing cateogry may loosing
                                    data)</small></label>
                            <select class="form-control select2 category" data-session="{{ json_encode($oldval) }}"
                                name="categories[]" id="categories" multiple="multiple">

                                @foreach(Ecommerce::getCategoryTree() as $category)
                                <option value="{{ $category->id }}"
                                    {{ (in_array($category->id,$product->categories->pluck('id')->toArray()??[]))?'selected':'' }}>
                                    {{ $category->name }}
                                </option>
                                @foreach($category->categories as $child)
                                <option value="{{ $child->id }}"
                                    {{ (in_array($child->id,$product->categories->pluck('id')->toArray()??[]))?'selected':'' }}>
                                    --{{ $child->name }}
                                <option>
                                    @foreach($child->categories as $grand)
                                <option value="{{ $grand->id }}"
                                    {{ (in_array($grand->id,$product->categories->pluck('id')->toArray()??[]))?'selected':'' }}>
                                    ----{{ $grand->name }}
                                <option>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                            </select>
                        </div>

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Addtional Field</h3>
                            </div>
                            <div class="card-body custom-field">
                                @foreach($product->custom_fields as $key=>$val)
                                @php($field = \Bsdev\Ecommerce\Models\CustomField::find($key))
                                @if($field->type=="textarea")
                                <div class="form-group">
                                    <label title="Reloading or any error may loosing data"
                                        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
                                        {{ ($field->is_required)?'*':'' }}</label>
                                    <textarea name="field[{{ $field->id }}]" class="form-control" rows="4"
                                        placeholder="{{ $field->placeholder }}">{{ $val }}</textarea>
                                </div>
                                @endif
                                @if($field->type=="text")
                                <div class="form-group">
                                    <label title="Reloading or any error may loosing data"
                                        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
                                        {{ ($field->is_required)?'*':'' }}</label>
                                    <input type="text" name="field[{{ $field->id }}]" class="form-control"
                                        placeholder="{{ $field->placeholder }}" value="{{ $val }}">
                                </div>
                                @endif

                                @if($field->type=="select")
                                <div class="form-group">
                                    <label title="Reloading or any error may loosing data"
                                        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
                                        {{ ($field->is_required)?'*':'' }}</label>
                                    <select class="form-control" name="field[{{ $field->id }}]">
                                        <option value="">Select {{ $field->title }}</option>
                                        @foreach ($field->values as $v )
                                        <option value="{{ $v }}" @if($val==$v) selected @endif>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                @if($field->type=="checkbox")
                                <div class="form-group">
                                    <label title="Reloading or any error may loosing data"
                                        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
                                        {{ ($field->is_required)?'*':'' }}</label>
                                    @foreach ($field->values as $v )
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="field[{{ $field->id }}][]" value="{{ $v }}"
                                            class="form-check-input" {{ (in_array($v,$val))?'checked':'' }}
                                            id="{{ \Illuminate\Support\Str::slug($v) }}"><label
                                            for="{{ \Illuminate\Support\Str::slug($v) }}"
                                            class="form-check-label">{{ $v }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                                @if($field->type=="radio")
                                <div class="form-group">
                                    <label title="Reloading or any error may loosing data"
                                        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
                                        {{ ($field->is_required)?'*':'' }}</label>
                                    @foreach ($field->values as $v )
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="field[{{ $field->id }}]" value="{{ $v }}"
                                            class="form-check-input" {{ ($v==$val)?'checked':'' }}
                                            id="{{ \Illuminate\Support\Str::slug($v) }}"><label
                                            for="{{ \Illuminate\Support\Str::slug($v) }}"
                                            class="form-check-label">{{ $v }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                                @if($field->type=="file")
                                <div class="form-group">
                                    <label title="Reloading or any error may loosing data"
                                        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
                                        {{ ($field->is_required)?'*':'' }}</label>
                                    <input type="file" name="field[{{ $field->id }}]" class="form-control"
                                        placeholder="{{ $field->placeholder }}">
                                    <a href="{{ asset('storage/'.$val) }}" target="_blank"><small>Click here to view
                                            file</small> </a>
                                    <input type="hidden" name="field[{{ $field->id }}]" value="{{ $val }}">
                                </div>

                                @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" name="tags" id="tags" data-role="tagsinput"
                                value="{{ $product->tags }}" placeholder="Enter tags">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thumbnail</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="thumbnail" class="custom-file-input file-input"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <img src="{{ asset('storage/'.$product->thumbnail) }}" class="preview img-fluid"
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
                                    placeholder="Enter Meta Title" value="{{ $product->seo['meta_title']??'' }}">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="5"
                                    placeholder="Enter Meta Description">{{ $product->seo['meta_description']??'' }}</textarea>
                            </div>
                        </div>
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Featured</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="featured" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success"
                                    {{ ($product->featured)?'checked':'' }}>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="status" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success"
                                    {{ ($product->status)?'checked':'' }}>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                        <a class="btn btn-danger float-right" onclick="$('.form')[0].reset()">Reset</a>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    @livewire('product-attribute-edit',['attribute_values'=>$product->variations->toArray(),'attributes_ids'=>$product->attribute_ids,'hasAttribute'=>$product->has_variation])
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"
    integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg=="
    crossorigin="anonymous"></script>
@livewireScripts
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
    Dropzone.autoDiscover = false
    
    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
   var myDropzone = new Dropzone('#dropzone',{
    
    uploadMultiple: false,
    parallelUploads: 100,
    maxFilesize: 8,
    maxFiles: 10,
    maxFilesize: 1,
    createImageThumbnails: true,
    url: "{{ route('products.image') }}",
    acceptedFiles: "image/jpeg,image/png,image/gif,image/svg,image/webp,image/jpg,video/*",
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
    $('.form').append('<input type="hidden" name="images[]" value='+xhr+'>');
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

        $(document).on('change','.category',function(){

    if($(this).val().length!=0){
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        url: "{{ route('get-custom-fields') }}",
        method: 'post',
        data:{
            categories:$(this).val(),
            old: $(this).data('session')
        },
        success: function(response) {
            $('.custom-field').html(response.view);
        },
        error: function(response) {
            
            $('.custom-field').html('Choose category to generate fields');
           
        }
    });
    }
    else{

        $('.custom-field').html('Choose category to generate fields');

    }
    });
    $('.product-form').submit(async function(e){
    e.preventDefault(0);
    $('.btn-submit').prop('disabled',true);
    $('.btn-submit').html('Processing...');

    if($('.has-attribute').val()==1){
        Livewire.emit('validateAttribute');
        $('.btn-submit').prop('disabled',false);
            $('.btn-submit').html('Try Again!!');
        }
        else{
            submitFunction();
        }
        });
        Livewire.on('submit',function() {
            submitFunction();
        })
function submitFunction(){
    $('.btn-submit').prop('disabled',true);
        $('.btn-submit').html('Processing...');
        var formData = new FormData($('.product-form')[0]);
    formData.append('thubmnail', $('.file-input')[0].files[0]);
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
        processData: false,
        contentType: false,
        url: $('.product-form').attr('action'),
        method: 'post',
        data:formData,
        success: function(response) {
          window.location.href=response.url;
        },
        error: function(response) {
            $('.btn-submit').prop('disabled',false);
            $('.btn-submit').html('Try Again!!');
            let html = '';
            $.each(response.responseJSON.errors, function(k, v) {
            html += '<li style="font-size: smaller;">'+v+'</li>';
            });
            $('.alert-danger').find('ul').html(html);
            $('.alert-danger').css('display','block');
            $('html, body').animate({
                    scrollTop: $("body").offset().top
                }, 2000);
           
        }
    });
    }
</script>

@endpush