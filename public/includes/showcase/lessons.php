<?php
// lessons.php
// Page "Cours & Ateliers" – avec abonnement IA (Mail) ajouté en bas
?>

<section id="lessons" class="py-16 md:py-32 bg-white">
  <div class="container mx-auto px-6 max-w-5xl">
    
    <h2 class="text-4xl md:text-5xl font-bold text-center text-gray-800 mb-12">
      Nos cours & ateliers
    </h2>
    
    <p class="text-xl md:text-2xl text-center text-gray-700 mb-16 max-w-4xl mx-auto leading-relaxed">
      Apprenez à votre rythme, sans stress ni jugement.  
      Smartphone, tablette, ordinateur, internet, mails, appels vidéo, achats en ligne, réseaux sociaux…  
      On vous accompagne pas à pas, avec patience et bienveillance, que vous soyez débutant complet ou que vous ayez juste besoin d’un coup de main.
    </p>

    <!-- Deux options côte à côte -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 mb-16">

      <!-- Cours à domicile (inchangé) -->
      <div class="bg-gray-50 p-8 md:p-10 rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl hover:border-blue-400 hover:-translate-y-2 transition-all duration-300 text-center">
        <div class="text-7xl mb-6">🏠📱💻</div>
        <h3 class="text-3xl font-bold text-blue-700 mb-4">
          Cours à domicile
        </h3>
        <p class="text-base font-medium text-gray-600 mb-2">
          Lundi – Mercredi – Vendredi
        </p>
        <p class="text-lg text-gray-800 mb-4">
          9h – 18h (créneaux flexibles)
        </p>
        
        <div class="bg-blue-50 rounded-xl p-6 mb-8 border border-blue-200">
          <p class="text-xl font-semibold text-blue-700 mb-3">
            33,33 € / heure
          </p>
          <p class="text-base text-gray-700 leading-relaxed">
            Facturé à l’heure – devis personnalisé gratuit avant toute intervention
          </p>
        </div>
        
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
          On vient directement chez vous, sur votre smartphone, tablette ou ordinateur.  
          Idéal si vous préférez rester tranquillement à la maison, si le déplacement est compliqué ou si vous avez plusieurs appareils à voir.
        </p>
        
        <p class="text-base text-gray-600 italic">
          Diagnostic gratuit sur place ou à domicile (à votre choix) + suivi régulier du matériel après les cours
        </p>
      </div>

      <!-- Cours à la boutique (inchangé) -->
      <div class="bg-gray-50 p-8 md:p-10 rounded-2xl shadow-lg border border-gray-200 hover:shadow-2xl hover:border-blue-400 hover:-translate-y-2 transition-all duration-300 text-center">
        <div class="text-7xl mb-6">☕🖥️📱</div>
        <h3 class="text-3xl font-bold text-blue-700 mb-4">
          Cours à la boutique
        </h3>
        <p class="text-base font-medium text-gray-600 mb-2">
          Mardi – Jeudi
        </p>
        <p class="text-lg text-gray-800 mb-2">
          Mardi matin (9h–12h) : <strong>Téléphone</strong>
        </p>
        <p class="text-lg text-gray-800 mb-2">
          Mardi après-midi (14h–17h) : <strong>Ordinateur</strong>
        </p>
        <p class="text-lg text-gray-800 mb-2">
          Jeudi matin (9h–12h) : <strong>Ordinateur</strong>
        </p>
        <p class="text-lg text-gray-800 mb-6">
          Jeudi après-midi (14h–17h) : <strong>Téléphone</strong>
        </p>
        
        <div class="bg-blue-50 rounded-xl p-6 mb-8 border border-blue-200">
          <p class="text-xl font-semibold text-blue-700 mb-3">
            17,50 € / heure
          </p>
          <p class="text-lg font-semibold text-blue-800 mb-2">
            soit 52,50 € pour 3 heures
          </p>
          <p class="text-base text-gray-700">
            1 cours complet – café (ou thé) offert
          </p>
        </div>
        
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
          Venez à Info-Café à Pau.  
          Ambiance chaleureuse et détendue, en petit groupe ou en individuel selon vos besoins.
        </p>
        
        <p class="text-base text-gray-600 italic">
          Diagnostic gratuit sur place + suivi régulier du matériel après les cours
        </p>
      </div>

    </div>

    <!-- Bloc réservation -->
    <div class="text-center mt-16 mb-20">
      <a href="index.php?page=booking_lessons" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xl px-12 py-6 rounded-full transition shadow-xl hover:scale-105">
        Réserver un cours maintenant →
      </a>
      
      <p class="mt-8 text-lg text-gray-600">
        Choisissez votre créneau à domicile ou à la boutique sur la page suivante.  
        Diagnostic gratuit offert (sur place ou à domicile selon votre préférence).
      </p>
    </div>

    <!-- NOUVEAU : Abonnement IA (Mail) – intégré ici comme service complémentaire -->
    <div class="bg-blue-50 rounded-2xl shadow-lg p-8 md:p-12 mb-16 border border-blue-200">
      <h3 class="text-3xl font-bold text-blue-700 mb-8 text-center">
        Assistance IA par mail – spécialement pour les seniors
      </h3>
      
      <p class="text-lg text-gray-700 leading-relaxed mb-8 text-center max-w-3xl mx-auto">
        Vous envoyez simplement un mail à une adresse dédiée (ex. : aide@info-cafe-ia.fr).<br>
        Une intelligence artificielle très simple vous répond comme un chat, mais uniquement par mail.<br><br>
        Pas d’application à installer, pas de fenêtre qui s’ouvre, pas de « super machine intelligente » compliquée.<br>
        C’est fait exprès pour que ce soit plus facile à comprendre : on parle juste de mails, comme avec un proche patient.
      </p>

      <div class="grid md:grid-cols-2 gap-8 max-w-2xl mx-auto">
        <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 text-center">
          <p class="text-2xl font-bold text-blue-700 mb-3">Mensuel</p>
          <p class="text-3xl font-extrabold text-blue-800">5,00 €</p>
          <p class="text-gray-600 mt-2">/mois TTC – sans engagement</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-md border border-emerald-300 text-center relative">
          <div class="absolute -top-3 right-4 bg-emerald-500 text-white text-xs font-bold px-3 py-1 rounded-full">
            Promo –6 €
          </div>
          <p class="text-2xl font-bold text-blue-700 mb-3">Annuel</p>
          <p class="text-3xl font-extrabold text-emerald-700">54,00 €</p>
          <p class="text-gray-600 mt-2">/an TTC – soit 4,50 € / mois</p>
        </div>
      </div>

      <div class="mt-10 text-center">
        <a href="index.php?page=booking_repair" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold text-lg px-10 py-4 rounded-full transition shadow-lg">
          Découvrir l’abonnement IA (Mail) →
        </a>
      </div>
    </div>

    <!-- Réassurance finale -->
    <div class="text-center max-w-4xl mx-auto space-y-8 text-lg md:text-xl text-gray-700 leading-relaxed">
      <p>Pas besoin d’être expert ou rapide : on explique <strong>tout simplement</strong>, sans jargon technique.</p>
      <p>Groupes limités pour que chacun puisse poser ses questions sans se sentir perdu.</p>
      <p>Après chaque cours, on propose un <strong>suivi régulier de votre matériel</strong> (vérification du bon fonctionnement, conseils d’entretien, réponses à vos questions futures) — gratuit et sans engagement.</p>
      <p class="font-semibold text-blue-700 text-2xl pt-6">
        Chez Info-Café, on n’est jamais « trop vieux » ou « trop débutant » — on apprend ensemble, à votre rythme.
      </p>
    </div>

  </div>
</section>