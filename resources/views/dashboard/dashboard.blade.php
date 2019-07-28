@extends('layouts.dashboard')

@section('content')
    @if (count($errors) > 0)
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    @if (session('status'))
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-lg-offset-3">
            <div class="box">
                <form action="{{ route('suggest') }}" method="get">
                    @csrf
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('trans.Enter Your Favourite Beer Information') }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('trans.Name') }} :</label>
                            <input class="form-control input-lg" type="text" name="name"
                                   placeholder="{{ __('trans.Name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('trans.Minimum ABV') }} :</label>
                            <input class="form-control input-lg" type="number" name="abv" step="0.1"
                                   placeholder="{{ __('trans.ABV') }}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit"
                                class="btn btn-lg btn-block btn-primary">{{ __('trans.Suggest') }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection