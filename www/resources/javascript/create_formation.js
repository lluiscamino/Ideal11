var numPlayers = 0, playersOnField = [];

function checkSubmit(event) {
    if (document.getElementById('player-name') === document.activeElement) {
        event.preventDefault();
        addPlayer();
        return false;
    } else if (playersOnField.length !== 11) {
        document.getElementById('numPlayersField').innerHTML = String(playersOnField.length);
        $('#errorNot11Players').modal();
        event.preventDefault();
        return false;
    }
}

function updateInputs() {
    createJson();
}

function createJson() {
    let json = '[';
    for (let i = 0; i < playersOnField.length; i++) {
        let element = document.getElementById('drag' + (playersOnField[i]-1));
        let elementObj = {id: i, player: element.dataset.player, w: element.style.left, h: element.style.top};
        json += JSON.stringify(elementObj);
        if (i != playersOnField.length-1) {
            json += ',';
        }
    }
    document.getElementById('formation').value = json + ']';
}

function generateLineUp(json, shirtUrl = '', locatePlayers = false) {
    let obj = JSON.parse(json);
    for (let i = 0; i < obj.length; i++) {
        if (obj[i].player !== undefined && locatePlayers) {
            includeShirt(shirtUrl, obj[i].player, parseInt(obj[i].h), parseInt(obj[i].w), true);
            $( function() {
                $('.available-player').draggable({
                    revert: 'invalid',
                    scroll: false
                });
            } );
            playersOnField.push(i+1);
            numPlayers++;
        }
    }
}

function changeFormationStyle() {
    let style = document.getElementById(document.getElementById('style').value + '-code-style').value;
    generateLineUp(style);
}

function changeKitImage() {
    let shirtUrl = document.getElementById(document.getElementById('team').value + '-shirt').value;
    let shirts = document.getElementsByClassName('kit');
    document.getElementById('kitUrl').value = shirtUrl;
    for (let i = 0; i < shirts.length; i++) {
        shirts[i].src = shirtUrl;
    }
}

function addPlayer() {
    let shirtUrl = document.getElementById('kitUrl').value;
    let name = document.getElementById('player-name').value;
    if (name != '') {
        includeShirt(shirtUrl, name);
        $( function() {
            $('.available-player').draggable({
                revert: 'invalid',
                scroll: false
            });
        } );
        document.getElementById('player-name').value = '';
        numPlayers++;
    } else {
        alert('You must write a player name');
    }
}

function removeFromField(id) {
    for (let i = 0; i < playersOnField.length; i++) {
        if (playersOnField[i] === id+1) {
            playersOnField.splice(i, 1);
            break;
        }
    }
    let element = document.getElementById('drag' + id);
    element.style.top = parseInt((element.dataset.pos)/ 7)*75 + 80 + 'px';
    element.style.left = (350 + (65 * (element.dataset.pos) % 450)) + 'px';
    element.children[0].style.display = 'none';
}

function idToInt(id) {
    return parseInt(id.substring(4))+1;
}

function includeShirt(shirtUrl, name, top = 'unset', left = 'unset', onfield = false) {
    if (top === 'unset' && left === 'unset') {
        left = (350 + (65 * numPlayers % 450));
        top = parseInt(numPlayers / 7)*75 + 80;
    }
    let width = name.length >= 10 ? 110 : 100;
    document.getElementById('available-players').innerHTML += '' +
        '<div class="ui-widget-content available-player" id="drag' + numPlayers + '" data-player="' + name + '" data-pos="' + numPlayers + '" style="top: ' + top + 'px; left: ' + left + 'px; position: absolute">' +
        '<img src="resources/images/icons/eye-minus.png" class="remove-player" title="Remove player ' + name + '" onclick="removeFromField(' + numPlayers + ')" style="display: ' + (onfield === true ? 'block' : 'none') + ';">' +
        '<img class="kit" src="' + shirtUrl + '">' +
        '<div class="player-name" style="width: ' + width + '%;">' + name + ''
        + '</div>' + '</div>';
}