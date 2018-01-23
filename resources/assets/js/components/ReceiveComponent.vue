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
                              {{file.name}} - <a :download="file.url" :href="file.url" target="_blank">Download Now</a>
                            </li>
                          </ul>
                          <br>
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
          progress: "",
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

            // Torrents can contain many files. Let's use the .mp4 file
            var files = torrent.files;
            for(var i = 0; i < files.length; i++){

                var file = files[i];
              // Display the file by adding it to the DOM.
              // Supports video, audio, image files, and more!
              files[i].getBlobURL(function (err, url) {
                console.log(file);
                if (err) throw err
               that.files.push({url: url, name: file.name});
              });
            }
          });
          }
        }
    }
</script>
