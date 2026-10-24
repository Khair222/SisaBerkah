<!-- ========================================================
     BERKAHBOT AI CHATBOT WIDGET — SISABERKAH
     Icon: Mascot Robot SisaBerkah (berkahbot-circle.png)
     AI Model: Gemini 2.5 Flash
     ======================================================== -->

<div id="berkahbot-widget-container">
  <!-- Floating Tooltip Greeting (Clean & Compact) -->
  <div id="berkahbot-tooltip" class="berkahbot-tooltip" onclick="toggleBerkahBotChat(event)">
    <span>Tanya BerkahBot AI</span>
    <button type="button" class="berkahbot-tooltip-close" id="berkahbot-tooltip-close" title="Tutup" onclick="closeBerkahBotTooltip(event)">&times;</button>
  </div>

  <!-- Floating Launcher Button (Compact Circular Ring, NO login required) -->
  <button
    type="button"
    id="berkahbot-launcher"
    class="berkahbot-launcher"
    aria-label="Buka Chatbot BerkahBot"
    title="Tanya BerkahBot AI"
    onclick="toggleBerkahBotChat(event)"
  >
    <img src="{{ asset('assets/images/berkahbot-circle.png') }}" alt="BerkahBot AI Avatar" class="berkahbot-avatar-img">
    <span class="berkahbot-online-badge" title="Online"></span>
    <span class="berkahbot-close-overlay" id="berkahbot-launcher-close">&times;</span>
  </button>

  <!-- Chatbot Window Popup (Compact & Sleek) -->
  <div id="berkahbot-window" class="berkahbot-window" aria-hidden="true" onclick="event.stopPropagation()">
    <!-- Header -->
    <div class="berkahbot-header">
      <div class="berkahbot-header-info">
        <div class="berkahbot-header-avatar">
          <img src="{{ asset('assets/images/berkahbot-circle.png') }}" alt="BerkahBot" class="berkahbot-header-img">
        </div>
        <div class="berkahbot-header-text">
          <div class="berkahbot-header-title-row">
            <h3 class="berkahbot-title">BerkahBot</h3>
            <span class="berkahbot-badge">AI Assistant</span>
          </div>
          <p class="berkahbot-subtitle">
            <span class="berkahbot-status-dot"></span>
            Asisten Cerdas SisaBerkah
          </p>
        </div>
      </div>
      <div class="berkahbot-header-actions">
        <button type="button" class="berkahbot-action-btn" id="berkahbot-btn-reset" title="Mulai Obrolan Baru" onclick="resetBerkahBotChat(event)">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12a9 9 0 0 1 15-6.7L21 8"></path>
            <path d="M21 3v5h-5"></path>
            <path d="M21 12a9 9 0 0 1-15 6.7L3 16"></path>
            <path d="M3 21v-5h5"></path>
          </svg>
        </button>
        <button type="button" class="berkahbot-action-btn" id="berkahbot-btn-close" title="Tutup Chat" onclick="toggleBerkahBotChat(event, false)">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>

    <!-- Messages Container -->
    <div class="berkahbot-messages" id="berkahbot-messages">
      <!-- Welcome Message -->
      <div class="berkahbot-msg-group bot">
        <div class="berkahbot-msg-avatar">
          <img src="{{ asset('assets/images/berkahbot-circle.png') }}" alt="BerkahBot">
        </div>
        <div class="berkahbot-msg-bubble">
          <p>Halo! 👋 Saya <strong>BerkahBot</strong>, asisten AI resmi SisaBerkah.</p>
          <p>Anda bisa langsung bertanya apa saja seputar pengolahan limbah organik dapur, panduan <strong>Maggot BSF</strong>, pembuatan <strong>kompos</strong> tanpa bau, info <strong>eco-enzyme</strong>, hingga mencari <strong>mitra terdekat</strong>.</p>
          <p style="margin-top: 5px; font-size: 0.78rem; color: #6EE7B7;">Ada yang ingin Anda tanyakan?</p>
        </div>
      </div>

      <!-- Quick Suggested Chips -->
      <div class="berkahbot-chips-wrap" id="berkahbot-chips">
        <div class="berkahbot-chips-title">Rekomendasi Pertanyaan:</div>
        <div class="berkahbot-chips-grid">
          <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Bagaimana cara mengolah sampah sisa makanan dapur agar tidak menimbulkan bau?">
            Cara Olah Sampah Dapur
          </button>
          <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Apa saja pakan favorit larva maggot BSF dan tips perawatannya?">
            Panduan Maggot BSF
          </button>
          <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Bagaimana rasio bahan hijau dan cokelat untuk membuat kompos yang benar?">
            Pembuatan Kompos
          </button>
          <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Siapa saja mitra penerima pasokan aktif di SisaBerkah dan lokasinya?">
            Mitra SisaBerkah
          </button>
          <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Kenapa kita dilarang keras membakar sampah organik?">
            Bahaya Bakar Sampah
          </button>
        </div>
      </div>
    </div>

    <!-- Typing Indicator -->
    <div class="berkahbot-typing" id="berkahbot-typing" style="display: none;">
      <div class="berkahbot-msg-avatar" style="width: 22px; height: 22px;">
        <img src="{{ asset('assets/images/berkahbot-circle.png') }}" alt="BerkahBot">
      </div>
      <div class="berkahbot-typing-bubble">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>
      <span class="berkahbot-typing-text">BerkahBot sedang mengetik...</span>
    </div>

    <!-- Input Form -->
    <form class="berkahbot-input-form" id="berkahbot-form" onsubmit="handleChatSubmit(event)">
      <div class="berkahbot-input-container">
        <textarea
          id="berkahbot-input"
          class="berkahbot-input"
          rows="1"
          placeholder="Tanya ke BerkahBot tanpa perlu login..."
          autocomplete="off"
          maxlength="1000"
          oninput="handleChatInput(this)"
          onkeydown="handleChatKeydown(event)"
        ></textarea>
        <button type="submit" id="berkahbot-send-btn" class="berkahbot-send-btn" title="Kirim Pesan" disabled>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
            <line x1="22" y1="2" x2="11" y2="13"></line>
            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
          </svg>
        </button>
      </div>
    </form>

    <!-- Custom Reset Confirmation Modal Popup (Replaces native browser confirm) -->
    <div id="berkahbot-reset-modal" class="berkahbot-reset-modal" aria-hidden="true" onclick="closeResetModal(event)">
      <div class="berkahbot-modal-card" onclick="event.stopPropagation()">
        <div class="berkahbot-modal-icon-badge">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12a9 9 0 0 1 15-6.7L21 8"></path>
            <path d="M21 3v5h-5"></path>
            <path d="M21 12a9 9 0 0 1-15 6.7L3 16"></path>
            <path d="M3 21v-5h5"></path>
          </svg>
        </div>
        <h4 class="berkahbot-modal-title">Mulai Obrolan Baru?</h4>
        <p class="berkahbot-modal-desc">
          Riwayat obrolan ini akan diatur ulang. Anda akan memulai percakapan baru dengan BerkahBot.
        </p>
        <div class="berkahbot-modal-actions">
          <button type="button" class="berkahbot-modal-btn berkahbot-btn-cancel" onclick="closeResetModal(event)">
            Batal
          </button>
          <button type="button" class="berkahbot-modal-btn berkahbot-btn-confirm" onclick="confirmResetChat(event)">
            Mulai Baru
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  #berkahbot-widget-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 999999;
    font-family: inherit;
    pointer-events: auto;
  }

  /* Tooltip Balloon (Clean & Compact) */
  .berkahbot-tooltip {
    position: absolute;
    bottom: 64px;
    right: 2px;
    background: #064E3B;
    color: #ECFDF5;
    border: 1px solid rgba(52, 211, 153, 0.4);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35), 0 0 12px rgba(16, 185, 129, 0.2);
    border-radius: 9999px;
    padding: 0.38rem 0.8rem;
    font-size: 0.76rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.45rem;
    white-space: nowrap;
    animation: berkahbotFloat 3s ease-in-out infinite, berkahbotFadeIn 0.3s ease forwards;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .berkahbot-tooltip::after {
    content: '';
    position: absolute;
    bottom: -5px;
    right: 24px;
    width: 9px;
    height: 9px;
    background: #064E3B;
    border-right: 1px solid rgba(52, 211, 153, 0.4);
    border-bottom: 1px solid rgba(52, 211, 153, 0.4);
    transform: rotate(45deg);
  }

  .berkahbot-tooltip-close {
    background: transparent;
    border: none;
    color: #A7F3D0;
    font-size: 1rem;
    cursor: pointer;
    padding: 0;
    line-height: 1;
    transition: color 0.2s;
  }
  .berkahbot-tooltip-close:hover {
    color: #FFFFFF;
  }

  /* Launcher Button: Compact Circular Mascot Ring (56px) */
  .berkahbot-launcher {
    position: relative;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: transparent;
    border: none;
    padding: 0;
    margin: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    filter: drop-shadow(0 6px 14px rgba(0, 0, 0, 0.4)) drop-shadow(0 0 10px rgba(34, 197, 94, 0.35));
    transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), filter 0.25s ease;
    outline: none;
  }

  .berkahbot-launcher:hover {
    transform: scale(1.08) translateY(-2px);
    filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5)) drop-shadow(0 0 16px rgba(52, 211, 153, 0.55));
  }

  .berkahbot-launcher:active {
    transform: scale(0.95);
  }

  .berkahbot-avatar-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
    border-radius: 50%;
    pointer-events: none;
    transition: transform 0.25s ease;
  }

  /* Online Status Badge */
  .berkahbot-online-badge {
    position: absolute;
    top: 1px;
    right: 1px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #22C55E;
    border: 2px solid #FFFFFF;
    box-shadow: 0 0 6px rgba(34, 197, 94, 0.9);
    z-index: 2;
    pointer-events: none;
  }

  /* Close Overlay Icon on Launcher */
  .berkahbot-close-overlay {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(6, 78, 59, 0.94);
    border: 2px solid #34D399;
    color: #FFFFFF;
    font-size: 1.7rem;
    font-weight: 300;
    line-height: 1;
    display: none;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
  }

  .berkahbot-launcher.active .berkahbot-close-overlay {
    display: flex;
  }
  .berkahbot-launcher.active .berkahbot-online-badge {
    display: none;
  }

  /* Chatbot Window Popup: Sleek, Compact (340px x 460px) */
  .berkahbot-window {
    position: absolute;
    bottom: 68px;
    right: 0;
    width: 340px;
    max-width: calc(100vw - 28px);
    height: 460px;
    max-height: calc(100vh - 90px);
    background: linear-gradient(180deg, #09261C 0%, #051811 100%);
    border: 1px solid rgba(52, 211, 153, 0.28);
    border-radius: 18px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6), 0 0 30px rgba(16, 185, 129, 0.15);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(14px) scale(0.96);
    transform-origin: bottom right;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    backdrop-filter: blur(14px);
  }

  .berkahbot-window.open {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0) scale(1);
  }

  /* Header (Compact) */
  .berkahbot-header {
    padding: 0.65rem 0.95rem;
    background: rgba(4, 28, 20, 0.92);
    border-bottom: 1px solid rgba(52, 211, 153, 0.18);
    display: flex;
    align-items: center;
    justify-content: space-between;
    backdrop-filter: blur(8px);
  }

  .berkahbot-header-info {
    display: flex;
    align-items: center;
    gap: 0.6rem;
  }

  .berkahbot-header-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.35));
  }

  .berkahbot-header-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
  }

  .berkahbot-title {
    margin: 0;
    font-size: 0.95rem;
    font-weight: 700;
    color: #F0FDF4;
    letter-spacing: -0.01em;
  }

  .berkahbot-header-title-row {
    display: flex;
    align-items: center;
    gap: 0.4rem;
  }

  .berkahbot-badge {
    background: linear-gradient(135deg, #22C55E, #10B981);
    color: #022C22;
    font-size: 0.62rem;
    font-weight: 800;
    padding: 0.1rem 0.4rem;
    border-radius: 9999px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }

  .berkahbot-subtitle {
    margin: 0.1rem 0 0 0;
    font-size: 0.7rem;
    color: #86EFAC;
    display: flex;
    align-items: center;
    gap: 0.3rem;
  }

  .berkahbot-status-dot {
    width: 6px;
    height: 6px;
    background: #22C55E;
    border-radius: 50%;
    box-shadow: 0 0 5px #22C55E;
    display: inline-block;
  }

  .berkahbot-header-actions {
    display: flex;
    align-items: center;
    gap: 0.3rem;
  }

  .berkahbot-action-btn {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(52, 211, 153, 0.18);
    color: #D1FAE5;
    width: 28px;
    height: 28px;
    border-radius: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
  }

  .berkahbot-action-btn:hover {
    background: rgba(34, 197, 94, 0.2);
    color: #FFFFFF;
    border-color: rgba(34, 197, 94, 0.5);
  }

  /* Messages Container (Compact) */
  .berkahbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 0.85rem;
    display: flex;
    flex-direction: column;
    gap: 0.7rem;
    scroll-behavior: smooth;
  }

  .berkahbot-messages::-webkit-scrollbar {
    width: 4px;
  }
  .berkahbot-messages::-webkit-scrollbar-track {
    background: transparent;
  }
  .berkahbot-messages::-webkit-scrollbar-thumb {
    background: rgba(52, 211, 153, 0.25);
    border-radius: 9999px;
  }

  /* Message Groups */
  .berkahbot-msg-group {
    display: flex;
    gap: 0.55rem;
    max-width: 90%;
    animation: berkahbotMsgIn 0.22s ease-out forwards;
  }

  .berkahbot-msg-group.bot {
    align-self: flex-start;
  }

  .berkahbot-msg-group.user {
    align-self: flex-end;
    flex-direction: row-reverse;
  }

  .berkahbot-msg-avatar {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
  }

  .berkahbot-msg-avatar img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
  }

  .berkahbot-msg-bubble {
    padding: 0.6rem 0.85rem;
    border-radius: 14px;
    font-size: 0.82rem;
    line-height: 1.48;
    word-break: break-word;
  }

  .berkahbot-msg-group.bot .berkahbot-msg-bubble {
    background: #0E2E23;
    border: 1px solid rgba(52, 211, 153, 0.2);
    color: #E2E8F0;
    border-top-left-radius: 3px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.25);
  }

  .berkahbot-msg-group.user .berkahbot-msg-bubble {
    background: linear-gradient(135deg, #15803D 0%, #166534 100%);
    border: 1px solid rgba(34, 197, 94, 0.4);
    color: #FFFFFF;
    border-top-right-radius: 3px;
    box-shadow: 0 3px 12px rgba(21, 128, 61, 0.3);
  }

  .berkahbot-msg-bubble p {
    margin: 0 0 0.35rem 0;
  }
  .berkahbot-msg-bubble p:last-child {
    margin-bottom: 0;
  }

  .berkahbot-msg-bubble ul,
  .berkahbot-msg-bubble ol {
    margin: 0.25rem 0 0.25rem 0.95rem;
    padding: 0;
  }

  .berkahbot-msg-bubble li {
    margin-bottom: 0.2rem;
  }

  .berkahbot-msg-bubble strong {
    color: #4ADE80;
    font-weight: 700;
  }
  .berkahbot-msg-group.user .berkahbot-msg-bubble strong {
    color: #FEF08A;
  }

  /* Quick Suggestion Chips */
  .berkahbot-chips-wrap {
    margin-top: 0.15rem;
    padding-left: 2rem;
    animation: berkahbotMsgIn 0.25s ease-out forwards;
  }

  .berkahbot-chips-title {
    font-size: 0.68rem;
    color: #86EFAC;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.04em;
    margin-bottom: 0.35rem;
  }

  .berkahbot-chips-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.35rem;
  }

  .berkahbot-chip {
    background: rgba(6, 78, 59, 0.65);
    border: 1px solid rgba(52, 211, 153, 0.3);
    color: #D1FAE5;
    padding: 0.32rem 0.62rem;
    border-radius: 9999px;
    font-size: 0.72rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: left;
  }

  .berkahbot-chip:hover {
    background: #15803D;
    color: #FFFFFF;
    border-color: #22C55E;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(34, 197, 94, 0.3);
  }

  /* Typing Indicator */
  .berkahbot-typing {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.35rem 0.85rem;
    background: rgba(4, 24, 17, 0.7);
    border-top: 1px solid rgba(52, 211, 153, 0.12);
  }

  .berkahbot-typing-bubble {
    background: #0E2E23;
    border: 1px solid rgba(52, 211, 153, 0.2);
    padding: 0.35rem 0.6rem;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 3.5px;
  }

  .berkahbot-typing-bubble .dot {
    width: 4.5px;
    height: 4.5px;
    background: #34D399;
    border-radius: 50%;
    animation: berkahbotDotBounce 1.4s infinite ease-in-out;
  }
  .berkahbot-typing-bubble .dot:nth-child(2) {
    animation-delay: 0.2s;
  }
  .berkahbot-typing-bubble .dot:nth-child(3) {
    animation-delay: 0.4s;
  }

  .berkahbot-typing-text {
    font-size: 0.7rem;
    color: #A7F3D0;
    font-style: italic;
  }

  /* Input Form (Compact) */
  .berkahbot-input-form {
    padding: 0.65rem 0.85rem;
    background: rgba(4, 24, 17, 0.95);
    border-top: 1px solid rgba(52, 211, 153, 0.18);
  }

  .berkahbot-input-container {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    background: #03130E;
    border: 1px solid rgba(52, 211, 153, 0.3);
    border-radius: 12px;
    padding: 0.35rem 0.45rem 0.35rem 0.75rem;
    transition: all 0.2s ease;
  }

  .berkahbot-input-container:focus-within {
    border-color: #22C55E;
    box-shadow: 0 0 0 2.5px rgba(34, 197, 94, 0.25);
  }

  .berkahbot-input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    color: #F0FDF4;
    font-size: 0.82rem;
    font-family: inherit;
    resize: none;
    max-height: 70px;
    line-height: 1.35;
  }

  .berkahbot-input::placeholder {
    color: #6EE7B7;
    opacity: 0.55;
  }

  .berkahbot-send-btn {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
    border: none;
    color: #042116;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    flex-shrink: 0;
  }

  .berkahbot-send-btn:hover:not(:disabled) {
    transform: scale(1.06);
    box-shadow: 0 3px 10px rgba(34, 197, 94, 0.4);
    color: #000000;
  }

  .berkahbot-send-btn:disabled {
    opacity: 0.35;
    cursor: not-allowed;
    background: #14382B;
    color: #64748B;
  }

  /* Animations */
  @keyframes berkahbotFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
  }

  @keyframes berkahbotFadeIn {
    from { opacity: 0; transform: translateY(4px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes berkahbotMsgIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes berkahbotDotBounce {
    0%, 80%, 100% { transform: scale(0.6); opacity: 0.4; }
    40% { transform: scale(1.1); opacity: 1; }
  }

  /* In-App Confirmation Modal Popup */
  .berkahbot-reset-modal {
    position: absolute;
    inset: 0;
    background: rgba(3, 18, 13, 0.82);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.25rem;
    z-index: 99;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.22s ease, visibility 0.22s ease;
  }

  .berkahbot-reset-modal.active {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
  }

  .berkahbot-modal-card {
    background: linear-gradient(165deg, #092B20 0%, #041811 100%);
    border: 1px solid rgba(52, 211, 153, 0.35);
    border-radius: 16px;
    padding: 1.25rem 1.15rem;
    width: 100%;
    max-width: 280px;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.65), 0 0 25px rgba(34, 197, 94, 0.18);
    text-align: center;
    transform: scale(0.9) translateY(8px);
    transition: transform 0.22s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .berkahbot-reset-modal.active .berkahbot-modal-card {
    transform: scale(1) translateY(0);
  }

  .berkahbot-modal-icon-badge {
    width: 44px;
    height: 44px;
    margin: 0 auto 0.75rem auto;
    border-radius: 50%;
    background: rgba(34, 197, 94, 0.15);
    border: 1px solid rgba(52, 211, 153, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4ADE80;
    box-shadow: 0 0 16px rgba(34, 197, 94, 0.25);
  }

  .berkahbot-modal-title {
    margin: 0 0 0.35rem 0;
    font-size: 0.95rem;
    font-weight: 700;
    color: #F0FDF4;
    letter-spacing: -0.01em;
  }

  .berkahbot-modal-desc {
    margin: 0 0 1.15rem 0;
    font-size: 0.76rem;
    line-height: 1.45;
    color: #A7F3D0;
  }

  .berkahbot-modal-actions {
    display: flex;
    gap: 0.55rem;
    width: 100%;
  }

  .berkahbot-modal-btn {
    flex: 1;
    padding: 0.52rem 0.7rem;
    border-radius: 10px;
    font-size: 0.78rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.18s ease;
    border: none;
    outline: none;
    font-family: inherit;
  }

  .berkahbot-btn-cancel {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.18);
    color: #CBD5E1;
  }

  .berkahbot-btn-cancel:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #FFFFFF;
    border-color: rgba(255, 255, 255, 0.3);
  }

  .berkahbot-btn-confirm {
    background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
    color: #032015;
    font-weight: 800;
    box-shadow: 0 3px 12px rgba(34, 197, 94, 0.35);
  }

  .berkahbot-btn-confirm:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 16px rgba(34, 197, 94, 0.5);
    color: #000000;
  }

  /* Responsive Mobile */
  @media (max-width: 480px) {
    #berkahbot-widget-container {
      bottom: 14px;
      right: 14px;
    }
    .berkahbot-launcher {
      width: 50px;
      height: 50px;
    }
    .berkahbot-window {
      right: -6px;
      bottom: 60px;
      width: calc(100vw - 28px);
      height: calc(100vh - 80px);
      max-height: 500px;
      border-radius: 16px;
    }
    .berkahbot-tooltip {
      display: none !important;
    }
  }
</style>

<script>
  window.berkahbotAvatarUrl = "{{ asset('assets/images/berkahbot-circle.png') }}";
  window.berkahbotApiUrl = "{{ route('chatbot.message') }}";
  window.berkahbotHistory = [];

  window.toggleBerkahBotChat = function(event, forceOpen) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const win = document.getElementById('berkahbot-window');
    const launcher = document.getElementById('berkahbot-launcher');
    const tooltip = document.getElementById('berkahbot-tooltip');
    const input = document.getElementById('berkahbot-input');

    if (!win || !launcher) return;

    const isOpen = win.classList.contains('open');
    const shouldOpen = (forceOpen !== undefined) ? forceOpen : !isOpen;

    if (shouldOpen) {
      win.classList.add('open');
      launcher.classList.add('active');
      if (tooltip) tooltip.style.display = 'none';
      setTimeout(() => { if (input) input.focus(); }, 250);
    } else {
      win.classList.remove('open');
      launcher.classList.remove('active');
    }
  };

  window.closeBerkahBotTooltip = function(event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const tooltip = document.getElementById('berkahbot-tooltip');
    if (tooltip) tooltip.style.display = 'none';
  };

  window.handleChatInput = function(textarea) {
    const sendBtn = document.getElementById('berkahbot-send-btn');
    textarea.style.height = 'auto';
    textarea.style.height = Math.min(textarea.scrollHeight, 70) + 'px';
    if (sendBtn) {
      sendBtn.disabled = !textarea.value.trim();
    }
  };

  window.handleChatKeydown = function(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
      event.preventDefault();
      const form = document.getElementById('berkahbot-form');
      if (form) {
        handleChatSubmit(event);
      }
    }
  };

  window.handleChipClick = function(btn) {
    const query = btn.getAttribute('data-query');
    if (query) {
      sendBerkahBotMessage(query);
    }
  };

  window.openResetModal = function(event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const modal = document.getElementById('berkahbot-reset-modal');
    if (modal) {
      modal.classList.add('active');
      modal.setAttribute('aria-hidden', 'false');
    }
  };

  window.closeResetModal = function(event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const modal = document.getElementById('berkahbot-reset-modal');
    if (modal) {
      modal.classList.remove('active');
      modal.setAttribute('aria-hidden', 'true');
    }
  };

  window.resetBerkahBotChat = function(event) {
    window.openResetModal(event);
  };

  window.confirmResetChat = function(event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    window.closeResetModal();

    const messagesEl = document.getElementById('berkahbot-messages');
    if (messagesEl) {
      window.berkahbotHistory = [];
      messagesEl.innerHTML = `
        <div class="berkahbot-msg-group bot">
          <div class="berkahbot-msg-avatar">
            <img src="${window.berkahbotAvatarUrl}" alt="BerkahBot">
          </div>
          <div class="berkahbot-msg-bubble">
            <p>Halo kembali! 👋 Percakapan telah diatur ulang.</p>
            <p>Ada yang bisa <strong>BerkahBot</strong> bantu hari ini seputar limbah organik dan mitra SisaBerkah?</p>
          </div>
        </div>
        <div class="berkahbot-chips-wrap" id="berkahbot-chips">
          <div class="berkahbot-chips-title">Rekomendasi Pertanyaan:</div>
          <div class="berkahbot-chips-grid">
            <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Bagaimana cara mengolah sampah sisa makanan dapur agar tidak menimbulkan bau?">Cara Olah Sampah Dapur</button>
            <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Apa saja pakan favorit larva maggot BSF dan tips perawatannya?">Panduan Maggot BSF</button>
            <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Bagaimana rasio bahan hijau dan cokelat untuk membuat kompos yang benar?">Pembuatan Kompos</button>
            <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Siapa saja mitra penerima pasokan aktif di SisaBerkah dan lokasinya?">Mitra SisaBerkah</button>
            <button type="button" class="berkahbot-chip" onclick="handleChipClick(this)" data-query="Kenapa kita dilarang keras membakar sampah organik?">Bahaya Bakar Sampah</button>
          </div>
        </div>
      `;
      messagesEl.scrollTop = 0;
    }

    const input = document.getElementById('berkahbot-input');
    if (input) {
      input.value = '';
      input.focus();
    }
  };

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const modal = document.getElementById('berkahbot-reset-modal');
      if (modal && modal.classList.contains('active')) {
        window.closeResetModal();
      }
    }
  });

  window.handleChatSubmit = function(event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const input = document.getElementById('berkahbot-input');
    const sendBtn = document.getElementById('berkahbot-send-btn');
    if (!input) return;
    const text = input.value.trim();
    if (!text) return;

    sendBerkahBotMessage(text);
    input.value = '';
    input.style.height = 'auto';
    if (sendBtn) sendBtn.disabled = true;
  };

  window.sendBerkahBotMessage = async function(userText) {
    const chipsEl = document.getElementById('berkahbot-chips');
    const typingEl = document.getElementById('berkahbot-typing');
    if (chipsEl) chipsEl.style.display = 'none';

    appendBerkahBotMsg('user', userText);
    window.berkahbotHistory.push({ role: 'user', text: userText });

    if (typingEl) typingEl.style.display = 'flex';
    scrollBerkahBotBottom();

    try {
      const response = await fetch(window.berkahbotApiUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({
          message: userText,
          history: window.berkahbotHistory
        })
      });

      const data = await response.json();
      if (typingEl) typingEl.style.display = 'none';

      if (data.success && data.reply) {
        appendBerkahBotMsg('bot', data.reply);
        window.berkahbotHistory.push({ role: 'model', text: data.reply });
      } else {
        appendBerkahBotMsg('bot', 'Maaf, BerkahBot sedang mengalami kendala jaringan. Silakan coba lagi ya!');
      }
    } catch (err) {
      if (typingEl) typingEl.style.display = 'none';
      appendBerkahBotMsg('bot', 'Koneksi terputus. Pastikan koneksi internet Anda aktif dan coba lagi ya!');
    }

    scrollBerkahBotBottom();
  };

  function appendBerkahBotMsg(sender, text) {
    const messagesEl = document.getElementById('berkahbot-messages');
    if (!messagesEl) return;

    const group = document.createElement('div');
    group.className = `berkahbot-msg-group ${sender}`;

    if (sender === 'bot') {
      group.innerHTML = `
        <div class="berkahbot-msg-avatar">
          <img src="${window.berkahbotAvatarUrl}" alt="BerkahBot">
        </div>
        <div class="berkahbot-msg-bubble">
          ${formatBerkahBotMarkdown(text)}
        </div>
      `;
    } else {
      group.innerHTML = `
        <div class="berkahbot-msg-bubble">
          ${escapeBerkahBotHtml(text).replace(/\n/g, '<br>')}
        </div>
      `;
    }

    messagesEl.appendChild(group);
    scrollBerkahBotBottom();
  }

  function scrollBerkahBotBottom() {
    const messagesEl = document.getElementById('berkahbot-messages');
    if (messagesEl) {
      setTimeout(() => {
        messagesEl.scrollTop = messagesEl.scrollHeight;
      }, 50);
    }
  }

  function escapeBerkahBotHtml(str) {
    return str.replace(/[&<>"']/g, function(m) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
    });
  }

  function formatBerkahBotMarkdown(text) {
    if (!text) return '';
    let html = escapeBerkahBotHtml(text);
    html = html.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
    html = html.replace(/\*(.*?)\*/g, '<em>$1</em>');

    const lines = html.split('\n');
    let inList = false;
    let listType = '';
    let output = [];

    for (let i = 0; i < lines.length; i++) {
      let line = lines[i].trim();
      if (line.match(/^[\*\-]\s+(.*)/)) {
        if (!inList || listType !== 'ul') {
          if (inList) output.push(`</${listType}>`);
          output.push('<ul>');
          inList = true;
          listType = 'ul';
        }
        output.push(`<li>${line.replace(/^[\*\-]\s+/, '')}</li>`);
        continue;
      }
      if (line.match(/^\d+\.\s+(.*)/)) {
        if (!inList || listType !== 'ol') {
          if (inList) output.push(`</${listType}>`);
          output.push('<ol>');
          inList = true;
          listType = 'ol';
        }
        output.push(`<li>${line.replace(/^\d+\.\s+/, '')}</li>`);
        continue;
      }
      if (inList) {
        output.push(`</${listType}>`);
        inList = false;
      }
      if (line === '') continue;
      output.push(`<p>${line}</p>`);
    }

    if (inList) output.push(`</${listType}>`);
    return output.join('');
  }
</script>
