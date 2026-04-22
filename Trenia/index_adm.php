<?php
include('api_dashboard.php');

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}
    
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inbox Dark</title>
    <style>
    #Arquivar {
        background-color: rgb(200, 50, 50);
    }

    :root {
        --bg: #0b0f14;
        --panel: #121821;
        --panel-2: #18212c;
        --panel-3: #1e2937;
        --border: #263241;
        --text: #eef4ff;
        --muted: #9aa8ba;
        --accent: #5aa9ff;
        --accent-soft: rgba(90, 169, 255, 0.14);
        --success: #46d39a;
        --warning: #ffb454;
        --shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
        --radius: 18px;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        background:
            radial-gradient(circle at top left, rgba(90, 169, 255, 0.15), transparent 28%),
            radial-gradient(circle at top right, rgba(97, 74, 255, 0.12), transparent 24%),
            var(--bg);
        color: var(--text);
        min-height: 100vh;
        padding: 24px;
    }

    button,
    input,
    textarea {
        font: inherit;
    }

    .app {
        max-width: 1380px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 260px 420px 1fr;
        gap: 18px;
        min-height: calc(100vh - 48px);
    }

    .panel {
        /* background: rgba(18, 24, 33, 0.9);*/
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        backdrop-filter: blur(2px);
        overflow: hidden;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        padding: 20px;
        gap: 18px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 8px;
    }

    .brand-badge {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #5aa9ff, #7a5cff);
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .brand h1 {
        font-size: 1.05rem;
    }

    .brand span {
        color: var(--muted);
        font-size: 0.88rem;
    }

    .compose-btn {
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, #5aa9ff, #7a5cff);
        color: white;
        padding: 14px 16px;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .compose-btn:hover {
        transform: translateY(-1px);
        opacity: 0.96;
    }

    .menu,
    .tags {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .menu-title,
    .tags-title {
        color: var(--muted);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        margin-bottom: 4px;
    }

    .menu-item,
    .tag-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        border-radius: 14px;
        color: var(--text);
        background: transparent;
        border: 1px solid transparent;
        transition: background 0.2s ease, border-color 0.2s ease;
        cursor: pointer;
    }

    .menu-item:hover,
    .tag-item:hover,
    .menu-item.active {
        background: var(--accent-soft);
        border-color: rgba(90, 169, 255, 0.25);
    }

    .menu-item small,
    .tag-item small {
        color: var(--muted);
        font-size: 0.78rem;
    }

    .contacts-card {
        margin-top: auto;
        background: linear-gradient(180deg, rgba(90, 169, 255, 0.12), rgba(90, 169, 255, 0.05));
        border: 1px solid rgba(90, 169, 255, 0.2);
        border-radius: 16px;
        padding: 16px;
    }

    .contacts-card h3 {
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .contacts-card p {
        color: var(--muted);
        font-size: 0.88rem;
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .contacts-card button {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text);
        border-radius: 12px;
        padding: 10px 12px;
        cursor: pointer;
    }

    .mail-list {
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }

    .mail-toolbar,
    .mail-view-header {
        padding: 18px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .search {
        width: 100%;
        background: var(--panel-2);
        border: 1px solid var(--border);
        color: var(--text);
        border-radius: 14px;
        padding: 13px 14px;
        outline: none;
        font-size: 0.95rem;
    }

    .search::placeholder {
        color: #6f7f92;
    }

    .mail-count {
        color: var(--muted);
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .mail-items {
        overflow: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .mail-item {
        border: 1px solid var(--border);
        background: rgba(255, 255, 255, 0.02);
        border-radius: 16px;
        padding: 14px;
        cursor: pointer;
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }

    .mail-item:hover {
        transform: translateY(-1px);
        border-color: rgba(90, 169, 255, 0.28);
        background: rgba(255, 255, 255, 0.04);
    }

    .mail-item.active {
        background: var(--accent-soft);
        border-color: rgba(90, 169, 255, 0.35);
    }

    .mail-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 8px;
    }

    .sender {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-weight: 700;
        font-size: 0.92rem;
        color: white;
        flex-shrink: 0;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    }

    .sender-meta {
        min-width: 0;
    }

    .sender-name {
        font-size: 0.95rem;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sender-email,
    .snippet,
    .meta-line {
        color: var(--muted);
        font-size: 0.84rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .subject-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 6px;
    }

    .subject {
        font-weight: 700;
        font-size: 0.95rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pill {
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        flex-shrink: 0;
    }

    .pill.primary {
        background: rgba(90, 169, 255, 0.18);
        color: #9dcbff;
    }

    .pill.success {
        background: rgba(70, 211, 154, 0.14);
        color: #88e2be;
    }

    .pill.warning {
        background: rgba(255, 180, 84, 0.14);
        color: #ffd08d;
    }

    .mail-view {
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }

    .mail-view-content {
        padding: 26px;
        overflow: auto;
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .view-subject {
        font-size: 1.6rem;
        line-height: 1.2;
    }

    .from-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 18px;
        border-radius: 18px;
        background: var(--panel-2);
        border: 1px solid var(--border);
        flex-wrap: wrap;
    }

    .from-left {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .from-details h3 {
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .from-details p {
        color: var(--muted);
        font-size: 0.9rem;
    }

    .mail-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .mail-actions button {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid var(--border);
        color: var(--text);
        border-radius: 12px;
        padding: 10px 14px;
        cursor: pointer;
    }

    .message-body {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 22px;
        color: #d9e6f5;
        line-height: 1.8;
        font-size: 0.98rem;
        white-space: pre-line;
    }

    .attachment-box {
        padding: 18px;
        border-radius: 18px;
        border: 1px dashed rgba(90, 169, 255, 0.35);
        background: rgba(90, 169, 255, 0.06);
    }

    .attachment-box strong {
        display: block;
        margin-bottom: 6px;
    }

    .attachment-box span {
        color: var(--muted);
        font-size: 0.9rem;
    }

    .empty-state {
        display: none;
        padding: 30px 18px;
        color: var(--muted);
        text-align: center;
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(3, 8, 15, 0.72);
        backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 50;
    }

    .modal-overlay.open {
        display: flex;
    }

    .compose-modal {
        width: min(720px, 100%);
        background: rgba(18, 24, 33, 0.98);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .compose-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 20px 22px;
        border-bottom: 1px solid var(--border);
        background: linear-gradient(180deg, rgba(90, 169, 255, 0.08), rgba(255, 255, 255, 0));
    }

    .compose-header h2 {
        font-size: 1.1rem;
    }

    .icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        border: 1px solid var(--border);
        background: rgba(255, 255, 255, 0.04);
        color: var(--text);
        cursor: pointer;
        font-size: 1rem;
    }

    .compose-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .field-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .field-group label {
        color: var(--muted);
        font-size: 0.85rem;
        font-weight: 600;
    }

    .field-group input,
    .field-group textarea {
        width: 100%;
        background: var(--panel-2);
        border: 1px solid var(--border);
        color: var(--text);
        border-radius: 14px;
        padding: 14px 15px;
        outline: none;
        font-size: 0.95rem;
        resize: vertical;
        font-family: inherit;
    }

    .field-group textarea {
        min-height: 220px;
        line-height: 1.7;
    }

    .field-group input:focus,
    .field-group textarea:focus {
        border-color: rgba(90, 169, 255, 0.45);
        box-shadow: 0 0 0 4px rgba(90, 169, 255, 0.08);
    }

    .compose-footer {
        padding: 18px 22px 22px;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .compose-note {
        color: var(--muted);
        font-size: 0.84rem;
    }

    .compose-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .secondary-btn,
    .send-btn {
        border-radius: 12px;
        padding: 11px 16px;
        cursor: pointer;
        font-weight: 700;
        font-size: 0.92rem;
    }

    .secondary-btn {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid var(--border);
        color: var(--text);
    }

    .send-btn {
        border: none;
        color: white;
        background: linear-gradient(135deg, #5aa9ff, #7a5cff);
    }

    .toast {
        position: fixed;
        right: 24px;
        bottom: 24px;
        background: rgba(18, 24, 33, 0.96);
        border: 1px solid rgba(70, 211, 154, 0.3);
        color: var(--text);
        border-radius: 16px;
        padding: 14px 16px;
        box-shadow: var(--shadow);
        opacity: 0;
        transform: translateY(12px);
        pointer-events: none;
        transition: opacity 0.25s ease, transform 0.25s ease;
        z-index: 60;
    }

    .toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 1120px) {
        .app {
            grid-template-columns: 220px 360px 1fr;
        }
    }

    @media (max-width: 920px) {
        .app {
            grid-template-columns: 1fr;
        }

        .sidebar {
            order: 1;
        }

        .mail-list {
            order: 2;
            min-height: 420px;
        }

        .mail-view {
            order: 3;
            min-height: 500px;
        }

        .compose-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .compose-actions {
            justify-content: stretch;
        }

        .compose-actions button {
            flex: 1;
        }
    }
    </style>
</head>

<script src="particulas.js"></script>

<body>
    <div class="app">
        <aside class="panel sidebar">
            <div class="brand">
                <div class="brand-badge">M</div>
                <div>
                    <h1>MailBox Dark</h1>
                    <span>Caixa de entrada</span>
                </div>
            </div>


        </aside>

        <section class="panel mail-list">
            <div class="mail-toolbar">

                <div class="mail-count" id="mailCount">Nenhum email encontrado.</div>
            </div>

            <div class="mail-items" id="mailItems"></div>
            <div class="empty-state" id="emptyState">Nenhum email encontrado para sua busca.</div>
        </section>

        <section class="panel mail-view">
            <div class="mail-view-header">
                <strong>Leitura</strong>
                <span class="meta-line" id="readStatus">Selecione uma mensagem</span>
            </div>

            <div class="mail-view-content" id="mailViewContent"></div>
        </section>
    </div>

    <div class="modal-overlay" id="composeModal" aria-hidden="true">
        <div class="compose-modal" role="dialog" aria-modal="true" aria-labelledby="composeTitle">
            <div class="compose-header">
                <h2 id="composeTitle">Novo email</h2>
                <button class="icon-btn" id="closeComposeBtn" aria-label="Fechar modal">✕</button>
            </div>

            <form id="composeForm">
                <div class="compose-body">
                    <div class="field-group">
                        <label for="composeTo">Para</label>
                        <input id="composeTo" name="to" type="email" placeholder="destinatario@exemplo.com" required />
                    </div>

                    <div class="field-group">
                        <label for="composeSubject">Assunto</label>
                        <input id="composeSubject" name="subject" type="text" placeholder="Digite o assunto do email"
                            required />
                    </div>

                    <div class="field-group">
                        <label for="composeMessage">Mensagem</label>
                        <textarea id="composeMessage" name="message" placeholder="Escreva sua mensagem aqui..."
                            required></textarea>
                    </div>
                </div>

                <div class="compose-footer">
                    <span class="compose-note">Simulação visual de envio de email.</span>
                    <div class="compose-actions">
                        <button type="button" class="secondary-btn" id="cancelComposeBtn">Cancelar</button>
                        <button type="submit" class="send-btn">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="toast" id="toastMessage">Email enviado com sucesso.</div>

    <script>
    const emails = [
        <?php
    echo LerEmails();
    ?>
    ];



    const mailItems = document.getElementById('mailItems');
    const mailViewContent = document.getElementById('mailViewContent');
    const searchInput = document.getElementById('searchInput');
    const mailCount = document.getElementById('mailCount');
    const emptyState = document.getElementById('emptyState');
    const readStatus = document.getElementById('readStatus');
    const composeBtn = document.getElementById('composeBtn');
    const composeModal = document.getElementById('composeModal');
    const closeComposeBtn = document.getElementById('closeComposeBtn');
    const cancelComposeBtn = document.getElementById('cancelComposeBtn');
    const composeForm = document.getElementById('composeForm');
    const composeTo = document.getElementById('composeTo');
    const composeSubject = document.getElementById('composeSubject');
    const composeMessage = document.getElementById('composeMessage');
    const toastMessage = document.getElementById('toastMessage');

    let selectedId = emails[0].id;
    let filteredEmails = [...emails];

    function getInitials(name) {
        return name
            .split(' ')
            .slice(0, 2)
            .map(part => part[0])
            .join('')
            .toUpperCase();
    }

    function renderList() {
        mailItems.innerHTML = '';
        mailCount.textContent = `${filteredEmails.length} email${filteredEmails.length !== 1 ? 's' : ''}`;

        if (!filteredEmails.length) {
            emptyState.style.display = 'block';
            return;
        }

        emptyState.style.display = 'none';

        filteredEmails.forEach(email => {
            const item = document.createElement('article');
            item.className = `mail-item ${email.id === selectedId ? 'active' : ''}`;
            item.innerHTML = `
          <div class="mail-top">
            <div class="sender">
              <div class="avatar">${getInitials(email.name)}</div>
              <div class="sender-meta">
                <div class="sender-name">${email.name}${email.unread ? ' •' : ''}</div>
                <div class="sender-email">${email.email}</div>
              </div>
            </div>
            <span class="meta-line">${email.time}</span>
          </div>
          <div class="subject-row">
            <div class="subject">${email.subject}</div>
            <span class="pill ${email.tagClass}">${email.tag}</span>
          </div>
          <div class="snippet">${email.snippet}</div>
        `;

            item.addEventListener('click', () => {
                selectedId = email.id;
                renderList();
                renderView();
            });

            mailItems.appendChild(item);
        });
    }

    function renderView() {
        const email = filteredEmails.find(item => item.id === selectedId) || emails.find(item => item.id ===
            selectedId);

        if (!email) {
            mailViewContent.innerHTML =
                '<div class="message-body">Selecione um email para visualizar o conteúdo.</div>';
            readStatus.textContent = 'Nenhuma mensagem selecionada';
            return;
        }

        readStatus.textContent = email.date;

        mailViewContent.innerHTML = `
        <div>
          <h2 class="view-subject">${email.subject}</h2>
        </div>

        <div class="from-card">
          <div class="from-left">
            <div class="avatar">${getInitials(email.name)}</div>
            <div class="from-details">
              <h3>${email.name}</h3>
              <p>${email.email}</p>
            </div>
          </div>

          <div class="mail-actions">
            <button id="Arquivar">Apagar</button>
          </div>
        </div>

        <div class="message-body">${email.body}</div>

         
      `;

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        })
        document.getElementById('Arquivar').addEventListener('click', () => {
            //alert(email.id)
            fetch('api_dashboard.php?apagarEmail=' + email.id)
                .then(response => response.text())
                .then(html => {
                    window.location.reload()
                })
        })
    }

    function applySearch() {
        const term = searchInput.value.toLowerCase().trim();

        filteredEmails = emails.filter(email => {
            return [email.name, email.email, email.subject, email.snippet, email.body, email.tag]
                .join(' ')
                .toLowerCase()
                .includes(term);
        });

        if (!filteredEmails.some(email => email.id === selectedId) && filteredEmails.length) {
            selectedId = filteredEmails[0].id;
        }

        renderList();
        renderView();
    }

    function openComposeModal() {
        composeModal.classList.add('open');
        composeModal.setAttribute('aria-hidden', 'false');
        setTimeout(() => composeTo.focus(), 50);
    }

    function closeComposeModal() {
        composeModal.classList.remove('open');
        composeModal.setAttribute('aria-hidden', 'true');
    }

    function resetComposeForm() {
        composeForm.reset();
    }

    function showToast(message) {
        toastMessage.textContent = message;
        toastMessage.classList.add('show');
        clearTimeout(showToast.timeoutId);
        showToast.timeoutId = setTimeout(() => {
            toastMessage.classList.remove('show');
        }, 2400);
    }

    function formatPreviewTime() {
        const now = new Date();
        return now.toLocaleTimeString('pt-BR', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function formatFullDate() {
        const now = new Date();
        return `Hoje, ${now.toLocaleTimeString('pt-BR', {
        hour: '2-digit',
        minute: '2-digit'
      })}`;
    }

    function createSentEmail(event) {
        event.preventDefault();

        const to = composeTo.value.trim();
        const subject = composeSubject.value.trim();
        const message = composeMessage.value.trim();

        if (!to || !subject || !message) return;

        const recipientName = to.split('@')[0]
            .split(/[._-]/)
            .filter(Boolean)
            .map(part => part.charAt(0).toUpperCase() + part.slice(1))
            .join(' ') || 'Destinatário';

        const newEmail = {
            id: Date.now(),
            name: recipientName,
            email: to,
            subject,
            snippet: message.replace(/\s+/g, ' ').slice(0, 90) + (message.length > 90 ? '...' : ''),
            body: message,
            time: formatPreviewTime(),
            date: formatFullDate(),
            tag: 'Enviado',
            tagClass: 'primary',
            attachment: '',
            unread: false
        };

        emails.unshift(newEmail);
        selectedId = newEmail.id;
        applySearch();
        closeComposeModal();
        resetComposeForm();
        renderView();
        showToast('Email enviado com sucesso.');
    }

    //composeBtn.addEventListener('click', openComposeModal);
    closeComposeBtn.addEventListener('click', closeComposeModal);
    cancelComposeBtn.addEventListener('click', () => {
        closeComposeModal();
        resetComposeForm();
    });

    composeModal.addEventListener('click', event => {
        if (event.target === composeModal) {
            closeComposeModal();
        }
    });

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && composeModal.classList.contains('open')) {
            closeComposeModal();
        }
    });


    renderList();
    renderView();
    </script>
</body>

</html>