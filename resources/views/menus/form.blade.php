@include('menu-maker::menus.menus', [
    'required' => 'required',
    'autofocus' => 'autofocus',
    'menus' => $sections,
    'parent' => 0,
    'parentCount' => 0
])
<div id="js-response"
     data-except="{{ isset($menu) ? $menu->id : 0 }}"
     data-ancestors="{{ trim(implode(',', old('parent_id', $parent_ids ?? [])), ',') }}"
     class="hide"></div>

<div class="form-group row required">
    {!! Form::label('name', __('menu-maker::menus.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
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

<div class="form-group row">
    {!! Form::label('route_list', __('menu-maker::menus.routes'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('route_list', null, [
            'class' => $errors->has('route_list') ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Comma separated names'
        ]) !!}
        {!! $errors->first('route_list', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('link', __('menu-maker::menus.link'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('link', null, ['class' => $errors->has('link') ? 'form-control is-invalid' : 'form-control']) !!}
        {!! $errors->first('link', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('icon', __('menu-maker::menus.icon'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('icon', null, ['class' => $errors->has('icon') ? 'form-control is-invalid' : 'form-control']) !!}
        {!! $errors->first('icon', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('class', __('menu-maker::menus.class'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('class', null, ['class' => $errors->has('class') ? 'form-control is-invalid' : 'form-control']) !!}
        {!! $errors->first('class', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('attr', __('menu-maker::menus.attr'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::text('attr', null, ['class' => $errors->has('attr') ? 'form-control is-invalid' : 'form-control']) !!}
        {!! $errors->first('attr', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row required">
    {!! Form::label('privilege', __('menu-maker::menus.privilege'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-6">
        {!! Form::select('privilege', $privileges, null, [
            'class' => $errors->has('privilege') ? 'form-control is-invalid' : 'form-control',
            'required'
        ]) !!}
        {!! $errors->first('privilege', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="form-check form-check-inline">
            {{ Form::radio('visible', '1', true, ['class' => 'form-check-input', 'id' => 'visible_1']) }}
            {!! Form::label('visible_1', __('menu-maker::menus.visible_1'), ['class' => 'form-check-label']) !!}
        </div>
        <div class="form-check form-check-inline">
            {{ Form::radio('visible', '0', null, ['class' => 'form-check-input', 'id' => 'visible_0']) }}
            {!! Form::label('visible_0', __('menu-maker::menus.visible_0'), ['class' => 'form-check-label']) !!}
        </div>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        {!! Form::submit(__('menu-maker::buttons.' . $action), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
@push('scripts')
    <script src="{{ asset('/vendor/menu-maker/menus.js') }}"></script>
@endpush
