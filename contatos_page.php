<?php
/*
 * Template Name: Contatos
 */
get_header();
?>

<div class="container">
    <div class="row">
        <!-- Breadcrumb -->
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contatos</li>
            </ol>
        </nav>

        <!-- Mapa e Informações -->
        <div class="col-12 col-md-6 mb-4">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1889.8680685295644!2d-39.863312499945906!3d-18.6758329733086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xca0cd4614ba4c1%3A0xd6dde30c8ab9461b!2sUniversidade%20Federal%20do%20Esp%C3%ADrito%20Santo%20-%20Campus%20S%C3%A3o%20Mateus!5e0!3m2!1spt-BR!2sbr!4v1724415085663!5m2!1spt-BR!2sbr"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Informações de Contato -->
        <div class="col-12 col-md-6">
            <h5>Endereço e Contato</h5>
            <div>
                <p>
                    Horário de atendimento: de segunda à sexta-feira, das 14h às 20h
                    <br>
                    Telefone: (27)3312-1740 (coordenação de curso)
                    <br>
                    E-mail: 
                    <a href="mailto:Raniella.bazoni@ufes.br" target="_blank">Raniella.bazoni@ufes.br</a>
                    <br>
                    Endereço: Rodovia BR-101, Km 60, Bairro Litorâneo, São Mateus – ES
                    <br>
                    Site:&nbsp;
                    <a href="https://fisica.saomateus.ufes.br">https://fisica.saomateus.ufes.br</a>&nbsp;
                </p>
                <br>
                <p class="m-0">
                    <strong>Diretor:</strong> Profº Luiz Antonio Favero Filho
                    <br>
                    <strong>Vice-diretora:</strong> Profª Vivian Estevam Cornelio
                    <br>
                    <strong>Coordenadora do projeto:</strong> Profª Dra. Raniella Falchetto Bazoni
                </p>
            </div>
        </div>
    </div>

    <!-- Perguntas, Sugestões, e Críticas -->
    <div class="row mt-5 text-center">
        <h5>
            Perguntas, sugestões e críticas
        </h5>
    </div>

    <!-- Formulário de Contato -->
    <div class="row d-flex flex-column align-items-center">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="formControlName" class="form-label">Nome</label>
                <input type="text" class="form-control" id="formControlName" placeholder="seu nome">
            </div>
            <div class="mb-3">
                <label for="formControlEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="formControlEmail" placeholder="nome@exemplo.com">
            </div>
            <div class="mb-3">
                <label for="formControlMesage" class="form-label">Mensagem</label>
                <textarea class="form-control" id="formControlMesage" rows="3" placeholder="Deixe sua mensagem aqui..."></textarea>
            </div>
        </div>
    </div>
</div>

<?php
// Inclui o rodapé do WordPress
get_footer();
?>
