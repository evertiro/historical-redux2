jQuery(function () {
  jQuery('.fontselect').fontselect();
  
  jQuery(".fontselect").change(function() {
    var this_id = jQuery(this).attr('id');
    var font = jQuery(this).val();
    font = font.replace(/\+/g, ' ').split(':');
    jQuery('#' + this_id + '-example').css('font-family', font[0]);
  });
    
  jQuery('.fs-size').click(function() {
	var the_original_id = jQuery(this).attr('id').split('-');
	var the_operation = the_original_id.pop();
	the_original_id = '#' + the_original_id.join('-') + '-example';
	var font_size = parseInt(jQuery(the_original_id).css('font-size').replace('px', ''));
	font_size = (the_operation == 'smaller') ? font_size-1 : font_size+1;
	jQuery(the_original_id).css('font-size',font_size + 'px');
  });
});

/*!
 * jQuery.fontselect - A font selector for the Google Web Fonts api
 * Tom Moor, http://tommoor.com
 * Copyright (c) 2011 Tom Moor
 * MIT Licensed
 * Modified by Keith Miyake to include a reset button
 * @version 0.1.1
*/

(function($){

  $.fn.fontselect = function(options) {

    var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

    var _fonts = [
      "ABeeZee:regular",
      "ABeeZee:italic",
      "Abel",
      "Abril+Fatface",
      "Aclonica",
      "Acme",
      "Actor",
      "Adamina",
      "Advent+Pro:100",
      "Advent+Pro:200",
      "Advent+Pro:300",
      "Advent+Pro:regular",
      "Advent+Pro:500",
      "Advent+Pro:600",
      "Advent+Pro:700",
      "Aguafina+Script",
      "Akronim",
      "Aladin",
      "Aldrich",
      "Alegreya:regular",
      "Alegreya:italic",
      "Alegreya:700",
      "Alegreya:700italic",
      "Alegreya:900",
      "Alegreya:900italic",
      "Alegreya+SC:regular",
      "Alegreya+SC:italic",
      "Alegreya+SC:700",
      "Alegreya+SC:700italic",
      "Alegreya+SC:900",
      "Alegreya+SC:900italic",
      "Alex+Brush",
      "Alfa+Slab+One",
      "Alice",
      "Alike",
      "Alike+Angular",
      "Allan:regular",
      "Allan:700",
      "Allerta",
      "Allerta+Stencil",
      "Allura",
      "Almendra:regular",
      "Almendra:italic",
      "Almendra:700",
      "Almendra:700italic",
      "Almendra+SC",
      "Amarante",
      "Amaranth:regular",
      "Amaranth:italic",
      "Amaranth:700",
      "Amaranth:700italic",
      "Amatic+SC:regular",
      "Amatic+SC:700",
      "Amethysta",
      "Anaheim",
      "Andada",
      "Andika",
      "Angkor",
      "Annie+Use+Your+Telescope",
      "Anonymous+Pro:regular",
      "Anonymous+Pro:italic",
      "Anonymous+Pro:700",
      "Anonymous+Pro:700italic",
      "Antic",
      "Antic+Didone",
      "Antic+Slab",
      "Anton",
      "Arapey:regular",
      "Arapey:italic",
      "Arbutus",
      "Arbutus+Slab",
      "Architects+Daughter",
      "Archivo+Black",
      "Archivo+Narrow:regular",
      "Archivo+Narrow:italic",
      "Archivo+Narrow:700",
      "Archivo+Narrow:700italic",
      "Arimo:regular",
      "Arimo:italic",
      "Arimo:700",
      "Arimo:700italic",
      "Arizonia",
      "Armata",
      "Artifika",
      "Arvo:regular",
      "Arvo:italic",
      "Arvo:700",
      "Arvo:700italic",
      "Asap:regular",
      "Asap:italic",
      "Asap:700",
      "Asap:700italic",
      "Asset",
      "Astloch:regular",
      "Astloch:700",
      "Asul:regular",
      "Asul:700",
      "Atomic+Age",
      "Aubrey",
      "Audiowide",
      "Autour+One",
      "Average",
      "Average+Sans",
      "Averia+Gruesa+Libre",
      "Averia+Libre:300",
      "Averia+Libre:300italic",
      "Averia+Libre:regular",
      "Averia+Libre:italic",
      "Averia+Libre:700",
      "Averia+Libre:700italic",
      "Averia+Sans+Libre:300",
      "Averia+Sans+Libre:300italic",
      "Averia+Sans+Libre:regular",
      "Averia+Sans+Libre:italic",
      "Averia+Sans+Libre:700",
      "Averia+Sans+Libre:700italic",
      "Averia+Serif+Libre:300",
      "Averia+Serif+Libre:300italic",
      "Averia+Serif+Libre:regular",
      "Averia+Serif+Libre:italic",
      "Averia+Serif+Libre:700",
      "Averia+Serif+Libre:700italic",
      "Bad+Script",
      "Balthazar",
      "Bangers",
      "Basic",
      "Battambang:regular",
      "Battambang:700",
      "Baumans",
      "Bayon",
      "Belgrano",
      "Belleza",
      "BenchNine:300",
      "BenchNine:regular",
      "BenchNine:700",
      "Bentham",
      "Berkshire+Swash",
      "Bevan",
      "Bigshot+One",
      "Bilbo",
      "Bilbo+Swash+Caps",
      "Bitter:regular",
      "Bitter:italic",
      "Bitter:700",
      "Black+Ops+One",
      "Bokor",
      "Bonbon",
      "Boogaloo",
      "Bowlby+One",
      "Bowlby+One+SC",
      "Brawler",
      "Bree+Serif",
      "Bubblegum+Sans",
      "Bubbler+One",
      "Buda:300",
      "Buenard:regular",
      "Buenard:700",
      "Butcherman",
      "Butterfly+Kids",
      "Cabin:regular",
      "Cabin:italic",
      "Cabin:500",
      "Cabin:500italic",
      "Cabin:600",
      "Cabin:600italic",
      "Cabin:700",
      "Cabin:700italic",
      "Cabin+Condensed:regular",
      "Cabin+Condensed:500",
      "Cabin+Condensed:600",
      "Cabin+Condensed:700",
      "Cabin+Sketch:regular",
      "Cabin+Sketch:700",
      "Caesar+Dressing",
      "Cagliostro",
      "Calligraffitti",
      "Cambo",
      "Candal",
      "Cantarell:regular",
      "Cantarell:italic",
      "Cantarell:700",
      "Cantarell:700italic",
      "Cantata+One",
      "Cantora+One",
      "Capriola",
      "Cardo:regular",
      "Cardo:italic",
      "Cardo:700",
      "Carme",
      "Carrois+Gothic",
      "Carrois+Gothic+SC",
      "Carter+One",
      "Caudex:regular",
      "Caudex:italic",
      "Caudex:700",
      "Caudex:700italic",
      "Cedarville+Cursive",
      "Ceviche+One",
      "Changa+One:regular",
      "Changa+One:italic",
      "Chango",
      "Chau+Philomene+One:regular",
      "Chau+Philomene+One:italic",
      "Chela+One",
      "Chelsea+Market",
      "Chenla",
      "Cherry+Cream+Soda",
      "Cherry+Swash:regular",
      "Cherry+Swash:700",
      "Chewy",
      "Chicle",
      "Chivo:regular",
      "Chivo:italic",
      "Chivo:900",
      "Chivo:900italic",
      "Cinzel:regular",
      "Cinzel:700",
      "Cinzel:900",
      "Cinzel+Decorative:regular",
      "Cinzel+Decorative:700",
      "Cinzel+Decorative:900",
      "Coda:regular",
      "Coda:800",
      "Coda+Caption:800",
      "Codystar:300",
      "Codystar:regular",
      "Combo",
      "Comfortaa:300",
      "Comfortaa:regular",
      "Comfortaa:700",
      "Coming+Soon",
      "Concert+One",
      "Condiment",
      "Content:regular",
      "Content:700",
      "Contrail+One",
      "Convergence",
      "Cookie",
      "Copse",
      "Corben:regular",
      "Corben:700",
      "Courgette",
      "Cousine:regular",
      "Cousine:italic",
      "Cousine:700",
      "Cousine:700italic",
      "Coustard:regular",
      "Coustard:900",
      "Covered+By+Your+Grace",
      "Crafty+Girls",
      "Creepster",
      "Crete+Round:regular",
      "Crete+Round:italic",
      "Crimson+Text:regular",
      "Crimson+Text:italic",
      "Crimson+Text:600",
      "Crimson+Text:600italic",
      "Crimson+Text:700",
      "Crimson+Text:700italic",
      "Crushed",
      "Cuprum:regular",
      "Cuprum:italic",
      "Cuprum:700",
      "Cuprum:700italic",
      "Cutive",
      "Cutive+Mono",
      "Damion",
      "Dancing+Script:regular",
      "Dancing+Script:700",
      "Dangrek",
      "Dawning+of+a+New+Day",
      "Days+One",
      "Delius",
      "Delius+Swash+Caps",
      "Delius+Unicase:regular",
      "Delius+Unicase:700",
      "Della+Respira",
      "Devonshire",
      "Didact+Gothic",
      "Diplomata",
      "Diplomata+SC",
      "Doppio+One",
      "Dorsa",
      "Dosis:200",
      "Dosis:300",
      "Dosis:regular",
      "Dosis:500",
      "Dosis:600",
      "Dosis:700",
      "Dosis:800",
      "Dr+Sugiyama",
      "Droid+Sans:regular",
      "Droid+Sans:700",
      "Droid+Sans+Mono",
      "Droid+Serif:regular",
      "Droid+Serif:italic",
      "Droid+Serif:700",
      "Droid+Serif:700italic",
      "Duru+Sans",
      "Dynalight",
      "EB+Garamond",
      "Eagle+Lake",
      "Eater",
      "Economica:regular",
      "Economica:italic",
      "Economica:700",
      "Economica:700italic",
      "Electrolize",
      "Emblema+One",
      "Emilys+Candy",
      "Engagement",
      "Enriqueta:regular",
      "Enriqueta:700",
      "Erica+One",
      "Esteban",
      "Euphoria+Script",
      "Ewert",
      "Exo:100",
      "Exo:100italic",
      "Exo:200",
      "Exo:200italic",
      "Exo:300",
      "Exo:300italic",
      "Exo:regular",
      "Exo:italic",
      "Exo:500",
      "Exo:500italic",
      "Exo:600",
      "Exo:600italic",
      "Exo:700",
      "Exo:700italic",
      "Exo:800",
      "Exo:800italic",
      "Exo:900",
      "Exo:900italic",
      "Expletus+Sans:regular",
      "Expletus+Sans:italic",
      "Expletus+Sans:500",
      "Expletus+Sans:500italic",
      "Expletus+Sans:600",
      "Expletus+Sans:600italic",
      "Expletus+Sans:700",
      "Expletus+Sans:700italic",
      "Fanwood+Text:regular",
      "Fanwood+Text:italic",
      "Fascinate",
      "Fascinate+Inline",
      "Faster+One",
      "Fasthand",
      "Federant",
      "Federo",
      "Felipa",
      "Fenix",
      "Finger+Paint",
      "Fjord+One",
      "Flamenco:300",
      "Flamenco:regular",
      "Flavors",
      "Fondamento:regular",
      "Fondamento:italic",
      "Fontdiner+Swanky",
      "Forum",
      "Francois+One",
      "Fredericka+the+Great",
      "Fredoka+One",
      "Freehand",
      "Fresca",
      "Frijole",
      "Fugaz+One",
      "GFS+Didot",
      "GFS+Neohellenic:regular",
      "GFS+Neohellenic:italic",
      "GFS+Neohellenic:700",
      "GFS+Neohellenic:700italic",
      "Galdeano",
      "Galindo",
      "Gentium+Basic:regular",
      "Gentium+Basic:italic",
      "Gentium+Basic:700",
      "Gentium+Basic:700italic",
      "Gentium+Book+Basic:regular",
      "Gentium+Book+Basic:italic",
      "Gentium+Book+Basic:700",
      "Gentium+Book+Basic:700italic",
      "Geo:regular",
      "Geo:italic",
      "Geostar",
      "Geostar+Fill",
      "Germania+One",
      "Give+You+Glory",
      "Glass+Antiqua",
      "Glegoo",
      "Gloria+Hallelujah",
      "Goblin+One",
      "Gochi+Hand",
      "Gorditas:regular",
      "Gorditas:700",
      "Goudy+Bookletter+1911",
      "Graduate",
      "Gravitas+One",
      "Great+Vibes",
      "Griffy",
      "Gruppo",
      "Gudea:regular",
      "Gudea:italic",
      "Gudea:700",
      "Habibi",
      "Hammersmith+One",
      "Handlee",
      "Hanuman:regular",
      "Hanuman:700",
      "Happy+Monkey",
      "Headland+One",
      "Henny+Penny",
      "Herr+Von+Muellerhoff",
      "Holtwood+One+SC",
      "Homemade+Apple",
      "Homenaje",
      "IM+Fell+DW+Pica:regular",
      "IM+Fell+DW+Pica:italic",
      "IM+Fell+DW+Pica+SC",
      "IM+Fell+Double+Pica:regular",
      "IM+Fell+Double+Pica:italic",
      "IM+Fell+Double+Pica+SC",
      "IM+Fell+English:regular",
      "IM+Fell+English:italic",
      "IM+Fell+English+SC",
      "IM+Fell+French+Canon:regular",
      "IM+Fell+French+Canon:italic",
      "IM+Fell+French+Canon+SC",
      "IM+Fell+Great+Primer:regular",
      "IM+Fell+Great+Primer:italic",
      "IM+Fell+Great+Primer+SC",
      "Iceberg",
      "Iceland",
      "Imprima",
      "Inconsolata:regular",
      "Inconsolata:700",
      "Inder",
      "Indie+Flower",
      "Inika:regular",
      "Inika:700",
      "Irish+Grover",
      "Istok+Web:regular",
      "Istok+Web:italic",
      "Istok+Web:700",
      "Istok+Web:700italic",
      "Italiana",
      "Italianno",
      "Jacques+Francois",
      "Jacques+Francois+Shadow",
      "Jim+Nightshade",
      "Jockey+One",
      "Jolly+Lodger",
      "Josefin+Sans:100",
      "Josefin+Sans:100italic",
      "Josefin+Sans:300",
      "Josefin+Sans:300italic",
      "Josefin+Sans:regular",
      "Josefin+Sans:italic",
      "Josefin+Sans:600",
      "Josefin+Sans:600italic",
      "Josefin+Sans:700",
      "Josefin+Sans:700italic",
      "Josefin+Slab:100",
      "Josefin+Slab:100italic",
      "Josefin+Slab:300",
      "Josefin+Slab:300italic",
      "Josefin+Slab:regular",
      "Josefin+Slab:italic",
      "Josefin+Slab:600",
      "Josefin+Slab:600italic",
      "Josefin+Slab:700",
      "Josefin+Slab:700italic",
      "Judson:regular",
      "Judson:italic",
      "Judson:700",
      "Julee",
      "Julius+Sans+One",
      "Junge",
      "Jura:300",
      "Jura:regular",
      "Jura:500",
      "Jura:600",
      "Just+Another+Hand",
      "Just+Me+Again+Down+Here",
      "Kameron:regular",
      "Kameron:700",
      "Karla:regular",
      "Karla:italic",
      "Karla:700",
      "Karla:700italic",
      "Kaushan+Script",
      "Kelly+Slab",
      "Kenia",
      "Khmer",
      "Kite+One",
      "Knewave",
      "Kotta+One",
      "Koulen",
      "Kranky",
      "Kreon:300",
      "Kreon:regular",
      "Kreon:700",
      "Kristi",
      "Krona+One",
      "La+Belle+Aurore",
      "Lancelot",
      "Lato:100",
      "Lato:100italic",
      "Lato:300",
      "Lato:300italic",
      "Lato:regular",
      "Lato:italic",
      "Lato:700",
      "Lato:700italic",
      "Lato:900",
      "Lato:900italic",
      "League+Script",
      "Leckerli+One",
      "Ledger",
      "Lekton:regular",
      "Lekton:italic",
      "Lekton:700",
      "Lemon",
      "Life+Savers",
      "Lilita+One",
      "Limelight",
      "Linden+Hill:regular",
      "Linden+Hill:italic",
      "Lobster",
      "Lobster+Two:regular",
      "Lobster+Two:italic",
      "Lobster+Two:700",
      "Lobster+Two:700italic",
      "Londrina+Outline",
      "Londrina+Shadow",
      "Londrina+Sketch",
      "Londrina+Solid",
      "Lora:regular",
      "Lora:italic",
      "Lora:700",
      "Lora:700italic",
      "Love+Ya+Like+A+Sister",
      "Loved+by+the+King",
      "Lovers+Quarrel",
      "Luckiest+Guy",
      "Lusitana:regular",
      "Lusitana:700",
      "Lustria",
      "Macondo",
      "Macondo+Swash+Caps",
      "Magra:regular",
      "Magra:700",
      "Maiden+Orange",
      "Mako",
      "Marcellus",
      "Marcellus+SC",
      "Marck+Script",
      "Marko+One",
      "Marmelad",
      "Marvel:regular",
      "Marvel:italic",
      "Marvel:700",
      "Marvel:700italic",
      "Mate:regular",
      "Mate:italic",
      "Mate+SC",
      "Maven+Pro:regular",
      "Maven+Pro:500",
      "Maven+Pro:700",
      "Maven+Pro:900",
      "McLaren",
      "Meddon",
      "MedievalSharp",
      "Medula+One",
      "Megrim",
      "Meie+Script",
      "Merienda+One",
      "Merriweather:300",
      "Merriweather:regular",
      "Merriweather:700",
      "Merriweather:900",
      "Metal",
      "Metal+Mania",
      "Metamorphous",
      "Metrophobic",
      "Michroma",
      "Miltonian",
      "Miltonian+Tattoo",
      "Miniver",
      "Miss+Fajardose",
      "Modern+Antiqua",
      "Molengo",
      "Molle:italic",
      "Monofett",
      "Monoton",
      "Monsieur+La+Doulaise",
      "Montaga",
      "Montez",
      "Montserrat:regular",
      "Montserrat:700",
      "Montserrat+Alternates:regular",
      "Montserrat+Alternates:700",
      "Montserrat+Subrayada:regular",
      "Montserrat+Subrayada:700",
      "Moul",
      "Moulpali",
      "Mountains+of+Christmas:regular",
      "Mountains+of+Christmas:700",
      "Mr+Bedfort",
      "Mr+Dafoe",
      "Mr+De+Haviland",
      "Mrs+Saint+Delafield",
      "Mrs+Sheppards",
      "Muli:300",
      "Muli:300italic",
      "Muli:regular",
      "Muli:italic",
      "Mystery+Quest",
      "Neucha",
      "Neuton:200",
      "Neuton:300",
      "Neuton:regular",
      "Neuton:italic",
      "Neuton:700",
      "Neuton:800",
      "News+Cycle:regular",
      "News+Cycle:700",
      "Niconne",
      "Nixie+One",
      "Nobile:regular",
      "Nobile:italic",
      "Nobile:700",
      "Nobile:700italic",
      "Nokora:regular",
      "Nokora:700",
      "Norican",
      "Nosifer",
      "Nothing+You+Could+Do",
      "Noticia+Text:regular",
      "Noticia+Text:italic",
      "Noticia+Text:700",
      "Noticia+Text:700italic",
      "Nova+Cut",
      "Nova+Flat",
      "Nova+Mono",
      "Nova+Oval",
      "Nova+Round",
      "Nova+Script",
      "Nova+Slim",
      "Nova+Square",
      "Numans",
      "Nunito:300",
      "Nunito:regular",
      "Nunito:700",
      "Odor+Mean+Chey",
      "Offside",
      "Old+Standard+TT:regular",
      "Old+Standard+TT:italic",
      "Old+Standard+TT:700",
      "Oldenburg",
      "Oleo+Script:regular",
      "Oleo+Script:700",
      "Open+Sans:300",
      "Open+Sans:300italic",
      "Open+Sans:regular",
      "Open+Sans:italic",
      "Open+Sans:600",
      "Open+Sans:600italic",
      "Open+Sans:700",
      "Open+Sans:700italic",
      "Open+Sans:800",
      "Open+Sans:800italic",
      "Open+Sans+Condensed:300",
      "Open+Sans+Condensed:300italic",
      "Open+Sans+Condensed:700",
      "Oranienbaum",
      "Orbitron:regular",
      "Orbitron:500",
      "Orbitron:700",
      "Orbitron:900",
      "Oregano:regular",
      "Oregano:italic",
      "Orienta",
      "Original+Surfer",
      "Oswald:300",
      "Oswald:regular",
      "Oswald:700",
      "Over+the+Rainbow",
      "Overlock:regular",
      "Overlock:italic",
      "Overlock:700",
      "Overlock:700italic",
      "Overlock:900",
      "Overlock:900italic",
      "Overlock+SC",
      "Ovo",
      "Oxygen:300",
      "Oxygen:regular",
      "Oxygen:700",
      "Oxygen+Mono",
      "PT+Mono",
      "PT+Sans:regular",
      "PT+Sans:italic",
      "PT+Sans:700",
      "PT+Sans:700italic",
      "PT+Sans+Caption:regular",
      "PT+Sans+Caption:700",
      "PT+Sans+Narrow:regular",
      "PT+Sans+Narrow:700",
      "PT+Serif:regular",
      "PT+Serif:italic",
      "PT+Serif:700",
      "PT+Serif:700italic",
      "PT+Serif+Caption:regular",
      "PT+Serif+Caption:italic",
      "Pacifico",
      "Paprika",
      "Parisienne",
      "Passero+One",
      "Passion+One:regular",
      "Passion+One:700",
      "Passion+One:900",
      "Patrick+Hand",
      "Patua+One",
      "Paytone+One",
      "Peralta",
      "Permanent+Marker",
      "Petit+Formal+Script",
      "Petrona",
      "Philosopher:regular",
      "Philosopher:italic",
      "Philosopher:700",
      "Philosopher:700italic",
      "Piedra",
      "Pinyon+Script",
      "Plaster",
      "Play:regular",
      "Play:700",
      "Playball",
      "Playfair+Display:regular",
      "Playfair+Display:italic",
      "Playfair+Display:700",
      "Playfair+Display:700italic",
      "Playfair+Display:900",
      "Playfair+Display:900italic",
      "Playfair+Display+SC:regular",
      "Playfair+Display+SC:italic",
      "Playfair+Display+SC:700",
      "Playfair+Display+SC:700italic",
      "Playfair+Display+SC:900",
      "Playfair+Display+SC:900italic",
      "Podkova:regular",
      "Podkova:700",
      "Poiret+One",
      "Poller+One",
      "Poly:regular",
      "Poly:italic",
      "Pompiere",
      "Pontano+Sans",
      "Port+Lligat+Sans",
      "Port+Lligat+Slab",
      "Prata",
      "Preahvihear",
      "Press+Start+2P",
      "Princess+Sofia",
      "Prociono",
      "Prosto+One",
      "Puritan:regular",
      "Puritan:italic",
      "Puritan:700",
      "Puritan:700italic",
      "Quando",
      "Quantico:regular",
      "Quantico:italic",
      "Quantico:700",
      "Quantico:700italic",
      "Quattrocento:regular",
      "Quattrocento:700",
      "Quattrocento+Sans:regular",
      "Quattrocento+Sans:italic",
      "Quattrocento+Sans:700",
      "Quattrocento+Sans:700italic",
      "Questrial",
      "Quicksand:300",
      "Quicksand:regular",
      "Quicksand:700",
      "Qwigley",
      "Racing+Sans+One",
      "Radley:regular",
      "Radley:italic",
      "Raleway:100",
      "Raleway:200",
      "Raleway:300",
      "Raleway:regular",
      "Raleway:500",
      "Raleway:600",
      "Raleway:700",
      "Raleway:800",
      "Raleway:900",
      "Raleway+Dots",
      "Rammetto+One",
      "Ranchers",
      "Rancho",
      "Rationale",
      "Redressed",
      "Reenie+Beanie",
      "Revalia",
      "Ribeye",
      "Ribeye+Marrow",
      "Righteous",
      "Rochester",
      "Rock+Salt",
      "Rokkitt:regular",
      "Rokkitt:700",
      "Romanesco",
      "Ropa+Sans:regular",
      "Ropa+Sans:italic",
      "Rosario:regular",
      "Rosario:italic",
      "Rosario:700",
      "Rosario:700italic",
      "Rosarivo:regular",
      "Rosarivo:italic",
      "Rouge+Script",
      "Ruda:regular",
      "Ruda:700",
      "Ruda:900",
      "Ruge+Boogie",
      "Ruluko",
      "Ruslan+Display",
      "Russo+One",
      "Ruthie",
      "Rye",
      "Sail",
      "Salsa",
      "Sanchez:regular",
      "Sanchez:italic",
      "Sancreek",
      "Sansita+One",
      "Sarina",
      "Satisfy",
      "Scada:regular",
      "Scada:italic",
      "Scada:700",
      "Scada:700italic",
      "Schoolbell",
      "Seaweed+Script",
      "Sevillana",
      "Seymour+One",
      "Shadows+Into+Light",
      "Shadows+Into+Light+Two",
      "Shanti",
      "Share:regular",
      "Share:italic",
      "Share:700",
      "Share:700italic",
      "Share+Tech",
      "Share+Tech+Mono",
      "Shojumaru",
      "Short+Stack",
      "Siemreap",
      "Sigmar+One",
      "Signika:300",
      "Signika:regular",
      "Signika:600",
      "Signika:700",
      "Signika+Negative:300",
      "Signika+Negative:regular",
      "Signika+Negative:600",
      "Signika+Negative:700",
      "Simonetta:regular",
      "Simonetta:italic",
      "Simonetta:900",
      "Simonetta:900italic",
      "Sirin+Stencil",
      "Six+Caps",
      "Skranji:regular",
      "Skranji:700",
      "Slackey",
      "Smokum",
      "Smythe",
      "Sniglet:800",
      "Snippet",
      "Sofadi+One",
      "Sofia",
      "Sonsie+One",
      "Sorts+Mill+Goudy:regular",
      "Sorts+Mill+Goudy:italic",
      "Source+Code+Pro:200",
      "Source+Code+Pro:300",
      "Source+Code+Pro:regular",
      "Source+Code+Pro:600",
      "Source+Code+Pro:700",
      "Source+Code+Pro:900",
      "Source+Sans+Pro:200",
      "Source+Sans+Pro:200italic",
      "Source+Sans+Pro:300",
      "Source+Sans+Pro:300italic",
      "Source+Sans+Pro:regular",
      "Source+Sans+Pro:italic",
      "Source+Sans+Pro:600",
      "Source+Sans+Pro:600italic",
      "Source+Sans+Pro:700",
      "Source+Sans+Pro:700italic",
      "Source+Sans+Pro:900",
      "Source+Sans+Pro:900italic",
      "Special+Elite",
      "Spicy+Rice",
      "Spinnaker",
      "Spirax",
      "Squada+One",
      "Stalinist+One",
      "Stardos+Stencil:regular",
      "Stardos+Stencil:700",
      "Stint+Ultra+Condensed",
      "Stint+Ultra+Expanded",
      "Stoke:300",
      "Stoke:regular",
      "Strait",
      "Sue+Ellen+Francisco",
      "Sunshiney",
      "Supermercado+One",
      "Suwannaphum",
      "Swanky+and+Moo+Moo",
      "Syncopate:regular",
      "Syncopate:700",
      "Tangerine:regular",
      "Tangerine:700",
      "Taprom",
      "Telex",
      "Tenor+Sans",
      "The+Girl+Next+Door",
      "Tienne:regular",
      "Tienne:700",
      "Tienne:900",
      "Tinos:regular",
      "Tinos:italic",
      "Tinos:700",
      "Tinos:700italic",
      "Titan+One",
      "Titillium+Web:200",
      "Titillium+Web:200italic",
      "Titillium+Web:300",
      "Titillium+Web:300italic",
      "Titillium+Web:regular",
      "Titillium+Web:italic",
      "Titillium+Web:600",
      "Titillium+Web:600italic",
      "Titillium+Web:700",
      "Titillium+Web:700italic",
      "Titillium+Web:900",
      "Trade+Winds",
      "Trocchi",
      "Trochut:regular",
      "Trochut:italic",
      "Trochut:700",
      "Trykker",
      "Tulpen+One",
      "Ubuntu:300",
      "Ubuntu:300italic",
      "Ubuntu:regular",
      "Ubuntu:italic",
      "Ubuntu:500",
      "Ubuntu:500italic",
      "Ubuntu:700",
      "Ubuntu:700italic",
      "Ubuntu+Condensed",
      "Ubuntu+Mono:regular",
      "Ubuntu+Mono:italic",
      "Ubuntu+Mono:700",
      "Ubuntu+Mono:700italic",
      "Ultra",
      "Uncial+Antiqua",
      "Underdog",
      "Unica+One",
      "UnifrakturCook:700",
      "UnifrakturMaguntia",
      "Unkempt:regular",
      "Unkempt:700",
      "Unlock",
      "Unna",
      "VT323",
      "Varela",
      "Varela+Round",
      "Vast+Shadow",
      "Vibur",
      "Vidaloka",
      "Viga",
      "Voces",
      "Volkhov:regular",
      "Volkhov:italic",
      "Volkhov:700",
      "Volkhov:700italic",
      "Vollkorn:regular",
      "Vollkorn:italic",
      "Vollkorn:700",
      "Vollkorn:700italic",
      "Voltaire",
      "Waiting+for+the+Sunrise",
      "Wallpoet",
      "Walter+Turncoat",
      "Warnes",
      "Wellfleet",
      "Wire+One",
      "Yanone+Kaffeesatz:200",
      "Yanone+Kaffeesatz:300",
      "Yanone+Kaffeesatz:regular",
      "Yanone+Kaffeesatz:700",
      "Yellowtail",
      "Yeseva+One",
      "Yesteryear",
      "Zeyada"
    ];

    var settings = $.extend( {
      style:            'redux-font-select',
      placeholder:      'Select a font',
      resettext:        'Reset',
      lookahead:        6,
      cssUrl:          'http://fonts.googleapis.com/css?family=',
      fonts:            _fonts,
      apiUrl:           'https://www.googleapis.com/webfonts/v1/webfonts',
      apiKey:           null,
      fetch:            false,
      combine:          false
    }, options);

    var Fontselect = (function(){

      function Fontselect(original, o){
        this.$original = $(original);
        this.options = o;
        this.active = false;
        this.setupHtml();
        this.setupFonts();
        if (this.options.fetch) {
          this.fetchFonts();
        }
      }

      Fontselect.prototype.fetchFonts = function () {
        var fontselect = this;
        var url = this.options.apiUrl;
        if (this.options.apiKey) {
          url = url + '?key=' + this.options.apiKey;
        }
        $.ajax({
          url: url,
          dataType: 'jsonp',
          success: function(data) {
            if (data.items && data.items.length > 0) {
              fontselect.options.fonts = [];
              $.each(data.items, function(key, font) {
              //TO-DO: add selectors for variants and subsets
                $.each(font.variants, function(key, variant) {
                  var family = font.family.replace(/ /g, '+');
                  if (font.variants.length > 1 || (variant != 400 && variant != 'regular')) {
                    family = family + ':' + variant;
                  }
                  fontselect.options.fonts.push(family);
                  //console.log('"'+family+'"');
                });
              });
            }
            fontselect.$drop.empty();
            fontselect.$results.empty();
            fontselect.$drop.append(fontselect.$results.append(fontselect.fontsAsHtml())).hide();
            $('li', fontselect.$results)
              .click(__bind(fontselect.selectFont, fontselect))
              .mouseenter(__bind(fontselect.activateFont, fontselect))
              .mouseleave(__bind(fontselect.deactivateFont, fontselect));
          },
          error: function(xmlhttp) {
            // JSONP doesn't trigger any event if there's an error with the request
          }
        });
      }

      Fontselect.prototype.setupFonts = function() {
        this.getVisibleFonts();
        this.bindEvents();

        var font = this.$original.val();
        if (font) {
          this.updateSelected();
          this.addFontLink(font);
        }
      }

      Fontselect.prototype.bindEvents = function(){

        $('li', this.$results)
        .click(__bind(this.selectFont, this))
        .mouseenter(__bind(this.activateFont, this))
        .mouseleave(__bind(this.deactivateFont, this));

        $('span', this.$select).click(__bind(this.toggleDrop, this));
        this.$arrow.click(__bind(this.toggleDrop, this));
        this.$reset.click(__bind(this.resetSelected, this));
      };

      Fontselect.prototype.toggleDrop = function(ev){

        if(this.active){
          this.$element.removeClass('redux-font-select-active');
          this.$top = this.$results.scrollTop();
          this.$drop.hide();
          clearInterval(this.visibleInterval);

        } else {
          this.$element.addClass('redux-font-select-active');
          this.$drop.show();
          this.$results.scrollTop(this.$top);
          this.moveToSelected();
          this.visibleInterval = setInterval(__bind(this.getVisibleFonts, this), 500);
        }

        this.active = !this.active;
      };

      Fontselect.prototype.selectFont = function(){

        var font = $('li.active', this.$results).data('value');
        this.$original.val(font).change();
        this.updateSelected();
        this.toggleDrop();
      };

      Fontselect.prototype.moveToSelected = function(){

        var $li, font = this.$original.val();

        if (font) {
          $li = $("li[data-value='"+ font +"']", this.$results);
        } else {
          $li = $("li", this.$results).first();
        }

        if (!$li.hasClass('active')) {
          this.$results.scrollTop(0);
          this.$results.scrollTop($li.addClass('active').position().top);
        }
      };

      Fontselect.prototype.activateFont = function(ev){
        $('li.active', this.$results).removeClass('active');
        $(ev.currentTarget).addClass('active');
      };

      Fontselect.prototype.deactivateFont = function(ev){

        $(ev.currentTarget).removeClass('active');
      };

      Fontselect.prototype.updateSelected = function(){

        var font = this.$original.val();
        $('span', this.$element).text(this.toReadable(font)).css(this.toStyle(font));
      };

      Fontselect.prototype.resetSelected = function(ev){

        this.$original.val('').change();
        $('span', this.$element).text(this.options.placeholder).css({'font-family' : '','font-weight' : '', 'font-style' : '', 'font-size' : ''});
      };

      Fontselect.prototype.setupHtml = function(){

        this.$original.empty().hide();
        this.$element = $('<div>', {'class': this.options.style});
        this.$arrow = $('<div><b></b></div>');
        this.$select = $('<a><span>'+ this.options.placeholder +'</span></a>');
        this.$drop = $('<div>', {'class': 'fs-drop'});
        this.$results = $('<ul>', {'class': 'fs-results'});
        this.$reset = $('<input type="button" class="'+ this.options.style +' fs-reset button" value="'+ this.options.resettext +'" />');
        this.$original.after(this.$element.append(this.$select.append(this.$arrow)).append(this.$drop));
        this.$reset.insertAfter(this.$element);
        this.$drop.append(this.$results.append(this.fontsAsHtml())).hide();
      };

      Fontselect.prototype.fontsAsHtml = function(){

        var fonts = this.options.fonts;
        var l = fonts.length;

        if (this.options.combine) {
          var combined = [];
          var name = '';
          var family = '';
          for (var i=0 ; i<l ; i++) {
            var parts = fonts[i].split(':');
            if (name == '' || name != parts[0]) {
              if (name != '') {
                combined.push(family);
              }
              name = parts[0];
              family = fonts[i];
            }
            else {
              family = family + '|' + fonts[i];
            }
            if (i == l-1) {
              combined.push(family);
            }
          }
          fonts = combined;
          l = fonts.length;
        }

        var r, s, h = '';

        for(var i=0; i<l; i++){
          r = this.toReadable(fonts[i]);
          s = this.toStyle(fonts[i]);
          h += '<li data-value="'+ fonts[i] +'" style="font-family: '+s['font-family'] +'; font-weight: '+s['font-weight'] +'; font-style: '+s['font-style'] +'">'+ r +'</li>';
        }

        return h;
      };

      Fontselect.prototype.toReadable = function(font){
        var readable = font;
        if (this.options.combine) {
          readable = readable.replace(/:.*/, '');
        }
        return readable.replace(/[\+|:]/g, ' ');
      };

      Fontselect.prototype.toStyle = function(font){
        var t = font.split(':');
        var variant = t[1] || '';
        var weight = variant.match(/(?:[0-9]+|bold)/) ? variant.match(/(?:[0-9]+|bold)/)[0] : 400;
        var style = variant.match(/italic/) ? variant.match(/italic/)[0] : 'normal';

        return {'font-family': this.toReadable(t[0]), 'font-weight': weight, 'font-style': style};
      };

      Fontselect.prototype.getVisibleFonts = function(){

        if(this.$results.is(':hidden')) return;

        var fs = this;
        var top = this.$results.scrollTop();
        var bottom = top + this.$results.height();

        if(this.options.lookahead){
          var li = $('li', this.$results).first().height();
          bottom += li*this.options.lookahead;
        }

        $('li', this.$results).each(function(){

          var ft = $(this).position().top+top;
          var fb = ft + $(this).height();

          if ((fb >= top) && (ft <= bottom)){
            var font = $(this).data('value');
            fs.addFontLink(font);
          }

        });
      };

      Fontselect.prototype.addFontLink = function(font){

        var link = this.options.cssUrl + font;

        if ($("link[href*='" + font + "']").length === 0){
			$('link:last').after('<link href="' + link + '" rel="stylesheet" type="text/css">');
		}
      };

      return Fontselect;
    })();

    return this.each(function() {
      return new Fontselect(this, settings);
    });

  };
})(jQuery);
