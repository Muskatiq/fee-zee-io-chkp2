const terms = document.querySelector('.terms-and-conditions');
const button = document.querySelector('.accept');

function obCallback(payload) {
    if(payload[0].intersectionRatio === 1) {
        button.disabled = false;
        //stop observing button
        ob.unobserve(terms.lastElementChild);
    }
}

//Intersection observer - watch if some element is already visible or not, we can define
// the starting position (root) and threshold, (when we want to be alerted)
// 1 means that it is fully visible
const ob = new IntersectionObserver(obCallback, 
    { 
        root: terms, 
        threshold: 1
    });

//Tell the observer watch for something
ob.observe(terms.lastElementChild);