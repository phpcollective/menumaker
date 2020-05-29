@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', $section->name)

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
                            {!! Form::label('name', __('menu-maker::menus.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', $section->name, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('alias', __('menu-maker::menus.alias'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('alias', $section->alias, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('created_at', __('menu-maker::common.created_at'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('created_at', $section->created_at . ' [' . $section->created_at->diffForHumans() . ']', ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('updated_at', __('menu-maker::common.updated_at'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('updated_at', $section->updated_at . ' [' . $section->updated_at->diffForHumans() . ']', ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="btn-group float-right" role="group" aria-label="Action Group">
                            <a href="{{ route('menu-maker::sections.edit', $section->id) }}"
                               class="btn btn-primary btn-sm"
                               title="Edit Item">{{ __('menu-maker::buttons.edit') }}</a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'route' => ['menu-maker::sections.destroy', $section->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::hidden('redirects_to', route('menu-maker::sections.index')) !!}
                            {!! Form::button(__('menu-maker::buttons.delete'), [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete Item',
                                'onclick'=>'return confirm("Are you sure you want to delete ' . $section->name . '?")'
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
