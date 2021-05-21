@extends('layouts.app')

@section('content')
<div class="container" style="ocapacity=20px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="opacity:.95;margin-top:100px;radius:25px;">
                <div class="panel-heading" style="text-align:center;color:red;">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Userame</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('comp_code') ? ' has-error' : '' }}">
                            <label for="comp_code" class="col-md-4 control-label">Company Code</label>

                            <div class="col-md-6">
                                <select id="comp_code" class="form-control" name="comp_code" value="{{ old('comp_code') }}" required autofocus>
                                    <option value="MAG1001">MAG1001</option>
                                    <option Value="ML1001">ML1001</option>
                                    <option value="MG1001">MG1001</option>
                                    <option value="MC1001">MC1001</option>
                                </select>
                                @if ($errors->has('comp_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comp_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                            <label for="position" class="col-md-4 control-label">Position</label>

                            <div class="col-md-6">
                                <select id="position" class="form-control" name="position" value="{{ old('position') }}" required autofocus>
                                    <option value="Consumerables">Consumerables</option>
                                    <option Value="Line Manager">Line Manager</option>
                                    <option value="Reception">Reception</option>
                                    <option value="Estimator">Estimator</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                                @if ($errors->has('comp_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
