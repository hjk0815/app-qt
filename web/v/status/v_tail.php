
<script>
  $(function() {

    // 任务切换tab
    $("#headTab<?= STATUS_TEMPERATURE ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/status/temp" ?>";
    });
    $("#headTab<?= STATUS_NETWORK ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/status/network" ?>";
    });
    $("#headTab<?= STATUS_MAIN ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/status/main" ?>";
    });
    $("#headTab<?= STATUS_VOLTAGE ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/status/voltage" ?>";
    });

  });
</script>

