<p class="title is-5">Games</p>
<p class="subtitle is-3">Published:</p>
<div class="columns is-multiline mt-2">
  <?php foreach($game as $game): ?>
    <div class="column is-3">
      <div class="media">
        <figure class="media-left">
          <p class="image is-64x64">
            <img src="<?= base_url() ?>/images/<?= $game['image'] ?>-thumb.jpeg">
          </p>
        </figure>
        <div class="media-content">
          <p class="title is-5"><?php if($game['rumor'] == 1): ?><span class="icon has-text-danger is-small" title="RUMOR!"><i class="fas fa-user-secret"></i></span>&nbsp;<?php endif; ?><a href="<?= base_url() ?>/game/<?= $game['slug'] ?>"><?= character_limiter($game['name'], 15, '...') ?></a></p>
          <p class="subtitle is-7">Release <?php if($game['release'] == '2099-01-01' || $game['release'] == 'TBA'): ?>TBA<?php else: ?><?= $game['release'] ?><?php endif; ?></p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
