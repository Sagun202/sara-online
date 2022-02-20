@if(!isset($old['field']))
@foreach($fields as $field)
@if($field->type=="textarea")
<div class="form-group">
    <label title="Reloading or any error may loosing data"
        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
        {{ ($field->is_required)?'*':'' }}</label>
    <textarea name="field[{{ $field->id }}]" class="form-control" rows="4"
        placeholder="{{ $field->placeholder }}">{{ old('field.'.$field->id) }}</textarea>
</div>
@endif
@if($field->type=="text")
<div class="form-group">
    <label title="Reloading or any error may loosing data"
        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
        {{ ($field->is_required)?'*':'' }}</label>
    <input type="text" value="{{ old('field.'.$field->id) }}" name="field[{{ $field->id }}]" class="form-control"
        placeholder="{{ $field->placeholder }}">
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
        <option value="{{ $v }}" {{ (old('field.'.$field->id)==$v)?'selected':'' }}>{{ $v }}</option>
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
        <input type="checkbox" name="field[{{ $field->id }}][]" value="{{ $v }}" class="form-check-input"
            {{ (in_array($v,old('field.'.$field->id)??[]))?'checked':'' }}
            id="{{ \Illuminate\Support\Str::slug($v) }}"><label for="{{ \Illuminate\Support\Str::slug($v) }}"
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
        <input type="radio" name="field[{{ $field->id }}]" value="{{ $v }}" class="form-check-input"
            id="{{ \Illuminate\Support\Str::slug($v) }}"><label for="{{ \Illuminate\Support\Str::slug($v) }}"
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
    <input type="file" value="{{ old('field.'.$field->id) }}" name="field[{{ $field->id }}]" class="form-control"
        placeholder="{{ $field->placeholder }}">
</div>

@endif
@endforeach
@else
@foreach($fields as $field)
@if($field->type=="textarea")
<div class="form-group">
    <label title="Reloading or any error may loosing data"
        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
        {{ ($field->is_required)?'*':'' }}</label>
    @php($tvalue ="")
    @foreach($old['field'] as $key=>$value) @if($key==$field->id)@php($tvalue=$value)@endif @endforeach
    <textarea name="field[{{ $field->id }}]" class="form-control" rows="4"
        placeholder="{{ $field->placeholder }}">{{ $tvalue }}</textarea>
</div>
@endif
@if($field->type=="text")
<div class="form-group">
    <label title="Reloading or any error may loosing data"
        for="{{ \Illuminate\Support\Str::slug($field->title) }}">{{ $field->title }}
        {{ ($field->is_required)?'*':'' }}</label>
    <input type="text" @foreach($old['field'] as $key=>$value)@if($key==$field->id)value="{{$value}}"@endif @endforeach
    name="field[{{ $field->id }}]" class="form-control" placeholder="{{ $field->placeholder }}">
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
        <option value="{{ $v }}" @foreach($old['field'] as $key=>$value)
            @if($key==$field->id && $v==$value)
            selected
            @endif
            @endforeach >{{ $v }}</option>
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
        <input type="checkbox" name="field[{{ $field->id }}][]" value="{{ $v }}" class="form-check-input"
            @foreach($old['field'] as $key=>$value)
        @if($key==$field->id)
        {{ (in_array($v,$value))?'checked':'' }}
        @endif
        @endforeach
        id="{{ \Illuminate\Support\Str::slug($v) }}"><label for="{{ \Illuminate\Support\Str::slug($v) }}"
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
        <input type="radio" name="field[{{ $field->id }}]" value="{{ $v }}" class="form-check-input"
            @foreach($old['field'] as $key=>$value)
        @if($key==$field->id)
        {{ ($v==$value)?'checked':'' }}
        @endif
        @endforeach
        id="{{ \Illuminate\Support\Str::slug($v) }}"><label for="{{ \Illuminate\Support\Str::slug($v) }}"
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
    <input type="file" value="{{ old('field.'.$field->id) }}" name="field[{{ $field->id }}]" class="form-control"
        placeholder="{{ $field->placeholder }}">
</div>

@endif
@endforeach

@endif