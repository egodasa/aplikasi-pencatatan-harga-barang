</div>
<!-- Akhir dari Bagian Isi Halaman -->

</div>
</section>
<!-- Akhir dari Bagian Kontent/Isi Halaman -->


</div>

<!-- Bagian Footer/Bawah -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright � 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>
<!-- Akhir dari Bagian Footer/Bawah -->

<!-- Javascript -->
<script src="assets/js/app_adminlte.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    var url = window.location;
    $('ul.nav a[href="' + url + '"]').parent().addClass('active');
    $('ul.nav a').filter(function () {
      return this.href == url;
    }).parent().addClass('active');
    
    // Semua tabel memiliki ID yang sama untuk datatable
    $("#tabel").DataTable();
  });
</script>
<!-- Akhir dari Javascript -->
</div>
</body>

</html>
