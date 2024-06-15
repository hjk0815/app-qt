
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title"></span>

            <ul class="nav nav-tabs" data-tabs="tabs">

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <!-- <li class="nav-item">
                <a class="nav-link active<?= $active == TOOL_SLIDER ? '' : 'x' ?>" id="headTab<?= TOOL_SLIDER ?>" data-toggle="tab">
                  <span class="fa fa-exchange  icon-2x"></span> SLIDER
                  <div class="ripple-container"></div>
                </a>
              </li> -->
<?php } ?>

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <li class="nav-item">
                <a class="nav-link active<?= $active == TOOL_MOTOR ? '' : 'x' ?>" id="headTab<?= TOOL_MOTOR ?>" data-toggle="tab">
                  <span class="fa fa-empire  icon-2x"></span> MOTOR
                  <div class="ripple-container"></div>
                </a>
              </li>
<?php } ?>

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <li class="nav-item">
                <a class="nav-link active<?= $active == TOOL_PCLD ? '' : 'x' ?>" id="headTab<?= TOOL_PCLD ?>" data-toggle="tab">
                  <span class="fa fa-podcast  icon-2x"></span> SCANNING
                  <div class="ripple-container"></div>
                </a>
              </li>
<?php } ?>

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <li class="nav-item">
                <a class="nav-link active<?= $active == TOOL_LASERID ? '' : 'x' ?>" id="headTab<?= TOOL_LASERID ?>" data-toggle="tab">
                  <span class="fa fa-stack-overflow fa-flip-horizontal  icon-2x"></span> LASERID
                  <div class="ripple-container"></div>
                </a>
              </li>
<?php } ?>

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <li class="nav-item">
                <a class="nav-link active<?= $active == TOOL_IAP ? '' : 'x' ?>" id="headTab<?= TOOL_IAP ?>" data-toggle="tab">
                  <span class="fa fa-cogs icon-2x"></span> IAP
                  <div class="ripple-container"></div>
                </a>
              </li>
<?php } ?>


<?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <li class="nav-item">
                <a class="nav-link active<?= $active == TOOL_ALGORITHM ? '' : 'x' ?>" id="headTab<?= TOOL_ALGORITHM ?>" data-toggle="tab">
                  <span class="fa fa-keyboard-o icon-2x"></span> ALGORITHM
                  <div class="ripple-container"></div>
                </a>
              </li>
<?php } ?>


<?php if (1) { ?>
            <?php if ($active == TOOL_NOISE) { ?> 
              <li class="nav-item">
                <a class="nav-link dropdown-toggle <?= $active == TOOL_NOISE ? 'active' : '' ?>" data-toggle="dropdown" href="#">
                  <span class="fa fa-puzzle-piece  icon-2x"></span> BASE NOISE
                  <div class="ripple-container"></div>
                </a>

                <ul class="dropdown-menu">
                  <li><a href="#" id="headTab<?= NOISE_CAPTURE ?>" class="nav-pills dropdown-toggle1 btn-primary<?= $page == NOISE_CAPTURE ? '' : 'x' ?>">Noise Capture</a></li>
                  <li class="divider"></li>
                  <li><a href="#" id="headTab<?= NOISE_CONFIG ?>" class="nav-pills dropdown-toggle1 btn-primary<?= $page == NOISE_CONFIG ? '' : 'x' ?>">Chart View(config)</a></li>
                  <li><a href="#" id="headTab<?= NOISE_SHIFT ?>" class="nav-pills dropdown-toggle1 btn-primary<?= $page == NOISE_SHIFT ? '' : 'x' ?>">Chart View(shift)</a></li>
                  <li><a href="#" id="headTab<?= NOISE_LIST ?>" class="nav-pills dropdown-toggle1 btn-primary<?= $page == NOISE_LIST ? '' : 'x' ?>">List View</a></li>
                </ul>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link active<?= $active == TOOL_NOISE ? '' : 'x' ?>" id="headTab<?= TOOL_NOISE ?>" data-toggle="tab">
                  <span class="fa fa-puzzle-piece  icon-2x"></span> BASE NOISE
                  <div class="ripple-container"></div>
                </a>
              </li>
            <?php } ?>
<?php } ?>

            </ul>
          </div>
        </div>

        