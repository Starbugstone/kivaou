const journeyListing = document.querySelector('#js-journey-listing'); //the list of the diffrent sites
const dataElements = document.querySelector('#js-data-elements') //the json storage of the locations
let blockSubmit = true; //are we blocking the form submit ?

//Construct the map
let map = L.map('map').setView([43.440955, 2.830353], 8);
let CartoDB_Positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 19
}).addTo(map);

//getting the location data passed from the database in json form
let locations = JSON.parse(dataElements.dataset.sites);

let markers = [];
for (let i = 0; i < locations.length; i++) {
    let location = locations[i];
    //adding marker to map
    markers[location.id] = L.marker([location.lat, location.lon], {title: location.name}).addTo(map);
    //setting the popup
    markers[location.id].bindPopup();
    //calling the funciton to update the popup
    markers[location.id].addEventListener('click', e => markerClick(e, markers[location.id], location));

    //search for the find button in list and add the marker click listener to it
    document.querySelector('#js-site-search-button-' + location.id).addEventListener('click', e => markerClick(e, markers[location.id], location));

}

//The marker popup on click
function markerClick(e, marker, info) {
    //open the popup. Needed for the site-search-button
    marker.openPopup();

    let p = marker.getPopup();
    let popupContent = '<p class="popup-header">' + info.name + '</p>';

    if (journeyListing.children.length > 0) { //if we've started typing a journey
        popupContent += '<p class="m-0 mt-1 w-100"><button class="btn btn-primary w-100 js-add-to-journey js-end-journey">Arrivé</button></p>';
        popupContent += '<p class="m-0 mt-1 w-100"><button class="btn btn-primary w-100 js-add-to-journey popup-default">Etape</button></p>';
        popupContent += '<p class="m-0 mt-1 w-100"><button class="btn btn-danger w-100 js-delete-journey">Effacer trajet</button></p>';
    } else {
        popupContent += '<p class="m-0 mt-1 w-100 "><button class="btn btn-primary w-100 js-add-to-journey popup-default">Depart de mon trajet</button></p>';
        //TODO: remove hard coded link
        popupContent += '<p class="m-0 mt-1 w-100"><a class="btn btn-primary w-100" href="/journey/site/' + info.id + '" style="color: #fff;">Liste des trajets</a></p>';
    }
    //filling the popup with our buttons
    p.setContent(popupContent);

    //adding the button functionality
    const addToJourneyButtons = document.querySelectorAll('.js-add-to-journey');
    if (addToJourneyButtons) {
        for (const addToJourneyButton of addToJourneyButtons) {
            addToJourneyButton.addEventListener('click', e => addToJourney(e, info));
            addToJourneyButton.addEventListener('click', e => closePopup(e, marker));
        }
    }

    const deleteJourneyButton = document.querySelector('.js-delete-journey');
    if (deleteJourneyButton) {
        deleteJourneyButton.addEventListener('click', e => deleteJourney(e));
        deleteJourneyButton.addEventListener('click', e => closePopup(e, marker));
    }

    const endJourneyButton = document.querySelector('.js-end-journey');
    if (endJourneyButton) {
        endJourneyButton.addEventListener('click', e => endJourney(e));
        endJourneyButton.addEventListener('click', e => closePopup(e, marker));
    }
}

function addToJourney(e, info) {

    let list = jQuery('#js-journey-listing');
    // Try to find the counter of the list or use the length of the list
    let counter = list.data('widget-counter') | list.children().length;
    //grab the prototype template
    let newWidget = list.attr('data-prototype');
    // replace the "__name__" used in the id and name of the prototype
    // with a number that's unique to your emails
    // end name attribute looks like name="contact[emails][2]"
    newWidget = newWidget.replace(/__name__/g, counter);
    // Increase the counter
    counter++;
    // And store it, the length cannot be used if deleting widgets is allowed
    list.data('widget-counter', counter);


    // create a new list element and add it to the list
    let newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);

    //setting the placeholder values to the site name + id
    newElem.find('.js-site-name-placeholder').val(info.name);
    newElem.find('.js-site-id-placeholder').val(info.id);

    //adding the delete button
    newElem.append(createDeleteButton());

    //adding the row to the dom
    newElem.appendTo(list);
}

function deleteJourney(e) {
    while (journeyListing.firstChild) {
        journeyListing.removeChild(journeyListing.firstChild);
    }
}

function closePopup(e, marker) {
    marker.closePopup();
}

function endJourney(e, auto=false) {
    const start = journeyListing.firstElementChild;
    const end = journeyListing.lastElementChild;
    let startId = start.querySelector('.js-site-id-placeholder').value;
    let endId = end.querySelector('.js-site-id-placeholder').value;
    let info = [];
    info.id = startId;
    info.name = start.querySelector('.js-site-name-placeholder').value;

    //we do not end at our start location
    if (startId !== endId && auto===false) {
        //TODO: This isn't great, prehaps a modal form with extra data for all validation (name / date) ?
        let roundJourney = confirm('Le depart et arrivé sont differents, Vous rentrez à ' + info.name + ' apres votre deplacement ?');
        if (roundJourney) {
            addToJourney(e, info);
        }
    }else if(startId !== endId && auto===true){
        addToJourney(e, info);
    }

    //removing the onclick functionality of the markers
    for (const marker of markers) {
        if (marker) {
            marker.off('click');
        }

    }
    //deleting the 'delete row' buttons
    jQuery('.delete-form-row').each(function () {
        jQuery(this).remove();
    });

    //removing the site search
    jQuery('#js-list-sites').remove();

    //Making the submit button visible
    document.querySelector('.js-submit-button').classList.remove('d-none');

    //authorising the submit
    blockSubmit = false;

    // TODO: If the rest of the form is filled, submit.
    // Could have a prob with date, need to think
    // prehaps a popup with date picker ?
}

// Creating the delete button, set the askConfirm to true for a delete confirmation
function createDeleteButton() {
    const deleteButton = document.createElement('button');
    deleteButton.setAttribute('class', 'btn btn-danger delete-form-row');

    deleteButton.insertAdjacentHTML('beforeend', '<i class="fa fa-trash" aria-hidden="true"></i>');

    deleteButton.addEventListener('click', function () {
        deleteFormRow(this);
    });

    return deleteButton;
}

//delete the row
function deleteFormRow(self) {
    self.parentNode.parentNode.removeChild(self.parentNode);
}

//blocking the form submit until the journey is finished
jQuery('.js-journey-form').submit(function (e) {
    if (blockSubmit) {
        console.log('blocked form submission');
        e.preventDefault();
        return false;
    }
})


//Automaticly open first site on enter press for the search list
jQuery('#site-search').keyup(function (e) {
    let upCode = e.which;
    // console.log(upCode);

    //enter key is 13
    if (upCode === 13) {
        //enter key was pressed
        let firstButton = jQuery('#site-list').children(":first").find("button");
        let firstButtonId = firstButton.data('markerid');

        //Make sure we have at least a button
        if(!firstButtonId){
            return;
        }

        //If popup is open and we re-hit enter, then activate default button
        if(markers[firstButtonId].isPopupOpen()){
            let myPopup = markers[firstButtonId].getPopup()._container;
            jQuery(myPopup).find("button.popup-default").click();

            //we already have started
            if (journeyListing.children.length > 1){
                endJourney(null, true);
            }

        }else{
            firstButton.click();
        }

        return;
    }

    //escape key is 27, delete the input text
    if (upCode === 27) {
        jQuery('#site-search').val("");
        map.closePopup();
        return;
    }
});

//listJs search form
let options = {
    valueNames: ['site-name']
};
let siteList = new List('listjs-site-list', options);