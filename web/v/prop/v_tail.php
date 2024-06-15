
<script>
  $(function() {

    // 任务切换tab
    $("#headTab<?= PROP_HOST ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/prop/host" ?>";
    });
    $("#headTab<?= PROP_CHANNELS ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/prop/channels" ?>";
    });
    $("#headTab<?= PROP_BSP ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/prop/bsp" ?>";
    });
    $("#headTab<?= PROP_FPGA ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/prop/fpga" ?>";
    });
    $("#headTab<?= PROP_DEBUG ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/prop/debug" ?>";
    });

  });
</script>

