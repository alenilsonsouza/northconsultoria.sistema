<?php require 'partials/aviso.php'; ?>
<section class="full">
    <div class="container">
        <h1 class="title1">Contato</h1>

        <div class="contact--info">
            <div class="contact--info-item">
                <img src="<?= BASE_URL_IMAGE; ?>whatsapp.png" alt="">
                <span>27 99915-6105</span>
            </div>
            <div class="contact--info-item">
                <img src="<?= BASE_URL_IMAGE; ?>tel.png" alt="">
                <span>27 3763-1927</span>
            </div>
            <div class="contact--info-item">
                <img src="<?= BASE_URL_IMAGE; ?>email.png" alt="">
                <span>pianaseguros@gmail.com</span>
            </div>
        </div>
      
        <form action="<?= BASE_URL; ?>contato/storage" method="post" class="contact-form">
            <div class="flex">
                <div>
                    <input type="text" name="nome" placeholder="Digite o seu nome" required>
                </div>
                <div>

                    <input type="tel" name="celular" required placeholder="Digite o seu telefone" id="celular">
                </div>
                <div>

                    <input type="email" name="email" placeholder="Digite o seu e-mail" required>
                </div>
            </div>

            <div>

                <select name="assunto" required>
                    <option value="">Assunto</option>
                    <option value="Planos de Saúde">Planos de Saúde</option>
                    <option value="Planos Odontológicos">Planos Odontológicos</option>
                    <option value="Empréstimos">Empréstimos</option>
                    <option value="Proteção Veicular e seguros">Proteção Veicular e seguros</option>
                </select>
            </div>
            <div>
                <textarea name="mensagem" placeholder="Digite a mensagem"></textarea>
            </div>
            <div>
                <button type="submit" class="button">Enviar</button>
            </div>

        </form>
    </div>
</section>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
    let cpf = document.querySelector('#celular');
    IMask(cpf, {
        mask: '(00) 00000-0000'
    });
</script>