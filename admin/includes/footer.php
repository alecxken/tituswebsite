    </div><!-- /.admin-content -->
</div><!-- /.admin-main -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc4s9bIOgUxi8T/jzmHA5BAFM/aHXo/9a3b4HXk1LKq1" crossorigin="anonymous"></script>
<script>
/* Confirm before destructive actions */
document.querySelectorAll('[data-confirm]').forEach(function(el) {
    el.addEventListener('click', function(e) {
        if (!confirm(el.dataset.confirm || 'Are you sure?')) { e.preventDefault(); }
    });
});
</script>
<?php if (isset($page_scripts)) echo $page_scripts; ?>
</body>
</html>
