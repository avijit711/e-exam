<div class="marquee">
  <marquee class="moving">
    <?php
    $notice_sql = "SELECT * FROM notice";
    $notice_stmt = $pdo->query($notice_sql);
    $notices = $notice_stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($notices as $key => $notice) {
        echo "<span class='badge badge-danger'> Latest Notice</span>";
        echo "<strong><a tabindex='-1' href='notice.view.php?id=".$notice['notice_id']."'> ".$notice['title']." </a></strong>";

      }


    ?>
  </marquee>
</div>
