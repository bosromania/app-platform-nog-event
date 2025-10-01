<?php
$player = trim(basename(urldecode($_SERVER['SCRIPT_URL'] ?? $_SERVER['REDIRECT_URL'])), ' /'); // number (1, 2, 3)

if (is_numeric($player) == false || $player > 3) {
    header("Location: /");
    exit;
}

$game = $_GET['game'] ?? 'a';

if (false == in_array($game, ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h','i','j'])) {
    header("Location: ?game=a");
    exit;
}

$next_game = chr(ord($game) + 1);

set_error_handler(function ($e_code, $text, $file, $line) use ($player, $game) {
    if (error_reporting() != 0) { // Because for expressions prepended by @ it returns 0 (zero).
        throw new ErrorException($text, $e_code, 0, "$player/$game", $line);
    }
});
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ro" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="ro" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="ro" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ro" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="language" http-equiv="content-language" content="ro">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>BOS la NOG <?= date('Y') ?></title>
    <meta name="description" itemprop="description"
        content="BOS la Noaptea ONG-urilor <?= date('Y') ?>. Participă la coding-ul echipei Web." />
    <meta name="expires" content="never">
    <meta name="revisit-after" content="1 Days">
    <meta name="google" content="notranslate" />

    <meta name="robots" content="noindex, nofollow" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://nog.bosromania.ro">
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:title" content="BOS la NOG <?= date('Y') ?>">
    <meta property="og:description"
        content="BOS la Noaptea ONG-urilor <?= date('Y') ?>. Participă la coding-ul echipei Web.">
    <meta property="og:image" itemprop="image" content="/assets/SEO-SM-image.jpg">
    <meta property="og:image:alt" content="BOS la NOG <?= date('Y') ?>">

    <meta name="twitter:url" content="https://nog.bosromania.ro" />
    <meta property="twitter:title" content="BOS la NOG <?= date('Y') ?>">
    <meta property="twitter:description"
        content="BOS la Noaptea ONG-urilor <?= date('Y') ?>. Participă la coding-ul echipei Web.">
    <meta name="twitter:image" content="/assets/SEO-SM-image.jpg" />
    <meta property="twitter:image:alt" content="BOS la NOG <?= date('Y') ?>">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">

    <style>
    #QR-code {
        opacity: 0;
    }

    img.logo-taiat {
        /* game c & e */
        display: none;
    }

    body[game="c"] #QR-code,
    body[game="i"] #QR-code,
    body[game="e"] #QR-code {
        opacity: 1;
    }

    body[game="c"] img.logo-taiat,
    body[game="i"] img.logo-taiat,
    body[game="e"] img.logo-taiat {
        position: absolute;
        transform: translate(50%, 20%);
    }

    body[game="i"] img.logo-taiat,
    body[game="e"] img.logo-taiat {
        display: block;
        top: 0%;
        left: 0%;
    }

    #cos {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    #cos li {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>

    <link href="/assets/favicon-bos.png" rel="shortcut icon" type="image/png" />
</head>

<body player="<?= $player ?>" game="<?= $game ?>">
    <div class="container py-2">
        <div class="row align-items-center py-3 border-bottom">
            <div class="col-6 text-center">
                <img id="hacker" class="w-50 py-3" src="/assets/WebDev-stereotype-hacker.png" />
                <div>
                    <span class="text-<?= $player == 1 ? 'primary' : ($player == 2 ? 'success' : 'info') ?>">Player
                        <?= $player ?></span>
                </div>
            </div>
            <div class="col-6 text-center pos-relative">
                <img id="QR-code" class="w-50 py-3" src="/assets/QR-apply-to-BOS-2025.jpeg" />

                <img class="w-50 logo-taiat" src="/assets/for-c-and-e/logo-BOS-taiat.jpg" />
            </div>
        </div>

        <div id="app" class="text-center pt-5 pb-3">
            <?php if ($game == 'j'): ?>
            <h1>
                Coș cumpărături Teambuilding
            </h1>
            <?php endif; ?>
            <?php include "errors/$player/$game/index.php"; ?>
        </div>

        <?php
        switch ($game) {
            case 'c': { ?>
        <div class="py-3 text-center">
            <h5><b>Task:</b> descoperă codul QR și scanează-l cu telefonul ;)</h5>
        </div>
        <?php
                break;
            }
            case 'f': { ?>
        <div class="row">
            <div class="col">
                <?php
                        foreach ($ingredients as $ingredient) { ?>
                <div style="text-align: center; margin: 10px;">
                    <img src="/assets/for-f/<?= $ingredient ?>.jpeg" class="w-50" />
                </div>
                <?php } ?>
            </div>
            <div class="col text-right">
                <img src="/assets/for-f/correct-recipe.jpeg" class="w-50" />
            </div>
        </div>

        <?php 
                break;
            }
        } ?>

        <div class="row py-3 align-items-center justify-content-center text-center">
            <div class="col">
                <h4 id="success" style="opacity: 0;" class="text-success my-1">Felicităăări</h4>
            </div>
            <div class="col">
                <div class="py-3">
                    <a id="next-game" style="display: none; opacity: 0;" href="?game=<?= $next_game ?>"
                        class="btn btn-sm btn-success">
                        Următorul challenge
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
    var player = parseInt("<?= $player ?>"); // 1 - 3
    var game = ("<?= $game ?>"); // a - h

    // console.log("<?= json_encode($ingredients ?? []) ?>");

    var games = {
        'f': {
            'ingredients': JSON.parse('<?= json_encode($ingredients ?? []) ?>')
        }
    };

    function showQR() {
        $('img#QR-code').css('opacity', 0).animate({
            'opacity': 1
        }, 1000);

        setTimeout(function() {
            $('#success').animate({
                'opacity': 1
            }, 1000);
        }, 1000);

        setTimeout(function() {
            $('a#next-game').css('display', 'block').animate({
                'opacity': 1
            }, 1000);
        }, 5000);
    }

    function overlayCheck(points) {
        let rightPos = (elem) => elem.getBoundingClientRect().right;
        let leftPos = (elem) => elem.getBoundingClientRect().left;
        let topPos = (elem) => elem.getBoundingClientRect().top;
        let btmPos = (elem) => elem.getBoundingClientRect().bottom;

        for (let i = 0; i < points.length; i++) {
            for (let j = 0; j < points.length; j++) {
                let isOverlapping = !(
                    rightPos(points[i]) < leftPos(points[j]) ||
                    leftPos(points[i]) > rightPos(points[j]) ||
                    btmPos(points[i]) < topPos(points[j]) ||
                    topPos(points[i]) > btmPos(points[j])
                );

                if (isOverlapping && j !== i) {
                    return true;
                }
            }
        }

        return false;
    }

    $(document).ready(function() {
        $('body #app button').on('click', showQR);

        if (game == 'b' || game == 'h') {
            showQR();
        }
        if (game == 'c') {
            if (overlayCheck(document.querySelectorAll('.logo-taiat, #QR-code')) == false) {
                showQR();
            }
        }
        if (game == 'd') {
            var text = $('#app').text();

            if (text.search("Termenul Lemuria") == -1 && text.search("Philip Sclater") == -1 &&
                text.search("Madagascar ") == -1 && text.search("Orientul Mijlociu") == -1) {
                showQR();
            }
        }
        if (game == 'e') {
            var interval = setInterval(function() {
                if (overlayCheck(document.querySelectorAll('.logo-taiat, #QR-code')) == false) {
                    console.log('error "e": check overlayCheck()'); //

                    showQR();
                    clearInterval(interval);
                }
            }, 1500);
        }
        if (game == 'f') {
            if (JSON.stringify(games.f.ingredients) == JSON.stringify(['chifla-sus', 'salata', 'ceapa', 'rosii',
                    'carne', 'chifla-jos'
                ])) {
                showQR();
            }
        }
        if (game == 'g') {
            if ($('#app a:nth-child(2)').attr('href') == "https://instagram.com/bosromania") {
                showQR();
            }
        }
        if (game == 'i') {
            if (x == "2025" || reclama != null) {
                $("img.logo-taiat").css('display', 'none');
                showQR();
            }
        }
        document.querySelector(".vodca img").src = "/assets/for-j/vodca.jpg"
        document.querySelector(".bere:last-child img").src = "/assets/for-j/bere.jpg"
        document.querySelector(".vin img").src = "/assets/for-j/vin.jpg"
        if (game == 'j') {

            if (document.querySelector(".vin img") != null) {
                showQR();
            }
        }

    });
    </script>
</body>

</html>