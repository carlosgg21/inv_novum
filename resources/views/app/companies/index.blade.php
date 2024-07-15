@extends('layouts.app')
@section('title', 'Company')
@section('page-title', 'Company')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Company"></x-breadcrumb>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-sm-2">
                <div class="sl-left"> <img src="{{ $company->logo ? \Storage::url($company->logo) : '' }}" alt="logo"
                        class="img-thumbnail" width="50%" height="50%" /> </div>
            </div>
            <div class="col-sm-8">
                <h4 class="font-weight-bold">{{ $company->name }}<br>
                    <small>"{{ $company->slogan }}"</small>
                </h4>
                <address>
                    {!! $company->address !!} <br>
        
                    <i class="fas fa-phone-square"></i> {{ $company->phone }}<br>
                    <i class="fa fa-envelope"></i> <a href="mailto:{{ $company->email }}">{{ $company->email }}</a><br>
                    <i class="fas fa-link"></i> <a href="{{ $company->email }}">Sitio web</a>
        
                </address>
        
            
        
            </div>
            <div class="col-sm-2">
                <div class="sl-left"> <img src="{{ $company->logo ? \Storage::url($company->qr_code) : '' }}" alt="qr_code"
                        class="img-thumbnail" width="100%" height="100%" /> </div>
            </div>
        </div>
        {{-- PARA UPDATE LOS DATOS DE LA COMPANY --}}
        {{-- @can('update', $company)
        <a href="{{ route('companies.edit', $company) }}">
            <button type="button" class="btn btn-light">
                <i class="fas fa-pencil"></i> Update
            </button>
        </a>
        @endcan --}}
       <hr>
        <h4><i class="fa fa-users"></i> Contacts</h4>
        <hr>
      <div class="row">
        @foreach ($company->companyContacts as $index => $contacts)
        <div class="col-md-4 mb-4">
            <div class="d-flex no-block comment-row">
                <div class="comment-text w-100">
                    <h5 class="font-medium">
                        <small>
                            {!! $contacts->boss ? '<span class="badge badge-dark">Boss</span>' : '' !!}
                        </small>
                        {{ $contacts->full_name }}
                    </h5>
                    <i class="fas fa-phone-square"></i> {{ $contacts->phone }}<br>
                    <i class="fa fa-envelope"></i> <a href="mailto:{{ $contacts->email }}">{{ $contacts->email }}</a><br>
                    <span class="badge badge-pill badge-info">{{ $contacts->charge->name }}</span>
                </div>
            </div>
        </div>
        @if (($index + 1) % 3 == 0)
    </div>
    <div class="row">
        @endif
        @endforeach
    </div
    </div>
</div>


@endsection