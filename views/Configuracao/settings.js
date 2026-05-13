/**
 * MedPass – Módulo de Acessibilidade Global
 * Inclua este script em TODAS as páginas do projeto:
 *   <script src="./settings.js"></script>
 *
 * Gerencia:
 *  - Tamanho de fonte: 3 estágios (pequeno / médio / grande)
 *  - Modo escuro
 *
 * Persistência: sessionStorage  →  as preferências valem durante
 * toda a sessão do navegador e são compartilhadas entre todas as
 * abas/páginas abertas no mesmo domínio na mesma sessão.
 */

(function () {
  /* ─── Chaves do sessionStorage ─── */
  const KEY_FONT  = 'medpass_font';   // 'small' | 'medium' | 'large'
  const KEY_DARK  = 'medpass_dark';   // 'true'  | 'false'

  /* ─── Mapeamento de estágio → classe CSS ─── */
  const FONT_CLASSES = {
    small:  'font-small',
    medium: 'font-medium',
    large:  'font-large',
  };

  /* ─── Lê preferência salva (ou retorna padrão) ─── */
  function getSavedFont() {
    return sessionStorage.getItem(KEY_FONT) || 'small';
  }

  function getSavedDark() {
    return sessionStorage.getItem(KEY_DARK) === 'true';
  }

  /* ─── Aplica fonte ao <body> ─── */
  function applyFont(stage) {
    const body = document.body;
    body.classList.remove(...Object.values(FONT_CLASSES));
    if (FONT_CLASSES[stage]) body.classList.add(FONT_CLASSES[stage]);
    sessionStorage.setItem(KEY_FONT, stage);
    /* Dispara evento para que a página possa reagir (ex.: atualizar sliders) */
    window.dispatchEvent(new CustomEvent('medpass:fontChange', { detail: stage }));
  }

  /* ─── Aplica modo escuro ao <body> ─── */
  function applyDark(enabled) {
    document.body.classList.toggle('dark-theme', enabled);
    sessionStorage.setItem(KEY_DARK, String(enabled));
    window.dispatchEvent(new CustomEvent('medpass:darkChange', { detail: enabled }));
  }

  /* ─── API pública ─── */
  window.MedPassSettings = {
    /**
     * Define o estágio de fonte.
     * @param {'small'|'medium'|'large'} stage
     */
    setFont: function (stage) {
      applyFont(stage);
    },

    /** Retorna o estágio atual da fonte. */
    getFont: function () {
      return getSavedFont();
    },

    /**
     * Ativa ou desativa o modo escuro.
     * @param {boolean} enabled
     */
    setDark: function (enabled) {
      applyDark(enabled);
    },

    /** Retorna true se o modo escuro estiver ativo. */
    getDark: function () {
      return getSavedDark();
    },
  };

  /* ─── Inicialização: aplica preferências assim que o script carrega ─── */
  function init() {
    applyFont(getSavedFont());
    applyDark(getSavedDark());
  }

  /* Roda imediatamente (antes do DOMContentLoaded) para evitar flash */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();