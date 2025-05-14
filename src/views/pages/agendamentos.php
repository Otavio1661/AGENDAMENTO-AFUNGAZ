<?php

?>
<head>
    <title><?= "Afungaz - $titulo" ?? 'Afungaz' ?></title>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>

    body{
        /* background-image:url("<?= $base; ?>assets/img/afungaz2.jpg"); */
        background: linear-gradient(rgb(15, 0, 150), rgb(0, 100, 250), rgb(15, 0, 150));
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100% 100%;
    }

    #cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        justify-items: center;
        padding: 20px;
    }

    @media (max-width: 992px) {
        #cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        #cards {
            grid-template-columns: 1fr;
        }
    }

    .custom-card {
        width: 280px;
        height: 350px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgb(0,0,0), 0 -2px 5px rgba(255, 255, 255, 0.6);
        overflow: hidden;
        text-align: center;
        padding: 1px 15px 25px 15px;
        margin-top: 50px;
    }

    .diferente-box{
        box-shadow:  0 2px 5px rgba(255, 255, 255, 0.6), 0 -2px 10px rgb(0,0,0);
    }

    .custom-card img {
        width: 100%;
        height: 75%;
        object-fit: cover;
        border-radius: 5px;
    }

    .custom-card .btn {
        margin-top: 20px;
    }
</style>


</head>
<body>
    

    <?php $render('nav'); ?>

    <section id="cards">

        <div class="custom-card">
            <h3>campo</h3>
            <img src="<?= $base; ?>assets/img/campo.jpg" alt="Imagem do card">
            <button class="btn btn-primary btn-block">Agendar</button>
        </div>
        
        <div class="custom-card">
            <h3>futsal</h3>
            <img src="<?= $base; ?>assets/img/futsal.jpg" alt="Imagem do card">
            <button class="btn btn-primary btn-block">Agendar</button>
        </div>

        <div class="custom-card">
            <h3>quiosque</h3>
            <img src="<?= $base; ?>assets/img/quiosque.jpg" alt="Imagem do card">
            <button class="btn btn-primary btn-block">Agendar</button>
        </div>
        
        <div class="custom-card diferente-box">
            <h3>quartos</h3>
            <img src="<?= $base; ?>assets/img/quartos.jpg" alt="Imagem do card">
            <button class="btn btn-primary btn-block">Agendar</button>
        </div>

        <div class="custom-card diferente-box">
            <h3>cozinha</h3>
            <img src="<?= $base; ?>assets/img/cozinha.jpg" alt="Imagem do card">
            <button class="btn btn-primary btn-block">Agendar</button>
        </div>

        <div class="custom-card diferente-box">
            <h3>salao de eventos</h3>
            <img src="<?= $base; ?>assets/img/salaodeeventos.jpg" alt="Imagem do card">
            <button class="btn btn-primary btn-block">Agendar</button>
        </div>
        
    </section>

    <?php $render('header'); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>