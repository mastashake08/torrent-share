<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Recieve A File</div>

                    <div class="panel-body">
                        <div class="form-group">
                          <input type="text" class="form-control" v-model="magnet">
                        </div>
                        <div class="form-group">
                          <button class="btn btn-small" v-on:click="download">Download Now</button>
                        </div>
                        <div id="file-list" class="form-group">
                          Percentage Downloaded - {{progress}}%

                          <ul>
                            <li v-for="file in files">
                              {{file.name}} - <a :download="file.name" :href="file.url" target="_blank">Download Now</a>
                            </li>
                          </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Stream Preview</div>

                    <div class="panel-body">

                          <div align="center" class="embed-responsive embed-responsive-16by9">
                          <video v-if="isVideo"id="video-player" autoplay controls class="embed-responsive-item"></video>
                          <audio v-if="isAudio"id="audio-player" autoplay controls></audio>
                          <img class="img-responsive" v-if="isImage" id="image-player"></img>
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
          progress: "",
          isVideo: false,
          isAudio: false,
          isImage: false,
          files: []
        }
        },
        created(){
        /*  navigator.registerProtocolHandler("magnet",
                                  "https://instatorrent.stream/?magnet=%s",
                                  "Magnet handler"); */
          this.client = new WebTorrent();
          console.log(this.$router);
          this.magnet = this.getQueryParam('magnet')+'&dn='+this.getQueryParam('dn')+'&tr='+this.getQueryParam('tr')
        },
        methods:{
          getQueryParam :function(name, url) {
            var result = '';
              if (!url) url = window.location.href;
              name = name.replace(/[\[\]]/g, "\\$&");
              var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                  results = regex.exec(url);
                  console.log(results);
              if (!results) return null;
              if (!results[2]) return '';
              for(var i = 0; i < results.length; ++i){
                result += results[i]
              }
              console.log(result);
              return decodeURIComponent(results[2].replace(/\+/g, " "));
          },

          download: function(){
            var that = this;
            this.client.add(this.magnet, function (torrent) {
              torrent.on('download',function(){
                that.progress = (torrent.progress).toFixed(3) * 100;
              });
              var files = torrent.files;
              for(var i = 0; i < files.length; i++){


                  var file = files[i];
                  if(file.name.endsWith('.mp4') || file.name.endsWith('.webm') || file.name.endsWith('.ogg')){
                    // Display the file by adding it to the DOM. Supports video, audio, image, etc. files
                    that.isVideo=true;
                    that.$nextTick(function () {
                     // DOM is now updated
                     // `this` is bound to the current instance
                     file.renderTo('video#video-player')
                   })

                  }
                  else if(file.name.endsWith('.jpeg')||file.name.endsWith('.jpg') || file.name.endsWith('.png')){
                    that.isImage = true;
                    that.$nextTick(function () {
                     // DOM is now updated
                     // `this` is bound to the current instance
                     file.renderTo('img#image-player');
                   })

                  }
                  else if(file.name.endsWith('.mp3') || file.name.endsWith('.flac') || file.name.endsWith('.aac')){
                    // Display the file by adding it to the DOM. Supports video, audio, image, etc. files
                    that.isAudio=true;
                    that.$nextTick(function () {
                     // DOM is now updated
                     // `this` is bound to the current instance
                      file.renderTo('audio#audio-player')
                   })

                  }
                // Display the file by adding it to the DOM.
                // Supports video, audio, image files, and more!
                file.getBlobURL(function (err, url) {
                  if (err) throw err
                 that.files.push({url: url, name: file.name});
                });
              }

          });
          }
        }
    }
</script>
