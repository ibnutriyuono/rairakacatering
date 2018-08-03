
<div class="fixed-action-btn">
  <a class="btn-floating btn-large teal-lighten-5">
    <i class="large material-icons">mode_edit</i>
  </a>
  <ul>
    <li><a href="<?php echo base_url(); ?>admin/laporan" target='_blank'class="btn-floating tooltipped yellow darken-1"data-position="left" data-tooltip="Print Laporan Order"><i class="material-icons">print</i></a></li>
    <li><a href="<?php echo base_url(); ?>admin/restore" target="_blank"class="btn-floating tooltipped green"data-position="left" data-tooltip="Restore Database"><i class="material-icons">publish</i></a></li>
    <li><a href="<?php echo base_url(); ?>admin/backup" class="btn-floating tooltipped blue"data-position="left" data-tooltip="Backup Database"><i class="material-icons">file_download</i></a></li>
  </ul>
</div>

<footer class="page-footer teal">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Tentang Kami</h5>
                    <p class="grey-text text-lighten-4">
                        Kami adalah Perusahaan Catering yang menyediakan berbagai alat catering yang bisa disewakan dan juga menyediakan makanan
                        dan minuman dengan bahan yang dijamin segar dan berkualitas. </p>


                </div>
                <div class="col l3 s12">
                    <h5 class="white-text">Kontak Kami</h5>
                    <ul>
                        <li>
                            <a class="white-text" href="<?php echo base_url(); ?>about">Tentang Kami</a>
                        </li>
                        <li>
                            <a class="white-text" href="#!">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div class="col l3 s12">
                    <h5 class="white-text">Lokasi</h5>
                    <ul>
                        <p class="grey-text text-lighten-4">RaiRaka Catering Dipatiukur Bandung 14045 Jawa Barat Indonesia
                        </p>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Made by
                <a class="brown-text text-lighten-3" href="#">RaiRaka</a>
            </div>
        </div>
    </footer>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
<script src="<?php echo base_url(); ?>assets/js/init.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
	$(document).ready(function () {
		$('.sidenav').sidenav();
        $('.modal').modal();
        $('.fixed-action-btn').floatingActionButton();
	});

	$(document).ready(function () {
		$('.tooltipped').tooltip();
	});

</script>
</body>

</html>
