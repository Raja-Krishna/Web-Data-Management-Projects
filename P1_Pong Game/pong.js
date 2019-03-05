var ballpos;
var top1;
var ypad;
var sa;
var dx;
var dy;
var interval;
var newx, newy;
var currentSpeed;
var topx;
var leftx;
var padx, pady;
var currentScore;
var maxscore;

/*eslint-env browser*/

function initialize() {

    top1 = Math.floor(Math.random() * 400) - 20;
    maxscore = 0;
    newx = 0;
    newy = top1;
    currentSpeed = 1;
    currentScore = 0;

    document.getElementById("ball").style.top = "0px";
    sa = 0;

}


function startGame() {
    initialize();
    topx = document.getElementById("ball").style.top = top1 + 'px';
    leftx = document.getElementById("ball").style.left = "0px";

    sa = Math.floor(Math.random() * 90) - 45;
    dx = Math.cos(sa * Math.PI / 180);
    dy = Math.sin(sa * Math.PI / 180);

    if (dy < 0.3) {
        dy = Math.sin(Math.random() * 0.45) - 1;
    }
    clearInterval(interval);
    interval = setInterval("movB()", 0.5);

}

function setSpeed(randspeed) {

    currentSpeed = (randspeed * 1) + 1;

}

function movePaddle(event) {

    ypad = event.pageY;

    if (ypad >= 0 && ypad <= 398)

        document.getElementById("paddle").style.top = ypad + 'px';
}

function strikes() {

    currentScore = currentScore + 1;
    document.getElementById("strikes").innerHTML = currentScore;
}

function resetGame() {
    maxscore = currentScore;
    document.getElementById("strikes").innerHTML = 0;
    top1 = Math.floor(Math.random() * 400) - 20;

    newx = 0;
    newy = top1;
    currentSpeed = 1;
    currentScore = 0;
    document.getElementById("ball").style.top = "0px";
    sa = 0;

}

function movB() {

    padx = document.getElementById("paddle").getBoundingClientRect().top;
    pady = document.getElementById("paddle").getBoundingClientRect().left;
    newx = newx + (currentSpeed * dx);
    newy = newy + (currentSpeed * dy);

    if (newx < 0) {
        dx = -dx;
    }

    if ((newy <= -82) || (newy >= 398)) {

        dy = -dy;
    }

    var paddlePosition = document.getElementById("paddle").getBoundingClientRect();
    if (newx >= 760 && newy >= paddlePosition.y - 250 && newy <= paddlePosition.y - 160) {
        console.log(newy, paddlePosition.y)
        strikes();
        dx = -dx;
    } else if (newx >= pady) {
        resetGame();
        console.log(newy, paddlePosition.y)

    }


    document.getElementById("score").innerHTML = maxscore;

    if (maxscore > score)

        document.getElementById("score").innerHTML = maxscore;
    document.getElementById("ball").style.top = newy + 'px';
    document.getElementById("ball").style.left = newx + 'px';

}