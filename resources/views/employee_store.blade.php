@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang("New employee")</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        {{ Form::model($employee, array('action' => 'EmployeeController@store')) }}

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
                        {{ Form::submit(__("Create employee")) }}
                        {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
