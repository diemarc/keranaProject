<script>

    var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

    copyTextareaBtn.addEventListener('click', function (event) {
        var copyTextarea = document.querySelector('.js-copytextarea');
        copyTextarea.select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Copying text command was ' + msg);
        } catch (err) {
            console.log('Oops, unable to copy');
        }
    });
</script>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-default">
            <span class='text-success'>
                <i class="fa fa-code fa-2x"></i>     
                <strong>MasterQuery-></strong><?php echo $rsModel->model; ?>
            </span>
            <button type="button" class="close" onclick="hideDiv('div_aux2')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="res_up"></div>
            <div class='well'>
                <h5 class="text-primary">Generated at <?php echo date('Y-m-d h:i:s');?></h5>
                <div class='container-fluid'>
                    <textarea id='master' rows=8 class="js-copytextarea form-control">
                        <?php echo trim($master_query, "."); ?>
                    </textarea>
                    <div class="breadcrumb">
                    <button class='js-textareacopybtn btn btn-primary'

                            >copy to clipboard</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>