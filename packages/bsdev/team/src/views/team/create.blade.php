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
                <h1>Create Team</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Create Team</li>
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
                <h3 class="card-title">Create Team</h3>

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
                <form class="row form" method="post" action="{{ route('teams.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-7">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Basic Info</h3>
                            </div>
                            <div class="card-body">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="card-body">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email" value="{{ old('email') }}">
                            </div>
                            <div class="card-body">
                                <label for="phone">phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter phone" value="{{ old('phone') }}">
                            </div>

                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Introduction</h3>
                            </div>
                            <div class="card-body">
                                <textarea id="description" class="form-control" name="introduction" rows="3"
                                    placeholder="Enter Breif Introduction">{{ old('introduction') }}</textarea>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="designation_id">Designation</label>
                            <select class="form-control select2" name="designation_id" id="designation_id">
                                <option value="">Choose Designation</option>
                                @foreach(Team::getDesignations() as $designation)
                                <option value="{{ $designation->id }}"
                                    {{ ($designation->id==old('designation_id'))?'selected':'' }}>{{ $designation->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" class="form-control" id="position" name="position"
                                placeholder="Enter position" value="{{ old('position') }}">
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
                                <h3 class="card-title">Social Links</h3>
                            </div>
                            <div class="card-body">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook"
                                    placeholder="Enter Facebook Link" value="{{ old('facebook') }}">
                            </div>
                            <div class="card-body">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter"
                                    placeholder="Enter Twitter Link" value="{{ old('twitter') }}">
                            </div>
                            <div class="card-body">
                                <label for="instagram">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram"
                                    placeholder="Enter Instagram Link" value="{{ old('instagram') }}">
                            </div>
                            <div class="card-body">
                                <label for="youtube">YouTube</label>
                                <input type="text" class="form-control" id="youtube" name="youtube"
                                    placeholder="Enter YouTube Link" value="{{ old('youtube') }}">
                            </div>
                            <div class="card-body">
                                <label for="linkedin">Linkedin</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin"
                                    placeholder="Enter linkedin Link" value="{{ old('linkedin') }}">
                            </div>
                            <div class="card-body">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" id="website" name="website"
                                    placeholder="Enter Website Link" value="{{ old('website') }}">
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
<script src="{{ asset('theme') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $('.team-menu').removeClass('menu-is-opening menu-open');
        $('.team-menu').addClass('menu-is-opening menu-open');
        $('.team-menu').find('>:first-child').removeClass('active');
        $('.team-menu').find('>:first-child').addClass('active');
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