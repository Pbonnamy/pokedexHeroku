<?php if (isset($_SESSION['pseudo'])) {?>
<div class="chatcontainer">
<p class="chattitle">Appuyer sur entrée pour valider</p>
<div><input class="chatinput" id=input placeholder="..." /></div>
<div id=box class="msgbox"></div>
<div>
<?php } ?>

<?php if (isset($_SESSION['pseudo'])) {
 echo '<div id="divCheckbox" style="display: none;">'.$_SESSION['pseudo'].'</div>';
} ?>

    <script src=https://cdn.pubnub.com/sdk/javascript/pubnub.4.28.2.min.js></script>

    <script>
    const name = document.getElementById('divCheckbox').innerHTML;

    (function() {
            var pubnub = new PubNub({
                publishKey: 'pub-c-d69b49c3-ec63-495b-a31d-c06b2c2ba31a',
                subscribeKey: 'sub-c-66f0521a-52bb-11eb-a73a-1eec528e8f1f'
            });
            function $(id) {
                return document.getElementById(id);
            }
            var box = $('box'),
                input = $('input'),
                channel = 'pokechat';


            pubnub.addListener({
                message: function(obj) {
                    box.innerHTML = ('' + obj.message).replace(/[<>]/g, '') + '<br>' + box.innerHTML
                }
            });
            pubnub.subscribe({
                channels: [channel]
            });

            pubnub.fetchMessages(
              {
                channels: ['pokechat'],
                end: '15343325004275466',
                count: 25
              },
              function (status, response) {
                //console.log(response);
                for(let i = 0; i< 25; i++){
                      box.innerHTML = ('' + response.channels.pokechat[i].message).replace(/[<>]/g, '') + '<br>' + box.innerHTML
                }
              }
            );
            input.addEventListener('keyup', function(e) {
                if ((e.keyCode || e.charCode) === 13) {
                    pubnub.publish({
                        channel: channel,
                        message: name+' : '+input.value,
                        x: (input.value = '')
                    });
                }
            });
        })();

    </script>
