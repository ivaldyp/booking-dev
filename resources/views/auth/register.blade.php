@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <input type="hidden" name="id_user" value="<?php echo md5(uniqid()); ?>">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="off" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nrk" class="col-md-4 col-form-label text-md-right">NRK</label>

                            <div class="col-md-6">
                                <input id="nrk" type="text" class="form-control @error('nrk') is-invalid @enderror" name="nrk" autocomplete="off" autofocus>

                                @error('nrk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nip" class="col-md-4 col-form-label text-md-right">NIP</label>

                            <div class="col-md-6">
                                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" autocomplete="off" autofocus>

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_status" class="col-md-4 col-form-label text-md-right">Tipe Pengguna</label>
                            <div class="col-md-6">
                                <select id="user_status" class="form-control" name="user_status" required>
                                    <option value="<?php echo NULL; ?>" disabled selected>-- Pilih Tipe Pengguna --</option>
                                    <?php foreach ($user_types as $type) { ?>
                                    <option value="{{$type->id_userType}}">{{$type->userType_name}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_bidang" class="col-md-4 col-form-label text-md-right">Bidang</label>
                            <div class="col-md-6">
                                <select id="user_bidang" class="form-control" name="user_bidang">
                                    <option value="<?php echo NULL; ?>" disabled selected>-- Pilih Bidang --</option>
                                    <option value="<?php echo NULL; ?>">Tidak Ada</option>
                                    <?php foreach ($bidangs as $bidang) { ?>
                                    <option value="{{$bidang->id_bidang}}">{{$bidang->bidang_name}}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required autocomplete="off" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <!-- <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="register-button" type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('confirm_password')

<script type="text/javascript" language="javascript">
    $(function () {
        $("#password2").bind("change paste keyup", function() {
            alert($(this).val()); 
        });
        // var pass = $('#password').val();
        // var pass2 = $('#password2').val();
        // alert("wadooo");
        // if (pass = pass2) {
        //     $("#register-button").prop("disabled", false);
        // }
    });
</script>

@endsection
