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
    <form class="row form" method="post" wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf
        <div class="col-md-7">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" wire:model="name" placeholder="Enter Name">
                @error('name')
                <span style="font-size: smaller; color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Values</label>
                @foreach ($values as $key=>$val)
                <div class="row pb-2">
                    <div class="col-md-10">
                        <input class="form-control" placeholder="Enter Values" type="text"
                            wire:model="values.{{ $key }}">
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:void(0);" class="btn btn-primary" style="padding:7px;" wire:click="add"><i
                                class="fa fa-plus"></i></a>
                    </div>
                    @if(!$loop->first)
                    <div class="col-md-1">
                        <a href="javascript:void(0);" class="btn btn-danger" style="padding:7px;"
                            wire:click="remove({{ $key }})"><i class="fa fa-minus"></i></a>
                    </div>
                    @endif
                </div>
                @endforeach

            </div>

            <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-5">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Categories <small>(multiple)</small></h3>
                </div>
                <div class="card-body">
                    <select name="categories[]" wire:model="categories" class="form-control select2" multiple="multiple"
                        style="height:200px !important;">
                        @foreach(Ecommerce::getCategoryTree() as $category)
                        <option value="{{ $category->id }}"
                            {{ (in_array($category->id,old('category_id')??[])?'selected':'') }}>
                            {{ $category->name }}
                        </option>
                        @foreach($category->categories as $child)
                        <option value="{{ $child->id }}"
                            {{ (in_array($child->id,old('category_id')??[])?'selected':'') }}>
                            --{{ $child->name }}
                        </option>
                        @foreach($child->categories as $grand)
                        <option value="{{ $grand->id }}"
                            {{ (in_array($grand->id,old('category_id')??[])?'selected':'') }}>
                            ----{{ $grand->name }}
                        </option>
                        @endforeach
                        @endforeach
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Publish</h3>
                </div>
                <div class="card-body">
                    <select wire:model="status" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
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