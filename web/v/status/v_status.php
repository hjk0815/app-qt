<div class="row">
  <div class="col-md-12 ml-auto1 mr-auto1">
    <div class="card">
      <div class="card-header card-header-success">

        <?php
        $active = STATUS_MAIN;
        include(APP . 'v/status/v_header.php');
        ?>
      </div>

      <div class="card-body">
        <div class="row ">

          <div class="col-lg-3 col-md-3 col-sm-3 padding5">
            <div class="panel_block padding5">
              <h2 class="">Version view(LARK)</h2>
              <ul class="padding0">

                <div class="row ">
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Hardware Version<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;"><?= $REG_HARDWARE_VERSION ?><small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label class="bmd-label-floating" style="font-size: 1em;">BSP Version<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label class="bmd-label-floating" style="font-size: 1em;"><?= $REG_APP_VERSION ?><small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">FPGA Version<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;"><?= $fpag_version ?><small></small></label>
                  </div>
                </div>

                <div class="row ">
                </div>

              </ul>
            </div>
            <div class="panel_block padding5">
              <h2 class="">Motor Status</h2>
              <ul class="padding0">

                <div class="row ">
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Driver Version<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="motorDriverVersion" class="bmd-label-floating" style="font-size: 1em;">0<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label class="bmd-label-floating" style="font-size: 1em;">Horz Speed<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label id="motorHorzSpeed" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Motor Status<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="motorStats" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>

                </div>

                <div class="row ">
                </div>

              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-3 padding5">
            <div class="panel_block padding5">
              <h2 class="">CPU Temperature</h2>
              <ul class="padding0">
                <div class="row ">
                  <div class="col-lg-12">
                    <label id="stat0Value" class="bmd-label-floating" style="font-size: 4em;color:darkslategray">0.0</label>
                    <label id="stat0Status" class="bmd-label-floating" style="font-size: 1em;color:darkslategray">'C</label>
                  </div>

                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Average<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="stat0Average" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label class="bmd-label-floating" style="font-size: 1em;">Minimum<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label id="stat0Min" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Maximum<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="stat0Max" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>

                </div>

              </ul>
            </div>

          </div>

          <div class="col-lg-3 col-md-3 col-sm-3 padding5">
            <div class="panel_block padding5">
              <h2 class="">UDP Send Rate(BSP)</h2>
              <ul class="padding0">
                <div class="row ">
                  <div class="col-lg-12">
                    <label id="stat1Value" class="bmd-label-floating" style="font-size: 4em;color:darkslategray">0.0</label>
                    <label id="stat1Status" class="bmd-label-floating" style="font-size: 1em;color:darkslategray">KB/s</label>
                  </div>

                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Average<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="stat1Average" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label class="bmd-label-floating" style="font-size: 1em;">Minimum<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label id="stat1Min" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Maximum<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="stat1Max" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>

                </div>

              </ul>
            </div>

          </div>


          <div class="col-lg-3 col-md-3 col-sm-3 padding5">
            <div class="panel_block padding5">
              <h2 class="">PS AUX VCC</h2>
              <ul class="padding0">
                <div class="row ">
                  <div class="col-lg-12">
                    <label id="stat2Value" class="bmd-label-floating" style="font-size: 4em;color:darkslategray">0.0</label>
                    <label id="stat2Status" class="bmd-label-floating" style="font-size: 1em;color:darkslategray">V</label>
                  </div>

                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Average<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="stat2Average" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label class="bmd-label-floating" style="font-size: 1em;">Minimum<small></small></label>
                  </div>
                  <div class="col-lg-6 row-bg-even">
                    <label id="stat2Min" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Maximum<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="stat2Max" class="bmd-label-floating" style="font-size: 1em;">0.0<small></small></label>
                  </div>

                </div>

              </ul>
            </div>

          </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 padding5">
            <div class="panel_block padding5">
              <h2 class="">Device serial bumber</h2>
              <ul class="padding0">
                <div class="row ">
                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Device number<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <input type="test" class="form-control" id="REG_DEVICE_ID" title="示例: PRODUCT-CHIP-LASER-ALGORITHM-DEVICE_NUMBER" required=""  
                    value= <?= $PRODUCT_V."-".$CHIP_V."-".$LASER_V."-".$ALG_V."-".$MOTOR_V."-".$hold_1."-".$DEVICE_NUMBER ?>>
                  </div>

                  <div class="col-lg-6">
                    <label class="bmd-label-floating" style="font-size: 1em;">Name<small></small></label>
                  </div>
                  <div class="col-lg-6">
                    <label id="DeviceName" class="bmd-label-floating" style="font-size: 1em;">**<small></small></label>
                  </div>

                </div>

              </ul>
          </div>

      </div>
    </div>
  </div>
</div>

<?php
include(APP . 'v/status/v_tail.php');
?>


<script>
  $(function() {
    var activeDev = <?= DEVICE_BSP ?>;

    const SerialNumDict = {
    Products: {
        "0" : "none",
        "1": "FB",
        "2": "LK1",
        "3": "LK2",
    },
    Chip: {
        "0" : "none",
        "1": "**",
    },
    Laser : {
        "0" : "none",
        "1" : "共电源",
        "2" : "非共电源",
    },
    Algorithm : {
        "0" : "none",
        "1" : "16K",
        "2" : "4x4K",
    },
    Motor: {
        "0" : "none",
        "1" : "16Hz",
        "2" : "32Hz",
    }
  };


    $("#btnRefresh").click(function() {
      location.replace(location.href);
    });

    $("#REG_DEVICE_ID").change(function() {
      var text = document.getElementById("REG_DEVICE_ID").value;
      var parArr = text.split('-');
      var result = parArr.map(part => {
        const intValue = parseInt(part, 10);
        if (intValue < 0 || intValue > 65535) {
            throw new Error(`Value ${intValue} is out of range for a byte.`);
        }
        return intValue;
      });
      const buffer = new ArrayBuffer(8); // 8 bytes to hold two 32-bit integers
      const dataView = new DataView(buffer);

      var listLen = result.length;
      // console.log("list len :: ",listLen);
      for (let i = 0; i < listLen-1; i++) {
          dataView.setUint8(i, result[i]);
      }
      dataView.setUint16(listLen-1, result[listLen-1]);

      // dataView.setUint8(4, intArray[4]);
      const firstUint32 = dataView.getUint32(0, false);
      const secondUint32 = dataView.getUint32(4, false);

      var addr = <?= REG_DEVICE_ID1 ?>;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + firstUint32 + "";
      ajaxExec(url);

      var addr = <?= REG_DEVICE_ID1 ?>;
      var url = "<?= AJAX_BASE ?>/regSet/&dev=" + activeDev + "&addr=" + addr + "&value=" + firstUint32 + "";
      ajaxExec(url);

      console.log("JKJJK :: ",firstUint32,secondUint32);
      updateDeviceName();
    })

    function updateDeviceName() {
      console.log("enter updata name")
      var text = document.getElementById("REG_DEVICE_ID").value;
      var parArr = text.split('-');
      var result = parArr.map(part => {
        const intValue = parseInt(part, 10);
        if (intValue < 0 || intValue > 65535) {
            throw new Error(`Value ${intValue} is out of range for a byte.`);
        }
        return intValue;
      });  
      var product = getValueByKey(SerialNumDict,["Products",result[0]]);
      var chip = getValueByKey(SerialNumDict,["Chip",result[1]]);
      var laser = getValueByKey(SerialNumDict,["Laser",result[2]]);
      var alg = getValueByKey(SerialNumDict,["Algorithm",result[3]]);
      var motor = getValueByKey(SerialNumDict,["Motor",result[4]]);
      var number = result[6];
      // console.log("device name :: ",name)
      let name = product +"-"+ chip+"-" + laser+"-" + alg+"-" + motor + "-Num" + number;
      document.getElementById("DeviceName").innerText = name;

    }
    updateDeviceName();
    function getValueByKey(dict, keys) {
    return keys.reduce((acc, key) => {
        if (acc && key in acc) {
            return acc[key];
        }
        return undefined;
    }, dict);
    }

    function updateState1() {
      $.ajax({
        type: "GET",
        url: "<?= AJAX_BASE ?>/dashboardCmd/&cmd=<?= DCMD_UPDATE ?>",
        contentType: 'application/json;charset=utf-8',
        dataType: "json",
        data: {},
        success: function(res) {
          console.log(res);
          while (res) {
            count = res.count;

            stat = res.cpuTemp;
            document.getElementById("stat0Value").innerText = stat[0];
            document.getElementById("stat0Average").innerText = stat[1];
            document.getElementById("stat0Min").innerText = stat[2];
            document.getElementById("stat0Max").innerText = stat[3];

            stat = res.udpRate;
            document.getElementById("stat1Value").innerText = stat[0];
            document.getElementById("stat1Average").innerText = stat[1];
            document.getElementById("stat1Min").innerText = stat[2];
            document.getElementById("stat1Max").innerText = stat[3];

            stat = res.vccPsAux;
            document.getElementById("stat2Value").innerText = stat[0];
            document.getElementById("stat2Average").innerText = stat[1];
            document.getElementById("stat2Min").innerText = stat[2];
            document.getElementById("stat2Max").innerText = stat[3];
            break;
          }

        },
        error: function(errorMsg) {
          console.log(errorMsg);
        }
      });
    }

    function updateMotor1() {
      $.ajax({
        type: "GET",
        url: "<?= URL_BASE ?>/status/formatMotorStatus",
        contentType: 'application/json;charset=utf-8',
        dataType: "json",
        data: {},
        success: function(res) {
          console.log(res);
          while (res) {
            document.getElementById("motorDriverVersion").innerText = res.driverVersion;
            document.getElementById("motorHorzSpeed").innerText = res.horzSpeed;
            document.getElementById("motorStats").innerHTML = res.motorStats;
            break;
          }

        },
        error: function(errorMsg) {
          console.log(errorMsg);
        }
      });
    }

    updateState1();
    updateMotor1();
    if (0){
      
      setInterval(function() {
        if (1) {
          updateState1();
          updateMotor1();
        }
      }, 1000);
    }


  });
</script>