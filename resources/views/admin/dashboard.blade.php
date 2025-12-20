@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div style="padding: 20px;">
    <h2 style="font-size: 25px; font-weight: 500; margin: 18px 0; color: #11101D;">
        {{ __('Admin Dashboard') }}
    </h2>
    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div style="overflow-x-auto;">
            <table class="min-w-full divide-y divide-gray-200" style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #f5f5f5;">
                    <tr>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">ID</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">Name</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">Email</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">Admin</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #666;">Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr style="border-bottom: 1px solid #e5e5e5;">
                            <td style="padding: 12px 16px;">{{ $user->id }}</td>
                            <td style="padding: 12px 16px;">{{ $user->name }}</td>
                            <td style="padding: 12px 16px;">{{ $user->email }}</td>
                            <td style="padding: 12px 16px;">{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                            <td style="padding: 12px 16px;">{{ $user->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
