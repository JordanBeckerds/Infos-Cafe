<section>
  <div class="min-h-[100vh] max-w-[80vw] min-w-[75vw] mx-auto p-4 font-sans antialiased flex items-center justify-center" id="app">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-4 min-h-[600px]">
      
      <div class="flex flex-col gap-0" id="steps-container"></div>

      <div class="flex flex-col gap-4">
        <div class="sticky top-4 flex flex-col gap-4">
          
          <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 flex flex-col items-center gap-2">
            <div class="text-[11px] uppercase tracking-wider text-slate-400 font-bold">Votre configuration</div>
            
            <svg class="w-full max-w-[200px] h-auto" viewBox="0 0 160 220" xmlns="http://www.w3.org/2000/svg">
              <rect x="30" y="10" width="100" height="180" rx="6" fill="white" stroke="#cbd5e1" stroke-width="1.5"/>
              <rect x="36" y="16" width="88" height="168" rx="4" fill="#f8fafc" stroke="#e2e8f0" stroke-width="0.5"/>
              <circle cx="115" cy="30" r="5" fill="#cbd5e1" id="pc-power" class="transition-all duration-400"/>
              <rect x="44" y="50" width="72" height="100" rx="3" fill="white" stroke="#e2e8f0" id="pc-mobo"/>
              <rect x="52" y="58" width="28" height="28" rx="2" fill="#f1f5f9" stroke="#94a3b8" id="pc-cpu"/>
              <rect x="44" y="94" width="72" height="22" rx="2" fill="#f1f5f9" stroke="#94a3b8" id="pc-gpu"/>
              <rect x="82" y="58" width="7" height="30" rx="1" fill="#f1f5f9" stroke="#94a3b8" id="pc-ram1"/>
              <rect x="91" y="58" width="7" height="30" rx="1" fill="#f1f5f9" stroke="#94a3b8" id="pc-ram2"/>
              <rect x="100" y="58" width="7" height="30" rx="1" fill="#e2e8f0" id="pc-ram3"/>
              <rect x="109" y="58" width="7" height="30" rx="1" fill="#e2e8f0" id="pc-ram4"/>
              <rect x="50" y="122" width="40" height="16" rx="2" fill="#f1f5f9" stroke="#94a3b8" id="pc-ssd"/>
              <rect x="44" y="145" width="72" height="24" rx="2" fill="#f1f5f9" stroke="#94a3b8" id="pc-psu"/>
            </svg>
            
            <div class="text-xs font-medium text-slate-500" id="case-label">Format : —</div>
          </div>

          <div class="grid grid-cols-2 gap-2">
            <div id="card-cpu" class="bg-slate-50 border border-slate-200 rounded-lg p-3 transition-colors">
              <div class="text-[10px] text-slate-400 uppercase font-bold">CPU</div>
              <div class="text-sm font-semibold text-slate-800" id="disp-cpu">—</div>
            </div>
            <div id="card-gpu" class="bg-slate-50 border border-slate-200 rounded-lg p-3 transition-colors">
              <div class="text-[10px] text-slate-400 uppercase font-bold">GPU</div>
              <div class="text-sm font-semibold text-slate-800" id="disp-gpu">—</div>
            </div>
            <div id="card-ram" class="bg-slate-50 border border-slate-200 rounded-lg p-3 transition-colors">
              <div class="text-[10px] text-slate-400 uppercase font-bold">RAM</div>
              <div class="text-sm font-semibold text-slate-800" id="disp-ram">—</div>
            </div>
            <div id="card-storage" class="bg-slate-50 border border-slate-200 rounded-lg p-3 transition-colors">
              <div class="text-[10px] text-slate-400 uppercase font-bold">Stockage</div>
              <div class="text-sm font-semibold text-slate-800" id="disp-storage">—</div>
            </div>
          </div>

          <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-5">
            <div class="w-full bg-slate-100 h-1 rounded-full overflow-hidden mb-4">
              <div id="progress" class="bg-slate-900 h-full transition-all duration-500" style="width:0%"></div>
            </div>
            <div class="text-xs text-slate-400 mb-1">Estimation assemblage</div>
            <div class="text-2xl font-bold text-slate-900" id="price-total">—</div>
            <div class="text-xs text-slate-500 mt-1" id="price-range">Sélectionnez vos composants</div>
          </div>

          <button class="w-full py-3 bg-slate-900 text-white rounded-xl font-semibold hover:bg-slate-800 disabled:opacity-30 disabled:cursor-not-allowed transition-all shadow-lg" id="rdv-btn" disabled onclick="alert('Configuration envoyée : ' + window.getSummary())">
            Prendre un RDV avec Info-Café ↗
          </button>
        </div>
      </div>
    </div>
  </div>  
</section>


<script>
const STEPS = [
  { 
    id:'usage', title:'Usage principal', 
    opts:[
      {id:'simple', name:'Bureautique / Études', sub:'Web, Office, Zoom', price:[450, 600]},
      {id:'multimedia', name:'Création / Montage', sub:'Adobe, 4K, Rendu', price:[850, 1100]},
      {id:'gaming', name:'Gaming Performance', sub:'High FPS, Ray Tracing', price:[1350, 1900]},
      {id:'workstation', name:'Calcul / IA / Dev', sub:'Virtualisation, Compil.', price:[1700, 2800]},
    ]
  },
  { 
    id:'cpu', title:'Choix du Processeur (CPU)', 
    opts:[
      {id:'i5', name:'Core i5-14400', sub:'10 Cores / 16 Threads - 4.7 GHz', pricemod:10, cpu:'i5-14400', gpu:'UHD 730'},
      {id:'i7', name:'Core i7-14700K', sub:'20 Cores / 28 Threads - 5.6 GHz', pricemod:240, cpu:'i7-14700K', gpu:'RTX 4070'}, // Added RTX to gaming tier i7
      {id:'i9', name:'Core i9-14900K', sub:'24 Cores / 32 Threads - 6.0 GHz', pricemod:420, cpu:'i9-14900K', gpu:'RTX 4080'}, 
      {id:'ultra', name:'Core Ultra 9 285K', sub:'24 Cores / 24 Threads - 5.7 GHz', pricemod:760, cpu:'Ultra 9 285K', gpu:'RTX 5060'},
    ]
  },
  { 
    id:'ram', title:'Mémoire (RAM DDR5 ou DDR4)', 
    opts:[
      {id:'8', name:'8 Go (2x4)', sub:'3800 MHz', pricemod:10}, 
      {id:'16', name:'16 Go (2x8)', sub:'5200 MHz', pricemod:55}, 
      {id:'32', name:'32 Go (2x16)', sub:'6000 MHz', pricemod:95}, 
      {id:'64', name:'64 Go (2x32)', sub:'6400 MHz', pricemod:210}, 
    ]
  },
  { 
    id:'storage', title:'Stockage (SSD NVMe)', 
    opts:[
      {id:'512', name:'512 Go Gen4', sub:'Lecture 3500 Mo/s', pricemod:10},
      {id:'1tb', name:'1 To Gen4', sub:'Lecture 5000 Mo/s', pricemod:65}, 
      {id:'2tb', name:'2 To Gen4', sub:'Lecture 7400 Mo/s', pricemod:135}, 
    ]
  },
  { 
    id:'case', title:'Format & Boîtier', 
    opts:[
      {id:'matx', name:'Micro-ATX', sub:'Compact (Recommandé)', pricemod:10},
      {id:'atx', name:'ATX Standard', sub:'Spacieux & Évolutif', pricemod:55},
      {id:'itx', name:'ITX Mini', sub:'Ultra-Compact (Premium)', pricemod:90}, 
    ]
  },
  { 
    id:'cooling', title:'Refroidissement', 
    opts:[
      {id:'air', name:'Air Cooling (BeQuiet)', sub:'Fiable & Silencieux', pricemod:10},
      {id:'aio240', name:'Watercooling 240mm', sub:'Pour i7 & Gaming', pricemod:95}, 
      {id:'aio360', name:'Watercooling 360mm', sub:'Indispensable pour i9', pricemod:140}, 
    ]
  },
  { 
    id:'os', title:'Système & Optimisation', 
    opts:[
      {id:'win11', name:'Windows 11 Home', sub:'Installé & Mis à jour', pricemod:10},
      {id:'atlas', name:'Atlas OS Edition', sub:'Gaming Débridé', pricemod:45},
    ]
  },
];

const state = {};
let openStep = 0;

function renderSteps() {
  const container = document.getElementById('steps-container');
  container.innerHTML = '';
  
  STEPS.forEach((step, idx) => {
    const sel = state[step.id];
    const selOpt = sel ? step.opts.find(o => o.id === sel) : null;
    const isDone = !!sel;
    const isOpen = openStep === idx;

    const wrap = document.createElement('div');
    wrap.className = "border-b border-slate-100 last:border-0";

    const hdr = document.createElement('div');
    hdr.className = `flex items-center gap-3 py-4 cursor-pointer group`;
    hdr.onclick = () => { openStep = isOpen ? -1 : idx; renderSteps(); };

    const num = document.createElement('div');
    num.className = `w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition-all ${
      isDone ? 'bg-emerald-500 text-white' : (isOpen ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-400')
    }`;
    num.textContent = isDone ? '✓' : (idx + 1);

    const title = document.createElement('div');
    title.className = `text-sm font-semibold transition-colors ${isOpen ? 'text-slate-900' : 'text-slate-500'}`;
    title.textContent = step.title;

    const chosen = document.createElement('div');
    chosen.className = 'ml-auto text-xs font-medium text-slate-400';
    chosen.textContent = selOpt ? selOpt.name : '';

    hdr.append(num, title, chosen);

    const body = document.createElement('div');
    body.className = `overflow-hidden transition-all duration-300 ${isOpen ? 'max-h-[500px] pb-6' : 'max-h-0'}`;

    const grid = document.createElement('div');
    grid.className = 'grid grid-cols-2 gap-2 mt-2';

    step.opts.forEach(opt => {
      const btn = document.createElement('div');
      const isSel = sel === opt.id;
      btn.className = `p-3 rounded-xl border-2 cursor-pointer transition-all ${
        isSel ? 'border-slate-900 bg-slate-50 shadow-sm' : 'border-slate-100 hover:border-slate-200 bg-white'
      }`;
      
      btn.innerHTML = `
        <div class="text-sm font-bold text-slate-800">${opt.name}</div>
        <div class="text-[11px] text-slate-500 leading-tight">${opt.sub}</div>
        ${opt.pricemod ? `<div class="text-[11px] font-bold mt-1 ${opt.pricemod > 0 ? 'text-slate-900' : 'text-emerald-600'}">${opt.pricemod > 0 ? '+' : ''}${opt.pricemod} €</div>` : ''}
        ${opt.price ? `<div class="text-[11px] font-bold mt-1">dès ${opt.price[0]} €</div>` : ''}
      `;
      
      btn.onclick = (e) => {
        e.stopPropagation();
        state[step.id] = opt.id;
        openStep = idx + 1;
        renderSteps();
        updatePC();
      };
      grid.appendChild(btn);
    });

    body.appendChild(grid);
    wrap.append(hdr, body);
    container.appendChild(wrap);
  });
}

function updatePC() {
  const usageId = state.usage;
  const cpuId = state.cpu;
  
  const usageOpt = usageId ? STEPS[0].opts.find(o => o.id === usageId) : null;
  const cpuOpt = cpuId ? STEPS[1].opts.find(o => o.id === cpuId) : null;
  
  // Update Specs Cards
  document.getElementById('disp-cpu').textContent = cpuOpt ? cpuOpt.cpu : '—';
  
  if (cpuOpt) {
    // If the GPU is the integrated UHD 730, display "Intégré" or "—"
    // Otherwise, display the actual GPU model
    document.getElementById('disp-gpu').textContent = (cpuOpt.gpu === 'UHD 730') ? 'Intégré' : cpuOpt.gpu;
  } else {
    document.getElementById('disp-gpu').textContent = '—';
  }
  
  // RAM Display
  const ramOpt = state.ram ? STEPS[2].opts.find(o => o.id === state.ram) : null;
  document.getElementById('disp-ram').textContent = ramOpt ? ramOpt.name : '—';

  // Storage Display
  const storageOpt = state.storage ? STEPS[3].opts.find(o => o.id === state.storage) : null;
  document.getElementById('disp-storage').textContent = storageOpt ? storageOpt.name : '—';

  // Case Format Display
  const caseOpt = state.case ? STEPS[4].opts.find(o => o.id === state.case) : null;
  document.getElementById('case-label').textContent = caseOpt ? 'Format : ' + caseOpt.name : 'Format : —';

  // Logic for Price
  let [lo, hi] = usageOpt ? [...usageOpt.price] : [0, 0];
  
  if (lo > 0) {
    // Sum up all pricemods from other steps (CPU, RAM, Storage, Case, Cooling, OS)
    [state.cpu, state.ram, state.storage, state.case, state.cooling, state.os].forEach((val, i) => {
      if (val) {
        const mod = STEPS[i+1].opts.find(o => o.id === val)?.pricemod || 0;
        lo += mod; hi += mod;
      }
    });
    document.getElementById('price-total').textContent = `${lo.toLocaleString()} – ${hi.toLocaleString()} €`;
    document.getElementById('price-range').textContent = "Estimation TTC (Pièces + Montage + Commission)";
  } else {
    document.getElementById('price-total').textContent = "—";
    document.getElementById('price-range').textContent = "Sélectionnez votre usage";
  }

  // Progress bar
  const filled = Object.keys(state).length;
  document.getElementById('progress').style.width = (filled / STEPS.length * 100) + '%';
  document.getElementById('rdv-btn').disabled = filled < STEPS.length;
}

window.getSummary = () => {
    let summary = "Configuration Info-Café : ";
    STEPS.forEach(step => {
        const sel = state[step.id];
        const opt = sel ? step.opts.find(o => o.id === sel) : null;
        if(opt) summary += `[${step.title}: ${opt.name}] `;
    });
    summary += "Total: " + document.getElementById('price-total').textContent;
    return summary;
};

// Init
renderSteps();
</script>