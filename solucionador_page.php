<?php
/*
 * Template Name: Solucionador
 */
get_header();
?>

<div class="container">
   <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Simuladores</li>
      </ol>
   </nav>

   <!-- Seção das Minhas Simulações -->
   <div class="mb-5">
      <div class="row g-3" id="minhas-simulacoes">
         <!-- As simulações serão carregadas aqui via JavaScript -->
      </div>
   </div>

</div>

<script>
// Configuração das simulações próprias
const minhasSimulacoes = [
    {
        nome: "Pêndulo Simples",
        pasta: "pendulo-simples",
        arquivo: "index.html",
        imagem: "thumb.png",
        descricao: "Simulação interativa de um pêndulo simples com controles de comprimento, gravidade e ângulo inicial"
    },
    // Adicione novas simulações aqui seguindo o mesmo padrão
];

// Função para carregar as simulações próprias
function carregarMinhasSimulacoes() {
    const container = document.getElementById('minhas-simulacoes');
    
    minhasSimulacoes.forEach(simulacao => {
        const col = document.createElement('div');
        col.className = 'col-12 col-sm-6 col-lg-4';
        
        const imagemPath = `<?php echo get_template_directory_uri(); ?>/simulacoes/${simulacao.pasta}/${simulacao.imagem}`;
        const simulacaoPath = `<?php echo get_template_directory_uri(); ?>/simulacoes/${simulacao.pasta}/${simulacao.arquivo}`;
        
        col.innerHTML = `
            <div class="card h-100 shadow-sm cursor-pointer" onclick="abrirSimulacaoDirecta('${simulacaoPath}', '${simulacao.nome}')">
                <img src="${imagemPath}" class="card-img-top" alt="${simulacao.nome}" 
                     style="height: 200px; object-fit: cover;" 
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIi8+CiAgPHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzZjNzU3ZCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkltYWdlbSBuw6NvIGVuY29udHJhZGE8L3RleHQ+Cjwvc3ZnPgo='">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title text-center">${simulacao.nome}</h6>
                    <p class="card-text small text-muted flex-grow-1">${simulacao.descricao}</p>
                    <div class="text-center mt-auto">
                        <span class="badge bg-primary">Interativo</span>
                        <small class="text-muted d-block mt-1">Clique para abrir</small>
                    </div>
                </div>
            </div>
        `;
        
        container.appendChild(col);
    });
}

// Função para abrir simulação diretamente em nova janela
function abrirSimulacaoDirecta(url, nome) {
    // Configurações da janela
    const largura = Math.min(1200, screen.width * 0.9);
    const altura = Math.min(800, screen.height * 0.9);
    const esquerda = (screen.width - largura) / 2;
    const topo = (screen.height - altura) / 2;
    
    const configuracoes = `
        width=${largura},
        height=${altura},
        left=${esquerda},
        top=${topo},
        scrollbars=yes,
        resizable=yes,
        menubar=no,
        toolbar=no,
        location=no,
        status=no
    `;
    
    // Abrir em nova janela
    const novaJanela = window.open(url, `simulacao_${Date.now()}`, configuracoes);
    
    // Focar na nova janela (se possível)
    if (novaJanela) {
        novaJanela.focus();
    } else {
        // Fallback caso o popup seja bloqueado
        alert('Por favor, permita popups para este site para abrir a simulação em uma nova janela.');
    }
}

// Carregar simulações quando a página carregar
document.addEventListener('DOMContentLoaded', carregarMinhasSimulacoes);
</script>

<style>
   .cursor-pointer {
      cursor: pointer;
   }

   .card:hover {
      transform: translateY(-2px);
      transition: transform 0.2s ease-in-out;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
   }

   .card {
      transition: all 0.2s ease-in-out;
   }

   /* Efeito visual para indicar que é clicável */
   .card:hover .badge {
      background-color: #0d6efd !important;
      transform: scale(1.05);
   }

   .card:hover .card-title {
      color: #0d6efd;
   }

   /* Estilo adicional para melhor UX */
   .card-body small {
      font-size: 0.75rem;
      margin-top: 0.25rem;
   }
</style>

<?php get_footer(); ?>