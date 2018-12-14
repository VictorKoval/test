@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang("Employee")</div>

                    <div class="card-body">
                        @if ($employee)

                            @lang("First name"): {{ $employee->first_name }}
                            <br>
                            @lang("Last name"): {{ $employee->last_name }}
                            <br>
                            @lang("Email"): {{ $employee->email }}
                            <br>
                            @lang("Phone"): {{ $employee->phone }}
                            <br>
                            @lang("Company name"): {{ $employee->company->name }}
                            <br>
                            <a href="/employee/{{$employee->id}}/edit/">@lang("edit")</a>
                            <br>
                            {{ Form::model($employee, array('method' => 'DELETE','route' => array('employee.destroy', $employee->id))) }}
                            {{ Form::submit(__("Delete")) }}
                            {{ Form::close() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
