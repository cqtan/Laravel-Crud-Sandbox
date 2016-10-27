
function slay_dragon() {
  var slaying = true;
  var youHit = Math.floor(Math.random() * 2);
  var damageThisRound = Math.floor(Math.random() * 5 + 1);
  var totalDamage = 0;

  while (slaying) {
    var message1 = "";
    var message2 = "";
    if (youHit) {
        message1 = ("You hit the dragon for " + damageThisRound + " damage.");
        totalDamage += damageThisRound;
        alert(message1);
        if (totalDamage >= 4) {
            message2 = ("You defeated the dragon! Gz!");
            slaying = false;
            alert(message2);
        } else {
            youHit = Math.floor(Math.random() * 2);
        }
    } else {
        message2 = ("You missed and died horribly");
        alert(message2);
    }
    slaying = false;
  }
}
