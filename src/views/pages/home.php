<head>
    <title><?= "Afungaz - $titulo" ?? 'Afungaz' ?></title>    


<style>

    body{
        width: 100%;
        height: 100vh;
    }

    #sobre{
        width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #sobre-filho{
        display: flex;
        width: 800px;
        height: 100%;
        flex-direction: column;
        align-content: center;
        justify-content: center;
    }

    h1{
        margin-top: 20px;
    }

</style>

</head>
<body>
    

    <?php $render('nav'); ?>
    <?php $render('carrossel'); ?>

    <section>
        <div id="sobre">
            <div id="sobre-filho">
                <h1>Sobre: Bem estar e lazer Afungaz</h1>
                <p>
                    A Gazin mantém, em seu parque industrial de Douradina-PR e nos de outras localidades, associações para uso e benefício dos funcionários de todos os níveis e familiares. São amplas áreas verdes com campo de futebol, vôlei, piscina, sala de ginástica, salão de festa e chalés para hospedagem. As instalações de Douradina permitem, inclusive, que os funcionários de outros estados venham passar férias com a família. Atende também representantes, visitantes e outras pessoas da sociedade para hospedagem. Os funcionários recém contratados têm direito a 15 dias de hospedagem gratuita até que se mudem para Douradina. Nas Afungaz do Grupo Gazin, em diferentes localidades, os funcionários e seus familiares participam diariamente de atividades de lazer, exercitando-se individual e coletivamente, por exemplo: caminhadas, academia, sauna, jogos de futebol, basquete, vôlei, parque infantil etc. Há ainda lanchonete e área para churrasco para o lazer. As associações (Afungaz) tem diretoria própria, composta por funcionários e voluntários de diversas áreas da Gazin para condução das atividades e administração geral.
                </p>
            </div>
        </div>
    </section>


    <?php $render('header'); ?>

</body>