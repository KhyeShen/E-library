const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})

const productContainers2 = [...document.querySelectorAll('.product-container2')];
const nxtBtn2 = [...document.querySelectorAll('.nxt-btn2')];
const preBtn2 = [...document.querySelectorAll('.pre-btn2')];

productContainers2.forEach((item, i) => {
    let containerDimensions2 = item.getBoundingClientRect();
    let containerWidth2 = containerDimensions2.width;

    nxtBtn2[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth2;
    })

    preBtn2[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth2;
    })
})