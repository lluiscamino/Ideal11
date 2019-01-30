<?php
$this->layout('global::main', array('title' => 'Home', 'url' => 'index'));
$selectedOrder = array('', '', '');
$selectedDirection = $this->e($direction) == 'DESC' ? array('selected', '') : array('', 'selected');
foreach ($selectedOrder as $i => $order) {
    if ($i === (int)$this->e($orderBy)) {
        $selectedOrder[$i] = 'selected';
    }
}
?>
<form class="form-inline" method="get" id="search-lineups-index">
  <div class="form-group">
    <label for="orderby-select">Order by</label>
    <select class="form-control" id="orderby-select" name="order">
      <option value="0" <?php echo $selectedOrder[0]; ?>>Creation date</option>
      <option value="1" <?php echo $selectedOrder[1]; ?>>Likes</option>
      <option value="2" <?php echo $selectedOrder[2]; ?>>Team</option>
    </select>
  </div>
  <div class="form-group">
    <label for="orderby-select">Order</label>
    <select class="form-control" id="orderby-select" name="direction">
      <option value="DESC" <?php echo $selectedDirection[0]; ?>>Descendant</option>
      <option value="ASC" <?php echo $selectedDirection[1]; ?>>Ascendant</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success mb-2">Search</button>
</form>
<?php
foreach($entries as $entry) {
    $this->insert('components::lineup_preview', $entry);
}
$this->insert('components::pagination', array('page' => $this->e($page), 'numPages' => $this->e($numPages)));