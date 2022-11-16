</div>




    

    


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
        $('.data-hora').mask('00/00/0000 00:00:00');

        function dataformatada() {
            var hoje = new Date();
            var dd = hoje.getDate();
            var mm = hoje.getMonth()+1;
            var aaaa = hoje.getFullYear();
            var horas = hoje.getHours();
            var minutos = hoje.getMinutes();
            var segundos = hoje.getSeconds();
                if(dd<10){dd='0'+dd}
                if(mm<10){mm='0'+mm}
                if(horas<10){horas='0'+horas}
                if(minutos<10){minutos='0'+minutos}
                if(segundos<10){segundos='0'+segundos}
            return dd +'/'+ mm +'/'+ aaaa +' '+ horas +':'+ minutos +':'+ segundos;
        }

        function aplicahoras() {
        debugger;
        var campos = document.getElementsByClassName('data-hora'),
            i = campos.length;

        while(i < campos.length ) {
            campos[i].value = dataformatada();
        }
        }
    </script>

</body>
</html>