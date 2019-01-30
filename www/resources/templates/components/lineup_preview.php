<?php
$authorField = $author !== 'Guest' ? '<a href="user.php?name=' . $this->e($author) . '">' . $this->e($author) . '</a>' : 'Guest';
?>
<div class="lineup-preview">
    <a href="lineup.php?id=<?php echo $id; ?>" class="lineup-link"><h2><?php echo $this->e($team); ?> (<?php echo $this->e($style); ?>)</h2></a>
    <span class="lineup-details">
        <img src="resources/images/icons/user.png" alt="User" title="Created by"> <?php echo $authorField; ?>
        <img src="resources/images/icons/calendar.png" alt="Calendar" title="Creation date"> <?php $creationDate = new DateTime($this->e($creationDate)); echo $creationDate->format(DATE_FORMAT); ?>
        <img src="resources/images/icons/heart.png" alt="Likes" title="Likes"> <?php echo $likes; ?>
    </span>
    <img src="resources/images/lineups/<?php echo $id; ?>.png" alt="Formation style">
</div>