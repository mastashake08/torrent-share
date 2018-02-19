@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pricing</div>

                <div class="panel-body">
                  {{config('app.name')}} will always be free. However
                  we do have operation costs and ask that if this software has
                  been beneficial to you please donate below.

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
