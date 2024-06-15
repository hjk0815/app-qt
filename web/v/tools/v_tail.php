
<script>
  $(function() {

    // 任务切换tab
    // $("#headTab<?= TOOL_SLIDER ?>").click(function() {
    //   window.location.href = "<?= URL_BASE . "/tools/slider" ?>";
    // });

    $("#headTab<?= TOOL_NOISE ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/noise" ?>";
    });
    $("#headTab<?= TOOL_PCLD ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/pcld" ?>";
    });
    $("#headTab<?= TOOL_MOTOR ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/motor" ?>";
    });
    $("#headTab<?= TOOL_LASERID ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/laserIds" ?>";
    });
    $("#headTab<?= TOOL_IAP ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/iap" ?>";
    });

    $("#headTab<?= TOOL_ALGORITHM ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/algorithm" ?>";
    });

    $("#headTab<?= NOISE_CAPTURE ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/noiseCmd" ?>";
    });
    $("#headTab<?= NOISE_LIST ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/noiseList" ?>";
    });
    $("#headTab<?= NOISE_CONFIG ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/noiseChart" ?>";
    });
    $("#headTab<?= NOISE_SHIFT ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/tools/noiseShift" ?>";
    });

    

  });
</script>

