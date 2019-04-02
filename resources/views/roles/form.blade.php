<div class="form-group row required">
    {!! Form::label('name', __('menu-maker::roles.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
        {!! $errors->first('name', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="form-check form-check-inline">
            {{ Form::radio('is_active', '1', true, ['class' => 'form-check-input', 'id' => 'is_active_1']) }}
            {!! Form::label('is_active_1', __('menu-maker::roles.is_active_1'), ['class' => 'form-check-label']) !!}
        </div>
        <div class="form-check form-check-inline">
            {{ Form::radio('is_active', '0', null, ['class' => 'form-check-input', 'id' => 'is_active_0']) }}
            {!! Form::label('is_active_0', __('menu-maker::roles.is_active_0'), ['class' => 'form-check-label']) !!}
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="form-check">
            {{ Form::checkbox('is_admin', '1', null, ['class' => 'form-check-input']) }}
            {!! Form::label('is_admin', __('menu-maker::roles.is_admin'), ['class' => 'form-check-label']) !!}
        </div>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        {!! Form::submit(__('menu-maker::buttons.' . $action), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
