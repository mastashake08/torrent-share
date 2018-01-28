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
        }
        },
        created(){
          var that = this;
          this.client = new WebTorrent();
          dragDrop('body', function (files) {
            that.client.seed(files, function (torrent) {
              that.magnet = torrent.magnetURI;
              that.isReady = true;
            })
          })
        },
        methods:{
          send: function(event){
            var that = this;
            this.client.seed(event.target.files, function (torrent) {
              that.magnet = torrent.magnetURI;
              that.isReady = true;
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
