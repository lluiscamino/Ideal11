<?php
$this->layout('global::main', array('title' => 'Create LineUp', 'url' => 'create'));
if ($this->e($alertText) !== '') {
    echo '<div class="alert alert-' . $this->e($alertType) . '" role="alert">' . $alertText . '</div>';
}
$shirtUrl = $setTeam !== '' ? '' : 'resources/images/kits/default.png';
?>
<div class="modal fade" id="errorNot11Players" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"><strong>You have to select 11 players.</strong> You have only placed <script>document.write(String(playersOnField.length))</script> players on the field.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div>
<form method="post" id="create-lineup-form">
    <div class="form-group">
        <label for="team">Team</label>
        <select class="form-control" id="team" name="team" onchange="changeKitImage()" required>
            <option selected disabled>Choose a team</option>
            <optgroup label="LaLiga">
                <?php
                foreach ($esTeams as $team) {
                    $selected = '';
                    if ($team['name'] === $setTeam) {
                        $selected = 'selected';
                        $shirtUrl = $team['shirt'];
                    }
                    echo '<option value="' . $team['id'] . '" ' . $selected . '>' . $team['name'] . '</option>';
                }
                ?>
                <optgroup label="Premier League">
                <?php
                foreach ($enTeams as $team) {
                    $selected = '';
                    if ($team['name'] === $setTeam) {
                        $selected = 'selected';
                        $shirtUrl = $team['shirt'];
                    }
                    echo '<option value="' . $team['id'] . '" ' . $selected . '>' . $team['name'] . '</option>';
                }
                ?>
                <optgroup label="Serie A">
                <?php
                foreach ($itTeams as $team) {
                    $selected = '';
                    if ($team['name'] === $setTeam) {
                        $selected = 'selected';
                        $shirtUrl = $team['shirt'];
                    }
                    echo '<option value="' . $team['id'] . '" ' . $selected . '>' . $team['name'] . '</option>';
                }
                ?>
                <optgroup label="Bundesliga">
                <?php
                foreach ($deTeams as $team) {
                    $selected = '';
                    if ($team['name'] === $setTeam) {
                        $selected = 'selected';
                        $shirtUrl = $team['shirt'];
                    }
                    echo '<option value="' . $team['id'] . '" ' . $selected . '>' . $team['name'] . '</option>';
                }
                ?>
                <optgroup label="Ligue 1">
                <?php
                foreach ($frTeams as $team) {
                    $selected = '';
                    if ($team['name'] === $setTeam) {
                        $selected = 'selected';
                        $shirtUrl = $team['shirt'];
                    }
                    echo '<option value="' . $team['id'] . '" ' . $selected . '>' . $team['name'] . '</option>';
                }
                ?>
        </select>
    </div>
    <?php
    foreach ($styles as $style) {
        echo '<input id="' . $style['id'] . '-code-style" type="hidden" value=\'' . $style['code'] . '\'>';
    }
    foreach ($esTeams as $team) {
        echo '<input id="' . $team['id'] . '-shirt" type="hidden" value=\'' . $team['shirt'] . '\'>';
    }
    foreach ($enTeams as $team) {
        echo '<input id="' . $team['id'] . '-shirt" type="hidden" value=\'' . $team['shirt'] . '\'>';
    }
    foreach ($itTeams as $team) {
        echo '<input id="' . $team['id'] . '-shirt" type="hidden" value=\'' . $team['shirt'] . '\'>';
    }
    foreach ($deTeams as $team) {
        echo '<input id="' . $team['id'] . '-shirt" type="hidden" value=\'' . $team['shirt'] . '\'>';
    }
    foreach ($frTeams as $team) {
        echo '<input id="' . $team['id'] . '-shirt" type="hidden" value=\'' . $team['shirt'] . '\'>';
    }
    ?>
    <div class="form-group">
        <label for="style">Formation style</label>
        <select class="form-control" id="style" name="style" onchange="changeFormationStyle()" required>
            <option selected disabled>Choose a style</option>
            <?php
            foreach ($styles as $style) {
                $selected = $style['title'] === $setStyle ? 'selected' : '';
                echo '<option value="' . $style['id'] . '" ' . $selected . '>' . $style['title'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="formation">Formation</label>
        <input type="hidden" id="kitUrl" name="kitUrl" value="<?php echo $shirtUrl?>" required>
        <input type="hidden" id="formation" name="formation" required>
        <div class="create-team">
            <div class="field" id="field">
            </div>
            <div class="select-player">
                <strong>Add players</strong>
                <p><input type="text" class="form-control" id="player-name" maxlength="25" placeholder="Player name">
                    <button type="button" class="btn btn-success" id="generate-player" onclick="addPlayer()">Add</button>
                <div id="available-players"></div>
            </div>
        </div>
    </div>
    <div style="clear: both;" onmouseover="updateInputs()">
        <br>
        <input type="submit" class="btn btn-success" name="createLineUp" value="Publish" onclick="checkSubmit(event)">
        <input type="reset" class="btn btn-default" value="Reset">
    </div>
</form>
<script>
    $('#field').droppable({
        drop: function(ev, ui) {
            let id = idtoInt(ui.draggable.attr('id'));
            if (!playersOnField.includes(id)) {
                playersOnField.push(id);
            }
            ui.draggable.children().eq(0).css('display', 'block');
            ui.draggable.children().eq(0).css('display', 'block');
        }
    });
    generateLineUp(<?php echo $defaultLineUp; ?>, '<?php echo $shirtUrl; ?>', <?php echo (int) $locatePlayers; ?>);
</script>
