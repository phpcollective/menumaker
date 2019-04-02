@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', 'Set Permission')

@section('content')
    <div class="card-header">
        @yield('title')
    </div>
    <div class="card-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @include('menu-maker::partials.alert')
                        {!! Form::open([
                            'method' => 'PUT',
                            'route' => 'menu-maker::permissions.update',
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        ]) !!}
                        @include('menu-maker::menus.menus', [
                            'required' => 'required',
                            'autofocus' => 'autofocus',
                            'menus' => $sections,
                            'parent' => 0,
                            'parentCount' => 0
                        ])
                        <div id="js-response"
                             data-except="0"
                             data-ancestors="{{ trim(implode(',', old('parent_id', $parent_ids ?? [])), ',') }}"
                             class="hide"></div>

                        <div class="form-group row">
                            {!! Form::label('controller', __('menu-maker::permissions.name'), ['class' => 'col-form-label']) !!}
                            <div class="col-md-8 offset-4">
                                <ul id="tree">
                                    @foreach($actions as $namespace => $controllers)
                                        <li>{{ $namespace }}
                                            <ul>
                                                @foreach($controllers as $controller => $methods)
                                                    <li>{{ $controller }}
                                                        <ul>
                                                            @foreach($methods as $method => $actions)
                                                                <li>{{ $method }}
                                                                    <ul>
                                                                        @foreach($actions as $action)
                                                                            <li>
                                                                                {{ Form::checkbox('actions[]', $namespace . '-' . $controller . '-' . $method . '-' . $action, null, ['class' => 'field']) }}
                                                                                {{ $action }}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="offset-4 col-md-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
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
    <script src="{{ asset('js/menus.js') }}"></script>
    <script>
        $(function () {
            $(document).on('change', '.parent', function (e) {
                var menu_id = $(this).val();
                $('#tree').find('input[type=checkbox]:checked').prop('checked', '');
                if (menu_id > 0) {
                    $.get(baseUrl() + 'permissions/selected?m_id=' + menu_id, function(data, status){
                        $.each(data.selectedActions, function (key, val) {
                            var value = val.replace(/\\/g, '\\\\');
                            $('input[type="checkbox"][value="' + value + '"]').prop('checked', 'checked');
                        });
                    }).fail(function(xhr, status, error) {
                        alert("An AJAX error occured: " + status + "\nError: " + error);
                    });
                }
            });
        });
    </script>
@endpush