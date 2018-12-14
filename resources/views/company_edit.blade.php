@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang("Company edit")</div>

                    <div class="card-body">
                        @if ($company)
                            {{ Form::model($company, array('method' => 'PUT', 'route' => array('company.update', $company->id), 'files' => true)) }}
                            {{ Form::label('name', __('Name')."*") }}
                            {{ Form::text('name') }}
                            <br>
                            {{ Form::label('email', __('Email')) }}
                            {{ Form::email('email') }}
                            <br>
                            @if(!empty($company->logo)) <img src="/storage/{{ $company->logo }}" alt="" style="max-width: 100px;"> @endif
                            {{ Form::label('logo', __('Logo')) }}
                            {{ Form::file('logo') }}
                            <br>
                            {{ Form::label('website', __('Website')) }}
                            {{ Form::text('website') }}
                            <br>
                            {{ Form::submit(__("Update company")) }}
                            {{ Form::close() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
