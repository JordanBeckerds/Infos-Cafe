<section class="min-h-screen py-12 md:py-16 bg-gradient-to-br from-gray-50 via-white to-indigo-50/30 mt-5">
  <div class="container mx-auto px-4 max-w-4xl">

    <div class="max-w-2xl mx-auto space-y-12">

      <!-- Progress dots – smaller -->
      <div class="flex justify-center gap-2.5 md:gap-3 mb-6 flex-wrap">
        <div class="step-dot w-3.5 h-3.5 rounded-full transition-all duration-500" data-step="1"></div>
        <div class="step-dot w-3.5 h-3.5 rounded-full transition-all duration-500" data-step="2"></div>
        <div class="step-dot w-3.5 h-3.5 rounded-full transition-all duration-500" data-step="3"></div>
        <div class="step-dot w-3.5 h-3.5 rounded-full transition-all duration-500" data-step="4"></div>
        <div class="step-dot w-3.5 h-3.5 rounded-full transition-all duration-500" data-step="5"></div>
        <div class="step-dot w-3.5 h-3.5 rounded-full transition-all duration-500" data-step="6"></div>
        <div class="step-dot w-3.5 h-3.5 rounded-full transition-all duration-500" data-step="7"></div>
        <div class="step-dot w-3.5 h-3.5 rounded-full transition-all duration-500" data-step="8"></div>
      </div>

      <!-- Questions container -->
      <div class="bg-white/90 backdrop-blur-xl rounded-2xl border border-white/30 shadow-xl p-6 md:p-9 transition-all duration-700 opacity-100" id="question-box">
        <div id="current-question"></div>

        <!-- Navigation buttons – slimmer -->
        <div class="flex justify-between mt-10 gap-5" id="nav-buttons">
          <button id="btn-prev" class="flex-1 px-6 py-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-xl transition disabled:opacity-40 disabled:cursor-not-allowed text-base">
            ← Précédent
          </button>
          <button id="btn-next" class="flex-1 px-6 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition disabled:opacity-40 disabled:cursor-not-allowed text-base">
            Suivant →
          </button>
        </div>
      </div>

      <!-- Final recap – appears below -->
      <div id="final-summary" class="hidden bg-white/90 backdrop-blur-xl rounded-2xl border border-white/30 shadow-xl p-7 md:p-10 text-center">
        <h3 class="text-2xl md:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-blue-600 mb-8">
          Votre configuration recommandée
        </h3>

        <div class="text-left space-y-5 max-w-xl mx-auto">
          <div id="final-parts" class="space-y-2.5 text-base md:text-lg text-gray-800"></div>

          <div class="mt-8 p-5 bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-xl border border-emerald-200">
            <div class="text-2xl md:text-3xl font-bold text-emerald-700 text-center mb-1" id="final-price">Prix estimé : —</div>
            <p class="text-center text-gray-600 text-sm md:text-base">tour + écran + assemblage – prix indicatif 2026</p>
          </div>

          <p id="final-note" class="text-base md:text-lg text-gray-600 italic mt-5"></p>
        </div>
      </div>

      <!-- "Prendre un RDV" button -->
      <div class="mt-10 text-center hidden" id="rdv-button-container">
        <a href="https://calendly.com/votre-lien-calendly" target="_blank" rel="noopener noreferrer"
           class="inline-block px-10 py-5 bg-emerald-600 hover:bg-emerald-700 text-white text-lg md:text-xl font-bold rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-emerald-300">
          Prendre un RDV →
        </a>
        <p class="mt-3 text-gray-600 text-sm">Un conseiller vous rappellera pour valider et personnaliser votre build</p>
      </div>

    </div>

  </div>
</section>

<script>
// FIXED – last step selection NOW triggers recap + RDV button
document.addEventListener('DOMContentLoaded', () => {
  const state = {
    usages: [],
    gamingLevel: null,
    screen: null,
    ram: null,
    storage: null,
    case: null,
    silence: null,
    budget: null
  };

  const questions = [
    { step: 1, id: 'usages', title: 'Usages principaux (plusieurs possibles)', multi: true, options: [
      { label: 'Famille / Quotidien', emoji: '👨‍👩‍👧‍👦', desc: 'navigation, vidéos, appels', value: 'simple' },
      { label: 'Enfants / Études', emoji: '📚🎮', desc: 'devoirs, jeux légers', value: 'enfants' },
      { label: 'Films / Créatif', emoji: '🎥📸', desc: 'streaming, montage léger', value: 'multimedia' },
      { label: 'Gaming', emoji: '🕹️', desc: 'jeux légers à moyens', value: 'gaming' },
      { label: 'Informatique / Dev', emoji: '💻🛠️', desc: 'code, virtualisation', value: 'dev' }
    ]},
    { step: 2, id: 'gamingLevel', title: 'Niveau de gaming souhaité', options: [
      { label: 'Aucun gaming', emoji: '❌', desc: 'pas de jeux', value: 'none' },
      { label: 'Gaming léger', emoji: '🌱', desc: 'Minecraft, Roblox, LoL, Valorant', value: 'light' },
      { label: 'Gaming modéré', emoji: '⚔️', desc: 'Fortnite, COD, Apex, AAA moyen', value: 'moderate' },
      { label: 'Gaming élevé', emoji: '🔥', desc: 'Cyberpunk, 1440p/4K ultra', value: 'high' }
    ]},
    { step: 3, id: 'screen', title: 'Taille d\'écran souhaitée', options: [
      { label: '24″', emoji: '24″', desc: 'Compact – idéal bureau ou petit espace', value: '24' },
      { label: '27″', emoji: '27″', desc: 'Confort – équilibre taille / espace bureau', value: '27' },
      { label: '32″+', emoji: '32″+', desc: 'Immersion – cinéma, gaming, création', value: '32' }
    ]},
    { step: 4, id: 'ram', title: 'RAM minimum souhaitée', options: [
      { label: '16 Go', emoji: '16 Go', desc: 'Usage léger – navigation, bureautique', value: '16' },
      { label: '32 Go', emoji: '32 Go', desc: 'Multitâche / Créatif – édition, streaming', value: '32' },
      { label: '64 Go+', emoji: '64 Go+', desc: 'Dev / Montage lourd – compilation, 3D, VM', value: '64' }
    ]},
    { step: 5, id: 'storage', title: 'Stockage minimum souhaité', options: [
      { label: '512 Go SSD', emoji: '512 Go', desc: 'Basique – navigation, documents', value: '512' },
      { label: '1 To SSD', emoji: '1 To', desc: 'Photos / Vidéos – médias, jeux légers', value: '1tb' },
      { label: '2 To+', emoji: '2 To+', desc: 'Gros projets – montage, dev, stockage lourd', value: '2tb' }
    ]},
    { step: 6, id: 'case', title: 'Format du boîtier', options: [
      { label: 'Mini-ITX', emoji: 'Mini-ITX', desc: 'Très compact – mini tour, bureau réduit', value: 'mini-itx' },
      { label: 'Micro-ATX', emoji: 'Micro-ATX', desc: 'Équilibré – bonne taille / performance', value: 'micro-atx' },
      { label: 'ATX', emoji: 'ATX', desc: 'Tour complète – max airflow, upgrade', value: 'atx' }
    ]},
    { step: 7, id: 'silence', title: 'Priorité silence / bruit', options: [
      { label: 'Super silencieux', emoji: '🤫', desc: 'AIO watercooling recommandé', value: 'super-quiet' },
      { label: 'Modéré', emoji: '😐', desc: 'air cooling suffisant', value: 'moderate' },
      { label: 'Peu importe', emoji: '🔊', desc: 'performance avant tout', value: 'no-care' }
    ]},
    { step: 8, id: 'budget', title: 'Niveau de qualité / budget', options: [
      { label: 'Haut de gamme', emoji: '⭐⭐⭐⭐⭐', desc: 'top performances, pas de compromis', value: 'top' },
      { label: 'Équilibré', emoji: '⭐⭐⭐', desc: 'meilleur rapport qualité/prix', value: 'moderate' },
      { label: 'Budget', emoji: '⭐⭐', desc: 'le moins cher possible', value: 'cheap' }
    ]}
  ];

  let currentIndex = 0;

  const container = document.getElementById('question-box');
  const btnPrev = document.getElementById('btn-prev');
  const btnNext = document.getElementById('btn-next');
  const navButtons = document.getElementById('nav-buttons');
  const finalSummary = document.getElementById('final-summary');
  const rdvContainer = document.getElementById('rdv-button-container');

  function shouldShowGamingLevel() {
    return state.usages.includes('gaming');
  }

  function getEffectiveIndex(idx = currentIndex) {
    let effective = idx;
    if (questions[effective]?.id === 'gamingLevel' && !shouldShowGamingLevel()) {
      effective++;
    }
    return effective;
  }

  function renderQuestion() {
    const index = getEffectiveIndex();
    const q = questions[index];
    if (!q) return;

    const html = `
      <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8 text-center">${q.title}</h2>
      <div class="space-y-4">
        ${q.options.map(opt => {
          const isSelected = q.multi 
            ? state[q.id]?.includes(opt.value)
            : state[q.id] === opt.value;

          return `
            <button 
              data-question="${q.id}" 
              data-value="${opt.value}" 
              class="group w-full bg-white border-2 ${isSelected ? 'border-indigo-600 bg-indigo-50/60 shadow-md' : 'border-gray-200'} hover:border-indigo-500 rounded-xl p-6 text-left transition-all duration-300 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-indigo-300/50"
            >
              <div class="flex items-center gap-5">
                <span class="text-5xl">${opt.emoji}</span>
                <div>
                  <div class="font-semibold text-xl group-hover:text-indigo-700">${opt.label}</div>
                  <div class="text-sm text-gray-600">${opt.desc}</div>
                </div>
              </div>
            </button>
          `;
        }).join('')}
      </div>
    `;

    document.getElementById('current-question').innerHTML = html;

    container.classList.remove('opacity-0', 'scale-95');
    container.classList.add('opacity-100', 'scale-100');

    container.scrollIntoView({ behavior: 'smooth', block: 'center' });

    // Progress
    document.querySelectorAll('.step-dot').forEach((dot, i) => {
      if (i + 1 <= index + 1) {
        dot.classList.add('bg-indigo-600', 'ring-4', 'ring-indigo-300/60', 'scale-125');
        dot.classList.remove('bg-gray-300');
      } else {
        dot.classList.remove('bg-indigo-600', 'ring-4', 'ring-indigo-300/60', 'scale-125');
        dot.classList.add('bg-gray-300');
      }
    });

    // Hide nav buttons at end
    // Original had empty if + else — we can simplify to just the else part
    navButtons.style.display = 'flex';
    btnPrev.disabled = currentIndex === 0;
    btnNext.disabled = !(q.multi ? state[q.id]?.length > 0 : state[q.id]);
  }

  // Start
  renderQuestion();

  // Précédent
  btnPrev.addEventListener('click', () => {
    if (currentIndex > 0) {
      currentIndex--;
      container.classList.add('opacity-0', 'scale-95');
      setTimeout(renderQuestion, 400);
    }
  });

  // Suivant
  btnNext.addEventListener('click', () => {
    const currentQ = questions[getEffectiveIndex()];
    if ((currentQ.multi && state[currentQ.id]?.length > 0) || (!currentQ.multi && state[currentQ.id])) {
      if (currentIndex < questions.length - 1) {
        currentIndex++;
        container.classList.add('opacity-0', 'scale-95');
        setTimeout(renderQuestion, 400);
      } else {
        // Show recap + RDV – questions stay visible
        finalSummary.classList.remove('hidden');
        rdvContainer.classList.remove('hidden');
        finalSummary.scrollIntoView({ behavior: 'smooth', block: 'start' });

        let parts = [];
        if (state.usages?.length) parts.push(`Usages : ${state.usages.join(', ')}`);
        if (state.gamingLevel && state.usages.includes('gaming')) parts.push(`Niveau gaming : ${state.gamingLevel}`);
        if (state.screen) parts.push(`Écran : ${state.screen}"`);
        if (state.ram) parts.push(`RAM : ≥ ${state.ram} Go`);
        if (state.storage) parts.push(`Stockage : ≥ ${state.storage}`);
        if (state.case) parts.push(`Boîtier : ${state.case.toUpperCase()}`);
        if (state.silence) parts.push(`Silence : ${state.silence === 'super-quiet' ? 'Super silencieux (AIO)' : state.silence === 'moderate' ? 'Modéré (air cooling)' : 'Peu importe'}`);
        if (state.budget) parts.push(`Niveau qualité : ${state.budget === 'top' ? 'Haut de gamme' : state.budget === 'moderate' ? 'Équilibré' : 'Budget'}`);

        document.getElementById('final-parts').innerHTML = parts.map(p => `<div>• ${p}</div>`).join('');
        document.getElementById('final-price').textContent = `Prix estimé : 800 – 2 800 €`;
      }
    }
  });

  // Re-click selected = go back
  document.getElementById('question-box').addEventListener('click', function(e) {
    const btn = e.target.closest('button');
    if (!btn) return;

    if (btn.id === 'btn-prev' || btn.id === 'btn-next') return;

    const dataQuestion = btn.getAttribute('data-question');
    const value = btn.getAttribute('data-value');

    if (!dataQuestion || !value) return;

    const currentQ = questions[getEffectiveIndex()];
    if (dataQuestion !== currentQ.id) return;

    if (currentQ.multi) {
      if (!state[dataQuestion]) state[dataQuestion] = [];
      const idx = state[dataQuestion].indexOf(value);
      if (idx !== -1) {
        state[dataQuestion].splice(idx, 1);
      } else {
        state[dataQuestion].push(value);
      }
    } else {
      if (state[dataQuestion] === value) {
        state[dataQuestion] = null;
        if (currentIndex > 0) {
          currentIndex--;
          container.classList.add('opacity-0', 'scale-95');
          setTimeout(renderQuestion, 400);
          return;
        }
      } else {
        state[dataQuestion] = value;
      }
    }

    renderQuestion();

    // Check if this selection completes the last step → show recap immediately
    if (currentIndex === questions.length - 1 && state[currentQ.id]) {
      finalSummary.classList.remove('hidden');
      rdvContainer.classList.remove('hidden');
      finalSummary.scrollIntoView({ behavior: 'smooth', block: 'start' });

      let parts = [];
      if (state.usages?.length) parts.push(`Usages : ${state.usages.join(', ')}`);
      if (state.gamingLevel && state.usages.includes('gaming')) parts.push(`Niveau gaming : ${state.gamingLevel}`);
      if (state.screen) parts.push(`Écran : ${state.screen}"`);
      if (state.ram) parts.push(`RAM : ≥ ${state.ram} Go`);
      if (state.storage) parts.push(`Stockage : ≥ ${state.storage}`);
      if (state.case) parts.push(`Boîtier : ${state.case.toUpperCase()}`);
      if (state.silence) parts.push(`Silence : ${state.silence === 'super-quiet' ? 'Super silencieux (AIO)' : state.silence === 'moderate' ? 'Modéré (air cooling)' : 'Peu importe'}`);
      if (state.budget) parts.push(`Niveau qualité : ${state.budget === 'top' ? 'Haut de gamme' : state.budget === 'moderate' ? 'Équilibré' : 'Budget'}`);

      document.getElementById('final-parts').innerHTML = parts.map(p => `<div>• ${p}</div>`).join('');
      document.getElementById('final-price').textContent = `Prix estimé : 800 – 2 800 €`;
    }
  });
});
</script>