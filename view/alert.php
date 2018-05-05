<style>

    .alert {
        /*background-color: #eee;*/
        /*padding: 20px;*/
    }

    .warning {
        background: rgba(255, 249, 62, 0.43);
        color: #9e9c28;
    }

    .error {
        background: rgba(236, 175, 175, 0.66);
        color: #a54646;
    }

    .success {
        background: rgba(41, 189, 53, 0.23);
        color: #4fa565;
    }
</style>


<div class="alert <?= $status ?>">
    <?= $message ?>
</div>