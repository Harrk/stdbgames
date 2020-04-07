<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php if (isset ( $item['gName'] )): ?>
    <title>Stadia GamesDB! -- <?= $item['gName'] ?></title>
    <?php else: ?>
    <title><?= $title ?></title>
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <section class="section">
      <div class="container">
      <nav class="navbar">
        <div class="navbar-brand">
          <a class="navbar-item" href="<?= base_url() ?>">Stadia GamesDB!</a>
          <div class="navbar-burger">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </div>
        </div>
        <div class="navbar-menu">
          <div class="navbar-start">
            <a class="navbar-item" href="<?= base_url() ?>/about">About</a>
            <?php if ( session('role') == 1): ?>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link">New...</a>
              <div class="navbar-dropdown">
                <a class="navbar-item" href="<?= base_url() ?>/games/gameform/">...Game</a>
                <a class="navbar-item" href="<?= base_url() ?>/games/devform/">...Developer</a>
                <a class="navbar-item" href="<?= base_url() ?>/games/pubform/">...Publisher</a>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <div class="navbar-end">
            <div class="navbar-item">
              <div class="buttons">
              <?php if( session('is_logged') != TRUE): ?>
                <a class="button is-primary" href="<?= base_url() ?>/users/signuser">Sign In</a>
                <a class="button is-light" href="<?= base_url() ?>/users/loguser">Log In</a>
                <?php else: ?>
                  <a class="button is-primary" href="<?= base_url() ?>/users/landing/<?= session('username') ?>">Profile</a>
                  <a class="button is-light" href="<?= base_url() ?>/users/logout">Log Out</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </nav>
      </div>
    </section>
