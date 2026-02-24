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

   <!-- Menu de Navegação das Simulações -->
   <div class="mb-4">
      <div class="row">
         <div class="col-12">
            <div class="card border-0 bg-light">
               <div class="card-body p-3">
                  <div class="d-flex flex-wrap align-items-center justify-content-between">
                     <div class="d-flex align-items-center mb-2 mb-md-0">
                        <i class="bi bi-grid-3x3-gap-fill me-2 text-primary" style="font-size: 1.2rem;"></i>
                        <h6 class="mb-0 text-muted">Categorias:</h6>
                     </div>
                     <div class="d-flex flex-wrap gap-2" id="menu-categorias">
                        <!-- Categorias serão geradas automaticamente -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Seção das Minhas Simulações -->
   <div class="mb-5">
      <div class="d-flex align-items-center justify-content-between mb-3">
         <h5 class="mb-0">
            <span id="titulo-secao">Todas as Simulações</span>
            <small class="text-muted ms-2">(<span id="contador-simulacoes">0</span> simulações)</small>
         </h5>
         <div class="dropdown">
            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
               <i class="bi bi-sort-down me-1"></i>Ordenar
            </button>
            <ul class="dropdown-menu">
               <li><a class="dropdown-item" href="#" onclick="ordenarSimulacoes('nome')">Por Nome</a></li>
               <li><a class="dropdown-item" href="#" onclick="ordenarSimulacoes('categoria')">Por Categoria</a></li>
            </ul>
         </div>
      </div>

      <div class="row g-3" id="minhas-simulacoes">
         <!-- As simulações serão carregadas aqui via JavaScript -->
      </div>
   </div>

</div>

<script>
   const minhasSimulacoes = [{
         nome: "Cinemática Unidimensional",
         pasta: "cinematica_unidimensional",
         arquivo: "index.html",
         imagem: "thumb.png",
         descricao: "Simulação interativa de movimento retilíneo com controles de posição inicial, velocidade, aceleração e tempo.",
         categoria: "Mecânica"
      },
      {
         nome: "Encontro de Particulas",
         pasta: "encontro-particulas",
         arquivo: "index.html",
         imagem: "thumb.png",
         descricao: "Simulação interativa de colisão entre duas partículas com ajuste de massas, velocidades e tipo de encontro (elástico ou inelástico).",
         categoria: "Mecânica"
      },
      {
         nome: "Pêndulo Simples",
         pasta: "pendulo-simples",
         arquivo: "index.html",
         imagem: "thumb.png",
         descricao: "Simulação interativa do movimento oscilatório de um pêndulo simples com controle de comprimento, massa, gravidade e ângulo inicial.",
         categoria: "Oscilações"
      },
      {
         nome: "Conversor de Unidades",
         pasta: "conversor-unidades",
         arquivo: "index.html",
         imagem: "thumb.jpg",
         descricao: "Conversor de unidades de outros sistemas para o Sistema Internacional.",
         categoria: "Conversões"
      },
      {
         nome: "Cinemática com Ref.",
         pasta: "cinematica_com_referencial",
         arquivo: "index.html",
         imagem: "thumb.png",
         descricao: "Simulação interativa de movimento retilíneo com controles de posição inicial, velocidade, aceleração e tempo e referencial.",
         categoria: "Mecânica"
      },
      {
         nome: "Movimento Bidimensional",
         pasta: "movimento_bidimensional",
         arquivo: "index.html",
         imagem: "thumb.png",
         descricao: "Simulação interativa de movimento bidimensional de uma joaninha sobre uma superfície horizontal.",
         categoria: "Cinemática"
      },
   ];

   let simulacoesFiltradas = [...minhasSimulacoes];
   let categoriaAtiva = 'todas';

   // Função para obter categorias únicas
   function obterCategorias() {
      const categorias = [...new Set(minhasSimulacoes.map(sim => sim.categoria))];
      return ['Todas', ...categorias.sort()];
   }

   function criarMenuCategorias() {
      const container = document.getElementById('menu-categorias');
      const categorias = obterCategorias();

      categorias.forEach(categoria => {
         const botao = document.createElement('button');
         botao.className = categoria === 'Todas' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm';
         botao.textContent = categoria;
         botao.onclick = () => filtrarPorCategoria(categoria);
         botao.id = `btn-${categoria.toLowerCase().replace(/\s+/g, '-')}`;
         container.appendChild(botao);
      });
   }

   function filtrarPorCategoria(categoria) {
      document.querySelectorAll('#menu-categorias button').forEach(btn => {
         btn.className = 'btn btn-outline-primary btn-sm';
      });
      document.getElementById(`btn-${categoria.toLowerCase().replace(/\s+/g, '-')}`).className = 'btn btn-primary btn-sm';

      if (categoria === 'Todas') {
         simulacoesFiltradas = [...minhasSimulacoes];
         categoriaAtiva = 'todas';
      } else {
         simulacoesFiltradas = minhasSimulacoes.filter(sim => sim.categoria === categoria);
         categoriaAtiva = categoria;
      }

      document.getElementById('titulo-secao').textContent =
         categoria === 'Todas' ? 'Todas as Simulações' : `Simulações - ${categoria}`;
      document.getElementById('contador-simulacoes').textContent = simulacoesFiltradas.length;

      carregarSimulacoes();
   }

   // Função para ordenar simulações
   function ordenarSimulacoes(tipo) {
      if (tipo === 'nome') {
         simulacoesFiltradas.sort((a, b) => a.nome.localeCompare(b.nome));
      } else if (tipo === 'categoria') {
         simulacoesFiltradas.sort((a, b) => {
            if (a.categoria === b.categoria) {
               return a.nome.localeCompare(b.nome);
            }
            return a.categoria.localeCompare(b.categoria);
         });
      }
      carregarSimulacoes();
   }

   // Função para carregar as simulações (atualizada)
   function carregarSimulacoes() {
      const container = document.getElementById('minhas-simulacoes');
      container.innerHTML = '';

      if (simulacoesFiltradas.length === 0) {
         container.innerHTML = `
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                    <h6 class="text-muted mt-3">Nenhuma simulação encontrada nesta categoria</h6>
                </div>
            </div>
        `;
         return;
      }

      simulacoesFiltradas.forEach(simulacao => {
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
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="card-title mb-0">${simulacao.nome}</h6>
                        <span class="badge bg-secondary small">${simulacao.categoria}</span>
                    </div>
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

   // Inicializar quando a página carregar
   document.addEventListener('DOMContentLoaded', function() {
      criarMenuCategorias();
      simulacoesFiltradas = [...minhasSimulacoes];
      document.getElementById('contador-simulacoes').textContent = simulacoesFiltradas.length;
      carregarSimulacoes();
   });
</script>

<style>
   .cursor-pointer {
      cursor: pointer;
   }

   .card:hover {
      transform: translateY(-2px);
      transition: transform 0.2s ease-in-out;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15) !important;
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

   /* Estilos do menu */
   #menu-categorias {
      gap: 0.5rem;
   }

   #menu-categorias button {
      transition: all 0.2s ease-in-out;
   }

   #menu-categorias button:hover {
      transform: translateY(-1px);
   }

   /* Responsividade do menu */
   @media (max-width: 768px) {
      #menu-categorias {
         justify-content: center;
         width: 100%;
      }

      .d-flex.flex-wrap.align-items-center.justify-content-between {
         flex-direction: column;
         align-items: stretch !important;
      }
   }

   /* Badge de categoria no card */
   .badge.bg-secondary {
      font-size: 0.7rem;
      background-color: #6c757d !important;
   }

   /* Animação suave para troca de conteúdo */
   #minhas-simulacoes {
      min-height: 300px;
   }
</style>

<?php get_footer(); ?>