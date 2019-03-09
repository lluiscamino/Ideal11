<?php
$this->layout('global::main', array('title' => $data['team'] . ' (' . $data['style'] . ')', 'url' => 'lineup'));
$authorField = $data['author'] !== 'Guest' ? '<a href="user.php?name=' . $data['author'] . '">' . $data['author'] . '</a>' : 'Guest';
$url = 'lineup.php?id=' . $data['id'];
$imageUrl = 'resources/images/lineups/' . $data['id'] . '.png';
?>
<div id="lineup-content">
    <div class="field" style="border: 0;">
        <img src="<?php echo $imageUrl; ?>" alt="Formation style">
        <div class="share-this-image">
            <div class="form-group">
                <label for="disabledTextInput">BBCode:</label>
                <input type="text" class="form-control" value="[url=<?php echo $url; ?>][img]<?php echo $imageUrl; ?>[/img][/url]" readonly>
            </div>
            <div class="form-group">
                <label for="disabledTextInput">HTML:</label>
                <input type="text" class="form-control" value="<a href=&quot;<?php echo $url; ?>&quot;><img src=&quot;<?php echo $imageUrl; ?>&quot; alt=&quot;LineUp generated with XXX&quot; title=&quot;LineUp generated with XXX&quot;></a>" readonly>
            </div>
        </div>
    </div>
    <div class="lineup-info">
        <img src="resources/images/icons/user.png" alt="User (icon)" title="Created by"> <strong>Author:</strong> <?php echo $authorField; ?><br>
        <img src="resources/images/icons/heart.png" alt="Heart (icon)" title="Likes"> <strong>Likes:</strong> <?php echo $data['likes']; ?><br>
        <img src="resources/images/icons/trophy.png" alt="Trophy (icon)" title="Team"> <strong>Team:</strong> <?php echo $data['team']; ?><br>
        <img src="resources/images/icons/style.png" alt="Style (icon)" title="Style"> <strong>Style:</strong> <?php echo $data['style']; ?><br>
        <img src="resources/images/icons/calendar.png" alt="Calendar (icon)" title="Creation date"> <strong>Created on:</strong> <?php $creationDate = new DateTime($data['creationDate']); echo $creationDate->format(DATE_FORMAT); ?><br>
        <img src="resources/images/icons/calendar2.png" alt="Calendar (icon) with a pencil" title="Last modification date"> <strong>Last modified:</strong> <?php if ($data['lastModificationDate'] !== '0000-00-00 00:00:00') {$lastModDate = new DateTime($data['lastModificationDate']); echo $lastModDate->format(DATE_FORMAT); } else {echo 'Never';} ?><br>
        <img src="resources/images/icons/group.png" alt="Group of people (icon)" title="Players"> <strong>Players:</strong>
        <?php
        $positions = json_decode($data['code'], true);
        $first = true;
        foreach ($positions as $position) {
            if (isset($position['player'])) {
                if (!$first) {
                    echo ', ';
                } else {
                    $first = false;
                }
                echo $position['player'];
            }
        }
        ?>
        <hr>
        <a href=""><img src="resources/images/icons/heart.png" alt="Heart (icon)" title="I like it"> I like it!</a><br>
        <a href='create.php?code=<?php echo $data['code']; ?>&team=<?php echo $data['team']; ?>&style=<?php echo $data['style']; ?>'><img src="resources/images/icons/plus.png" alt="Plus (icon)" title="Create new LineUp"> Create a new LineUp from this one</a>
        <br style="clear: both;">
    </div>
</div>