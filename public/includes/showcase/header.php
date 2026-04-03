<header class="bg-gray-950 text-gray-200 shadow-lg">
  <div class="max-w-[90vw] md:max-w-[75vw] mx-auto px-4 lg:px-8">
    <div class="flex items-center justify-between h-[15vh]">

      <!-- Logo + Nom -->
      <div class="flex items-center">
        <a href="index.php?page=home" class="flex items-center">
          <img 
            src="../public/assets/logo.png" 
            alt="Logo Info-Café"
            class="h-24 sm:h-20 md:h-28 w-auto object-contain mr-4 md:mr-8 rounded-full"
          >
        </a>
      </div>

      <!-- Navigation desktop -->
      <nav class="hidden md:flex items-center space-x-8 lg:space-x-6">
        <a href="index.php?page=home"          class="text-lg lg:text-xl font-medium hover:text-blue-400 transition">Accueil</a>
        <a href="index.php?page=lessons"       class="text-lg lg:text-xl font-medium hover:text-blue-400 transition">Cours & Ateliers</a>
        <a href="index.php?page=repair"        class="text-lg lg:text-xl font-medium hover:text-blue-400 transition">Réparation & Maintenance</a>
        <a href="index.php?page=pc-build"      class="text-lg lg:text-xl font-medium hover:text-blue-400 transition">Montage PC</a>
        <a href="#" class="text-lg lg:text-xl font-medium hover:text-blue-400 transition">À propos</a>
        <a href="#" class="text-lg lg:text-xl font-medium hover:text-blue-400 transition">Contact</a>
        <a href="index.php?page=login" class="text-lg lg:text-xl font-medium hover:text-blue-400 hover:bg-[#e5e7eb] transition bg-blue-400 py-3 px-6 rounded-2xl">Login</a>
      </nav>

      <!-- Bouton mobile -->
      <button 
        id="mobile-menu-button" 
        class="md:hidden focus:outline-none transition-transform duration-400 ease-out hover:rotate-90 active:scale-95"
        aria-label="Ouvrir / Fermer le menu"
        aria-expanded="false"
      >
        <!-- Hamburger icon -->
        <svg 
          id="hamburger-icon" 
          class="w-10 h-10 text-gray-200 transition-all duration-400 ease-out transform rotate-0"
          fill="none" 
          stroke="currentColor" 
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>

        <!-- Close icon (starts hidden, rotated) -->
        <svg 
          id="close-icon" 
          class="w-10 h-10 text-gray-200 absolute inset-0 transition-all duration-400 ease-out opacity-0 rotate-[-90deg] scale-75"
          fill="none" 
          stroke="currentColor" 
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

    </div>

    <!-- Menu mobile -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-950 border-t border-gray-800 origin-top transition-all duration-400 ease-out opacity-0 scale-y-95 pointer-events-none">
      <nav class="flex flex-col space-y-6 py-8 text-center">
        <a href="index.php?page=home"          class="text-xl font-medium hover:text-blue-400 transition">Accueil</a>
        <a href="index.php?page=lessons"       class="text-xl font-medium hover:text-blue-400 transition">Cours & Ateliers</a>
        <a href="index.php?page=repair"        class="text-xl font-medium hover:text-blue-400 transition">Réparation & Maintenance</a>
        <a href="index.php?page=pc-build"      class="text-xl font-medium hover:text-blue-400 transition">Montage PC</a>
        <a href="#" class="text-xl font-medium hover:text-blue-400 transition">À propos</a>
        <a href="#" class="text-xl font-medium hover:text-blue-400 transition">Contact</a>
      </nav>
    </div>

  </div>
</header>

<script>
// Fixed JS – rotation reset + smooth crossfade
const button = document.getElementById('mobile-menu-button');
const menu = document.getElementById('mobile-menu');
const hamburger = document.getElementById('hamburger-icon');
const closeIcon = document.getElementById('close-icon');

if (button && menu && hamburger && closeIcon) {
  button.addEventListener('click', function () {
    const isCurrentlyOpen = !menu.classList.contains('hidden');

    if (isCurrentlyOpen) {
      // Close
      menu.classList.add('opacity-0', 'scale-y-95', 'pointer-events-none');
      setTimeout(() => menu.classList.add('hidden'), 400);

      hamburger.classList.remove('rotate-0', 'opacity-0');
      closeIcon.classList.add('opacity-0', 'rotate-[-90deg]', 'scale-75');
    } else {
      // Open
      menu.classList.remove('hidden');
      setTimeout(() => {
        menu.classList.remove('opacity-0', 'scale-y-95', 'pointer-events-none');
        menu.classList.add('opacity-100', 'scale-y-100', 'pointer-events-auto');
      }, 10);

      hamburger.classList.add('rotate-90', 'opacity-0');
      closeIcon.classList.remove('opacity-0', 'rotate-[-90deg]', 'scale-75');
    }

    button.setAttribute('aria-expanded', !isCurrentlyOpen);
  });
}
</script>