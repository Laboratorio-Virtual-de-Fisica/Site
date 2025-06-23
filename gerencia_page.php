<?php 
/* 
 * Template Name: Gerencia 
 */ 

get_header();

// Configurações do banco de dados 
$host = 'labvirtual.fisica.ufes.br'; 
$dbname = 'labvir_db'; 
$username = 'labvir_db'; 
$password = 'OwrucQ068FJ1'; 

// Inicializa as variáveis de edição
$editing = false;
$editId = 0;
$editTitulo = '';
$editMinutos = '';
$editUrl = '';

try {
    // Criando conexão com o banco de dados usando PDO 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // PROCESSAMENTO DE FORMULÁRIOS
    
    // Adicionar novo vídeo
    if (isset($_POST['submit_add'])) {
        $minutos = intval($_POST['minutos']);
        $titulo = htmlspecialchars($_POST['titulo']);
        $url = htmlspecialchars($_POST['url']);
        
        $sql = "INSERT INTO Videos (minutos, titulo, url) VALUES (:minutos, :titulo, :url)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['minutos' => $minutos, 'titulo' => $titulo, 'url' => $url]);
        
        echo '<div class="alert alert-success" role="alert">Vídeo adicionado com sucesso!</div>';
    }
    
    // Preparar edição de vídeo
    if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
        $editing = true;
        $editId = intval($_GET['edit']);
        
        $stmt = $pdo->prepare("SELECT * FROM Videos WHERE id = :id");
        $stmt->execute(['id' => $editId]);
        $video = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($video) {
            $editTitulo = $video['titulo'];
            $editMinutos = $video['minutos'];
            $editUrl = $video['url'];
        }
    }
    
    // Atualizar vídeo existente
    if (isset($_POST['submit_update'])) {
        $id = intval($_POST['video_id']);
        $minutos = intval($_POST['minutos']);
        $titulo = htmlspecialchars($_POST['titulo']);
        $url = htmlspecialchars($_POST['url']);
        
        $sql = "UPDATE Videos SET minutos = :minutos, titulo = :titulo, url = :url WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['minutos' => $minutos, 'titulo' => $titulo, 'url' => $url, 'id' => $id]);
        
        echo '<div class="alert alert-success" role="alert">Vídeo atualizado com sucesso!</div>';
        
        // Resetar o modo de edição
        $editing = false;
    }
    
    // Excluir vídeo
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        $id = intval($_GET['delete']);
        
        $sql = "DELETE FROM Videos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        echo '<div class="alert alert-warning" role="alert">Vídeo excluído com sucesso!</div>';
    }
    
    // Função para extrair o ID do vídeo do YouTube da URL
    function getYoutubeVideoId($url) {
        $pattern = 
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
        if (preg_match($pattern, $url, $match)) {
            return $match[1];
        }
        return false;
    }
    
} catch (PDOException $e) {
    echo '<div class="alert alert-danger" role="alert">Erro na conexão: ' . $e->getMessage() . '</div>';
}
?>

<div class="container mt-4">
    <!-- Cabeçalho com título e botão de adicionar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciamento de Vídeos</h1>
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addVideoModal">
            <i class="bi bi-plus-circle"></i> Adicionar Vídeo
        </button>
    </div>
    
    <!-- Modal para adicionar vídeo -->
    <div class="modal fade" id="addVideoModal" tabindex="-1" aria-labelledby="addVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addVideoModalLabel">
                        <?php echo $editing ? 'Editar Vídeo' : 'Adicionar Novo Vídeo'; ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo $editing ? '?edit=' . $editId : ''; ?>" id="videoForm">
                        <?php if ($editing): ?>
                            <input type="hidden" name="video_id" value="<?php echo $editId; ?>">
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título do Vídeo</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $editTitulo; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="url" class="form-label">URL do YouTube</label>
                            <input type="url" class="form-control" id="url" name="url" value="<?php echo $editUrl; ?>" required>
                            <div class="form-text">Exemplo: https://www.youtube.com/watch?v=dQw4w9WgXcQ</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="minutos" class="form-label">Duração (minutos)</label>
                            <input type="number" class="form-control" id="minutos" name="minutos" value="<?php echo $editMinutos; ?>" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <?php if ($editing): ?>
                        <button type="submit" form="videoForm" name="submit_update" class="btn btn-success">Atualizar Vídeo</button>
                    <?php else: ?>
                        <button type="submit" form="videoForm" name="submit_add" class="btn btn-primary">Adicionar Vídeo</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Lista de vídeos existentes -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            Lista de Vídeos
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php
                try {
                    $stmt = $pdo->query("SELECT * FROM Videos ORDER BY id DESC");
                    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (count($videos) > 0) {
                        foreach ($videos as $video) {
                            $videoId = getYoutubeVideoId($video['url']);
                            $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/mqdefault.jpg" : "https://via.placeholder.com/320x180?text=Sem+Imagem";
                            ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="<?php echo $thumbnailUrl; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($video['titulo']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($video['titulo']); ?></h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-secondary"><?php echo $video['minutos']; ?> minutos</span>
                                            <a href="<?php echo htmlspecialchars($video['url']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">Ver Vídeo</a>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <a href="?edit=<?php echo $video['id']; ?>" class="btn btn-sm btn-warning" 
                                           onclick="editVideo(<?php echo $video['id']; ?>)">Editar</a>
                                        <a href="?delete=<?php echo $video['id']; ?>" class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Tem certeza que deseja excluir este vídeo?')">Excluir</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="col-12 text-center py-5"><p>Nenhum vídeo cadastrado ainda.</p></div>';
                    }
                } catch (PDOException $e) {
                    echo '<div class="col-12"><div class="alert alert-danger" role="alert">Erro ao listar vídeos: ' . $e->getMessage() . '</div></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
// Script para abrir modal automaticamente quando estiver em modo de edição
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($editing): ?>
    var modal = new bootstrap.Modal(document.getElementById('addVideoModal'));
    modal.show();
    <?php endif; ?>
    
    // Função para tratar o clique em editar (será definida globalmente)
    window.editVideo = function(id) {
        // Previne o comportamento padrão do link
        event.preventDefault();
        
        // Redireciona para a mesma página com parâmetro de edição
        window.location.href = '?edit=' + id;
    };
});
</script>

<?php get_footer(); ?>