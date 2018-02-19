<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Send A File</div>

                    <div class="panel-body">
                        <div class="form-group">
                          Drag and drop or select the file(s) you want to share.
                          <input type="file" v-on:change="send" multiple>
                        </div>
                        <div  v-if="isReady">
                          <button v-if="copied == false" class="btn btn-sm btn-primary" type="button"
                            v-clipboard:copy="url"
                            v-clipboard:success="onCopy"
                            v-clipboard:error="onError">Copy To Clipboard</button>
                            <button v-else class="btn btn-sm" type="button" disabled>Copy To Clipboard</button>
                              <a class="twitter-share-button"
                              :href="twitterLink"
                              data-size="large"
                              :data-url="url">
                            Tweet</a>
                            <br>
                            <h2>Share your link {{urlLink}}</h2>
                            <br>
                            Total Uploaded: {{uploaded}} bytes
                            <br>
                            Upload Speed: {{speed}} b/s
                            <br>
                            Total Progress: {{progress * 100}}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        data() {
          return {
          client : {},
          magnet: "",
          isReady: false,
          copied: false,
          uploaded: '',
          progress: '',
          speed: '',
          urlLink: "",
          twitterLink: ""
        }
        },
        created(){
          const trackers = ['wss://tracker.btorrent.xyz', 'wss://tracker.openwebtorrent.com', 'wss://tracker.fastcast.nz']

          const rtcConfig = {
            'iceServers': [
              {
                'urls': 'stun:stun.l.google.com:19305'
              }
            ]
          }

          const trackerOpts = {
            announce: trackers,
            rtcConfig: rtcConfig
          }
          if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/js/worker.js');
          }
          var that = this;
          this.client = new WebTorrent({
                  tracker: trackerOpts
                });
          dragDrop('body', function (files) {
            that.client.seed(files, function (torrent) {
              that.magnet = torrent.magnetURI;
              axios.post('/api/add-torrent',{magnet:that.magnet}).then(function(data){
                that.urlLink = 'https://instatorrent.stream/?magnet_id='+data.data.id
                that.twitterLink = "https://twitter.com/intent/tweet?text=Download%20my%20torrent&via=mastashake08&url="+that.urlLink;
              });
              that.isReady = true;
            })
            torrent.on('upload', function (bytes) {
              that.progress = torrent.progress
              that.speed = torrent.uploadSpeed
              that.uploaded = torrent.uploaded
            })
          })
        },
        methods:{
          send: function(event){
            var that = this;
            this.client.seed(event.target.files, function (torrent) {
              that.magnet = torrent.magnetURI;
              axios.post('/api/add-torrent',{magnet:that.magnet}).then(function(data){
                that.urlLink = 'https://instatorrent.stream/?magnet_id='+data.data.id
                that.twitterLink = "https://twitter.com/intent/tweet?text=Download%20my%20torrent&via=mastashake08&url="+that.urlLink;
              });
              that.isReady = true;
              torrent.on('upload', function (bytes) {
                that.progress = torrent.progress
                that.speed = torrent.uploadSpeed
                that.uploaded = torrent.uploaded
              });
            })
          },
          onCopy: function (e) {
            alert('Link Copied To Clipboard');
          },
          onError: function (e) {
            alert('Failed to copy texts')
          }
    }
  }
</script>
