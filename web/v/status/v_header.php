
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title"></span>

            <ul class="nav nav-tabs" data-tabs="tabs">

              <li class="nav-item">
                <a class="nav-link active<?= $active == STATUS_MAIN ? '' : 'x' ?>" id="headTab<?= STATUS_MAIN ?>" data-toggle="tab">
                  <span class="fa fa-certificate icon-2x"></span> Status
                  <div class="ripple-container"></div>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link active<?= $active == STATUS_TEMPERATURE ? '' : 'x' ?>" id="headTab<?= STATUS_TEMPERATURE ?>" data-toggle="tab">
                  <span class="fa fa-thermometer-half icon-2x"></span> Temperature
                  <div class="ripple-container"></div>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link active<?= $active == STATUS_VOLTAGE ? '' : 'x' ?>" id="headTab<?= STATUS_VOLTAGE ?>" data-toggle="tab">
                  <span class="fa fa-ticket icon-2x"></span> Voltage
                  <div class="ripple-container"></div>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link active<?= $active == STATUS_NETWORK ? '' : 'x' ?>" id="headTab<?= STATUS_NETWORK ?>" data-toggle="tab">
                  <span class="fa fa-sitemap icon-2x"></span> Network
                  <div class="ripple-container"></div>
                </a>
              </li>

            </ul>
          </div>
        </div>

        