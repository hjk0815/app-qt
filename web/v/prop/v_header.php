
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title"></span>

            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a class="nav-link active<?= $active == PROP_HOST ? '' : 'x' ?>" id="headTab<?= PROP_HOST ?>" data-toggle="tab">
                  <span class="fa fa-window-restore icon-2x"></span> Host
                  <div class="ripple-container"></div>
                </a>
              </li>

<?php if ($userAuth >= AUTH_USER) { ?>
              <!-- <li class="nav-item">
                <a class="nav-link active<?= $active == PROP_CHANNELS ? '' : 'x' ?>" id="headTab<?= PROP_CHANNELS ?>" data-toggle="tab">
                  <span class="fa fa-podcast icon-2x"></span> Channels
                  <div class="ripple-container"></div>
                </a>
              </li> -->

              <li class="nav-item">
                <a class="nav-link active<?= $active == PROP_BSP ? '' : 'x' ?>" id="headTab<?= PROP_BSP ?>" data-toggle="tab">
                  <span class="fa fa-map  icon-2x"></span> BSP
                  <div class="ripple-container"></div>
                </a>
              </li>
<?php } ?>

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <li class="nav-item">
                <a class="nav-link active<?= $active == PROP_FPGA ? '' : 'x' ?>" id="headTab<?= PROP_FPGA ?>" data-toggle="tab">
                  <span class="fa fa-microchip  icon-2x"></span> FPGA
                  <div class="ripple-container"></div>
                </a>
              </li>
<?php } ?>

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
              <li class="nav-item">
                <a class="nav-link active<?= $active == PROP_DEBUG ? '' : 'x' ?>" id="headTab<?= PROP_DEBUG ?>" data-toggle="tab">
                  <span class="fa fa-bug  icon-2x"></span> Debug
                  <div class="ripple-container"></div>
                </a>
              </li>
<?php } ?>

            </ul>
          </div>
        </div>

        