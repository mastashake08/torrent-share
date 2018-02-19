@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <div class="container">
                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- instatorrent -->
                  <ins class="adsbygoogle"
                       style="display:block"
                       data-ad-client="ca-pub-7023023584987784"
                       data-ad-slot="2340456025"
                       data-ad-format="auto"></ins>
                  <script>

                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
                  </div>
                  <br>
                
                  <send-component></send-component>
                  <receive-component magnet-link="{{$magnet->magnet}}"></receive-component>
                  <div class="container">
                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- instatorrents2 -->
                  <ins class="adsbygoogle"
                       style="display:block"
                       data-ad-client="ca-pub-7023023584987784"
                       data-ad-slot="7782330870"
                       data-ad-format="auto"></ins>
                  <script>
                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
