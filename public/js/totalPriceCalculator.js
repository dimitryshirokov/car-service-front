function calculateWorkPrice() {
    let workPrice = 0;
    let partsPrice = calculatePartsPrice();
    let totalPrice;
    finalWorks.forEach(function (element) {
        workPrice = workPrice + parseInt(element.totalPrice);
    });
    $('#workCost').html(workPrice + ' P');
    $('#partsCost').html(partsPrice + ' P');

    totalPrice = workPrice + partsPrice;

    $('#fullCost').html(totalPrice + ' P');
}

function calculatePartsPrice() {
    let partsPrice = 0;
    for (let i = 1; i <= partId; i++) {
        let element = $('#part_price_' + i);
        if (element !== undefined) {
            if (!isNaN(parseInt(element.val()))) {
                partsPrice = partsPrice + parseInt(element.val());
            }
        }
    }
    if (isNaN(partsPrice)) {
        partsPrice = 0;
    }

    return partsPrice;
}