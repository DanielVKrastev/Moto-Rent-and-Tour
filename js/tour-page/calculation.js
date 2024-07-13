document.addEventListener('change', function(mouseoverBox) {
    let box = document.getElementById('page-box-right');

    if (!box.contains(clickOutsideBox.target)) {
        priceSum();
    }

});

function priceSum() {
    let price = Number(document.querySelector('.js-tour-price').value);
    let checkSum = Number(checkBoxSum());
    console.log(checkSum);
    console.log(price);
    
    let sum = price + checkSum;
    console.log(sum);
    document.querySelector('.js-tour-price-sum').
    innerHTML = sum + " лв.";
    document.querySelector('.js-tour-price-sum-mobile').
    innerHTML = sum + " лв.";
    document.querySelector('.js-tour-price-sum-input').value = (sum).toFixed(2);
}

function checkBoxSum() {
    const radio = document.querySelectorAll("input[type=radio]");
    const checkboxes = document.querySelectorAll("input[type=checkbox]");       
    let total = 0;

    for (const {checked, dataset} of radio) {
        total += checked ? Number(dataset.amount) : 0;
    }

    for (const {checked, dataset} of checkboxes) {
        total += checked ? Number(dataset.amount) : 0;
    }

    return total;
}