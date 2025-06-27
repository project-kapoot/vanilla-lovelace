<div class="waiting-room-page">
    <div class="container-700">
        <h1>Nom du quiz</h1>
        <?php if(!$user->hasRole('presenter')) : ?>
            <div class="presenter">
                <p class="text-center fw-bold">Présenté par :</p>
                <div class="player">
                    <img class="player__avatar" src="/assets/img/placeholder.png" alt="">
                    <span class="player__pseudo">Pseudonyme</span>
                </div>
            </div>
        <?php endif ?>
        <p class="text-center fw-bold">En attente de joueurs ...</p>
        <div class="players">
            <?php for($i = 0; $i < 8; $i++) : ?>
                <div class="player">
                    <img class="player__avatar" src="/assets/img/placeholder.png" alt="">
                    <span class="player_pseudo">Joueur numéro <?= $i ?></span>
                </div>
            <?php endfor ?>
        </div>
        <menu class="game-menu">
            <?php if($user->hasRole('presenter')) : ?>
                <button class="btn-secondary">Commencer la partie</button>
            <?php endif ?>
            <button class="btn-secondary">Copier le lien d'invitation</button>
        </menu>
    </div>
</div>