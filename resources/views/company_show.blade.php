@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang("Company")</div>

                    <div class="card-body">
                        @if ($company)
                            @lang("Name"): {{ $company->name }}
                            <br>
                            @lang("Email"): {{ $company->email }}
                            <br>
                            @if(!empty($company->logo)) @lang("Logo"): <img src="/storage/{{ $company->logo }}" alt="" style="max-width: 100px;"> <br>@endif

                            @lang("Website"): {{ $company->website }}
                            <br>
                            <a href="/company/{{$company->id}}/edit/">@lang("edit")</a>
                            <br>
                            {{ Form::model($company, array('method' => 'DELETE','route' => array('company.destroy', $company->id))) }}
                            {{ Form::submit(__("Delete")) }}
                            {{ Form::close() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
