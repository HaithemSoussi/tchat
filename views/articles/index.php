    <h1>Liste des articles</h1>
    <?php foreach ($articles as $article): ?>
        <h2><a href="lire/<?= $article['slug'] ?>"><?= $article['nom'] ?></a></h2>
        <p><?= $article['description'] ?></p>
        <p><?= $article['prix'] ?></p>
    <?php endforeach; ?>