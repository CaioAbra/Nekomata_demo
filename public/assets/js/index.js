//tratamento do efeito de input flutuante
$('.inputEfectFloat .form-group input').focus(function () {
    $(this).siblings('label').addClass("focused");
});

$('inputEfectFloat .form-group input').blur(function () {
    $(this).siblings('label').removeClass("focused");

    var InputPreechido = $(this).val().length;

    if (InputPreechido > 0) {
        $(this).siblings('label').css({ "color": "transparent" });
    } else {
        $(this).siblings('label').css({ "color": "black" });
    }
});

//tratamento para ver senha
$(".input-group-append button#viewPassword").on("click", function () {
    if (!$("input#senha").hasClass("passwordView")) {
        $("input#senha").attr('type', 'text').addClass("passwordView");
        $(".input-group-append button#viewPassword img").attr('src', '/Nekomata/public/assets/image/svg/olho_fechado.svg');
    } else {
        $("input#senha").attr('type', 'password').removeClass("passwordView");
        $(".input-group-append button#viewPassword img").attr('src', '/Nekomata/public/assets/image/svg/olho_aberto.svg');
    }
});

// tratamento de contador de caracteres
$('div.counterText input').on('keypress', function () {
    let maxLength = this.maxLength;
    let Length = $(this).val().length;

    let calcMaxLength = maxLength - Length;
    // console.log(calcMaxLength);

    $(this).parent().find('small span.caunt-characters').text(calcMaxLength);

});

$('div.counterText input').on('keyup', function () {
    let maxLength = this.maxLength;
    let Length = $(this).val().length;

    let calcMaxLength = maxLength - Length;
    // console.log(calcMaxLength);

    $(this).parent().find('small span.caunt-characters').text(calcMaxLength);

});

// tratamento da slug, remoção de caracteres especiais
$('form#novaPostagem input#titulo_postagem').on('keyup', function () {
    let tituloDigitado = $(this).val();

    const replaceSpecialChars = (str) => {
        return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove acentos
            .replace(/([^\w]+|\s+)/g, '-') // Substitui espaço e outros caracteres por hífen
            .replace(/\-\-+/g, '-')	// Substitui multiplos hífens por um único hífen
            .replace(/(^-+|-+$)/, ''); // Remove hífens extras do final ou do inicio da string
    }

    let tituloSlugTratada = replaceSpecialChars(tituloDigitado).toLowerCase();

    // console.log(tituloSlugTratada)
    // $('span#slugTratada').text(tituloSlugTratada);
    $('#slugTratada').val(tituloSlugTratada);
})

$('form.fomrNovaCategoria input#novaCategoria').on('keyup', function () {
    let Categoria = $(this).val();

    const replaceSpecialChars = (str) => {
        return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove acentos
            .replace(/([^\w]+|\s+)/g, '-') // Substitui espaço e outros caracteres por hífen
            .replace(/\-\-+/g, '-')	// Substitui multiplos hífens por um único hífen
            .replace(/(^-+|-+$)/, ''); // Remove hífens extras do final ou do inicio da string
    }

    let CategoriaSlugTratada = replaceSpecialChars(Categoria).toLowerCase();

    $('#slugNovaCategoria').text(CategoriaSlugTratada).val(CategoriaSlugTratada);
})

//efeitos "word" do textAres
$('#conteudo_postagem').trumbowyg({
    semantic: false,
    lang: 'pt_br',
    autogrow: true,
    autogrowOnEnter: true,
    btns: [
        // ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat']
        // ,        ['fullscreen']
    ]
});

//pegando data atual
const today = new Date();
var dataAtual = today.toLocaleDateString();

$('#DataPostagem').val(dataAtual);

$('#status_post').change(function () {
    var valorStatusPost = ($(this).val());

    if (valorStatusPost != 0) {
        if (valorStatusPost == 1) {
            $('#textDataPostagem').text('Dia de publicação');
            $('#DataPostagem').val(dataAtual);
        } else {
            $('#textDataPostagem').text('Dia de criação');
            $('#DataPostagem').val(dataAtual);

        }
        // console.log(valorStatusPost);
    }
});

//preview imagem
$("#thumb_postagem").change(function () {
    if (this.files && this.files[0]) {
        var file = new FileReader();
        file.onload = function (e) {
            document.getElementById("preview_thumb_postagem").src = e.target.result;
        };
        file.readAsDataURL(this.files[0]);
    }
});