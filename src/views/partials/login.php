<head>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


    <style>
        
        #login {
            min-width: 200px;
            min-height: 300px;
            width: 2rem;
            height: 4rem;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            backdrop-filter: blur(5px);
            padding: 15px;
            border-radius: 10px;
            z-index: 1000;
            background-color: rgba(24, 0, 92, 0.23);
            box-shadow: 0 2px 10px black;
        }

        #login form {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        #login i
        {
            font-size: 78px;
            margin-right: 10px;
            color: white;
            display: flex;
            justify-content: center;
        }

        #login form div
        {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 66%;
            justify-content: space-evenly;
        }

    </style>

</head>



<div id="login">
    <form action="">
        <i class="bi bi-person-circle"></i>
        <div>
            <input type="text" name="usuario" placeholder="Usuario">
            <input type="password" name="senha" placeholder="Senha">
            <button>Logar</button>
        </div>
    </form>
</div>

<script src="<?= $base; ?>assets/js/login.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>