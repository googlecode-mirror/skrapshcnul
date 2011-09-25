$(document).ready(function() {
	// Declare variables to hold twitter API url and user name
	var twitter_api_url = 'http://search.twitter.com/search.json';
	//var twitter_user = 'lupomontero';
	var twitter_user = 'lunchsparks';

	// Enable caching
	$.ajaxSetup({
		cache : true
	});

	// Send JSON request
	// The returned JSON object will have a property called "results" where we find
	// a list of the tweets matching our request query
	$.getJSON(twitter_api_url + '?callback=?&rpp=5&q=from:' + twitter_user, function(data) {
		$('#f-twitter').html('');

		$.each(data.results, function(i, tweet) {
			// Uncomment line below to show tweet data in Fire Bug console
			// Very helpful to find out what is available in the tweet objects
			//console.log(tweet);

			// Before we continue we check that we got data
			if(tweet.text !== undefined) {
				// Calculate how many hours ago was the tweet posted
				var date_tweet = new Date(tweet.created_at);
				var date_now = new Date();
				var date_diff = date_now - date_tweet;
				var hours = Math.round(date_diff / (1000 * 60 * 60));

				// Build the html string for the current tweet
				var tweet_html = '<div class="tweet_item">';
				tweet_html += '<div class="tweet_text">';
				tweet_html += '<a href="http://www.twitter.com/';
				tweet_html += twitter_user + '/status/' + tweet.id + '">';
				tweet_html += tweet.text + '<\/a><\/div>';
				tweet_html += '<div class="tweet_hours">' + hours;
				tweet_html += ' hours ago<\/div>';
				tweet_html += ' <\/div>';

				// Append html string to tweet_container div
				$('#f-twitter').append(tweet_html);
				//$('#f-twitter').children("div:nth-child(1)").slideUp('slow');
			}
		});
	});
});

var tweet_count = 1;

var animateTweet = function(){
	var tweet_size = $('#f-twitter').children().size();
	$('#f-twitter').children("div:nth-child("+tweet_count+")").slideUp('slow');
	if (tweet_count+1 <= tweet_size) {
		tweet_count++
	} else {
		// reset slides and count
		$('#f-twitter').children().toggle('slow');
		tweet_count = 1;
	}
}

setInterval(animateTweet, 7000);

var testimonial_count = 1;

var animateTestimonial = function(){
	var testimonial_size = $('#lunchsparks-testimonial').children().size();
	$('#lunchsparks-testimonial').children("div:nth-child("+testimonial_count+")").slideUp('slow');
	if (testimonial_count+1 <= testimonial_size) {
		testimonial_count++
	} else {
		// reset slides and count
		$('#lunchsparks-testimonial').children().toggle('slow');
		testimonial_count = 1;
	}
}

setInterval(animateTestimonial, 10000);
