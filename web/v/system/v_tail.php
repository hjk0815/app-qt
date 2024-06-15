
<script>
  $(function() {

    // 任务切换tab
    $("#headTab<?= SYSTEM_REGS ?>").click(function() {
      window.location.href = "<?= URL_BASE . "/main/systemRegs" ?>";
    });

  });
</script>

