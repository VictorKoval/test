@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang("New company")</div>

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
                    {{ Form::model($company, array('action' => 'CompanyController@store','files' => true)) }}
                    {{ Form::label('name', __('Name')."*") }}
                    {{ Form::text('name') }}
                    <br>
                    {{ Form::label('email', __('Email')) }}
                    {{ Form::email('email') }}
                    <br>
                    {{ Form::label('logo', __('Logo')) }}
                    {{ Form::file('logo') }}
                    <br>
                    {{ Form::label('website', __('Website')) }}
                    {{ Form::text('website') }}
                    <br>
                    {{ Form::submit(__("Create company")) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
