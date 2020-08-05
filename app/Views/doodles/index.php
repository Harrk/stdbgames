<div class="columns mt-2">
  <div class="column">
    <p class="subtitle is-5">Stadia</p>
    <p class="title is-3">Doodles:</p>
    <div class="content mt-2">
      <p>
        <strong>Stadia Doodles</strong> Are that cool images made by Google to promote some games on the <strong>Stadia</strong> platform and I'm trying to collect all here in this little page.
        <br \>
        The idea comes from Sarah White's (<a href="https://twitter.com/squeak_easy" target="_blank">squeak_easy</a>) Twitter and I find that it can be a pretty good idea to make, so here it is!
      </p>
    </div>
  </div>
</div>
<?php if(isset($error)): ?>
  <div class="columns">
    <div class="column">
      <div class="content has-text-centered">
        <?= $error ?>
      </div>
    </div>
  </div>
<?php else: ?>
  <div class="columns is-multiline">
    <?php foreach($doodle as $doodle): ?>
      <div class="column is-4">
        <div class="card">
          <div class="card-image">
            <figure class="image is-5by4">
              <img src="<?= base_url() ?>/images/doodles/<?= $doodle['image'] ?>-thumb.jpeg">
            </figure>
          </div>
          <div class="card-content is-overlay">
            <span class="tag is-primary has-text-dark"><a href="<?= base_url() ?>/game/<?= $doodle['game_slug'] ?>"><?= $doodle['game_name'] ?></a></span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
<?php if(isset($insert)): ?>
  <div class="columns mt-2">
    <div class="column">
      <form action="<?= base_url() ?>/doodles/insertdoodle" method="post" enctype="multipart/form-data">
        <div class="field is-grouped is-grouped-multiline">
          <div class="control is-expanded">
            <input type="file" name="image" class="input">
          </div>
          <?= view_cell('\App\Controllers\Games::allgames') ?>
          <div class="control">
            <button class="button is-primary has-text-dark" value="submit">Add Doodle</button>
          </div>
          <div class="control">
            <button class="button is-danger has-text-white" value="reset">Start Over</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php endif; ?>
