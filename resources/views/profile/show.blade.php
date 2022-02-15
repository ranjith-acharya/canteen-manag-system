@extends('layouts.app')

@section('custom-title')
{{ Auth::user()->name }}
@endsection

@section('content')
@if(session('status'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast" role="status" aria-live="polite" data-bs-autohide="true" data-bs-animation="true" data-bs-delay="10000">
        <div class="toast-header">
            <img src="{{ asset('img/logo.ico') }}" class="rounded img-fluid me-2" alt="logo" height="30" width="30">
            <strong class="me-auto">Cafeteria</strong>
            <small>{{ date('s') }}&nbsp;secs ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-success">
            <i class="bi bi-check2-circle text-success"></i>&nbsp;&nbsp;{{ session('status') }}
        </div>
    </div>
</div>
@endif
<div class="container">
    <h4 class="display-6 mt-2">Profile <i class="bi bi-sliders2"></i></h4>
    <div class="card card-body mt-4">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="../img/user/{{ Auth::user()->avatar }}" class="img-fluid" height="128px" width="128px">
            </div>
            <div class="col-md-9">
                <div class="row g-2 mb-2">
                    <div class="form-group col-md-4">
                        <label for="name" class="fw-bold">Full name :</label>
                        <div class="">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email_address" class="fw-bold">Email address :</label>
                        <div class="">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="form-group col-md-4">
                        <label for="account_created" class="fw-bold">Account created :</label>
                        <div class="">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="card" class="fw-bold">Card :</label>
                        <button type="button" id="revealCardBtn" class="btn btn-sm text-dark border-0 badge rounded-pill"><i id="eye" class="bi bi-eye-slash lead"></i></button>
                        <div class="">
                            <p id="cardInfo">{{ Str::mask(Auth::user()->card, 'X', -16, 10) }}</p>
                            <p id="revealCard" style="display:none;">{{ Auth::user()->card }}</p> 
                        </div>
                    </div>
                </div>
                <hr>
                @if(count($profiles) > 0)
                    <div class="row g-2 mb-2">
                        <div class="form-group col-md-4">
                            <label for="department" class="fw-bold">Department :</label>
                            <div class="text-capitalize">{{ $user->profile->department }}&nbsp;{{ $user->profile->branch }}</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="year" class="fw-bold">Year :</label>
                            <div class="text-capitalize">{{ $user->profile->year }}</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="contact" class="fw-bold">Contact :</label>
                            <div class="text-capitalize">+91&nbsp;{{ $user->profile->contact }}</div>
                        </div>
                    </div>
                        <a href="https://www.instagram.com/{{ $user->profile->instagram }}" target="_blank"><i class="bi bi-instagram lead" style="color:#E4405F;"></i></a>&nbsp;
                        <a href="https://www.linkedin.com/in/{{ $user->profile->linkedin }}" target="_blank"><i class="bi bi-linkedin lead" style="color:#0A66C2;"></i></a>&nbsp;
                        <a href="whatsapp:+91{{ $user->profile->contact }}" target="_blank"><i class="bi bi-whatsapp lead" style="color:#25D366;"></i></a>
                    <br><br><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateProfile">Update</button>
                    <div class="modal fade" id="updateProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog col-md-12">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('profile.update', $user->profile->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select @error('branch') is-invalid @enderror" name="branch" id="branch" aria-label="">
                                                <option selected disabled>Select Branch</option>
                                                <option value="c.s" @if(Auth::user()->profile->branch == 'c.s') selected @endif>Computer</option>
                                                <option value="i.t" @if(Auth::user()->profile->branch == 'i.t') selected @endif>I.T</option>
                                            </select>
                                            <label for="branch" class="text-dark">Select Branch</label>
                                            @error('branch')
                                            <div class="invalid-feedback mt-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select @error('department') is-invalid @enderror" name="department" id="department" aria-label="">
                                                <option selected disabled>Select Department</option>
                                                <option value="b.sc" @if(Auth::user()->profile->department == 'b.sc') selected @endif>Bachelor Science</option>
                                                <option value="b.com" @if(Auth::user()->profile->department == 'b.com') selected @endif>Bachelor Commerce</option>
                                                <option value="b.e" @if(Auth::user()->profile->department == 'b.e') selected @endif>Engineering</option>
                                            </select>
                                            <label for="department" class="text-dark">Select Department</label>
                                            @error('department')
                                            <div class="invalid-feedback mt-2">
                                                {{ $message }}
                                            </div>  
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select @error('year') is-invalid @enderror" name="year" id="year" aria-label="">
                                                <option selected disabled>Select Year</option>
                                                <option value="first" @if(Auth::user()->profile->year == 'first') selected @endif>First Year</option>
                                                <option value="second" @if(Auth::user()->profile->year == 'second') selected @endif>Second Year</option>
                                                <option value="third" @if(Auth::user()->profile->year == 'third') selected @endif>Third Year</option>
                                                <option value="final" @if(Auth::user()->profile->year == 'final') selected @endif>Final Year</option>
                                            </select>
                                            <label for="year" class="text-dark">Select Year</label>
                                            @error('year')
                                            <div class="invalid-feedback mt-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" placeholder="Contact number" maxlength="10" value="{{ Auth::user()->profile->contact }}">
                                            <label for="contact" class="text-dark">Contact</label>
                                            @error('contact')
                                            <div class="invalid-feedback mt-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" placeholder="Instagram username" value="{{ Auth::user()->profile->instagram }}">
                                            <label for="instagram" class="text-dark">Instagram username</label>
                                            @error('instagram')
                                                <div class="invalid-feedback mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input id="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" placeholder="LinkedIn username" value="{{ Auth::user()->profile->linkedin }}">
                                            <label for="linkedin" class="text-dark">LinkedIn username</label>
                                            @error('linkedin')
                                            <div class="invalid-feedback mt-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success" value="Update">
                                </form>
                            </div>    
                        </div>
                @else
                    <h4 class="lead">Add Information Click <a type="button" class="link" data-bs-toggle="modal" data-bs-target="#createProfile">here</a></h4>
                    <div class="modal fade" id="createProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Add Information</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select @error('branch') is-invalid @enderror" name="branch" id="branch" aria-label="">
                                                    <option selected disabled>Select Branch</option>
                                                    <option value="c.s">Computer</option>
                                                    <option value="i.t">I.T</option>
                                                  </select>
                                                  <label for="branch" class="text-dark">Select Branch</label>
                                                @error('branch')
                                                <div class="invalid-feedback mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select @error('department') is-invalid @enderror" name="department" id="department" aria-label="">
                                                    <option selected disabled>Select Department</option>
                                                    <option value="b.sc">Bachelor Science</option>
                                                    <option value="b.com">Bachelor Commerce</option>
                                                    <option value="b.e">Engineering</option>
                                                  </select>
                                                  <label for="department" class="text-dark">Select Department</label>
                                                @error('department')
                                                <div class="invalid-feedback mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select @error('year') is-invalid @enderror" name="year" id="year" aria-label="">
                                                    <option selected disabled>Select Year</option>
                                                    <option value="first">First Year</option>
                                                    <option value="second">Second Year</option>
                                                    <option value="third">Third Year</option>
                                                    <option value="final">Final Year</option>
                                                  </select>
                                                  <label for="year" class="text-dark">Select Year</label>
                                                @error('year')
                                                <div class="invalid-feedback mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-floating">
                                                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" placeholder="Contact number" maxlength="10">
                                                    <label for="contact" class="text-dark">Contact</label>
                                                    @error('contact')
                                                    <div class="invalid-feedback mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-floating">
                                                    <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" placeholder="Instagram username">
                                                    <label for="instagram" class="text-dark">Instagram username</label>
                                                    @error('instagram')
                                                    <div class="invalid-feedback mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-floating">
                                                    <input id="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" placeholder="LinkedIn username">
                                                    <label for="linkedin" class="text-dark">LinkedIn username</label>
                                                    @error('linkedin')
                                                    <div class="invalid-feedback mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <div class="form-floating">
                                                    <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" placeholder="Choose avatar" accept="image/*">
                                                    <label for="avatar" class="text-dark">Choose avatar</label>
                                                    @error('avatar')
                                                    <div class="invalid-feedback mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Save">
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
$(document).ready(function(){
    $('.toast').toast('show');
});

$('#revealCardBtn').click(function(){
    // alert("hey");
    $('#cardInfo').toggle('hide');
    $('#revealCard').toggle('show');
});

</script>
@endsection