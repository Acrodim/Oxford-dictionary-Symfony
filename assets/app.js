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



    // let loadingApi = $('#loading-api');
    let defaultSphareApi = $('#loading-api');
    let wordSphareApi = $('#canv');

     const result = () => {
        axios.get('/get-words')
            .then(function (response) {

                console.log(response);
                if (response.data.length > 0) {

                    // hide loading animation
                    defaultSphareApi.hide('slow');
                    wordSphareApi.hide('hide');

                    console.log('cloud start');
                    // convert respons to obj
                    let obj = response.data.reduce(function(accum, currentVal) {
                        accum[currentVal.id] = currentVal.word;
                        return accum;
                    }, {});

                    // obj to arr
                    let result = Object.values(obj);

                    // init cloud
                    tagCloud('#tagcloud', result, {
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
                    const $ = require('jquery');
                    $('.tagcloud').addClass('init-cloud');
                }else{

                    console.log('Not found');
                    defaultSphareApi.hide('hide');
                    wordSphareApi.show('show');
                    /* Not found */
                    var c = document.getElementById("canv");
                    var $ = c.getContext("2d");
                    var w = c.width = window.innerWidth;
                    var h = c.height = window.innerHeight;

                    function txt() {
                        var t   =  "Oxford dictionaries API".split("").join(String.fromCharCode(0x2004));
                        $.font = "3.5em Roboto";
                        $.fillStyle = 'hsla(0, 0%,20%, 1)';
                        $.fillText(t, (c.width - $.measureText(t).width) * 0.5, c.height * 0.5);
                    }

                    var rad = 250, til = 1, num = 5;
                    var alph = 0.9, pov = 100;
                    var midX = w / 2, midY = h / 2;
                    var maxZ = pov - 2, cnt = til - 1;
                    var _arr = {}, dump = {};
                    var spX = 0.1, spY = 0.1, spZ = 0.1;
                    var grav = -0, psz = 5;
                    var xMid = 0, yMid = 0, zMid = -3 - rad;
                    var dth = -750, ang = 0;
                    var sp = 2 * Math.PI / 360;
                    anim();

                    function anim() {
                        window.requestAnimationFrame(anim);
                        cnt++;
                        if (cnt >= til) {
                            cnt = 0;
                            var i, theta, phi, _x, _y, _z, sin, cos, pnxt, rotX, rotZ, rng, m, dalph;
                            for (i = 0; i < num; i++) {
                                theta = Math.random() * 2 * Math.PI;
                                phi = Math.acos(Math.random() * 2 - 1);
                                _x = rad * Math.sin(phi) * Math.cos(theta);
                                _y = rad * Math.sin(phi) * Math.sin(theta);
                                _z = rad * Math.cos(phi);
                                var p = add(_x, yMid + _y, zMid + _z, 0.005 * _x, 0.002 * _y, 0.002 * _z);
                                p.a = 120; p.b = 120; p.c = 460;
                                p.va = 0; p.vb = alph; p.vc = 0;
                                p.rem = 120 + Math.random() * 20;
                                p.mvX = 0; p.mvY = grav; p.mvZ = 0;
                            }
                        }
                        ang = (ang + sp) + (2 * Math.PI);
                        sin = Math.sin(ang);
                        cos = Math.cos(ang);
                        var g = $.createRadialGradient(c.width, c.width,0, c.height, c.height, c.width);
                        g.addColorStop(0,'hsla(255,255%,255%,1)'); // hsla(0,0%,80%,1)
                        g.addColorStop(0.5, 'hsl(0deg 0% 100%)');
                        g.addColorStop(1, 'hsla(255,255%,255%,1)');
                        $.fillStyle = g;
                        $.fillRect(0, 0, w, h);
                        p = _arr.first;
                        while (p != null) {
                            pnxt = p.next; p.go++;
                            if (p.go > p.rem) {
                                p.vx += p.mvX + spX * (Math.random() * 2 - 1);
                                p.vy += p.mvY + spY * (Math.random() * 2 - 1);
                                p.vz += p.mvZ + spZ * (Math.random() * 2 - 1);
                                p.x += p.vx;
                                p.y += p.vy;
                                p.z += p.vz;
                            }
                            rotX = cos * p.x + sin * (p.z - zMid);
                            rotZ = -sin * p.x + cos * (p.z - zMid) + zMid;
                            m = pov / (pov - rotZ);
                            p.px = rotX * m + midX;
                            p.py = p.y * m + midY;
                            if (p.go < p.a + p.b + p.c) {
                                if (p.go < p.a)
                                    p.alpha = (p.vb - p.va) / p.a * p.go + p.va;
                                else if (p.go < p.a + p.b)
                                    p.alpha = p.vb/2;
                                else if (p.go < p.a + p.b + p.c)
                                    p.alpha = (p.vc - p.vb) / p.c * (p.go - p.a - p.b) + p.vb;
                            } else
                                p.end = true;
                            if ((p.px > w) || (p.px < 0) || (p.py < 0) || (p.py > h) || (rotZ > maxZ))
                                rng = true;
                            else
                                rng = false;
                            if (rng || p.end)fin(p);
                            else {
                                dalph = (1 - rotZ / dth);
                                dalph = (dalph > 1) ? 1 : ((dalph < 0) ? 0 : dalph);
                                $.fillStyle = 'hsla(0, 0%, 5%, '+p.alpha+')';
                                $.beginPath();
                                $.fillRect(p.px, p.py, m*psz, m*psz);
                                $.fill();
                            }
                            p = pnxt;
                        }
                        txt();
                    }

                    function add(_x, _y, _z, vx0, vy0, vz0) {
                        var np;
                        if (dump.first != null) {
                            np = dump.first;
                            if (np.next != null) {
                                dump.first = np.next;
                                np.next.prev = null;
                            } else dump.first = null;
                        }
                        else
                            np = {};
                        if (_arr.first == null) {
                            _arr.first = np;
                            np.prev = null;
                            np.next = null;
                        } else {
                            np.next = _arr.first;
                            _arr.first.prev = np;
                            _arr.first = np;
                            np.prev = null;
                        }
                        np.x = _x; np.y = _y; np.z = _z;
                        np.vx = vx0; np.vy = vy0; np.vz = vz0;
                        np.go = 0; np.end = false;
                        if (Math.random() < 0.5) np.rt = true;
                        else np.rt = false;
                        return np;
                    }

                    function fin(p) {
                        if (_arr.first == p) {
                            if (p.next != null) {
                                p.next.prev = null;
                                _arr.first = p.next;
                            } else _arr.first = null;
                        } else {
                            if (p.next == null) p.prev.next = null;
                            else {
                                p.prev.next = p.next;
                                p.next.prev = p.prev;
                            }
                        }
                        if (dump.first == null) {
                            dump.first = p;
                            p.prev = null;
                            p.next = null;
                        } else {
                            p.next = dump.first;
                            dump.first.prev = p;
                            dump.first = p;
                            p.prev = null;
                        }
                    }
                    window.addEventListener('resize',function(){
                        c.width = w = window.innerWidth;
                        c.height = h = window.innerHeight;
                    }, false);

                    /* Not found */

                }

            }).catch(function (error) {
                console.log(error);
                // alert(error);
            });

    }


    (function() {
        var selectors = {
            nav: '[data-features-nav]',
            tabs: '[data-features-tabs]',
            active: '.__active'
        };
        var classes = {
            active: '__active'
        };
        $('a', selectors.nav).on('click', function() {
            let $this = $(this)[0];
            $(selectors.active, selectors.nav).removeClass(classes.active);
            $($this).addClass(classes.active);
            $('div', selectors.tabs).removeClass(classes.active);
            $($this.hash, selectors.tabs).addClass(classes.active);
            return false
        });
    }());

    $(".btn-with-icon").on("click", function(e) {
        e.preventDefault();
        console.log(7);
        $(".wave-anim").addClass('visible').one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd", function() {
            $(".wave-anim").removeClass('visible');
        });
    });


    /* run sphere */
    result();

    /* init bootstrap tooltip */
    $('[data-toggle="tooltip"]').tooltip();

    // a search page opens after clicking on links our cloud words
    let rootEl = document.querySelector('#tagcloud');
    rootEl.addEventListener('click', function clickEventHandler(e) {
        if (e.target.className === 'tagcloud--item') {
            window.open(`/search?q=${e.target.innerText}`, '_self');
        }
    });

});


