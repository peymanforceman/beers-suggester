@extends('layouts.dashboard')
@section('head')
    <link rel="stylesheet"
          href="{{URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

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
        <div class="col-md-8 col-lg-offset-2">
            <div class="box">
                <form action="{{ route('suggest') }}" method="get">
                    @csrf
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('trans.Enter Your Favourite Beer Information') }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ __('trans.Name') }} :</label>
                            <input class="form-control" type="text" name="name"
                                   placeholder="{{ __('trans.Name') }}" value="{{ $request->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('trans.Minimum ABV') }} :</label>
                            <input class="form-control" type="number" name="abv" step="0.1"
                                   value="{{ $request->abv }}"
                                   placeholder="{{ __('trans.ABV') }}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit"
                                class="btn btn-block btn-primary">{{ __('trans.Suggest') }}</button>
                    </div>
                </form>
            </div>
        </div>
        @if(!$beers->isEmpty())
            <div class="col-md-8 col-lg-offset-2">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('trans.Results') :</h3>
                    </div>
                    <div class="box-body">
                        <table id="beers_table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('trans.Image')</th>
                                <th>@lang('trans.Beer Name')</th>
                                <th>@lang('trans.ABV')</th>
                                <th>@lang('trans.Tagline')</th>
                                <th>@lang('trans.Description')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($beers as $beer)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $beer->id }}</td>
                                    <td style="vertical-align: middle;">@if($beer->image_url != null)<img
                                                style="max-height:100px;" src="{{ $beer->image_url }}">@endif</td>
                                    <td style="vertical-align: middle;">{{ $beer->name }}</td>
                                    <td style="vertical-align: middle;">{{ $beer->abv }}</td>
                                    <td style="vertical-align: middle;">{{ $beer->tagline }}</td>
                                    <td style="vertical-align: middle;">{{ $beer->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('footer')
    <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#beers_table').DataTable({
                "order": [[3, "asc"]]
            });
        })
    </script>
@endsection