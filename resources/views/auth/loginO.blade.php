@extends('layouts.login')

 
@section('content')
<div class="container">
    <div class="row" style="margin-top:8%;">
 <center><div style="background-color:white;border-radius:30px;padding:10px 10px 10px 10px;width:250px;margin-bottom:30px"><img style=";"  src="{{  URL::asset('public/img/logo.png') }}" alt="Saamp" class="img-circle" width="200"></div></center>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default ">
                <div class="panel-heading   " style="color:white;font-weight:800;font-size:20px;background-color:#ddaa00;"><center>Connexion</center></div>

                <div class="panel-body " style="padding-top:30px;">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="login" class="col-md-4 control-label">
                               Identifiant
                            </label>

                            <div class="col-md-6">
                                <input id="login" type="text"
                                       class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="login" value="{{ old('username') ?: old('email') }}" required autofocus>

                                @if ($errors->has('username') || $errors->has('email'))
                                    <span class="invalid-feedback">
								<strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
									</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      <!--  <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> se souvenir de moi
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Connexion
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Mot de passe oublié?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
 
@endsection

<style>
 
</style>