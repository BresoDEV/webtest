function joaat(text) {
  if (!text) {
    return 0;
  }
  var value = 0, temp;
  var index = 0;
  var quoted = false;
  if (text.charCodeAt(index) === 34) {
    quoted = true;
    index = (index + 1) | 0;
  }
  //text = text.toLowerCase();
  for (; index < text.length; index = (index + 1) | 0) {
    var v = text.charCodeAt(index);
    if (quoted && (v === 34)) {
      break;
    }
    if (v === 92) {
      v = 47;
    }
    temp = v;
    temp = (temp + value) >>> 0;
    value = (temp << 10) >>> 0;
    temp = (temp + value) >>> 0;
    value = temp >>> 6;
    value = (value ^ temp) >>> 0;
  }
  temp = (value << 3) >>> 0;
  temp = (value + temp) >>> 0;
  var temp2 = temp >>> 11;
  temp = (temp2 ^ temp) >>> 0;
  temp2 = (temp << 15) >>> 0;
  value = (temp2 + temp) >>> 0;
  if (value < 2) {
    value = (value + 2) >>> 0;
  }
  return value.toString(16).toUpperCase();
}


function getEstrelas(q) {
  //&#9733;
  if (q >= 0 && q <= 19) {
    return '<font style="color:gold">&#9733;</font>&#9733;&#9733;&#9733;&#9733;'
  }
  if (q >= 20 && q <= 39) {
    return '<font style="color:gold">&#9733;&#9733;</font>&#9733;&#9733;&#9733;'
  }
  if (q >= 40 && q <= 59) {
    return '<font style="color:gold">&#9733;&#9733;&#9733;</font>&#9733;&#9733;'
  }
  if (q >= 60 && q <= 79) {
    return '<font style="color:gold">&#9733;&#9733;&#9733;&#9733;</font>&#9733;'
  }
  if (q >= 80 && q <= 100) {
    return '<font style="color:gold">&#9733;&#9733;&#9733;&#9733;&#9733;</font>'
  }

}

function gerarPrompt() {
  const areaAtual = localStorage.getItem('flashcards_area');
  const assuntoAtual = localStorage.getItem('flashcards_assunto');
  const levelAtual = localStorage.getItem('flashcards_assunto_' + assuntoAtual);

  const _1 = 'Preciso que crie uma pergunta sobre a area ' + areaAtual + ', sobre o assunto ' + assuntoAtual
  const _2 = ',juntamente com a resposta da pergunta,e uma dica da resposta, no formato "pergunta$$resposta$$dica$$". '
  const _3 = 'O grau de dificuldade da questao, deve ser ' + levelAtual + '/100.'
  const _4 = 'Preciso apenas disso, sem outros textos adicionais'

  return _1 + _2 + _3 + _4;
}

var tentativas = 0;

function ia() {

  //console.log(pergunta)

  fetch('https://text.pollinations.ai/prompt/' + encodeURIComponent(gerarPrompt()) + '?seed=' + Math.floor(Math.random() * 9999)) // substitua pelo site desejado
    .then(response => response.text()) // pega o HTML como texto
    .then(html => {

      for (var i = 0; i < 100; i++) {
        html = html.replace("```node", "")
        html = html.replace("```javascript", "")
        html = html.replace("```js", "")
        html = html.replace("```bash", "")
        html = html.replace("```cpp", "")
        html = html.replace("```csharp", "")
        html = html.replace("```html", "")
        html = html.replace("```ruby", "")
        html = html.replace("```lua", "")
        html = html.replace("```markdown", "")
        html = html.replace("```css", "")
    }
    for (var i = 0; i < 100; i++) {
        html = html.replace("\n", "<br>")
        html = html.replace("```", "")
        html = html.replace("**", "")
        html = html.replace("###", "")
    }


      if (html.split('$$')[2]) {
        global_pergunta = html.split('$$')[0]
        global_resposta = html.split('$$')[1]
        global_dica = html.split('$$')[2]
        tentativas = 0;
      } else {
        if (tentativas != 5) {
          tentativas++
          ia()
        } else {
          global_pergunta = 'Erro de conexão, tente novamente'
          global_resposta = 'Erro de conexão, tente novamente'
          global_dica = 'Erro de conexão, tente novamente'
        }
      }

    })
    .catch(err => {
      if (tentativas != 5) {
        tentativas++
        ia()
      } else {
        global_pergunta = 'Erro de conexão, tente novamente'
        global_resposta = 'Erro de conexão, tente novamente'
        global_dica = 'Erro de conexão, tente novamente'
      }
    });
}


var global_pergunta = ''
var global_resposta = ''
var global_dica = ''