<!-- header enter -->

<ul class="nav nav-tabs" data-tabs="tabs">
<?php if ($userAuth >= AUTH_GUEST) { ?>
  <li class="nav-item">
    <a class="nav-link <?= $menu == MENU_STATUS ? "active" : "" ?> " 
    href="<?= URL_BASE ?>/status/index" data-toggle1="tab">
      <i class="fa fa-bar-chart fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="Status watch"></i> 
      <div class="ripple-container"></div>
    </a>
  </li>
<?php } ?>

<?php if ($userAuth >= AUTH_USER) { ?>
  <li class="nav-item">
    <a class="nav-link <?= $menu == MENU_PROP ? "active" : "" ?> " 
    href="<?= URL_BASE ?>/prop/index" data-toggle1="tab">
      <i class="fa fa-gear fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="Parameter setting"></i> 
      <div class="ripple-container"></div>
    </a>
  </li>
<?php } ?>

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
  <li class="nav-item">
    <a class="nav-link <?= $menu == MENU_TOOLS ? "active" : "" ?> " 
    href="<?= URL_BASE ?>/tools/index" data-toggle1="tab">
      <i class="fa fa-legal fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="Tool chains"></i> 
      <div class="ripple-container"></div>
    </a>
  </li>
<?php } ?>

<?php if ($userAuth >= AUTH_USER) { ?>
  <!-- <li class="nav-item">
    <a class="nav-link <?= $menu == MENU_CALIB ? "active" : "" ?> " 
    href="<?= URL_BASE ?>/calib/index" data-toggle1="tab">
      <i class="fa fa-crosshairs fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="System calibration"></i> 
      <div class="ripple-container"></div>
    </a>
  </li> -->
<?php } ?>

<?php if ($userAuth >= AUTH_ENGINEER) { ?>
  <li class="nav-item">
    <a class="nav-link <?= $menu == MENU_SYSTEM ? "active" : "" ?> " 
    href="<?= URL_BASE ?>/main/systemRegs" data-toggle1="tab">
      <i class="fa fa-terminal fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="Engineer tools"></i> 
      <div class="ripple-container"></div>
    </a>
  </li>
<?php } ?>

<?php if (0) { ?>
  <li class="nav-item">
    <a class="nav-link <?= $menu == MENU_POINTS ? "active" : "" ?> " target="_blank" 
    href="<?= URL_BASE ?>/main/pointCloud" data-toggle1="tab" data-bs-placement="top" title="Cloud points">
      <i class="fa fa-magnet fa-2x"></i> 
      <div class="ripple-container"></div>
    </a>
  </li>
<?php } ?>

</ul>

<!-- header leave -->