<?php 
define('MARGIN', 2);
?>
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item <?php echo $this->e($page) == 1 ? 'disabled' : '';?>">
      <a class="page-link" href="index.php?p=<?php echo $this->e($page)-1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <?php 
    for ($i = $this->e($page) - MARGIN; $i <= $this->e($page) + MARGIN; $i++) {
        if ($i > 0 && $i <= $this->e($numPages)) {
            echo $i == $this->e($page) ? '<li class="page-item active" aria-current="page"><a class="page-link" href="index.php?p=' . $i . '">' . $i . ' <span class="sr-only">(current)</span></a></li>' : '<li class="page-item"><a class="page-link" href="index.php?p=' . $i . '">' . $i . '</a></li>';
        }
    }
    ?>
    <li class="page-item <?php echo $this->e($page) >= $this->e($numPages) ? 'disabled' : '';?>">
      <a class="page-link" href="index.php?p=<?php echo $this->e($page)+1; ?>">Next</a>
    </li>
  </ul>
</nav>