@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', 'Assign Menus')

@section('content')
    <div class="card-header">
        @yield('title') <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm float-right"
                           title="Back">{!! __('menu-maker::buttons.back') !!}</a>
    </div>
    <div class="card-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        {!! Form::open([
                            'method' => 'PUT',
                            'route' => 'menu-maker::roles.assign',
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        ]) !!}
                        @include('menu-maker::partials.alert')
                        <div class="form-group row required">
                            {!! Form::label('role_id', __('menu-maker::roles.role_id'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::select('role_id', $roles, null, [
                                    'placeholder' => 'Role',
                                    'class' => $errors->has('role_id') ? 'form-control is-invalid' : 'form-control',
                                    'required',
                                    'autofocus'
                                ]) !!}
                                {!! $errors->first('role_id', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
                            </div>
                        </div>

                        <div class="form-group row required">
                            {!! Form::label('section_id', __('menu-maker::menus.parent_id.0'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::select('section_id', $sections, null, [
                                    'placeholder' => 'Select Section',
                                    'class' => $errors->has('section_id') ? 'form-control is-invalid' : 'form-control',
                                    'required'
                                ]) !!}
                                {!! $errors->first('section_id', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
                            </div>
                        </div>
                        <div id="menu-tree"></div>
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
@push('scripts')
    <script>
        $(function () {
            $('#section_id').on('change', function (e) {
                var menu_id = $(this).val() || 0,
                    role_id = $('#role_id').val() || 0;
                $('#menu-tree').html('');
                if (menu_id > 0) {
                    $.get(baseUrl() + 'menus/' + menu_id + '/tree?g=' + role_id, function (data, status) {
                        $('#menu-tree').html(data);
                    }).fail(function (xhr, status, error) {
                        alert("An AJAX error occured: " + status + "\nError: " + error);
                    });
                }
            });

            $('#role_id').on('change', function (e) {
                var role_id = $(this).val() || 0,
                    section_id = $('#section_id').val() || 0;
                $('#menu-tree').find('input[type=checkbox]:checked').prop('checked', '');
                if (role_id > 0 && section_id > 0) {
                    $.get(baseUrl() + 'selected-menus?g=' + role_id + '&p=' + section_id, function (data, status) {
                        $.each(data.selected, function (key, id) {
                            $('input[type="checkbox"][value="' + id + '"]').prop('checked', 'checked');
                        });
                    }).fail(function (xhr, status, error) {
                        alert("An AJAX error occured: " + status + "\nError: " + error);
                    });
                }
            });

            $('#section_id').trigger('change');
        });
    </script>
@endpush
