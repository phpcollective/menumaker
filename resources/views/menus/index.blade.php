@extends('menu-maker::layouts.app')

{{-- Page title --}}
@section('title', 'Menu List')

@section('content')
    <div class="card-header">
        @yield('title') <a href="{{ route('menu-maker::menus.create') }}" class="btn btn-primary btn-sm float-right" title="{{ __('menu-maker::buttons.add') }}">{{ __('menu-maker::buttons.add') }}</a>
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
                                    <th>{{ __('menu-maker::menus.name') }}</th>
                                    <th>{{ __('menu-maker::menus.visible') }}</th>
                                    <th>{{ __('menu-maker::menus.privilege') }}</th>
                                    <th>{{ __('menu-maker::common.updated_at') }}</th>
                                    <th>{{ __('menu-maker::common.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $x = $menus->perPage() * ($menus->currentPage() - 1); @endphp
                                @foreach($menus as $menu)
                                    @if(! $menu->ancestors->count())
                                        @continue
                                    @endif
                                    <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                                        <td>{{ ++$x }}</td>
                                        <td>
                                            <small>{{ implode(' > ', $menu->ancestors->pluck('name')->toArray()) }}</small><br>
                                            {{ $menu->name }}
                                        </td>
                                        <td>{{ __('menu-maker::menus.visible_' . $menu->visible) }}</td>
                                        <td>{{ $menu->privilege }}</td>
                                        <td>{{ $menu->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Group">
                                                <a href="{{ route('menu-maker::menus.show', $menu->id) }}"
                                                   class="btn btn-success btn-sm"
                                                   title="View Item">{{ __('menu-maker::buttons.view') }}</a>
                                                <a href="{{ route('menu-maker::menus.edit', $menu->id) }}"
                                                   class="btn btn-primary btn-sm"
                                                   title="Edit Item">{{ __('menu-maker::buttons.edit') }}</a>
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'route' => ['menu-maker::menus.destroy', $menu->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::hidden('redirects_to', url()->full()) !!}
                                                {!! Form::button(__('menu-maker::buttons.delete'), [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Item',
                                                    'onclick'=>'return confirm("Are you sure you want to delete ' . $menu->name . '?")'
                                                ])!!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination float-right"> {!! $menus->render() !!} </div>
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
