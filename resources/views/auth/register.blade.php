@extends('layouts.newlogin')

@section('content')

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Créer mon compte</h1>
                            </div>
                            <form class="user"  method="POST" action="{{ route('register') }}">
								{{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" name="name"
                                            placeholder="Prénom">
								@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" name="lastname"
                                            placeholder="Nom">
                                    </div>
                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif									
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email"
                                        placeholder="Adresse Email">
                                </div>
								
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
								<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="exampleInputPassword" placeholder="Mot de passe">
                                    </div>
									
								
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="password_confirmation"
                                            id="exampleRepeatPassword" placeholder="Confirmation">
                                    </div>
							   @if ($errors->has('password') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

							   @if ($errors->has('password_confirmation') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif									
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Inscription
                                </button>
                                 
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">Mot de passe oublié?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{route('login')}}">Vous avez un compte? Connexion ici</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection