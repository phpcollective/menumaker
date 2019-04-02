@if (count($menus) > 0)
    <div class="form-group row {{ isset($required) ? $required : '' }}">
        {!! Form::label('parent-' . $parent ?? 0, __('menu-maker::menus.parent_id.' . $parentCount ?? 0), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
        <div class="col-md-6">
            {!! Form::select('parent_id[]', $menus, null, [
                'placeholder' => isset($placeholder) ? $placeholder : 'Select Ancestor',
                'class' => $errors->has('parent_id.' . $parentCount ?? 0) ? 'form-control parent is-invalid' : 'form-control parent',
                'id' => 'parent-' . $parent ?? 0,
                'data-target' => $parent ?? 0,
                'required' => isset($required) ? $required : false,
                'autofocus' => isset($autofocus) ? $autofocus : false
            ]) !!}
            {!! $errors->first('parent_id.' . $parentCount ?? 0, '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
        </div>
    </div>
    <div id="child-of-parent-{{ $parent ?? 0 }}"></div>
@endif