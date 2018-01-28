<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
                          <br>
                          <div align="center" class="embed-responsive embed-responsive-16by9">
                          <video v-show="isVideo"id="video-player" autoplay controls class="embed-responsive-item"></video>
                          </div>
                          <audio v-show="isAudio"id="audio-player" autoplay controls></audio>
                          <img class="img-responsive" v-show="isImage" id="image-player"></img>
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
          this.client = new WebTorrent();
        },
        methods:{
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
                    file.renderTo('video#video-player')
                  }
                  else if(file.name.endsWith('.jpeg')||file.name.endsWith('.jpg') || file.name.endsWith('.png')){
                    that.isImage = true;
                    file.renderTo('img#image-player');
                  }
                  else if(file.name.endsWith('.mp3') || file.name.endsWith('.flac') || file.name.endsWith('.aac')){
                    // Display the file by adding it to the DOM. Supports video, audio, image, etc. files
                    that.isAudio=true;
                    file.renderTo('audio#audio-player')
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
