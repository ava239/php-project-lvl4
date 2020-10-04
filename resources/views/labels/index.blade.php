@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('labels.title') }}</h1>
        @auth
            <a href="{{ route('labels.create') }}" class="btn btn-primary">{{ __('labels.add_new') }}</a>
        @endauth
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('labels.id') }}</th>
                <th>{{ __('labels.name') }}</th>
                <th>{{ __('labels.created_at') }}</th>
                @auth
                    <th>{{ __('labels.actions') }}</th>
                @endauth
            </tr>
            </thead>
            @foreach($labels as $label)
                <tr>
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->created_at }}</td>
                    @auth
                        <td>
                            @can('delete', $label)
                                <a href="{{ route('labels.destroy', $label) }}"
                                   data-confirm="{{ __('labels.confirmation') }}"
                                   data-method="delete">
                                    {{ __('labels.remove') }}
                                </a>
                            @endcan
                            @can('update', $label)
                                <a href="{{ route('labels.edit', $label) }}">
                                    {{ __('labels.edit') }}
                                </a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>

        {{ $labels->links() }}
    </div>
@endsection
