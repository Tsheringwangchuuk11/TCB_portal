<div class="modal modal-danger fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="frm_title"></h4>
            </div>
            <div class="modal-body" id="frm_body">
                <p></p>
            </div>
            <div class="modal-footer">
                <div id="post-loading-container" class="hide text-center">
                    <img src="{{ asset('images\loading.gif') }}" alt="">
                </div>
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CANCEL</button>
                <button type="button" class="btn btn-outline" id="frm_submit">PROCEED</button>
            </div>
        </div>
    </div>
</div>
