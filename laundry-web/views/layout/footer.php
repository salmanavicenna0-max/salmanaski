<footer class="py-0 my-4">
 
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    if(toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            // Pasang/Lepas class 'active'
            sidebar.classList.toggle('active');
        });
    }

    // Klik di luar sidebar buat nutup (khusus mobile)
    document.addEventListener('click', function(event) {
        const isClickInside = sidebar.contains(event.target) || toggleBtn.contains(event.target);
        
        if (!isClickInside && window.innerWidth < 992 && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }
    });
});
</script>
  <p class="text-center text-body-secondary">Copyright 2026 <br>XIPPLG1, Salman Avin</p>
</footer>