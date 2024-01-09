document.addEventListener('DOMContentLoaded', function () {
    //  mes1 = document.getElementById('bbb');
    //var mes_1=document.getElementById('mes_1');
    btn_ok.addEventListener("click", () => {
        fetch(ruta, {
            method: "POST",
            body: new FormData(formulario)
        }).then(response => response.text()).then(response => {
            if (response === "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Realizado Con Exito',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    });

    function selectActives() {
        mes_1.value = periodo['mes_1'];
        mes_2.value = periodo['mes_2'];
        mes_3.value = periodo['mes_3'];
        mes_4.value = periodo['mes_4'];
        mes_5.value = periodo['mes_5'];
    }
    selectActives();

});
