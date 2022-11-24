<nav class="text-center">
  <ul class="pagination">
    <?php for ($i=1; $i <= $arResult->excursions_list['page_count'] ; $i++):?>
    <li class="page-item <?php if ($arResult->current_page == $i): ?>
      active
    <?php endif ?>">
      <a class="page-link" href="?page_N=<?php echo $i;?>">
        <?php echo $i; ?>
      </a>
    </li>
    <?php endfor; ?>
  </ul>
</nav>
