<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= isset($titulo) ? "Afungaz - $titulo" : 'Afungaz' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        body {
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
            box-shadow: 0 2px 10px rgb(0, 0, 0), 0 -2px 5px rgba(255, 255, 255, 0.6);
            overflow: hidden;
            text-align: center;
            padding: 1px 15px 25px 1px;
            margin-top: 50px;
        }

        .diferente-box {
            box-shadow: 0 2px 5px rgba(255, 255, 255, 0.6), 0 -2px 10px rgb(0, 0, 0);
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

        /* Estilo do modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 300px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
          
        }

        .modal-conteudo {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 700px;
            position: relative;
        }

        .fechar {
            color: red;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }



.card-wrapper {
  width: 300px;
  height: 350px;
  perspective: 1000px;
  display: inline-block;
  margin: 10px;
}

.card-flip {
  width: 100%;
  height: 100%;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  position: relative;
}

.card-wrapper.flipped .card-flip {
  transform: rotateY(180deg);
}

.card-front
 {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  background: white;
  border: 1px solid #ccc;
  border-radius: 10px;
  padding: 15px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.card-back{

      position: absolute;
  width: 100%;
  height: 100%;
  border-radius: 10px;
  backface-visibility: hidden;
  background: #fff;
  border: 1px solid #ccc;
  padding: 15px;
  box-sizing: border-box;
  text-align: center;
}

.card-front img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 5px;
}

.card-back {
  background: #f0f0f0;
  transform: rotateY(180deg);
   display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}


    </style>
</head>
<body>

<?php $render('nav'); ?>

<section id="cards">
 <div class="card-wrapper" onclick="this.classList.toggle('flipped')">
  <div class="card-flip">
    <div class="card-front">
      <h3>campo</h3>
      <img src="<?= $base; ?>assets/img/campo.jpg" alt="Imagem do card">
      <button class="btn btn-primary btn-block" onclick="event.stopPropagation(); abrirModal()">Agendar</button>
    </div>
    <div class="card-back">
    <!--Trocar os titulos e os textos depois se precisar para algo com mais sentido do sistema-->
      <h3>Como funciona?</h3>
      <p>Você pode agendar um horário para utilizar o campo. Clique no botão para escolher a data e hora disponíveis.</p>
    </div>
  </div>
</div>


 <div class="card-wrapper" onclick="this.classList.toggle('flipped')">
  <div class="card-flip">
    <div class="card-front">
      <h3>quadra</h3>
      <img src="<?= $base; ?>assets/img/futsal.jpg" alt="Imagem do card">
      <button class="btn btn-primary btn-block" onclick="event.stopPropagation(); abrirModal()">Agendar</button>
    </div>
    <div class="card-back">
      <h3>Como funciona?</h3>
      <p>Agende horários para jogar na quadra no nosso espaço coberto!</p>
    </div>
  </div>
</div>

 <div class="card-wrapper" onclick="this.classList.toggle('flipped')">
  <div class="card-flip">
    <div class="card-front">
      <h3>quiosque</h3>
      <img src="<?= $base; ?>assets/img/quiosque.jpg" alt="Imagem do card">
      <button class="btn btn-primary btn-block" onclick="event.stopPropagation(); abrirModal()">Agendar</button>
    </div>
    <div class="card-back">
      <h3>Como funciona?</h3>
      <p>Perfeito para churrascos e reuniões com amigos. Reserve agora!</p>
    </div>
  </div>
</div>

 <div class="card-wrapper" onclick="this.classList.toggle('flipped')">
  <div class="card-flip">
    <div class="card-front">
      <h3>quartos</h3>
      <img src="<?= $base; ?>assets/img/quartos.jpg" alt="Imagem do card">
      <button class="btn btn-primary btn-block" onclick="event.stopPropagation(); abrirModal()">Agendar</button>
    </div>
    <div class="card-back">
      <h3>Como funciona?</h3>
      <p>Hospede-se com conforto! Escolha a data e garanta seu quarto.</p>
    </div>
  </div>
</div>

 <div class="card-wrapper" onclick="this.classList.toggle('flipped')">
  <div class="card-flip">
    <div class="card-front">
      <h3>cozinha</h3>
      <img src="<?= $base; ?>assets/img/cozinha.jpg" alt="Imagem do card">
      <button class="btn btn-primary btn-block" onclick="event.stopPropagation(); abrirModal()">Agendar</button>
    </div>
    <div class="card-back">
      <h3>Como funciona?</h3>
      <p>Agende o uso da cozinha para preparar suas refeições com tranquilidade.</p>
    </div>
  </div>
</div>

 <div class="card-wrapper" onclick="this.classList.toggle('flipped')">
  <div class="card-flip">
    <div class="card-front">
      <h3>salao de eventos</h3>
      <img src="<?= $base; ?>assets/img/salaodeeventos.jpg" alt="Imagem do card">
      <button class="btn btn-primary btn-block" onclick="event.stopPropagation(); abrirModal()">Agendar</button>
    </div>
    <div class="card-back">
      <h3>Como funciona?</h3>
      <p>Ideal para festas, casamentos e eventos. Reserve seu espaço!</p>
    </div>
  </div>
</div>

</section>

<!-- Modal de exemplo para o angedamento mudar depois com infos do banco-->
<div id="modalAgendamentos" class="modal">
    <div class="modal-conteudo">
        <span class="fechar" onclick="fecharModal()">&times;</span>
        <h2>Agendamentos</h2>
        <p>Aqui você pode ver ou criar novos agendamentos!</p>
        <!-- Exemplo de tabela ou conteúdo -->
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Usuário</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>20/05/2025</td>
                    <td>14:00</td>
                    <td>João</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php $render('header'); ?>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<script>
    function abrirModal() {
        document.getElementById("modalAgendamentos").style.display = "block";
    }

    function fecharModal() {
        document.getElementById("modalAgendamentos").style.display = "none";
    }

    // Fecha o modal ao clicar fora dele
    window.onclick = function(event) {
        const modal = document.getElementById("modalAgendamentos");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>


</body>
</html>
