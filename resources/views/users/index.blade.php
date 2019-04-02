@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', 'User List')

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
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>{{ __('menu-maker::common.sl') }}</th>
                                    <th>{{ __('menu-maker::users.name') }}</th>
                                    <th>{{ __('menu-maker::users.email') }}</th>
                                    <th>{{ __('menu-maker::common.updated_at') }}</th>
                                    <th>{{ __('menu-maker::common.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $x = $users->perPage() * ($users->currentPage() - 1); @endphp
                                @foreach($users as $user)
                                    <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                                        <td>{{ ++$x }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('menu-maker::users.edit', $user->id) }}"
                                               class="btn btn-primary btn-sm"
                                               title="Assign Group">{{ __('menu-maker::buttons.assign-role') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination float-right"> {!! $users->render() !!} </div>
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
