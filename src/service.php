<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../dashboard.css">
    <style>
        .lien {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-top: 10rem;
        }

        .carte {
            width: 20rem;
            height: 25rem;
            margin: 1rem;
            z-index: 1;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid rgba(255, 255, 255, .25);
    border-radius: 20px;
    background-color: rgba(255, 255, 255, 0.45);
    box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);
        }

        .carte:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .toolss {
            display: flex;
            align-items: center;
            padding: 9px;
        }

        .rond {
            padding: 0 4px;
        }

        .boxx {
            display: inline-block;
            align-items: center;
            width: 10px;
            height: 10px;
            padding: 1px;
            border-radius: 50%;
        }

        .red {
            background-color: #ff605c;
        }

        .yellow {
            background-color: #ffbd44;
        }

        .green {
            background-color: #00ca4e;
        }

        .carte__content {
            padding-top: 30%;
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        a {
            text-decoration: none;
            color: black;
            text-align: center;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="lien">
        <div class="carte">
            <div class="toolss">
                <div class="rond">
                    <span class="red boxx"></span>
                </div>
                <div class="rond">
                    <span class="yellow boxx"></span>
                </div>
                <div class="rond">
                    <span class="green boxx"></span>
                </div>
            </div>
            <div class="carte__content">
                <a href="synthese.php">
                    <h1>Synthèse</h1>
                </a>
            </div>
        </div>
        <div class="carte">
            <div class="toolss">
                <div class="rond">
                    <span class="red boxx"></span>
                </div>
                <div class="rond">
                    <span class="yellow boxx"></span>
                </div>
                <div class="rond">
                    <span class="green boxx"></span>
                </div>
            </div>
            <div class="carte__content">
                <a href="synthese.php">
                    <h1>Synthèse</h1>
                </a>
            </div>
        </div>
        <div class="carte">
            <div class="toolss">
                <div class="rond">
                    <span class="red boxx"></span>
                </div>
                <div class="rond">
                    <span class="yellow boxx"></span>
                </div>
                <div class="rond">
                    <span class="green boxx"></span>
                </div>
            </div>
            <div class="carte__content">
                <a href="synthese.php">
                    <h1>Synthèse</h1>
                </a>
            </div>
        </div>
        <!-- Add more cards as needed -->
    </div>
</body>

</html>