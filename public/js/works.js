function addWork() {
    let template = '<div id="work_' + id + '">'
        + '<div class="input-group" style="margin-top: 5px">'
        + '<select class="form-control" onchange="addEmployers(this, '+ id +')"><option disabled selected>Выберите работу</option>';
    works.forEach(function (element) {
        template = template + '<option value="'+ element.id +'">' + element.title + '</option>';
    });
    template = template + '</select><input id="work_' + id +'_workers" type="hidden"><div class="input-group-addon">'
        + '<button class="btn-danger" onclick="deleteWork('+ id +')"><i class="fa fa-minus-square"></i></button></div> </div>';
    $('#works').append(template);
    console.log(works);
    id++;
}

function deleteWork(id) {
    $('#work_' + id).remove();
    deleteFinalWork(id);
    calculateWorkPrice();
}

function addEmployers(element, workDivId) {
    let workId = $(element).val();
    let work = findWork(workId);
    console.log(work);
    // Сначала добавим на модалку заголовок
    let header = '<div class=modal-header>'
        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="deleteWork(' + workDivId + ')">'
        + '<span aria-hidden="true">x</span>'
        + '</button>'
        + '<h4 class="modal-title">Добавить "' + work.title + '"</h4>'
        + '</div>';
    $('#add_employee_modal_header').html(header);

    // Теперь добавим на модалку формочку
    let workers = [];
    let neededPositions = work.positionTypes;
    console.log(employers);
    for (var position in neededPositions) {
        if (employers.hasOwnProperty(position)) {
            workers.push({
                position: position,
                translation: neededPositions[position],
                employers: employers[position]
            });
        }
    }
    console.log(workers);

    let body = '<div class="modal-body"><p class="text-bold">Цена: ' + work.price + ' Р</p>'
        + '<div class="form-group">'
        + '<label class="control-label required" for="hours">Количество нормочасов: </label>'
        + '<div class="input-group">'
        + '<input class="form-control" type="text" id="hours">'
        + '<input type="hidden" id="modalWorkId" value="' + work.id +'">'
        + '</div>'
        + '</div>';

    workers.forEach(function (element) {
        body = body + '<div class="form-group">'
            + '<label class="control-label required" for="' + element.position + '">'
            + element.translation + ': </label>'
            + '<div class="input-group">'
            + '<select class="form-control" id="' + element.position + '">';
        element.employers.forEach(function (employer) {
            body = body + '<option value="' + employer.id + '">'
                + employer.fio + '</option>';
        });
        body = body + '</select>'
            + '</div>'
            + '</div>';
    });

    body = body + '</div>';

    $('#add_employee_modal_body').html(body);

    // Добавим футер
    let footer = '<div class="modal-footer">'
        + '<button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="deleteWork(' + workDivId +')">Отмена</button>'
        + '<button type="button" class="btn btn-success" onclick="commitWork(' + workDivId +')">Подтвердить</button>'
        + '</div>';

    $('#add_employee_modal_footer').html(footer);



    $('#add_employee_modal').modal('show');
}

function findWork(workId) {
    let work = '';
    works.forEach(function (element) {
        if (parseInt(element.id) === parseInt(workId)) {
            work = element;
            return;
        }
    });
    return work;
}

function commitWork(workDivId) {
    let modalFormBody = $('#add_employee_modal_body');
    let employersElements = modalFormBody.find("select");
    let workers = [];
    for (let i = 0; i < employersElements.length; i++) {
        let val = $(employersElements[i]).val();
        workers.push(val);
    }
    let hours = $('#hours').val();
    let workId = $('#modalWorkId').val();

    let work = findWork(workId);

    let totalPrice = work.price * hours;

    let finalWork = {
        employers: workers,
        workId: workId,
        hours: hours,
        totalPrice: totalPrice,
        workDivId: workDivId
    };

    finalWorks.push(finalWork);

    $('#add_employee_modal').modal('hide');

    console.log(finalWorks);
    calculateWorkPrice();
}

function deleteFinalWork(workDivId) {
    let length = finalWorks.length;
    for (let i = 0; i < length; i++) {
        if (finalWorks.hasOwnProperty(i)) {
            if (parseInt(finalWorks[i].workDivId) === parseInt(workDivId)) {
                finalWorks.splice(i, 1);
            }
        }
    }
    console.log(finalWorks);
}