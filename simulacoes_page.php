<?php
/*
 * Template Name: simulacoes
 */
get_header();

// Configurações do banco de dados 
$host = 'labvirtual.fisica.ufes.br'; 
$dbname = 'labvir_db'; 
$username = 'labvir_db'; 
$password = 'OwrucQ068FJ1'; 

// Função para extrair o ID do vídeo do YouTube da URL
function getYoutubeVideoId($url) {
    $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
    if (preg_match($pattern, $url, $match)) {
        return $match[1];
    }
    return false;
}

// Função para formatar a URL do YouTube para embed
function getYoutubeEmbedUrl($url) {
    $videoId = getYoutubeVideoId($url);
    if ($videoId) {
        return "https://www.youtube.com/embed/{$videoId}";
    }
    return $url;
}

// Buscar vídeos do banco de dados
$videos = [];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT * FROM Videos ORDER BY id DESC");
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo '<div class="alert alert-danger" role="alert">Erro ao buscar vídeos: ' . $e->getMessage() . '</div>';
}
?>

<!-- Conteúdo principal -->
<main>
    <div class="container">
        <!-- Breadcrumb -->
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vídeos</li>
            </ol>
        </nav>
        <!-- Grid de vídeos -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php if (count($videos) > 0): ?>
                <?php foreach ($videos as $video): ?>
                    <?php 
                        $embedUrl = getYoutubeEmbedUrl($video['url']);
                        $videoId = getYoutubeVideoId($video['url']);
                    ?>
                    <div class="col">
                        <div class="card shadow-sm bg-transparent border bg-body-secondary h-100">
                            <?php if ($embedUrl): ?>
                            <div class="ratio border ratio-16x9">
                                <iframe 
                                    src="<?php echo $embedUrl; ?>"
                                    title="<?php echo htmlspecialchars($video['titulo']); ?>" 
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <?php else: ?>
                            <div class="ratio border ratio-16x9 bg-secondary d-flex align-items-center justify-content-center">
                                <div class="text-white text-center p-3">
                                    <i class="bi bi-film fs-1"></i>
                                    <p>Vídeo indisponível</p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-body-emphasis"><?php echo htmlspecialchars($video['titulo']); ?></h5>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <a href="<?php echo htmlspecialchars($video['url']); ?>" class="btn btn-primary" target="_blank">Acessar</a>
                                    <small class="text-secondary"><?php echo $video['minutos']; ?> min</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        <p class="mb-0">Nenhum vídeo encontrado no banco de dados.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (current_user_can('administrator') || current_user_can('editor')): ?>
        <!-- Botão de gerenciamento (apenas para administradores) -->
        <div class="mt-5 text-center">
            <a href="<?php echo home_url('/gerencia'); ?>" class="btn btn-outline-primary">
                <i class="bi bi-gear-fill me-1"></i> Gerenciar Vídeos
            </a>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php
// Inclui o rodapé do WordPress
get_footer();
?>