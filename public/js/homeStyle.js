// Misc Essentials
window.addEventListener('load', init);

function init() {
    console.log('init');
    calcMargin();
}

function divideHeight(div, n) {
    return document.getElementById(div).clientHeight / n;
}

// Variables used
var jokeContainer = document.getElementById('jokeContainer');
var uploadContainer = document.getElementById('uploadContainer');
var joke = document.getElementById('joke');
var title = document.getElementById('title');
var downImage = document.getElementById('downImage');
var downImageContainer = document.getElementById('downImageContainer');

// Calculate the joke margin
function calcMargin() {

    var containerHeight = divideHeight('container', 2);
    var jokeHeight = divideHeight('joke', 2);
    var titleHeight = divideHeight('title', 1);

    var margin = containerHeight - jokeHeight - titleHeight;

    joke.style.marginTop = margin + 'px';
}

// Menu click
downImage.addEventListener('click', openMenu);

// Open the menu after a click
function openMenu(){

    joke.style.transition = "margin 1s";

    jokeContainer.style.height = '0';
    uploadContainer.style.height = '100vh';
    title.style.marginTop = "-400px";
    joke.style.marginTop = "-300px";
    downImageContainer.style.marginTop = "-720px";
    downImage.style.transform = "rotate(360deg)";

    downImage.removeEventListener('click', openMenu);
    downImage.addEventListener('click', backHome);

}

// Go back home after another click
function backHome() {

    jokeContainer.style.height = '100vh';
    uploadContainer.style.height = '0';
    title.style.marginTop = "0";
    joke.style.marginTop = "0";
    downImageContainer.style.marginTop = "-110px";
    downImage.style.transform = "rotate(180deg)";
    calcMargin();

    downImage.removeEventListener('click', backHome);
    downImage.addEventListener('click', openMenu);

}
