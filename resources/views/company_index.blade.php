@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang("Companies")</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang("Name")</th>
                                <th>@lang("Email")</th>
                                <th>@lang("Logo")</th>
                                <th>@lang("Website")</th>
                                <th>-</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    <a href="/company/{{$company->id}}">{{ $company->name }}</a>
                                </td>
                                <td>
                                    {{ $company->email }}
                                </td>
                                <td>
                                    @if(!empty($company->logo)) <img src="/storage/{{ $company->logo }}" alt="" style="max-width: 100px;"> @endif
                                </td>
                                <td>
                                    {{ $company->website }}
                                </td>
                                <td>
                                    <a href="/company/{{$company->id}}/edit/">@lang("edit")</a>
                                </td>
                                <td>
                                    {{ Form::model($company, array('method' => 'DELETE','route' => array('company.destroy', $company->id))) }}
                                    {{ Form::submit(__("Delete")) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
