window.addEventListener('load', init);

function init() {
    console.log('init');
    calcMargin();
}

function divideHeight(div, n) {
    return document.getElementById(div).clientHeight / n;
}

function calcMargin() {

    var joke = document.getElementById('joke');

    var containerHeight = divideHeight('container', 2);
    var jokeHeight = divideHeight('joke', 2);
    var titleHeight = divideHeight('title', 1);

    var margin = containerHeight - jokeHeight - titleHeight;

    joke.style.marginTop = margin + 'px';
}
