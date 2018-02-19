var Twit = require('twit')
require('dotenv').config()

var T = new Twit({
  consumer_key:         process.env.TWITTER_KEY,
  consumer_secret:      process.env.TWITTER_SECRET,
  access_token:         process.env.TWITTER_ACCESS_TOKEN,
  access_token_secret:  process.env.TWITTER_ACCESS_TOKEN_SECRET,
  timeout_ms:           60*1000,  // optional HTTP request timeout to apply to all requests.
})

//
// filter the public stream by english tweets containing `#apple`
//
var stream = T.stream('statuses/filter', { track: ['#bittorrent','#webtorrent','#torrent','file sharing','#filesharing', 'pirate bay', 'vuze']})

stream.on('tweet', function (tweet) {
  console.log(tweet)
  T.post('favorites/create', { id: tweet.id_str },function(data){
    console.log('Tweet liked!')
  });
})
