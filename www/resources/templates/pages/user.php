<?php
$this->layout('global::main', array('title' => $this->e($userInfo['nickname']), 'url' => 'user'));
?>
<div class="row">
    <div class="col-sm-3">
        <div class="text-center">
            <?php
            if ($this->e($userInfo['vip'])) {
                echo '<div class="verified" title="Verified"></div>';
            }
            ?>
            <img src="<?php echo $this->e($userInfo['avatar']);?>" class="avatar img-circle img-thumbnail" alt="<?php echo $this->e($userInfo['nickname']);?>'s avatar">
            <span class="last-seen">Last seen: <?php $lastLogin = new DateTime($this->e($userInfo['lastLogin'])); echo $lastLogin->format(DATE_FORMAT); ?></span>
        </div>

    </div>
    <div class="col-sm-9">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#details" data-toggle="tab">User info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#notes" data-toggle="tab">LineUps</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#friends" data-toggle="tab">Comments</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="details">
                <hr>
                <p><strong>Number of LineUps:</strong> <?php echo $this->e($userInfo['numLineups']);?>
                <p><strong>Number of comments:</strong> X
                <p><strong>Register date:</strong> <?php $registerDate = new DateTime($this->e($userInfo['registerDate'])); echo $registerDate->format(DATE_FORMAT); ?>
            </div>
            <div class="tab-pane" id="notes">
                <hr>
                <?php
                if ($this->e($userInfo['numLineups'] !== 0)) {
                    echo '<ul class="list-group">';
                    foreach ($lineUps as $lineUp) {
                        $creationDate = new DateTime($lineUp['creationDate']);
                        echo '<li class="list-group-item"><a href="lineup.php?id=' . $lineUp['id'] . '">' . $lineUp['team'] . ' (' . $lineUp['style'] . ')</a><span class="user-lineups-date">' . $creationDate->format(DATE_FORMAT) . '</span></li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<i>This user has not created any LineUp yet.</i>';
                }
                ?>
            </div>
            <div class="tab-pane" id="friends">
                <hr>
                <i>No comments.</i>
            </div>
        </div>
    </div>
</div>