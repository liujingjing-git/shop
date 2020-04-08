<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	 <form class="form-horizontal" role="form" method="POST" action="/password/update">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="old_password" class="col-md-4 control-label">原始密码</label>
                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control" name="old_password" value="{{ old('old_password') }}" required>
                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">输入新密码</label>
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
                                <label for="password-confirm" class="col-md-4 control-label">确认新密码</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        更改密码
                                    </button>
                                </div>
                            </div>
                        </form>
                        
</body>
</html>