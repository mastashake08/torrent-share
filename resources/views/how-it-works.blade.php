@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">How It Works</div>

                <div class="panel-body">
                  {{config('app.name')}} is a file sharing web application powered by the Bittorrent protocol!
                  Perfect for business as well as personal applications, this application provides the following features:
                  <ul>
                    <li>P2P over Bittorrent protocol - No middleman required, upload your file to create your magnet link and anyone can download your file either with this web app or with another bittorrent client such as Vuze</li>
                    <li>Check Out The File Before You Download It - All files are shown in the preview area as you are reading the file so you can preview what file is being sent to you. This is perfect if you want to ensure the file sent is correct before downloading, or simply for streaming!</li>
                    <li>The Ultime Solution For Sending En Mass - All downloaders of a file simultaneously stream said file. This means the more people who download a file, the faster and more sure download for everyone else. This is the power of bittorrent.</li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
