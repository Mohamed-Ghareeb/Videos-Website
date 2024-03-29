<div class="row">
    @php $input = "name";  @endphp
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Page Title</label>
            <input type="text" name="{{$input}}" value="{{ isset($row) ? $row->{$input} : '' }}" class="form-control @error($input) is-invalid @enderror">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @php $input = "meta_keywords"; @endphp
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Meta Keywords</label>
            <input type="text" name="{{$input}}" value="{{ isset($row) ? $row->{$input} : '' }}" class="form-control @error($input) is-invalid @enderror">
            @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    @php $input = "des"; @endphp
    <div class="col-md-12">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Page Descriptions</label>
            <textarea name="{{$input}}" cols="30" rows="10"
                class="form-control @error($input) is-invalid @enderror">{{ isset($row) ? $row->{$input} : '' }}</textarea>
            @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    @php $input = "meta_des"; @endphp
    <div class="col-md-12">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Meta Descriptions</label>
            <textarea name="{{$input}}" cols="30" rows="10" class="form-control @error($input) is-invalid @enderror">{{ isset($row) ? $row->{$input} : '' }}</textarea>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>