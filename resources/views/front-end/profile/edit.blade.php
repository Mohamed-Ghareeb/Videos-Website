<form action="{{ route('profile.update') }}" method="POST">
    <div class="row">
        @csrf
            @php $input = "name"; @endphp
            <div class="col-md-8">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Username</label>
                    <input type="text" name="{{$input}}" value="{{ isset($user) ? $user->{$input} : '' }}"
                        class="form-control @error($input) is-invalid @enderror">
                    @error($input)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4"></div>
            @php $input = "password"; @endphp
            <div class="col-md-8">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Password</label>
                    <input type="password" name="{{$input}}" class="form-control @error($input) is-invalid @enderror">
                    @error($input)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4"></div>
            @php $input = "email"; @endphp
            <div class="col-md-8">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Email address</label>
                    <input type="email" name="{{$input}}" value="{{ isset($user) ? $user->{$input} : '' }}"
                        class="form-control @error($input) is-invalid @enderror">
                    @error($input)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4"></div>
            <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
            <div class="clearfix"></div>
    </div>
</form>



