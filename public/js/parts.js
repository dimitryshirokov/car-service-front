function addPart() {
    let template = '<div id="part_' + partId +'">'
        // Название детали
        + '<div class="form-group">'
        + '<label class="control-label required" for="part_title_' + partId +'">Название детали:</label>'
        + '<div class="input-group">'
        + '<input type="text" class="form-control" id="part_title_' + partId +'">'
        + '</div>'
        + '</div>'
        // Номер детали
        + '<div class="form-group">'
        + '<label class="control-label required" for="part_number_' + partId +'">Номер детали:</label>'
        + '<div class="input-group">'
        + '<input type="text" class="form-control" id="part_number_' + partId +'">'
        + '</div>'
        + '</div>'
        // Стоимость детали
        + '<div class="form-group">'
        + '<label class="control-label required" for="part_price_' + partId +'">Стоимость детали:</label>'
        + '<div class="input-group">'
        + '<input type="text" class="form-control" oninput="calculateWorkPrice()" id="part_price_' + partId +'">'
        + '</div>'
        + '</div>'
        + '<button type="button" class="btn btn-danger" onclick="deletePart(' + partId +')">Удалить</button>'
        + '<hr />'
        + '</div>';

    $('#parts').append(template);
    partId++;
}

function deletePart(partId) {
    $('#part_' + partId).remove();
    calculateWorkPrice();
}