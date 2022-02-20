<div>

    <div class="form-group">
        <label for="hasAttribute">Attributes (click if product has attributes)</label>
        <input type="checkbox" id="hasAttribute" value="1" wire:model="hasAttribute">
    </div>
    @if($hasAttribute)
    <div class="form-group">
        <label for="attributes">Attributes</label>
        <select class="form-control" wire:model="attributes_ids" id="attributes" multiple>
            @foreach($attributes as $attribute)
            <option value="{{ $attribute->id }}">
                {{ $attribute->name }}
            </option>
            @endforeach
        </select>
    </div>
    @foreach ($attribute_values as $i=> $val) @if(count($selectedAttributes)>0)
    <div class="row" style="border: 2px solid red; padding:20px;">
        <div class="col-6">
            <label for="title.{{ $i }}">Title</label>
            <input type="text" class="form-control" wire:model="attribute_values.{{ $i }}.title">
            @error("attribute_values.$i.title")
            <span style="font-size: smaller; color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-6">
            <label for="quantity.{{ $i }}">Quantity</label>
            <input type="text" class="form-control" wire:model="attribute_values.{{ $i }}.quantity">
            @error("attribute_values.$i.quantity")
            <span style="font-size: smaller; color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-6">
            <label for="price.{{ $i }}">Price</label>
            <input type="text" class="form-control" wire:model="attribute_values.{{ $i }}.price">
            @error("attribute_values.$i.price")
            <span style="font-size: smaller; color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-6">
            <label for="media.{{ $i }}">Images</label>
            <input type="file" class="form-control" wire:model="attribute_values.{{ $i }}.media" multiple>
            @error("attribute_values.$i.media")
            <span style="font-size: smaller; color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="row">
            @foreach($selectedAttributes as $key=> $attribute)
            <div class="col">
                <label for="{{ $attribute->id }}">{{ $attribute->name }}</label>
                <select class="form-control" wire:model="attribute_values.{{ $i }}.conf.{{ $attribute->id }}">
                    <option value="">Select {{ $attribute->name }}</option>
                    @foreach ($attribute->values as $value)
                    <option value="{{ $value->id }}">
                        {{ $value->name }}
                    </option>

                    @endforeach
                </select>

            </div>
            @endforeach
            @error("attribute_values.$i.conf")
            <div class="col-12">
                <span style="font-size: smaller; color:red;">{{ $message }}</span>
            </div>
            @enderror

        </div>
    </div>
    <div class="form-group">
        <a href="javascript:void(0);" wire:click="addMore" class="btn btn-primary">Add More+</a>
        <a href="javascript:void(0);" wire:click="remove({{ $i }})" class="btn btn-danger">Remove-</a>

    </div>
    @endif
    @endforeach
    {{-- <a href="javascript:void(0);" wire:click="save" class="btn btn-success">Save</a> --}}
    @endif
    <input type="hidden" value="{{ $hasAttribute }}" class="has-attribute">
    @if($hasAttribute)
    <input type="hidden" value="{{ json_encode($attributes_ids) }}" name="attribute_ids">
    <input type="hidden" value="{{ json_encode($finalAttribute) }}" name="variations">
    @endif
</div>