<script type="text/x-template" id="template-qr-code">

    <div class="col-sm-4">
      <div class="panel panel-info">
          <div class="panel-heading">
          <h3 class="panel-title"><strong><i class="fa fa-qrcode fa-2x"></i> QR Code generator</strong></h3>
          </div>
          <div class="panel-body">

          <iframe src="./phpqrcode/index.php" frameborder="0" style="height: 440px;width: 100%;margin-top: -1%;"></iframe>

</div> <!--End body-->  
</div> <!--End Panel-->
</div> <!--End Panel-->

</script>

<script>
 var QR_code =  Vue.component('app-qr-code', {
    template: '#template-qr-code'
  });
</script>

<style>
  
</style>