@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ trans('lang.offer_title') }}: {{ $letter->offer_title }}</h2>
    <p class="text-gray-700"><strong>{{ trans('lang.recipient') }}:</strong> {{ $letter->branch->owner_email }}</p>
    <p class="text-gray-700"><strong>{{ trans('lang.message') }}:</strong> {{ $letter->offer_message }}</p>
    <p class="text-gray-700"><strong>{{ trans('lang.date') }}:</strong> {{ $letter->created_at->format('d/m/Y') }}</p>

    @if($letter->attachment)
        <p><strong>{{ trans('lang.attachment') }}:</strong> 
            <a href="{{ asset($letter->attachment) }}" target="_blank">{{ trans('lang.download') }}</a>
        </p>
    @endif
</div>

@endsection
