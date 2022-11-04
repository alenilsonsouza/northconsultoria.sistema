<?php require 'partials/aviso.php'; ?>
<section class="full">
    <div class="container">
        <h1 class="title1">Relatório de Beneficioários</h1>
        <form action="<?=BASE_URL;?>relatorio/verifyExists" method="post" class="form_document">
            <div class="input">
                <label for="cpf">CPF do Titular</label>
                <input type="tel" name="cpf" id="cpf" required placeholder="000.000.000-00">
            </div>
            <div class="input">
            <div class="g-recaptcha" data-sitekey="6LckTNwiAAAAAJlt9w9pZPhu5EhdoJbG_W8d1wWO"></div>
            </div>
            <div class="input">
                <button type="submit" class="button">Consultar</button>
            </div>
        </form>
    </div>
</section>
<script src="https://unpkg.com/imask"></script>
<script>
    let el = document.querySelector('#cpf');
    IMask(el, {
        mask: '000.000.000-00',
    });
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>