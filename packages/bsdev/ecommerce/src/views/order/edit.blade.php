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
                <h1>Update Order</h1>
            </div>
            
            
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Update Order</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

        <!-- SELECT2 EXAMPLE -->
        <div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download"> PDF Generate</button>
            </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Order</h3>

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
                <form class="row form" method="post" action="{{ route('orders.update',$order->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-md-7">

                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Order Items</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @php($total=0)
                                        @foreach ($order->cart_items as $item)
                                        @php($total+=$item->quantity*$item->price)
                                        <tr>
                                            @php($product = $item->product)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($product->has_variation)
                                                {{ $item->variation->title??'Deleted Product' }}<br>
                                                <ul>
                                                    @foreach ($item->getAttributeArray() as $attribute)
                                                    <li>
                                                        {{ $attribute->name }}:
                                                        @php($name =
                                                        $attribute->values->where('id',$item->variations[$attribute->id])->pluck('name'))
                                                        <span>{{ $name[0] }}</span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @else

                                                {{ $item->product->title??'Deleted Product' }}<br>
                                                @endif

                                            </td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rs. {{ $item->quantity*$item->price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>

                                        <tr>
                                            <td colspan="3">

                                            </td>
                                            <td>
                                                Shipping Cost
                                            </td>
                                            <td>
                                                Rs. {{ $order->shipping_cost }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">

                                            </td>
                                            <td>
                                                Grand Total
                                            </td>
                                            <td>
                                                Rs. {{ $total+$order->shipping_cost }}
                                            </td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">





                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">User Detail</h3>
                            </div>
                            <div class="card-body">
                                <b>Full Name:</b> {{ $order->user->name }}<br>
                                <b>Email:</b> {{ $order->user->email }}<br>
                                <b>Phone:</b> <a href="tel:{{ $order->user->phone }}">{{ $order->user->phone }}</a><br>
                                <b>Shipping:</b>
                                @foreach ($order->shipping_detail??[] as $key=>$val)
                                <b>{{ $key }}</b>:<i>{{ $val }}</i><br>
                                @endforeach
                                <br>
                            </div>
                        </div>
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Payment Status</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="payment_status" value="1" data-bootstrap-switch
                                    data-off-color="danger" data-on-color="success" {{
                                    ($order->payment_status)?'checked':'' }}>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Order Status</h3>
                            </div>
                            <div class="card-body">
                                <select class="form-control" name="order_status">
                                    <option value="1" {{ ($order->order_status==1)?'selected':'' }}>Pending</option>
                                    <option value="2" {{ ($order->order_status==2)?'selected':'' }}>Confirmed</option>
                                    <option value="3" {{ ($order->order_status==3)?'selected':'' }}>Packed</option>
                                    <option value="4" {{ ($order->order_status==4)?'selected':'' }}>Delivered</option>
                                    <option value="5" {{ ($order->order_status==5)?'selected':'' }}>Cancelled</option>
                                </select>
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
    $('.order-menu').removeClass('menu-is-opening menu-open');
        $('.order-menu').addClass('menu-is-opening menu-open');
        $('.order-menu').find('>:first-child').removeClass('active');
        $('.order-menu').find('>:first-child').addClass('active');
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
        console.log(xhr);
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



</script>
<script src="/path/to/cdn/jquery.min.js"></script>

<script src="/path/to/jQuery.print.js"></script>
        <script src="pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script type="text/javascript">
    window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'low_stock.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 1 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
            };
            html2pdf().from(invoice).set(opt).save();
        })
}
</script>
@endpush