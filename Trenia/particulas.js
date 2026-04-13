function ehMobile() {
  return /Android|iPhone|iPad|iPod|Opera Mini|IEMobile|WPDesktop/i.test(navigator.userAgent);
}


var w, h, loopId, id, canvas, ctx, particles;

//cores aleatorias
var rgb1 = 179;//Math.floor(Math.random() * 256);
var rgb2 = 40;//Math.floor(Math.random() * 256);
var rgb3 = 220;//Math.floor(Math.random() * 256);

var rgb4 = 43;//Math.floor(Math.random() * 256);
var rgb5 = 185;//Math.floor(Math.random() * 256);
var rgb6 = 220;//Math.floor(Math.random() * 256);

var options = {
  lineColor: "rgb(" + rgb1 + "," + rgb2 + "," + rgb3 + ")", //cor da bolinha
  particleColor: "rgb(" + rgb4 + "," + rgb5 + "," + rgb6 + ")", //cor da linha
  particleAmount: 200, //quantidade de bolinhas na tela
  defaultRadius: 0.5, //tamanho minimo da bolinha
  variantRadius: 1.5, //variacao do tamanho da bolinha (pra menos e pra mais)
  defaultSpeed: 0.1, //velocidade de moviemento
  variantSpeed: 0.2, //variacao da velocidade de movimento
  linkRadius: 180, //distancia que elas se ligam
  linha: 0.1, //largura da linha que liga as bolinhas
};

if (ehMobile()) {
  options.particleAmount = 80
}  

var rgb = options.lineColor.match(/\d+/g);

document.addEventListener("DOMContentLoaded", init);

function init() {
  document.body.innerHTML =
    '<canvas id="canvas" style="z-index: -1; position: fixed;left: -10px; top: -10px"></canvas>' +document.body.innerHTML

  while (!document.getElementById("canvas")) {}
  canvas = document.getElementById("canvas");
  ctx = canvas.getContext("2d");
  resizeReset();
  initialiseElements();
  startAnimation();
}

function resizeReset() {
  w = canvas.width = window.innerWidth ;
  h = canvas.height = window.innerHeight;
}

function initialiseElements() {
  particles = [];
  for (var i = 0; i < options.particleAmount; i++) {
    particles.push(new Particle());
  }
}

function startAnimation() {
  loopId = requestAnimationFrame(animationLoop);
}

function animationLoop() {
  ctx.clearRect(0, 0, w, h);
  drawScene();

  id = requestAnimationFrame(animationLoop);
}

function drawScene() {
  drawLine();
  drawParticle();
}

function drawParticle() {
  for (var i = 0; i < particles.length; i++) {
    particles[i].update();
    particles[i].draw();
  }
}

function drawLine() {
  for (var i = 0; i < particles.length; i++) {
    linkPoints(particles[i], particles);
  }
}

function linkPoints(point, hubs) {
  for (var i = 0; i < hubs.length; i++) {
    var distance = checkDistance(point.x, point.y, hubs[i].x, hubs[i].y);
    var opacity = 1 - distance / options.linkRadius;
    if (opacity > 0) {
      ctx.lineWidth = options.linha;
      ctx.strokeStyle =
        "rgba(" + rgb[0] + "," + rgb[1] + "," + rgb[2] + "," + opacity + ")";
      ctx.beginPath();
      ctx.moveTo(point.x, point.y);
      ctx.lineTo(hubs[i].x, hubs[i].y);
      ctx.closePath();
      ctx.stroke();
    }
  }
}

function checkDistance(x1, y1, x2, y2) {
  return Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
}

Particle = function () {
  var _this = this;

  _this.x = Math.random() * w;
  _this.y = Math.random() * h;
  _this.color = options.particleColor;
  _this.radius = options.defaultRadius + Math.random() * options.variantRadius;
  _this.speed = options.defaultSpeed + Math.random() * options.variantSpeed;
  _this.directionAngle = Math.floor(Math.random() * 360);
  _this.vector = {
    x: Math.cos(_this.directionAngle) * _this.speed,
    y: Math.sin(_this.directionAngle) * _this.speed,
  };

  _this.update = function () {
    _this.border();
    _this.x += _this.vector.x;
    _this.y += _this.vector.y;
  };

  _this.border = function () {
    if (_this.x >= w || _this.x <= 0) {
      _this.vector.x *= -1;
    }
    if (_this.y >= h || _this.y <= 0) {
      _this.vector.y *= -1;
    }
    if (_this.x > w) _this.x = w;
    if (_this.y > h) _this.y = h;
    if (_this.x < 0) _this.x = 0;
    if (_this.y < 0) _this.y = 0;
  };

  _this.draw = function () {
    ctx.beginPath();
    ctx.arc(_this.x, _this.y, _this.radius, 0, Math.PI * 2);
    ctx.closePath();
    ctx.fillStyle = _this.color;
    ctx.fill();
  };
};
