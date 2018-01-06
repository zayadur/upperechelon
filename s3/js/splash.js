// set phrases and date we're counting down to
var phrases = ["aligning the stars", "breaking boundaries", "crossing oceans", "moving mountains", "traversing space"];
var target_date = new Date('Dec, 23, 2017').getTime();
 
// variables for phrases and countdown units
var phrase, selectPhrase, countdown, days, hours, minutes, seconds;

// selecting a random phrase
selectPhrase = function () {
    phrase = phrases[Math.floor(Math.random() * 5)];
    return phrase;
};
 
// get tag element
phrase = document.getElementById('phrase');
countdown = document.getElementById('countdown');
 
// update the tag with id "countdown" every 1 second
setInterval(function () {
 
    // find the amount of "seconds" between now and target
    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;
 
    // do some time calculations
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;
     
    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;
     
    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);
     
    // format countdown string + set tag value
    phrase.innerHTML = '<span class="phrase">' + selectPhrase(); + '<br />'
    countdown.innerHTML = '<span class="days">' + days +  '</span> <span class="hours">' + hours + '</span> <span class="minutes">'
    + minutes + '</span> <span class="seconds">' + seconds + '</span>';
 
}, 1000);
