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
                          SHARE - <strong>{{magnet}}</strong>
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
            console.log('Component mounted.')
        },
        data() {
          return {
          client : {},
          magnet: "",
          isReady: false
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
          }
        }
    }
</script>
