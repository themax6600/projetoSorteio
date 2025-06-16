document.addEventListener("DOMContentLoaded", function () {
    const cpfInput = document.getElementById("cpf");

    cpfInput.addEventListener("input", function () {
        let cpf = cpfInput.value;

        // Remove tudo que não for número
        cpf = cpf.replace(/\D/g, "");

        // Aplica a máscara
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        cpfInput.value = cpf;
    });
});
