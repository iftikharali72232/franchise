@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contact Messages</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->id }}</td>
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->message }}</td>
                    <td>{{ $msg->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $messages->links() }}
</div>
@endsection
