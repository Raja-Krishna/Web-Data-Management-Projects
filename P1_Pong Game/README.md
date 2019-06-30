# Pong Game

The goal of this project is to learn client-side web programming using JavaScript and AJAX. More specifically, you will create a Web application that displays information about movies.


You need to write a JavaScript file pong.js, used in the file pong.html, that implements the following actions:

* initialize: initialize the game
* startGame: starts the game (when you click the mouse)
* setSpeed: sets the speed to 0 (slow), 1 (medium), 2 (fast)
* resetCounter: resets the score to zero
* movePaddle: moves the paddle up and down, by following the mouse


**Description:**

The pong court is 800x500px, the pong ball is 20x20px, and the paddle is 102x14px. When you click on the Start button or left-click on the court, the ball must start from a random place at the left border of the court at a random angle between -π/4 and π/4. The paddle can move up and down on the right border by just moving the mouse (without clicking the mouse). The ball bounces on the left, top, and bottom borders of the court. Everytime you hit the ball with the paddle, you add one strike. If the ball crosses the right border (the dotted line), the game is suspended and the strikes so far becomes your score. You would need to click on the Start button or click on the court to restart with a zero number of strikes. So the goal of this game is to move the paddle to protect the right border by hitting the ball.

**Hints:**

* The position of any element is dictated by the three style properties: position, left, and top. If an element is nested inside another and its position is "absolute", the top and left properties are relative to the enclosing element.  
  &lt;p id="x" style="position: absolute; left: 50px; top: 100px;"> ... </p&gt;  
  To move this element, just change the left/top attributes using code:  
  document.getElementById("x").style.top = "10px";

* Note that the values that you set the left/top attributes must have units (e.g., "10px"). It will not work if you set them to numbers.
* You can get the X and Y coordinates of the mouse using the pageX and pageY attributes of an event (e.g., from the event that is passed on the onmousemove handler).
* To animate an element, it must be moved by small amounts, many times, in rapid succession. For example, you can use setTimeout("fun()", n) that calls fun() after a delay of n milliseconds (you have to put it in a loop or use recurion).
* It will be easier to develop your code by first ignoring the paddle and making all the court borders solid, so the ball will bounce on every border. After you make this work, you can change your code so that the ball that tries to cross the right border bounces if it hits the paddle. You need to define a time period (the "tick") dt to calculate the new x/y coordinates from the current. The speed coordinates vx/vy are determined when the ball is kick-started (from the kick angle). The new x is x+vx*dt, but if the new value is beyond the right border, then the ball must be bounced by seting vx = -vx and x = 2*width-x, assuming that the court x-coordinates are from 0 to width. You do something similar for the left, top, and, bottom borders.

**Note:** You should use plain JavaScript. You should not use any JavaScript library, such as JQuery. You should not use the JavaScript canvas object.