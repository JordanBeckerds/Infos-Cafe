<?php
// booking_lessons.php
// Page de prise de RDV pour les cours – avec bouton RETOUR ajouté
?>

<main class="bg-gray-50 min-h-screen py-16 md:py-24">

  <div class="container mx-auto px-6 max-w-6xl">

    <!-- Bouton RETOUR -->
    <div class="mb-8">
      <a href="index.php?page=lessons" 
         class="inline-flex items-center text-gray-700 hover:text-blue-600 font-medium text-lg transition-colors duration-200">
        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Retour aux cours
      </a>
    </div>

    <!-- Titre principal -->
    <div class="text-center mb-16">
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-800 leading-tight mb-6">
        Réserver un cours
      </h1>
      <p class="text-xl md:text-2xl text-gray-700 max-w-4xl mx-auto leading-relaxed">
        Choisissez entre un cours à domicile ou directement à la boutique Info-Café à Pau.  
        On avance tranquillement, à votre rythme, sans pression.
      </p>
      <p class="mt-6 text-lg font-medium text-blue-600">
        Première séance découverte possible • Café offert à la boutique
      </p>
    </div>

    <!-- Deux cartes côte à côte pour les deux options -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-16">

      <!-- Carte 1 : Cours à domicile -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-10 transition-all duration-300 hover:shadow-2xl hover:border-blue-400">
        <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">
          Cours à domicile
        </h2>
        <p class="text-lg text-gray-700 text-center mb-8 leading-relaxed">
          On vient chez vous, sur votre ordinateur ou smartphone.  
          Idéal si vous préférez rester tranquillement à la maison.
        </p>

        <!-- Embed Cal.com à domicile -->
        <div style="width:100%; min-height: 680px; overflow:scroll;" id="my-cal-inline-cours-a-domicile-info-cafe-pau"></div>

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

          Cal("init", "cours-a-domicile-info-cafe-pau", {origin:"https://app.cal.com"});

          Cal.ns["cours-a-domicile-info-cafe-pau"]("inline", {
            elementOrSelector:"#my-cal-inline-cours-a-domicile-info-cafe-pau",
            config: {
              "layout":"month_view",
              "useSlotsViewOnSmallScreen":"true"
            },
            calLink: "info-cafe-knwc5n/cours-a-domicile-info-cafe-pau",
          });

          Cal.ns["cours-a-domicile-info-cafe-pau"]("ui", {
            "hideEventTypeDetails":false,
            "layout":"month_view",
            "theme":"light",
            "cssVarsPerTheme":{
              "light":{
                "cal-brand":"#2563eb",
                "cal-brand-emphasis":"#1d4ed8"
              }
            }
          });
        </script>
      </div>

      <!-- Carte 2 : Cours à la boutique -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-10 transition-all duration-300 hover:shadow-2xl hover:border-blue-400">
        <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">
          Cours à la boutique
        </h2>
        <p class="text-lg text-gray-700 text-center mb-8 leading-relaxed">
          Venez nous voir à Info-Café à Pau.  
          Ambiance détendue, petit groupe ou individuel, café offert.
        </p>

        <!-- Embed Cal.com sur place -->
        <div style="width:100%; min-height: 680px; overflow:scroll;" id="my-cal-inline-cours-a-la-boutique"></div>

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

          Cal("init", "cours-a-la-boutique", {origin:"https://app.cal.com"});

          Cal.ns["cours-a-la-boutique"]("inline", {
            elementOrSelector:"#my-cal-inline-cours-a-la-boutique",
            config: {
              "layout":"month_view",
              "useSlotsViewOnSmallScreen":"true"
            },
            calLink: "info-cafe-knwc5n/cours-a-la-boutique",
          });

          Cal.ns["cours-a-la-boutique"]("ui", {
            "hideEventTypeDetails":false,
            "layout":"month_view",
            "theme":"light",
            "cssVarsPerTheme":{
              "light":{
                "cal-brand":"#2563eb",
                "cal-brand-emphasis":"#1d4ed8"
              }
            }
          });
        </script>
      </div>

    </div>

    <!-- Texte de réassurance final -->
    <div class="text-center max-w-4xl mx-auto space-y-6 text-lg md:text-xl text-gray-700 leading-relaxed">
      <p>Après réservation, vous recevrez une confirmation avec tous les détails (adresse pour la boutique ou horaire pour le domicile).</p>
      
      <p>On s’adapte complètement à votre niveau et à votre matériel – pas de jugement, que du plaisir d’apprendre.</p>
      
      <p class="font-semibold text-blue-600 text-2xl pt-4">
        Ici, tout le monde progresse à son rythme… et c’est ça qui compte.
      </p>

      <p class="text-base md:text-lg mt-10">
        Une question ou besoin d’un horaire particulier ? 
        <a href="#contact" class="text-blue-600 hover:text-blue-700 underline font-medium">
          Contactez-nous
        </a>
      </p>
    </div>

  </div>

</main>

<!-- Styles pour harmoniser les embeds Cal.com (inchangé) -->
<style>
  #my-cal-inline-cours-a-domicile-info-cafe-pau,
  #my-cal-inline-cours-a-la-boutique {
    border-radius: 1rem;
  }
  .cal-branding {
    display: none !important; /* si autorisé par votre plan Cal.com */
  }
  /* Scrollbar douce */
  #my-cal-inline-cours-a-domicile-info-cafe-pau::-webkit-scrollbar,
  #my-cal-inline-cours-a-la-boutique::-webkit-scrollbar {
    width: 8px;
  }
  #my-cal-inline-cours-a-domicile-info-cafe-pau::-webkit-scrollbar-track,
  #my-cal-inline-cours-a-la-boutique::-webkit-scrollbar-track {
    background: #f3f4f6;
  }
  #my-cal-inline-cours-a-domicile-info-cafe-pau::-webkit-scrollbar-thumb,
  #my-cal-inline-cours-a-la-boutique::-webkit-scrollbar-thumb {
    background: #9ca3af;
    border-radius: 4px;
  }
  #my-cal-inline-cours-a-domicile-info-cafe-pau::-webkit-scrollbar-thumb:hover,
  #my-cal-inline-cours-a-la-boutique::-webkit-scrollbar-thumb:hover {
    background: #6b7280;
  }
</style>