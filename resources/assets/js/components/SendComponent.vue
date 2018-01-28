<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Send A File</div>

                    <div class="panel-body">
                        <div class="form-group">
                          Drag and drop or select the file(s) you want to share.
                          <input type="file" v-on:change="send">
                        </div>
                        <div  v-if="isReady">
                          <button v-if="copied == false" class="btn btn-sm btn-primary" type="button"
                            v-clipboard:copy="magnet"
                            v-clipboard:success="onCopy"
                            v-clipboard:error="onError">Copy To Clipboard</button>
                            <button v-else class="btn btn-sm" type="button" disabled>Copy To Clipboard</button>
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
          speed: ''
        }
        },
        created(){
          if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/js/worker.js');
          }
          var that = this;
          this.client = new WebTorrent();
          dragDrop('body', function (files) {
            that.client.seed(files, function (torrent) {
              that.magnet = torrent.magnetURI;
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
              that.isReady = true;
              torrent.on('upload', function (bytes) {
                that.progress = torrent.progress
                that.speed = torrent.uploadSpeed
                that.uploaded = torrent.uploaded
              });
            })
          },
          onCopy: function (e) {
            alert('Magnet Link Copied To Clipboard');
          },
          onError: function (e) {
            alert('Failed to copy texts')
          }
    }
  }
</script>
