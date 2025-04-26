var numParticles = 150;
  var radiusLines = 50;
  var corLinha =  "rgba(0, 255, 255, 0.30)";
  var ballColor = "rgba(0, 255, 255, 0.30)";
  var velocidadeMovimento = 1;
  var tamBolinhas = 1;
  
    var canvas = document.getElementById("meuCanvas");
    canvas.style.position='fixed'
    canvas.style.zIndex='-1'
    var ctx = canvas.getContext("2d");
    
    function resizeCanvas() {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    }

resizeCanvas();

    var particles = [];

    function Particle(x, y, radius) {
      this.x = x;
      this.y = y;
      this.radius = radius;
      this.color = ballColor;
      this.velocity = {
        x: (Math.random() - 0.5) * velocidadeMovimento,
        y: (Math.random() - 0.5) * velocidadeMovimento 
      };

      this.update = function() {
        this.x += this.velocity.x;
        this.y += this.velocity.y;

        if (this.x + this.radius > canvas.width || this.x - this.radius < 0) {
          this.velocity.x = -this.velocity.x;
        }
        if (this.y + this.radius > canvas.height || this.y - this.radius < 0) {
          this.velocity.y = -this.velocity.y;
        }

        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.fill();
        ctx.closePath();
      };

      this.connect = function(otherParticle) {
        
        var distance = Math.sqrt(
          Math.pow(this.x - otherParticle.x, 2) + Math.pow(this.y - otherParticle.y, 2)
        );

        if (distance < radiusLines) { 
          ctx.beginPath();
          ctx.moveTo(this.x, this.y);
          ctx.lineTo(otherParticle.x, otherParticle.y);
          ctx.strokeStyle = corLinha;
          ctx.stroke();
          ctx.closePath();
        }
      };
    }

    for (var i = 0; i < numParticles; i++) {
      var x = Math.random() * canvas.width;
      var y = Math.random() * canvas.height;
      var radius = Math.random() *tamBolinhas + 1;
      particles.push(new Particle(x, y, radius));
    }

    function animate() {
         
      requestAnimationFrame(animate);
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      for (var i = 0; i < particles.length; i++) {
        particles[i].update();
        for (var j = i + 1; j < particles.length; j++) {
          particles[i].connect(particles[j]);
        }
      }
    }


    animate();