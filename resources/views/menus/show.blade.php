@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', $menu->name)

@section('content')
    <div class="card-header">
        @yield('title') <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm float-right" title="Back">{!! __('menu-maker::buttons.back') !!}</a>
    </div>
    <div class="card-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @foreach($menu->ancestors as $key => $parent)
                            <div class="form-group row">
                                {!! Form::label('parent_id', __('menu-maker::menus.parent_id.' . $key), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('parent_id', $parent->name, ['class' => 'form-control-plaintext', 'readonly']) !!}
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group row">
                            {!! Form::label('name', __('menu-maker::menus.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', $menu->name, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('alease', __('menu-maker::menus.alease'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('alease', $menu->alease, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('link', __('menu-maker::menus.link'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('link', $menu->link, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('icon', __('menu-maker::menus.icon'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('icon', $menu->icon, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('class', __('menu-maker::menus.class'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('class', $menu->class, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('attr', __('menu-maker::menus.attr'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('attr', $menu->attr, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('privilege', __('menu-maker::menus.privilege'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('privilege', $menu->privilege, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('visible', __('menu-maker::menus.visible'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('visible', __('menu-maker::menus.visible_' . $menu->visible), ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('created_at', __('menu-maker::common.created_at'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('created_at', $menu->created_at . ' [' . $menu->created_at->diffForHumans() . ']', ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('updated_at', __('menu-maker::common.updated_at'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('updated_at', $menu->updated_at . ' [' . $menu->updated_at->diffForHumans() . ']', ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="btn-group float-right" role="group" aria-label="Action Group">
                            <a href="{{ route('menu-maker::menus.edit', $menu->id) }}"
                               class="btn btn-primary btn-sm"
                               title="Edit Item">{{ __('menu-maker::buttons.edit') }}</a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'route' => ['menu-maker::menus.destroy', $menu->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::hidden('redirects_to', route('menu-maker::menus.index')) !!}
                            {!! Form::button(__('menu-maker::buttons.delete'), [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete Item',
                                'onclick'=>'return confirm("Are you sure you want to delete ' . $menu->name . '?")'
                            ])!!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
@endsection
