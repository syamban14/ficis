        </div>
        <div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white"><i class="bi bi-box-arrow-right"></i> Logout?</h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="<?php echo base_url();?>assets/img/logout2.gif" class="img-fluid">
                        <div class="d-grid">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</a>
                                <a href="<?php echo base_url();?>login/logout" class="btn btn-danger">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center py-4 bg-white text-muted border-top">
            Copyright IT BCS 2022
        </footer>
        <script type="text/javascript">
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var thisDay = date.getDay(),
                thisDay = myDays[thisDay];
            var yy = date.getYear();
            var year = (yy < 1000) ? yy + 1900 : yy;
            var hari_ini = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
            document.getElementById('time').innerHTML=hari_ini;
            //-->
            function startTime() {
                var today=new Date(),
                curr_hour=today.getHours(),
                curr_min=today.getMinutes(),
                curr_sec=today.getSeconds();
                curr_hour=checkTime(curr_hour);
                curr_min=checkTime(curr_min);
                curr_sec=checkTime(curr_sec);
                document.getElementById('time').innerHTML=hari_ini+" "+curr_hour+":"+curr_min+":"+curr_sec;
            }
            function checkTime(i) {
                if (i<10) {
                    i="0" + i;
                }
                return i;
            }
            setInterval(startTime, 500);

            $('button.navbar-toggler').click(function(event) {
                $('#main').toggleClass("blur");
            });
            $(document).ready(function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                  return new bootstrap.Tooltip(tooltipTriggerEl);
                });
                var tooltipTriggerLists = [].slice.call(document.querySelectorAll('.tooltips'));
                var tooltipLists = tooltipTriggerLists.map(function (tooltipTriggerEl) {
                  return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }); 
        </script>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>-->

        
        <!-- <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap5.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js"></script>
        <!-- Bootstrap Select JS Plugin -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    </body>
</html>