@extends('layouts.app')

@section('content')
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
<div class="jumbotron">
<p class="text-center">InstaTorrent Stream is a web app that allows sending and receiving files using the WebTorrent protocol.
  Don't want to download the file? You can stream it right in the browser!</p>
</div>
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
@endsection
