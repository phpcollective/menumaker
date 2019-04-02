@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', 'Role')

@section('content')
    <div class="card-header">
        @yield('title')
        <div class="btn-group float-right" role="group" aria-label="Action Group">
            <a href="{{ route('menu-maker::roles.create') }}" class="btn btn-success btn-sm" title="{{ __('menu-maker::buttons.add') }}">{{ __('menu-maker::buttons.add') }}</a>
            <a href="{{ route('menu-maker::roles.menus') }}" class="btn btn-primary btn-sm" title="{{ __('menu-maker::buttons.set-menu') }}">{{ __('menu-maker::buttons.set-menu') }}</a>
        </div>
    </div>
    <div class="card-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @include('menu-maker::partials.alert')
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>{{ __('menu-maker::common.sl') }}</th>
                                    <th>{{ __('menu-maker::roles.name') }}</th>
                                    <th>{{ __('menu-maker::roles.is_active') }}</th>
                                    <th>{{ __('menu-maker::roles.is_admin') }}</th>
                                    <th>{{ __('menu-maker::common.updated_at') }}</th>
                                    <th>{{ __('menu-maker::common.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $x = $roles->perPage() * ($roles->currentPage() - 1); @endphp
                                @foreach($roles as $role)

                                    <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                                        <td>{{ ++$x }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ __('menu-maker::roles.is_active_' . $role->is_active) }}</td>
                                        <td>{{ __('menu-maker::roles.is_admin_' . $role->is_admin) }}</td>
                                        <td>{{ $role->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Group">
                                                <a href="{{ route('menu-maker::roles.show', $role->id) }}"
                                                   class="btn btn-success btn-sm"
                                                   title="View Item">{{ __('menu-maker::buttons.view') }}</a>
                                                <a href="{{ route('menu-maker::roles.edit', $role->id) }}"
                                                   class="btn btn-primary btn-sm"
                                                   title="Edit Item">{{ __('menu-maker::buttons.edit') }}</a>
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'route' => ['menu-maker::roles.destroy', $role->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::hidden('redirects_to', url()->full()) !!}
                                                    {!! Form::button(__('menu-maker::buttons.delete'), [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Item',
                                                        'onclick'=>'return confirm("Are you sure you want to delete ' . $role->name . '?")'
                                                    ])!!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination float-right"> {!! $roles->render() !!} </div>
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
