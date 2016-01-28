$(document).ready(function() { 
    // $("html").niceScroll();
    $("pre").snippet("php",{style:"acid"});
});

$("li").hover(function() {
	$(this).animate({backgroundColor: "#000"}, "slow");
});
