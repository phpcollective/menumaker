@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', 'User Update')

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
                        {!! Form::model($user, [
                            'method' => 'PATCH',
                            'route' => ['menu-maker::users.update', $user->id],
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        ]) !!}
                        {!! Form::hidden('redirects_to', url()->previous()) !!}

                        <div class="form-group row">
                            {!! Form::label('name', __('menu-maker::users.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('email', __('menu-maker::users.email'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('email', null, ['class' => 'form-control-plaintext', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                @foreach($roles as $id => $name)
                                    <div class="form-check">
                                        {{ Form::checkbox('role_id[]', $id, in_array($id, $selected), [
                                            'class' => 'form-check-input',
                                            'id' => 'role-check-' . $id,
                                        ]) }}
                                        {!! Form::label('role-check-' . $id, $name, ['class' => 'form-check-label']) !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit(__('menu-maker::buttons.update'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
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
