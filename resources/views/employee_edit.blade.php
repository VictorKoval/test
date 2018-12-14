@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang("Employee edit")</div>

                    <div class="card-body">
                        @if ($employee)
                            {{ Form::model($employee, array('method' => 'PUT', 'route' => array('employee.update', $employee->id), 'files' => true)) }}
                            {{ Form::label('first_name', __('First name')."*") }}
                            {{ Form::text('first_name') }}
                            <br>
                            {{ Form::label('last_name', __('Last name')."*") }}
                            {{ Form::text('last_name') }}
                            <br>
                            {{ Form::label('email', __('Email')) }}
                            {{ Form::email('email') }}
                            <br>
                            {{ Form::label('phone', __('Phone')) }}
                            {{ Form::text('phone') }}
                            <br>
                            {{ Form::label('company_id', __('Company')."*") }}
                            {{ Form::select('company_id', $companies) }}
                            <br>
                            {{ Form::submit(__("Update employee")) }}
                            {{ Form::close() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
