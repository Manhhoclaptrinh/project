<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mario Pixel Login</title>

<style>
body {
    background: #5c94fc;
    font-family: monospace;
    text-align: center;
    color: white;
}

#gameBox {
    width: 512px;
    margin: 10px auto;
    border: 6px solid #000;
    background: #5c94fc;
}

canvas {
    image-rendering: pixelated;
    background: #5c94fc;
}

#score {
    background: #000;
    padding: 5px;
}

#loginBox {
    width: 300px;
    margin: 20px auto;
    padding: 15px;
    background: #000;
    border: 4px solid #fff;
    opacity: 0.35;
    pointer-events: none;
}

#loginBox.active {
    opacity: 1;
    pointer-events: auto;
}

input {
    width: 90%;
    padding: 6px;
}

button {
    margin-top: 10px;
    padding: 6px 20px;
    background: red;
    color: white;
    border: none;
    cursor: pointer;
}
</style>
</head>

<body>

<h2>🎮 MARIO PIXEL LOGIN</h2>
<p>SPACE để nhảy – 10 điểm để mở đăng nhập</p>

<div id="gameBox">
    <canvas id="game" width="512" height="240"></canvas>
    <div id="score">SCORE: <span id="point">0</span> / 10</div>
</div>

<div id="loginBox">
    <form action="process_login.php" method="post">
        Email<br>
        <input type="email" name="email" required><br><br>
        Password<br>
        <input type="password" name="password" required><br>
        <button>LOGIN</button>
    </form>
</div>

<script>
const canvas = document.getElementById("game");
const ctx = canvas.getContext("2d");

ctx.imageSmoothingEnabled = false;

const TILE = 8;
const GROUND = 200;

let score = 0;
let unlocked = false;

const mario = {
    x: 40,
    y: GROUND - 32,
    vy: 0,
    w: 32,
    h: 32,
    jump: false,
};

const pipe = {
    x: 520,
    y: GROUND - 32,
    w: 24,
    h: 32,
    speed: 5
};

function pixel(x, y, color) {
    ctx.fillStyle = color;
    ctx.fillRect(x, y, TILE, TILE);
}

function drawMario() {
    const px = mario.x;
    const py = mario.y;

    // mũ
    pixel(px+0,py,"red"); pixel(px+8,py,"red");
    pixel(px+16,py,"red"); pixel(px+24,py,"red");

    // mặt
    pixel(px+8,py+8,"#f1c27d");
    pixel(px+16,py+8,"#f1c27d");

    // thân
    pixel(px+8,py+16,"blue");
    pixel(px+16,py+16,"blue");

    // chân
    pixel(px+8,py+24,"brown");
    pixel(px+16,py+24,"brown");
}

function drawPipe() {
    ctx.fillStyle = "#2ecc71";
    ctx.fillRect(pipe.x, pipe.y, pipe.w, pipe.h);
}

function drawGround() {
    ctx.fillStyle = "#8B4513";
    ctx.fillRect(0, GROUND, canvas.width, 40);
}

function update() {
    ctx.clearRect(0,0,canvas.width,canvas.height);

    drawGround();

    mario.y += mario.vy;
    mario.vy += 1;

    if (mario.y >= GROUND - mario.h) {
        mario.y = GROUND - mario.h;
        mario.vy = 0;
        mario.jump = false;
    }

    pipe.x -= pipe.speed;
    if (pipe.x < -pipe.w) {
        pipe.x = canvas.width;
        score++;
        document.getElementById("point").innerText = score;

        if (score >= 10 && !unlocked) {
            unlocked = true;
            document.getElementById("loginBox").classList.add("active");
        }
    }

    // va chạm
    if (
        mario.x < pipe.x + pipe.w &&
        mario.x + mario.w > pipe.x &&
        mario.y < pipe.y + pipe.h &&
        mario.y + mario.h > pipe.y
    ) {
        score = 0;
        document.getElementById("point").innerText = score;
        pipe.x = canvas.width;
    }

    drawMario();
    drawPipe();

    requestAnimationFrame(update);
}

document.addEventListener("keydown", e => {
    if (e.code === "Space" && !mario.jump) {
        mario.vy = -14;
        mario.jump = true;
    }
});

update();
</script>

</body>
</html>
