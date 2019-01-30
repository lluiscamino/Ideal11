<?php
$this->layout('global::main', array('title' => 'Search by', 'url' => 'search'));
?>
<div class="search">
    <form action="index.php">
        <div class="form-group">
            <label for="searchTeam">Team</label>
            <select class="form-control" id="searchTeam" name="searchTeam">
                <option value="" selected>Don't search by team</option>
                <optgroup label="LaLiga">
                    <?php
                    foreach ($esTeams as $team) {
                        echo '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
                    }
                    ?>
                    <optgroup label="Premier League">
                    <?php
                    foreach ($enTeams as $team) {
                        echo '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
                    }
                    ?>
                    <optgroup label="Serie A">
                    <?php
                    foreach ($itTeams as $team) {
                        echo '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
                    }
                    ?>
                    <optgroup label="Bundesliga">
                    <?php
                    foreach ($deTeams as $team) {
                        echo '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
                    }
                    ?>
                    <optgroup label="Ligue 1">
                        <?php
                        foreach ($frTeams as $team) {
                            echo '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
                        }
                        ?>
            </select>
        </div>
        <div class="form-group">
            <label for="searchStyle">Formation style</label>
            <select class="form-control" id="searchStyle" name="searchStyle">
                <option value="" selected>Don't search by style</option>
                <?php
                foreach ($styles as $style) {
                    echo '<option value="' . $style['title'] . '">' . $style['title'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="searchAuthor">Author</label>
            <input class="form-control" type="text" id="searchAuthor" name="searchAuthor" placeholder="Leave empty to not search by author">
        </div>
        <input type="submit" class="btn btn-success" name="search" value="Search">
    </form>
</div>