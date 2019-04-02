@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', $role->name)

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
                        <div class="form-group row">
                            {!! Form::label('name', __('menu-maker::roles.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', $role->name, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('is_active', __('menu-maker::roles.is_active'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('is_active', __('menu-maker::roles.is_active_' . $role->is_active), ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('is_admin', __('menu-maker::roles.is_admin'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('is_admin', __('menu-maker::roles.is_admin_' . $role->is_admin), ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('created_at', __('menu-maker::common.created_at'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('created_at', $role->created_at . ' [' . $role->created_at->diffForHumans() . ']', ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('updated_at', __('menu-maker::common.updated_at'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('updated_at', $role->updated_at . ' [' . $role->updated_at->diffForHumans() . ']', ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="btn-group float-right" role="group" aria-label="Action Group">
                            <a href="{{ route('menu-maker::roles.edit', $role->id) }}"
                               class="btn btn-primary btn-sm"
                               title="Edit Item">{{ __('menu-maker::buttons.edit') }}</a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'route' => ['menu-maker::roles.destroy', $role->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::hidden('redirects_to', route('menu-maker::roles.index')) !!}
                            {!! Form::button(__('menu-maker::buttons.delete'), [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete Item',
                                'onclick'=>'return confirm("Are you sure you want to delete ' . $role->name . '?")'
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
