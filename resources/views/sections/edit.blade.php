@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', 'Section Update')

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
                        {!! Form::model($section, [
                            'method' => 'PATCH',
                            'route' => ['menu-maker::sections.update', $section->id],
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        ]) !!}
                        {!! Form::hidden('redirects_to', url()->previous()) !!}
                        @include('menu-maker::sections.form', ['action' => 'update'])
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
