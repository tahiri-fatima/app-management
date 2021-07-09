@extends('layouts.layoutsLogin')

@section('content')



    <div class="login-block col d-flex justify-content-center" >
   
        <!-- Container-fluid starts -->
        <div class="container" >
            <div class="row  ">
                <div class="col-sm-12">
                    
                    <!-- Authentication card start -->

                        <form class="md-float-material form-material" method="POST" action="{{ route('login.authenticate') }}">
                        @csrf
                        

                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Se connecter</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                    <input id="code_personne" type="text" class="form-control @error('code_personne') is-invalid @enderror" name="code_personne" value="{{ old('code_personne') }}" 
                                        required autocomplete="code_personne" autofocus>
                                        <span class="form-bar"></span>  
                                        @error('code_personne')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror  
                                      
                                        <label class="float-label">Nom d'utilisateur</label>
                                    </div>

                                    <div class="form-group form-primary">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">                                        <span class="form-bar"></span>
                                        <span class="form-bar"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label class="float-label">Mot de passe</label>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>

                                            <div class="forgot-phone text-right f-right">
                                                @if (Route::has('password.request'))
                                                    <a class="text-right f-w-600" href="{{ route('password.request') }}">
                                                        {{ __('Mot de passe oublier?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30 text-center">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light text-center m-b-20 m-r-15" style="width: 170px;">Se connecter</button>
                                            <a class="btn btn-primary  waves-effect waves-light text-center m-b-20" style="width: 170px;" href="/" >Annuler</a>
                                        </div>
                                    </div>
                                    <hr/>
                                  
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </div>
 
@endsection
