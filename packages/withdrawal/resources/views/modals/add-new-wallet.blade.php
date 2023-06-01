
 <!--  Modal content for the above example -->
 <div class="modal fade bs-example-modal-lg"  id="walletsModal" tabindex="-1" role="dialog" aria-labelledby="walletsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" onsubmit="return false;" id="new-wallet-form" action="{{ $saveWalletUrl }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Add new wallet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                           
                <div class="col-12">
                    <label for="label-wallet-address">Lable address wallet</label>    
                    <div class="input-group mb-3">  
                        <input  type="text" id="-label-wallet-address" class="form-control" name="label" required autofocus placeholder="Label">
                    </div>
                    <span id="label-error" class="invalid-feedback hidden" role="alert"></span>
                 </div>

                <div class="col-12">
                    <label for="wallet-address">Wallet address for {{$token->token_code}} </label>  
                    <div class="input-group mb-3">  
                        <input  type="text" id="wallet-address" class="form-control" name="wallet" required autocomplete="wallet" autofocus placeholder="wallet address">
                    </div>
                    <span id="wallet-error" class="invalid-feedback hidden" role="alert"></span>
                </div>
                

                <input type="hidden" name="token_id" value="{{$token->id}}">

                <div class="modal-footer">

                    
                    <button class="btn btn-light waves-effect w-a" id="clos-mk"  type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary waves-effect w-a waves-light" id="sub-btn-f" type="sumbit">Save</button>
            
                    <button class="btn btn-primary w-a waves-effect waves-light hidden" style="display: none" id="sub-btn-loading" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                      </button>
            
                </div>


            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>
(function($){
   $('body').on('submit', '#new-wallet-form', function (event) {
        event.preventDefault();
        var wallet = $('#wallet-address').val();
        $('#wallet-error').hide().html('');
        $('#sub-btn-f').hide()
        $('#sub-btn-loading').show()
        $.ajax({
          data: $('#new-wallet-form').serialize(),
          url: $('#new-wallet-form').attr('action'),
          type: "POST",
          dataType: 'json',
          success: function (data) {
              
              $('#sub-btn-f').show()
              $('#sub-btn-loading').hide()
            
             var walletData = data.data

             if (data.mode) {
                $('#user_wallet_id').append(new Option(data.data.label+' - '+data.data.wallet, data.data.id))
                $('#user_wallet_id').val(data.data.id);
                $('#clos-mk').click()
             } 


          },
          error: function (data) {
            $('#sub-btn-f').show()
              $('#sub-btn-loading').hide()

            try {
                if (data.responseJSON.errors.wallet[0] != '') {
                    $('#wallet-error').show().html('<span>'+data.responseJSON.errors.wallet[0]+'</span>');
                }
            } catch (error) {
                alert('Try again!');
            }
              
              console.log('Error:', data.responseJSON);
             
          },
          done:function() {
              $('#sub-btn-f').show()
              $('#sub-btn-loading').hide()
          }
      });
    });
})(jQuery); 
</script>

<style>
.w-a {
    width: auto
}
</style>