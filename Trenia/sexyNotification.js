function msgbox(titulo, texto, tempo = 1000, layout = 0, corFundo = 'green', corfonte = 'aliceblue', borderradius = true, textoCentralizado = false) {
    var topo = 10;
    var opacidade = 0.0;
    const rect = document.createElement('div');
    rect.style.position = 'fixed';
    rect.style.zIndex = '10000';
    rect.style.minWidth = '25%';
    rect.style.maxWidth = '50%';

    //rect.style.height = '100px';
    if (borderradius) {
        rect.style.borderRadius = '10px';
    }
    rect.style.backgroundColor = corFundo;




    rect.style.padding = '10px';
    rect.style.opacity = opacidade;


    const titlee = document.createElement('span');
    titlee.innerHTML = titulo;
    titlee.style.color = corfonte;

    const alerta = document.createElement('span');
    alerta.innerHTML = '<br>' + texto;
    alerta.style.color = corfonte;


    rect.appendChild(titlee);
    rect.appendChild(alerta);
    document.body.appendChild(rect);

    switch (layout) {
        case 0:
            rect.style.right = '10px';
            topo = 10;
            rect.style.top = topo + 'px';
            if (textoCentralizado) { rect.style.textAlign = 'center'; }
            else { rect.style.textAlign = 'right'; }
            break;
        case 1:
            rect.style.left = '10px';
            topo = 10;
            rect.style.top = topo + 'px';
            if (textoCentralizado) { rect.style.textAlign = 'center'; }
            else { rect.style.textAlign = 'left'; }
            break;
        case 2:
            rect.style.left = '10px';
            topo = 10;
            rect.style.bottom = topo + 'px';
            if (textoCentralizado) { rect.style.textAlign = 'center'; }
            else { rect.style.textAlign = 'left'; }
            break;

        case 3:
            rect.style.right = '10px';
            topo = 10;
            rect.style.bottom = topo + 'px';
            if (textoCentralizado) { rect.style.textAlign = 'center'; }
            else { rect.style.textAlign = 'right'; }
            break;


        case 4:

            rect.style.right = ((window.innerWidth / 2) - (rect.offsetWidth / 2)) + 'px';
            topo = 10;
            rect.style.top = topo + 'px';

            rect.style.textAlign = 'center';
            break;

        case 5:
            rect.style.right = ((window.innerWidth / 2) - (rect.offsetWidth / 2)) + 'px';
            rect.style.top = ((window.innerHeight / 2) - (rect.offsetHeight / 2)) + 'px';

            rect.style.textAlign = 'center';
            break;

        case 6:
            rect.style.right = ((window.innerWidth / 2) - (rect.offsetWidth / 2)) + 'px';
            topo = 10;
            rect.style.bottom = topo + 'px';

            rect.style.textAlign = 'center';
            break;

        default:
            rect.style.right = '10px';
            topo = 10;
            rect.style.top = topo + 'px';
            if (textoCentralizado) { rect.style.textAlign = 'center'; }
            else { rect.style.textAlign = 'right'; }
            break;
    }

    var lp = setInterval(() => {
        if (opacidade <= 0.9) {
            opacidade += 0.02;
            rect.style.opacity = opacidade;
        }
        else {
            clearInterval(lp);
            setTimeout(() => {
                var loop = setInterval(() => {
                    if (topo !== window.innerHeight) {
                        topo++;

                        if (layout === 0 || layout === 1) { rect.style.top = topo + 'px'; }

                        opacidade -= 0.002;
                        rect.style.opacity = opacidade;
                    }
                    else {

                        clearInterval(loop);
                        rect.remove();
                    }


                }, 1);
            }, tempo);
        }


    }, 1);

}