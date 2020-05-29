<div class="form-group row required">
    {!! Form::label('name', __('menu-maker::menus.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
        {!! $errors->first('name', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row required">
    {!! Form::label('alias', __('menu-maker::menus.alias'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('alias', null, ['class' => $errors->has('alias') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
        {!! $errors->first('alias', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        {!! Form::submit(__('menu-maker::buttons.' . $action), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
