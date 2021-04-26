/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import './styles/app.scss';

import 'jquery';
import 'bootstrap';

const tagCloud = require('TagCloud');
const axios = require('axios');
const $ = require('jquery');

global.$ = $;

$(document).ready(function(){

    let loadingApi = $('#loading-api');

     const result = () => {
        axios.get('/get-words')
            .then(function (response) {
                if (response.data.length > 0) {

                    // hide loading animation
                    loadingApi.hide('slow');

                    // init cloud
                    tagCloud('#tagcloud', response.data, {
                        // radius in px
                        radius: 200,

                        // animation speed
                        // slow, normal, fast
                        maxSpeed: 'normal',
                        initSpeed: 'fast',

                        // 0 = top
                        // 90 = left
                        // 135 = right-bottom
                        direction: 135,

                        // interact with cursor move on mouse out
                        keep: true

                    });

                    $('.tagcloud').addClass('init-cloud');
                }
            }).catch(function (error) {
                console.log(error);
                alert(error);
            });
    }

    setTimeout(result, 2500);

    // a search page opens after clicking on links our cloud words
    let rootEl = document.querySelector('#tagcloud');
    rootEl.addEventListener('click', function clickEventHandler(e) {
        if (e.target.className === 'tagcloud--item') {
            window.open(`/search?q=${e.target.innerText}`, '_self');
        }
    });

});


