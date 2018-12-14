@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang("Employees")</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang("First name")</th>
                            <th>@lang("Last name")</th>
                            <th>@lang("Email")</th>
                            <th>@lang("Phone")</th>
                            <th>@lang("Company name")</th>
                            <th>-</th><th>-</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>
                                    <a href="/employee/{{$employee->id}}">{{ $employee->first_name }}</a>
                                </td>
                                <td>
                                    {{ $employee->last_name }}
                                </td>
                                <td>
                                    {{ $employee->email }}
                                </td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    <a href="/company/{{$employee->company->id}}">{{ $employee->company->name }}</a>
                                </td>
                                <td>
                                    <a href="/employee/{{$employee->id}}/edit/">@lang("edit")</a>
                                </td>
                                <td>
                                    {{ Form::model($employee, array('method' => 'DELETE','route' => array('employee.destroy', $employee->id))) }}
                                    {{ Form::submit(__("Delete")) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
