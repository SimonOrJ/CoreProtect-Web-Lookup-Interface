<?php
/**
 * index.php file
 * by Simon Chuu
 */
$config = require "config.php";
?><!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $config['page']['name'] ?></title>
      <?php
      $theme = $config['page']['bootstrap'];
      $dark = $config['page']['darkInput'];
      if (!$theme)
          echo '<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/slate/bootstrap.min.css" rel="stylesheet" integrity="sha384-G9YbB4o4U6WS4wCthMOpAeweY4gQJyyx0P3nZbEBHyz+AtNoeasfRChmek1C2iqV" crossorigin="anonymous">';
      elseif (strpos($theme, "<link ") === 0)
          echo $theme;
      else
          echo "<link rel=\"stylesheet\" href=\"$theme\">";
      if (!isset($dark) || $dark !== false)
          echo '<link rel="stylesheet" href="res/css/bootstrap-dark-input.css">';
      ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="res/css/bootstrap-datetimepicker.min.css"> <!-- https://github.com/technovistalimited/bootstrap4-datetimepicker -->
    <link rel="stylesheet" href="res/css/lookup.css">
<!--    <link rel="stylesheet" href="res/css/jquery-autocomplete.css">-->
  </head>
  <body data-spy="scroll" data-target="#row-pages">
    <nav id="top" class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
      <div class="container">
        <a class="navbar-brand" href="<?php echo $config['page']['href'] ?>"><?php echo $config['page']['name'] ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="nav navbar-nav">
              <?php foreach($config['navbar'] as $link => $href) echo
                  '<li class="nav-item"><a class="nav-link" href="' . $href . '">' . $link . '</a></li>';
              ?>
          </ul>
        </div>
      </div>
    </nav>

<!--    <nav id="scroll-nav" class="navbar navbar-dark bg-inverse navbar-fixed-bottom">
      <div class="container-fluid">
        <ul id="row-pages" class="nav navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#top">Top</a></li>
        </ul>
      </div>
    </nav>
-->
    <div class="container">
      <!-- Lookup Form -->
      <div class="card">
        <div class="card-header">Make a query</div>
        <form id="lookup-form" class="card-body">

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <label for="lookup-database" class="input-group-text">Server</label>
            </div>
            <select class="custom-select" id="lookup-database" name="server">
                <?php
                foreach (array_keys($config['database']) as $key) {
                    echo "<option value=\"$key\">$key</option>";
                }
                ?>
            </select>
          </div>

          <div class="row">
            <div class="col-auto form-group">
              <div class="input-group-append btn-group btn-group-toggle" data-toggle="buttons">
                <label for="lookup-a-block-add" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-block-add"> +Block
                </label>
                <label for="lookup-a-block-sub" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-block-sub"> -Block
                </label>
                <label for="lookup-a-container-add" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-container-add"> +Container
                </label>
                <label for="lookup-a-container-sub" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-container-sub"> -Container
                </label>
                <label for="lookup-a-kill" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-kill"> Kill
                </label>
              </div>
            </div>
            <div class="col-auto form-group">
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label for="lookup-rollback-yes" class="action-btns btn btn-secondary">
                  <input type="radio" id="lookup-rollback-yes" name="rollback"> Yes
                </label>
                <label for="lookup-rollback-null" class="action-btns btn btn-outline-secondary active">
                  <input type="radio" id="lookup-rollback-null" name="rollback" checked> Rollback
                </label>
                <label for="lookup-rollback-no" class="action-btns btn btn-secondary">
                  <input type="radio" id="lookup-rollback-no" name="rollback"> No
                </label>
              </div>
            </div>
            <div class="col-auto form-group">
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label for="lookup-a-click" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-click"> Click
                </label>
                <label for="lookup-a-chat" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-chat"> Chat
                </label>
                <label for="lookup-a-command" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-command"> Command
                </label>
                <label for="lookup-a-session" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-session"> Session
                </label>
                <label for="lookup-a-username" class="action-btns btn btn-secondary">
                  <input type="checkbox" id="lookup-a-username"> Username
                </label>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6 col-12 form-group input-group">
              <div class="input-group-prepend">
                <label for="lookup-coords-x" class="input-group-text" id="lookup-coords-label">Corner 1</label>
              </div>
              <input type="number" class="form-control" id="lookup-coords-x" name="x" placeholder="x">
              <input type="number" class="form-control" id="lookup-coords-y" name="y" placeholder="y">
              <input type="number" class="form-control" id="lookup-coords-z" name="z" placeholder="z">
            </div>
            <div class="col-md-6 col-12 form-group input-group">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-secondary" id="lookup-coords-toggle">
                  Corner 2
                </button>
              </div>
              <input type="number" class="form-control rounded-right" id="lookup-coords-radius" placeholder="radius" hidden>
              <input type="number" class="form-control" id="lookup-coords2-x" name="x2" placeholder="x">
              <input type="number" class="form-control" id="lookup-coords2-y" name="y2" placeholder="y">
              <input type="number" class="form-control" id="lookup-coords2-z" name="z2" placeholder="z">
            </div>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <label for="lookup-world" class="input-group-text">Worlds</label>
            </div>
            <input type="text" class="form-control" id="lookup-world" name="w" placeholder="Worlds, comma separated">
            <div class="input-group-append btn-group-toggle" data-toggle="buttons">
              <label for="lookup-world-exclude" class="btn btn-outline-secondary">
                <input type="checkbox" id="lookup-world-exclude"> Exclude
              </label>
            </div>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <label for="lookup-user" class="input-group-text">Users</label>
            </div>
            <input type="text" class="form-control" id="lookup-user" name="u" placeholder="Users, comma separated">
            <div class="input-group-append btn-group-toggle" data-toggle="buttons">
              <label for="lookup-user-exclude" class="btn btn-outline-secondary">
                <input type="checkbox" id="lookup-user-exclude"> Exclude
              </label>
            </div>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <label for="lookup-material" class="input-group-text">Materials</label>
            </div>
            <input type="text" class="form-control" id="lookup-material" name="b" placeholder="Blocks or items, comma separated">
            <div class="input-group-append btn-group-toggle" data-toggle="buttons">
              <label for="lookup-material-exclude" class="btn btn-outline-secondary">
                <input type="checkbox" id="lookup-material-exclude"> Exclude
              </label>
            </div>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <label for="lookup-entity" class="input-group-text">Entities</label>
            </div>
            <input type="text" class="form-control" id="lookup-entity" name="e" placeholder="Entities, comma separated">
            <div class="input-group-append btn-group-toggle" data-toggle="buttons">
              <label for="lookup-entity-exclude" class="btn btn-outline-secondary">
                <input type="checkbox" id="lookup-entity-exclude"> Exclude
              </label>
            </div>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <label for="lookup-keyword" class="input-group-text">Keyword</label>
            </div>
            <input type="text" class="form-control" id="lookup-keyword" name="keyword" placeholder="Keywords (roughly implemented)">
          </div>

          <div class="row">
            <div class="col-md-6 col-12 form-group input-group">
              <div class="input-group-prepend">
                <label for="lookup-time" class="input-group-text">Date/Time</label>
              </div>
              <input type="text" class="form-control datetimepicker-input" id="lookup-time" placeholder="0000-00-00T00:00:00" data-target="#lookup-time" data-toggle="datetimepicker">
              <div class="input-group-append btn-group-toggle" data-toggle="buttons">
                <label for="lookup-time-rev" class="btn btn-outline-secondary">
                  <input type="checkbox" id="lookup-time-rev"> Reverse
                </label>
              </div>
            </div>
            <div class="col-md-6 col-12 form-group input-group">
              <div class="input-group-prepend">
                <label for="lookup-limit" class="input-group-text">Limit</label>
              </div>
              <input type="number" class="form-control" id="lookup-limit" name="count" min="1" max="<?php echo $config['form']['max'] ?>" placeholder="<?php echo $config['form']['count'] ?>">
            </div>
          </div>

          <input class="btn btn-primary btn-block" type="submit" id="lookup-submit" value="Make a Lookup">
        </form>
      </div>
      <div id="lookup-alert">
      </div>
    </div>

    <!-- Output table -->
    <div class="container-fluid table-responsive">
      <table id="output-table" class="table table-sm table-striped">
        <thead class="thead-inverse">
          <tr id="row-0">
            <th>#</th>
            <th>Time</th>
            <th>User</th>
            <th>Action</th>
            <th>Coordinates/World</th>
            <th>Entity/Block/Item[Data] (Amount)</th>
          </tr>
        </thead>
        <tbody id="output-body">
          <tr>
            <th scope="row">-</th>
            <td colspan="7">Please submit a lookup.</td>
          </tr>
        </tbody>
        <caption id="output-time"></caption>
      </table>
    </div>

    <div class="container">
      <!-- Load More form -->
      <div id="more-form" class="card">
        <form class="card-body">
          <div class="row">
            <div class="col-md-6 col-12 form-group input-group">
              <div class="input-group-prepend">
                <label for="more-limit" class="input-group-text">Load next</label>
              </div>
              <input type="number" class="form-control" id="more-limit" name="count" min="1" max="<?php echo $config['form']['max'] ?>" placeholder="<?php echo $config['form']['moreCount'] ?>">
            </div>
          </div>

          <input class="btn btn-primary btn-block" type="submit" id="more-submit" value="Load more" disabled>
        </form>
      </div>
      <div id="more-alert">
      </div>

      <p>If you encounter any issues, please open an issue on the <a href="https://github.com/SimonOrJ/CoreProtect-Lookup-Web-Interface">GitHub project page</a>.</p>
    </div>

    <!-- Copyright Message -->
    <div class="container-fluid">
      <p>&copy; <?php echo str_replace("%year%", date("Y"),$config["copyright"]) ?>. <span class="">CoreProtect LWI v0.9.3-beta &ndash; Created by <a href="http://simonorj.com/">Simon Chuu</a>.</span></p>
    </div>

    <script>
      // noinspection JSAnnotator
      const config = <?php echo json_encode($config['form']) ?>;
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="res/js/bootstrap-datetimepicker.min.js"></script> <!-- https://github.com/technovistalimited/bootstrap4-datetimepicker -->
    <script src="res/js/lookup.js"></script>
  </body>
</html>
