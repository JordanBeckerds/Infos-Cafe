<?php
// booking_repair.php
// Page de prise de RDV – respecte exactement la palette et le style du site Info-Café
?>

<main class="bg-gray-50 min-h-screen py-16 md:py-24">

  <div class="container mx-auto px-6 max-w-7xl">

    <!-- Titre principal – style identique au hero mais sans image de fond -->
    <div class="text-center mb-16">
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-800 leading-tight mb-6">
        Prendre rendez-vous
      </h1>
      <p class="text-xl md:text-2xl text-gray-700 max-w-4xl mx-auto leading-relaxed">
        Réservez un créneau pour un diagnostic, une réparation, une maintenance ou une question sur votre matériel.
      </p>
      <p class="mt-6 text-lg font-medium text-blue-600">
        Diagnostic initial offert • On avance à votre rythme
      </p>
    </div>

    <!-- Bloc Cal.com – adapté au style des cartes du site -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-10 mb-16 transition-all duration-300 hover:shadow-2xl hover:border-blue-400">
      
      <!-- Votre code embed Cal.com exact – on ajuste juste le conteneur -->
      <div style="width:100%; min-height: 760px; overflow:scroll;" id="my-cal-inline-maintenance-reparation"></div>

      <script type="text/javascript">
        (function (C, A, L) { 
          let p = function (a, ar) { a.q.push(ar); }; 
          let d = C.document; 
          C.Cal = C.Cal || function () { 
            let cal = C.Cal; 
            let ar = arguments; 
            if (!cal.loaded) { 
              cal.ns = {}; 
              cal.q = cal.q || []; 
              d.head.appendChild(d.createElement("script")).src = A; 
              cal.loaded = true; 
            } 
            if (ar[0] === L) { 
              const api = function () { p(api, arguments); }; 
              const namespace = ar[1]; 
              api.q = api.q || []; 
              if(typeof namespace === "string"){
                cal.ns[namespace] = cal.ns[namespace] || api;
                p(cal.ns[namespace], ar);
                p(cal, ["initNamespace", namespace]);
              } else p(cal, ar); 
              return;
            } 
            p(cal, ar); 
          }; 
        })(window, "https://app.cal.com/embed/embed.js", "init");

        Cal("init", "maintenance-reparation", {origin:"https://app.cal.com"});

        Cal.ns["maintenance-reparation"]("inline", {
          elementOrSelector:"#my-cal-inline-maintenance-reparation",
          config: {
            "layout":"month_view",
            "useSlotsViewOnSmallScreen":"true",
            "theme":"light"   // ← changé en light pour cohérence avec le site clair
          },
          calLink: "info-cafe-knwc5n/maintenance-reparation",
        });

        Cal.ns["maintenance-reparation"]("ui", {
          "theme":"light",   // ← light au lieu de dark
          "cssVarsPerTheme":{
            "light":{
              "cal-brand":"#2563eb",          // blue-600 pour matcher votre palette
              "cal-brand-emphasis":"#1d4ed8"  // blue-700 hover
            }
          },
          "hideEventTypeDetails":false,
          "layout":"month_view"
        });
      </script>

    </div>

    <!-- Texte de réassurance – même ton que la section "Pourquoi nous" -->
    <div class="text-center max-w-4xl mx-auto space-y-6 text-lg md:text-xl text-gray-700 leading-relaxed">
      <p>Une fois votre créneau réservé, vous recevrez une confirmation par mail avec le lien visio (ou l’adresse si intervention sur site).</p>
      
      <p>Pas de stress : on explique tout simplement, sans jargon technique.</p>
      
      <p class="font-semibold text-blue-600 text-2xl pt-4">
        Ici, on prend le temps – à votre rythme, sans jugement.
      </p>

      <p class="text-base md:text-lg mt-8">
        Une question avant de réserver ? 
        <a href="#contact" class="text-blue-600 hover:text-blue-700 underline font-medium">
          Contactez-nous
        </a>
      </p>
    </div>

  </div>

</main>

<!-- Styles supplémentaires pour harmoniser Cal.com avec votre charte -->
<style>
  /* Ajustements fins pour que Cal.com ressemble aux cartes du site */
  #my-cal-inline-maintenance-reparation {
    border-radius: 1rem;
  }
  /* Masquer le branding Cal.com si autorisé par votre plan */
  .cal-branding {
    display: none !important;
  }
  /* Scrollbar discrète */
  #my-cal-inline-maintenance-reparation::-webkit-scrollbar {
    width: 8px;
  }
  #my-cal-inline-maintenance-reparation::-webkit-scrollbar-track {
    background: #f3f4f6;
  }
  #my-cal-inline-maintenance-reparation::-webkit-scrollbar-thumb {
    background: #9ca3af;
    border-radius: 4px;
  }
  #my-cal-inline-maintenance-reparation::-webkit-scrollbar-thumb:hover {
    background: #6b7280;
  }
</style>