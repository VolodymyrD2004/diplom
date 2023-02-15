function translit(text) {
    var transl = [];
    transl['А'] = 'A';
    transl['а'] = 'a';
    transl['Б'] = 'B';
    transl['б'] = 'b';
    transl['В'] = 'V';
    transl['в'] = 'v';
    transl['Г'] = 'H';
    transl['г'] = 'h';
    transl['Ґ'] = 'G';
    transl['ґ'] = 'g';
    transl['Д'] = 'D';
    transl['д'] = 'd';
    transl['Е'] = 'E';
    transl['е'] = 'e';
    transl['Є'] = 'Ye';
    transl['є'] = 'ie';
    transl['Ж'] = 'Zh';
    transl['ж'] = 'zh';
    transl['З'] = 'Z';
    transl['з'] = 'z';
    transl['И'] = 'Y';
    transl['и'] = 'y';
    transl['І'] = 'I';
    transl['і'] = 'i';
    transl['Ї'] = 'Yi';
    transl['ї'] = 'i';
    transl['Й'] = 'Y';
    transl['й'] = 'i';
    transl['К'] = 'K';
    transl['к'] = 'k';
    transl['Л'] = 'L';
    transl['л'] = 'l';
    transl['М'] = 'M';
    transl['м'] = 'm';
    transl['Н'] = 'N';
    transl['н'] = 'n';
    transl['О'] = 'O';
    transl['о'] = 'o';
    transl['П'] = 'P';
    transl['п'] = 'p';
    transl['Р'] = 'R';
    transl['р'] = 'r';
    transl['С'] = 'S';
    transl['с'] = 's';
    transl['Т'] = 'T';
    transl['т'] = 't';
    transl['У'] = 'U';
    transl['у'] = 'u';
    transl['Ф'] = 'F';
    transl['ф'] = 'f';
    transl['Х'] = 'Kh';
    transl['х'] = 'kh';
    transl['Ц'] = 'Ts';
    transl['ц'] = 'ts';
    transl['Ч'] = 'Ch';
    transl['ч'] = 'ch';
    transl['Ш'] = 'Sh';
    transl['ш'] = 'sh';
    transl['Щ'] = 'Shсh';
    transl['щ'] = 'shсh';
    transl['Ю'] = 'Yu';
    transl['ю'] = 'iu';
    transl['Я'] = 'Ya';
    transl['я'] = 'ia';
    transl[' '] = '-';
    transl['+'] = '';
    transl[','] = '';
    transl['\''] = '';
    transl['ь'] = '';
    transl['’'] = '';
    transl['.'] = '-';
    transl['’'] = '';

    var result = '';
    for (i = 0; i < text.length; i++) {
        if (transl[text[i]] !== undefined) {
            result += transl[text[i]];
        } else {
            result += text[i];
        }
    }
    return result
}

function updateProductUrl(event) {
    let title = document.querySelector('#product-title').value;
    let sku = document.querySelector('#product-sku').value;

    let result = translit(title + '-' + sku).toLowerCase();

    let urlInput = document.querySelector('#product-url')
    urlInput.value = result;
}

document.querySelector('#product-title').addEventListener('input', updateProductUrl);
document.querySelector('#product-sku').addEventListener('input', updateProductUrl);