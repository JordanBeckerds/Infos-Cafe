<footer class="bg-white border-t border-gray-200 py-4 px-8 text-center text-sm text-gray-500 min-w-[100%] mt-[5vh]">
    &copy; <?= date('Y') ?> Info-Café Administration. Tous droits réservés.
</footer>

<script>
    // Example: Add confirmation to delete buttons
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', (e) => {
            if(!confirm('Voulez-vous vraiment supprimer cet élément ?')) e.preventDefault();
        });
    });
</script>