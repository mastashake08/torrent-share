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
                  <br>
                  Paypal: <a href="https://paypal.me/jyroneparker" target="_blank">https://paypal.me/jyroneparker</a>
                  <br>
                  Cash: <a href="https://cash.me/$mastashake08" target="_blank">https://cash.me/$mastashake08</a>
                  <br>
                  BTC: 1B1W57t6u7TuMgP5H58dhxs3djL8MPxsDJ<br>
                  ETH: 0x90cd2bC52190108E9EfCF98a3a78Beb8ad6A1b19<br>
                  LTC: LM161CJ99PT9d4aU1t96amcd6AtDZqd8tC<br>
                  BCH: qpnlq0usktaak3h57kp60jutg0tdwczrzv7j62hqwt<br>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
