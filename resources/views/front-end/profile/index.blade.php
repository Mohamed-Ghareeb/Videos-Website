@extends('layouts.app')

@section('title', $user->name)

@section('content')


<div class="section profile-content" style="margin-top:200px">
    <div class="container">
        <div class="owner">

            <div class="name">
                <h4 class="title">{{ $user->name }}
                    <br>
                </h4>
                <h6 class="description">{{ $user->email }}</h6>
            </div>
            @if (auth()->user() && $user->id == auth()->user()->id)
                
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto text-center">
                        <br>
                        <btn onclick="$('#profileCard').slideToggle(1000)" class="btn btn-outline-default btn-round"><i class="fa fa-cog"></i> Update Your Profile</btn>
                    </div>
                </div>
                <br />

                <div class="card card-nav-tabs text-left" id="profileCard" style="display:none">
                    <div class="card-header card-header-primary">
                        <h4 style="margin-top:10px;margin-bottom:5px">Update Profile</h4>
                    </div>
                    <div class="card-body">
                        @include('front-end.profile.edit')

                        </div>
                    </div>
                    
                
            @endif
        </div>
    </div>
</div>


@endsection