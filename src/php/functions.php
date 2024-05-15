<?php

    class Functions {
        public function showNotification($msg) { ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Mensagem</strong>
                        <small>Agora</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= $msg; ?>
                    </div>
                </div>
            </div>
            <script src="../../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../../../assets/js/showNotification.js"></script>
            <?php
        }
    }

?>