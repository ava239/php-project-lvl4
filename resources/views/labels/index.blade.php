@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('labels.title') }}</h1>
        @auth
            <a href="{{ route('labels.create') }}" class="btn btn-primary">{{ __('layout.buttons.add_new') }}</a>
        @endauth
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('layout.headers.id') }}</th>
                <th>{{ __('layout.headers.name') }}</th>
                <th>{{ __('layout.headers.created_at') }}</th>
                @auth
                    <th>{{ __('layout.headers.actions') }}</th>
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
                            @can('update', $label)
                                <a href="{{ route('labels.edit', $label) }}">
                                    {{ __('layout.buttons.edit') }}
                                </a>
                            @endcan
                            @can('delete', $label)
                                <a href="{{ route('labels.destroy', $label) }}"
                                   data-confirm="{{ __('layout.texts.confirmation') }}"
                                   data-method="delete" rel="nofollow" class="text-danger">
                                    {{ __('layout.buttons.remove') }}</a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>

        {{ $labels->links() }}
    </div>
@endsection
