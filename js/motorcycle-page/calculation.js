document.addEventListener('change', function(mouseoverBox) {
    let box = document.getElementById('end-rent-input');
    if (!box.contains(clickOutsideBox.target)) {
    let startRentDate = new Date(document.querySelector('.js-start-rent-input').value);
    let endRentDate = new Date(document.querySelector('.js-end-rent-input').value);
    //calculating the time difference of 2 dates
    let differenceInTime = endRentDate.getTime() - startRentDate.getTime();

    //calc. the no. of days between 2 dates
    let differenceInDays = Math.round(differenceInTime / (1000 * 3600 * 24));
    if(differenceInDays === 0){
        differenceInDays += 1;
    }

    //dispay the final days
    document.querySelector('.js-rent-for-days').
         innerHTML = "Наем за " + differenceInDays + " дни";
    document.querySelector('.js-rent-for-days-mobile').
         innerHTML = "Наем за " + differenceInDays + " дни";
    document.querySelector('.js-rent-for-days-input').value = differenceInDays;

    //sum price * days
    priceSum(Number(differenceInDays));
    }
});

function priceSum(days) {
    let price = Number(document.querySelector('.js-moto-rent-price-input').value);
    let checkSum = Number(checkBoxSum());
    //console.log(checkSum);
    //console.log(price);

    if(days > 5) price -= 5;
    if(days > 7) price -= 5;

    document.querySelector('.js-rent-per-day').
        innerHTML = `(${(price + (checkSum / days)).toFixed(2)} лв. на ден)`;
    let sum = price * days;
    document.querySelector('.js-rent-price-sum').
        innerHTML = `${sum + checkSum} лв.`;
    document.querySelector('.js-rent-price-sum-mobile').
        innerHTML = sum + checkSum + " лв.";
    document.querySelector('.js-rent-per-day-input').value = (price).toFixed(2);
    document.querySelector('.js-rent-price-sum-input').value = sum;
}

function checkBoxSum() {
    const checkboxes = document.querySelectorAll("input[type=checkbox]");      
    let total = 0;

    for (const {checked, dataset} of checkboxes) {
        total += checked ? Number(dataset.amount) : 0;
    }

    return total;
}