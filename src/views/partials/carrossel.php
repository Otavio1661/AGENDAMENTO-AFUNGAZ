<style>

    .carousel-item{
        height: 400px;
        width: 100%;
    }

    #img {
        height: 200%;
        width: 100%;
        object-fit: contain; /* Mantém proporção e preenche o container */
        object-position: center -200px;
        display: block;
        margin: 0 auto;
    }

        #img2 {
        width: 100%;
        height: 400px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }

        #img3 {
        height: 200%;
        width: 100%;
        object-fit: contain; /* Mantém proporção e preenche o container */
        object-position: center -200px;
        display: block;
        margin: 0 auto;
    }

    #carouselExampleIndicators{
        box-shadow: 0px 5px 20px black;
    }

</style>

<section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img id="img" class="d-block w-100" src="<?= $base; ?>assets/img/Afungaz1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img id="img2" class="d-block w-100" src="<?= $base; ?>assets/img/afungaz2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img id="img3" class="d-block w-100" src="<?= $base; ?>assets/img/Afungaz1.png" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!-- Link para o CSS do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Scripts JS do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>