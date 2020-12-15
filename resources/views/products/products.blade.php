

@extends('layouts.back')
 
 @section('content')
<?php 
use App\Http\Controllers\HomeController ;

$referentiels=  HomeController::referentiel1() ;
 
/*
$referentiels= json_decode( 
 '{
  "type": [
    {
      "id": 101,
      "libelle": "DEMI-PRODUITS"
    },
    {
      "id": 102,
      "libelle": "GALVANO"
    },
    {
      "id": 103,
      "libelle": "APPRETS et METRAGE"
    },
    {
      "id": 104,
      "libelle": "BIJOUX"
    }
  ],
  "famille1": [
    {
      "id": 1001,
      "libelle": "METAUX PURS",
      "type_id": 101,
      "alliage": [
        33,
        34,
        35,
        36
      ]
    },
    {
      "id": 1002,
      "libelle": "ALLIAGES POUR FCP",
      "type_id": 101,
      "alliage": [
        37,
        38,
        39,
        40,
        41,
        42,
        43,
        44,
        45,
        46,
        47,
        48,
        49,
        50,
        51,
        52,
        53,
        54,
        55
      ]
    },
    {
      "id": 1003,
      "libelle": "FIL",
      "type_id": 101,
      "alliage": [
        33,
        37,
        38,
        39,
        40,
        41,
        42,
        43,
        52,
        63,
        64,
        65,
        66,
        67,
        68,
        69,
        70,
        71,
        72,
        74,
        75,
        77,
        78,
        86
      ]
    },
    {
      "id": 1004,
      "libelle": "PLANE",
      "type_id": 101,
      "alliage": [
        33,
        37,
        38,
        39,
        40,
        41,
        42,
        43,
        52,
        63,
        64,
        65,
        66,
        67,
        68,
        69,
        70,
        71,
        72,
        74,
        75,
        77,
        78,
        86
      ]
    },
    {
      "id": 1005,
      "libelle": "TUBE",
      "type_id": 101,
      "alliage": [
        33,
        37,
        38,
        39,
        40,
        41,
        42,
        43,
        52,
        63,
        64,
        65,
        66,
        67,
        68,
        69,
        70,
        71,
        72,
        74,
        75,
        77,
        78,
        86
      ]
    },
    {
      "id": 1006,
      "libelle": "PLAQUE OR SUR CUIVRE",
      "type_id": 101,
      "alliage": [
        37,
        38,
        39,
        40,
        41,
        42,
        43,
        63,
        64,
        65,
        66,
        67,
        68,
        69,
        70,
        71,
        72,
        86
      ]
    },
    {
      "id": 1007,
      "libelle": "BRASURE",
      "type_id": 101,
      "alliage": [
        71,
        37,
        40,
        42,
        66,
        69,
        151,
        152,
        153,
        154,
        63
      ]
    },
    {
      "id": 1009,
      "libelle": "ANODE",
      "type_id": 102,
      "alliage": [
        33
      ]
    },
    {
      "id": 1010,
      "libelle": "SELS",
      "type_id": 102,
      "alliage": [
        15,
        16,
        17,
        22,
        23,
        24,
        25
      ]
    },
    {
      "id": 1011,
      "libelle": "BAINS",
      "type_id": 102,
      "alliage": [
        18,
        19,
        21,
        159,
        163,
        166,
        167
      ]
    },
    {
      "id": 1012,
      "libelle": "SOLUTION STYLO",
      "type_id": 102,
      "alliage": [
        20,
        157,
        158,
        168,
        169
      ]
    },
    {
      "id": 1013,
      "libelle": "FERMOIRS",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1014,
      "libelle": "FINITION",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1015,
      "libelle": "TIGE - POUSSETTE",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1016,
      "libelle": "SYSTEME",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1017,
      "libelle": "BOULE 2 TROUS",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1018,
      "libelle": "CHATON",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1019,
      "libelle": "SERTI CLOS",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1020,
      "libelle": "CORPS DE BAGUE",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1021,
      "libelle": "BROCHE",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1022,
      "libelle": "CHAINES AU METRE",
      "type_id": 103,
      "alliage": [
        2,
        3,
        4,
        27,
        31,
        160
      ]
    },
    {
      "id": 1024,
      "libelle": "CHAINE MECANIQUE",
      "type_id": 104,
      "alliage": [
        2,
        3,
        4
      ]
    },
    {
      "id": 1025,
      "libelle": "JONC MASSIF",
      "type_id": 104,
      "alliage": [
        2,
        3,
        4
      ]
    },
    {
      "id": 1026,
      "libelle": "CHAINE CREUSE",
      "type_id": 104,
      "alliage": [
        2,
        3,
        4
      ]
    },
    {
      "id": 1027,
      "libelle": "CREOLES",
      "type_id": 104,
      "alliage": [
        2,
        3,
        4
      ]
    },
    {
      "id": 1028,
      "libelle": "IDENTITE BEBE",
      "type_id": 104,
      "alliage": [
        2,
        3,
        4
      ]
    }
  ],
  "famille2": [
    {
      "famille2": 2001,
      "libelle": "GRENAILLE",
      "parents": [
        1001,
        1002
      ]
    },
    {
      "famille2": 2002,
      "libelle": "ROND",
      "parents": [
        1003
      ]
    },
    {
      "famille2": 2003,
      "libelle": "DEMI JONC",
      "parents": [
        1003
      ]
    },
    {
      "famille2": 2004,
      "libelle": "CARRE",
      "parents": [
        1003
      ]
    },
    {
      "famille2": 2005,
      "libelle": "RECTANGLE",
      "parents": [
        1003
      ]
    },
    {
      "famille2": 2006,
      "libelle": "LONGUE",
      "parents": [
        1006
      ]
    },
    {
      "famille2": 2007,
      "libelle": "PETITE",
      "parents": [
        1006
      ]
    },
    {
      "famille2": 2008,
      "libelle": "PLAQUE",
      "parents": [
        1007
      ]
    },
    {
      "famille2": 2012,
      "libelle": "AIGUILLE POUR SERING",
      "parents": [
        1007
      ]
    },
    {
      "famille2": 2013,
      "libelle": "PATE SERINGUE",
      "parents": [
        1007
      ]
    },
    {
      "famille2": 2014,
      "libelle": "PORTE SERINGUE",
      "parents": [
        1007
      ]
    },
    {
      "famille2": 2015,
      "libelle": "PORTE SERINGUE AVEC ",
      "parents": [
        1007
      ]
    },
    {
      "famille2": 2016,
      "libelle": "ANODE ARGENT LAMINEE",
      "parents": [
        1009
      ]
    },
    {
      "famille2": 2017,
      "libelle": "ANODE ARGENT PROFILE",
      "parents": [
        1009
      ]
    },
    {
      "famille2": 2018,
      "libelle": "AUROCYANURE DE POTAS",
      "parents": [
        1010
      ]
    },
    {
      "famille2": 2019,
      "libelle": "CYANURE  D`ARGENT",
      "parents": [
        1010
      ]
    },
    {
      "famille2": 2020,
      "libelle": "DICHLOROTETRAMINE DE",
      "parents": [
        1010
      ]
    },
    {
      "famille2": 2021,
      "libelle": "DEGRAISSANT",
      "parents": [
        1011
      ]
    },
    {
      "famille2": 2022,
      "libelle": "DORURE",
      "parents": [
        1011,
        1012
      ]
    },
    {
      "famille2": 2023,
      "libelle": "PLACAGE",
      "parents": [
        1011
      ]
    },
    {
      "famille2": 2024,
      "libelle": "RHODIAGE",
      "parents": [
        1011,
        1012
      ]
    },
    {
      "famille2": 2025,
      "libelle": "SEL POUR BAIN DE NEU",
      "parents": [
        1011
      ]
    },
    {
      "famille2": 2026,
      "libelle": "RHODIAGE NOIR",
      "parents": [
        1012
      ]
    },
    {
      "famille2": 2027,
      "libelle": "MOUSQUETON",
      "parents": [
        1013
      ]
    },
    {
      "famille2": 2028,
      "libelle": "ANNEAU MARIN",
      "parents": [
        1013
      ]
    },
    {
      "famille2": 2029,
      "libelle": "ANNEAU RESSORT",
      "parents": [
        1013
      ]
    },
    {
      "famille2": 2030,
      "libelle": "IMPERDABLE",
      "parents": [
        1013
      ]
    },
    {
      "famille2": 2031,
      "libelle": "SYSTEME DE SURETE",
      "parents": [
        1014
      ]
    },
    {
      "famille2": 2032,
      "libelle": "ANNEAU DE BOUT",
      "parents": [
        1014
      ]
    },
    {
      "famille2": 2033,
      "libelle": "BELIERES",
      "parents": [
        1014
      ]
    },
    {
      "famille2": 2034,
      "libelle": "POUSSETTES",
      "parents": [
        1015
      ]
    },
    {
      "famille2": 2035,
      "libelle": "TIGE POUR POUSSETTE",
      "parents": [
        1015
      ]
    },
    {
      "famille2": 2036,
      "libelle": "TIGE MONTEE",
      "parents": [
        1015
      ]
    },
    {
      "famille2": 2037,
      "libelle": "GUARDIAN",
      "parents": [
        1016
      ]
    },
    {
      "famille2": 2038,
      "libelle": "ALTOR COS",
      "parents": [
        1016
      ]
    },
    {
      "famille2": 2039,
      "libelle": "BASCULE",
      "parents": [
        1016
      ]
    },
    {
      "famille2": 2040,
      "libelle": "DORMEUSE",
      "parents": [
        1016
      ]
    },
    {
      "famille2": 2041,
      "libelle": "CROCHET",
      "parents": [
        1016
      ]
    },
    {
      "famille2": 2042,
      "libelle": "DIAMANTEE",
      "parents": [
        1017
      ]
    },
    {
      "famille2": 2043,
      "libelle": "LISSE",
      "parents": [
        1017
      ]
    },
    {
      "famille2": 2044,
      "libelle": "4 GRIFFES",
      "parents": [
        1018
      ]
    },
    {
      "famille2": 2045,
      "libelle": "6 GRIFFES",
      "parents": [
        1018
      ]
    },
    {
      "famille2": 2046,
      "libelle": "2 GRIFFES",
      "parents": [
        1018
      ]
    },
    {
      "famille2": 2047,
      "libelle": "3 GRIFFES",
      "parents": [
        1018
      ]
    },
    {
      "famille2": 2048,
      "libelle": "BAS",
      "parents": [
        1019
      ]
    },
    {
      "famille2": 2049,
      "libelle": "HAUT",
      "parents": [
        1019
      ]
    },
    {
      "famille2": 2050,
      "libelle": "SOLITAIRE",
      "parents": [
        1020
      ]
    },
    {
      "famille2": 2051,
      "libelle": "SOLITAIRE ACCOMPAGNE",
      "parents": [
        1020
      ]
    },
    {
      "famille2": 2052,
      "libelle": "CLIP POUR BROCHE",
      "parents": [
        1021
      ]
    },
    {
      "famille2": 2053,
      "libelle": "CROCHET POUR BROCHE",
      "parents": [
        1021
      ]
    },
    {
      "famille2": 2054,
      "libelle": "FORCAT DIAMANTEE",
      "parents": [
        1022,
        1024
      ]
    },
    {
      "famille2": 2055,
      "libelle": "GOURMETTE DIAMANTEE",
      "parents": [
        1022,
        1024
      ]
    },
    {
      "famille2": 2056,
      "libelle": "FORCAT RONDE",
      "parents": [
        1022,
        1024
      ]
    },
    {
      "famille2": 2057,
      "libelle": "ALTERNEE 1 - 1",
      "parents": [
        1022,
        1024,
        1028
      ]
    },
    {
      "famille2": 2058,
      "libelle": "ALTERNEE 1 - 3",
      "parents": [
        1022,
        1024,
        1028
      ]
    },
    {
      "famille2": 2059,
      "libelle": "FORCAT MARINE",
      "parents": [
        1022,
        1024,
        1028
      ]
    },
    {
      "famille2": 2060,
      "libelle": "MARINE BATTUE",
      "parents": [
        1022,
        1024,
        1028
      ]
    },
    {
      "famille2": 2061,
      "libelle": "CHEVAL 4 FACES",
      "parents": [
        1022
      ]
    },
    {
      "famille2": 2062,
      "libelle": "JASERON",
      "parents": [
        1022,
        1028
      ]
    },
    {
      "famille2": 2063,
      "libelle": "SERPENT",
      "parents": [
        1022,
        1024
      ]
    },
    {
      "famille2": 2064,
      "libelle": "VENITIENNE",
      "parents": [
        1022
      ]
    },
    {
      "famille2": 2065,
      "libelle": "PRESTIGE",
      "parents": [
        1013
      ]
    },
    {
      "famille2": 2066,
      "libelle": "JONC FIL DEMI JONC",
      "parents": [
        1025
      ]
    },
    {
      "famille2": 2067,
      "libelle": "JONC FIL ROND",
      "parents": [
        1025
      ]
    },
    {
      "famille2": 2068,
      "libelle": "MAILLE GOURMETTE",
      "parents": [
        1026
      ]
    },
    {
      "famille2": 2069,
      "libelle": "MAILLE JASERON",
      "parents": [
        1026
      ]
    },
    {
      "famille2": 2070,
      "libelle": "MAILLE PALMIER",
      "parents": [
        1026
      ]
    },
    {
      "famille2": 2071,
      "libelle": "MAILLE ALTERNEE",
      "parents": [
        1026
      ]
    },
    {
      "famille2": 2072,
      "libelle": "MAILLE AMERICAINE",
      "parents": [
        1026
      ]
    },
    {
      "famille2": 2073,
      "libelle": "MAILLE FORCAT DOUBLE",
      "parents": [
        1026
      ]
    },
    {
      "famille2": 2074,
      "libelle": "LISSES",
      "parents": [
        1027
      ]
    },
    {
      "famille2": 2075,
      "libelle": "TORSADEES",
      "parents": [
        1027
      ]
    },
    {
      "famille2": 2076,
      "libelle": "ALTERNEE 1 - 3 LARGE",
      "parents": [
        1028
      ]
    },
    {
      "famille2": 2077,
      "libelle": "FORCAT CLAIRE",
      "parents": [
        1028
      ]
    },
    {
      "famille2": 2078,
      "libelle": "GOURMETTE",
      "parents": [
        1028
      ]
    },
    {
      "famille2": 2079,
      "libelle": "BISMARK",
      "parents": [
        1028
      ]
    },
    {
      "famille2": 2101,
      "libelle": "",
      "parents": [
        1004,
        1005
      ]
    }
  ],
  "famille3": [
    {
      "id": 3001,
      "libelle": "",
      "famille_id": 2001,
      "photo_id": 1
    },
    {
      "id": 3002,
      "libelle": "",
      "famille_id": 2001,
      "photo_id": 2
    },
    {
      "id": 3003,
      "libelle": "",
      "famille_id": 2002,
      "photo_id": 3
    },
    {
      "id": 3004,
      "libelle": "",
      "famille_id": 2003,
      "photo_id": 4
    },
    {
      "id": 3005,
      "libelle": "",
      "famille_id": 2004,
      "photo_id": 5
    },
    {
      "id": 3006,
      "libelle": "",
      "famille_id": 2005,
      "photo_id": 6
    },
    {
      "id": 3007,
      "libelle": "",
      "famille_id": 2101,
      "photo_id": 7
    },
    {
      "id": 3008,
      "libelle": "",
      "famille_id": 2101,
      "photo_id": 8
    },
    {
      "id": 3009,
      "libelle": "",
      "famille_id": 2006,
      "photo_id": 9
    },
    {
      "id": 3010,
      "libelle": "",
      "famille_id": 2007,
      "photo_id": 9
    },
    {
      "id": 3011,
      "libelle": "FAIBLE",
      "famille_id": 2008,
      "photo_id": 10
    },
    {
      "id": 3012,
      "libelle": "FORTE",
      "famille_id": 2008,
      "photo_id": 10
    },
    {
      "id": 3013,
      "libelle": "MOYENNE",
      "famille_id": 2008,
      "photo_id": 10
    },
    {
      "id": 3014,
      "libelle": "TRES FAIBLE",
      "famille_id": 2008,
      "photo_id": 10
    },
    {
      "id": 3015,
      "libelle": "ROSE",
      "famille_id": 2012,
      "photo_id": 11
    },
    {
      "id": 3016,
      "libelle": "ROUGE",
      "famille_id": 2012,
      "photo_id": 11
    },
    {
      "id": 3017,
      "libelle": "VIOLETTE",
      "famille_id": 2012,
      "photo_id": 11
    },
    {
      "id": 3018,
      "libelle": "FAIBLE",
      "famille_id": 2013,
      "photo_id": 11
    },
    {
      "id": 3019,
      "libelle": "FORTE",
      "famille_id": 2013,
      "photo_id": 11
    },
    {
      "id": 3020,
      "libelle": "",
      "famille_id": 2014,
      "photo_id": 11
    },
    {
      "id": 3021,
      "libelle": "",
      "famille_id": 2015,
      "photo_id": 11
    },
    {
      "id": 3022,
      "libelle": "",
      "famille_id": 2016,
      "photo_id": 99
    },
    {
      "id": 3023,
      "libelle": "",
      "famille_id": 2017,
      "photo_id": 99
    },
    {
      "id": 3024,
      "libelle": "",
      "famille_id": 2018,
      "photo_id": 12
    },
    {
      "id": 3025,
      "libelle": "DOUBLE",
      "famille_id": 2019,
      "photo_id": 12
    },
    {
      "id": 3026,
      "libelle": "SIMPLE",
      "famille_id": 2019,
      "photo_id": 12
    },
    {
      "id": 3027,
      "libelle": "",
      "famille_id": 2020,
      "photo_id": 99
    },
    {
      "id": 3028,
      "libelle": "",
      "famille_id": 2021,
      "photo_id": 99
    },
    {
      "id": 3029,
      "libelle": "",
      "famille_id": 2022,
      "photo_id": 13
    },
    {
      "id": 3030,
      "libelle": "",
      "famille_id": 2023,
      "photo_id": 13
    },
    {
      "id": 3031,
      "libelle": "",
      "famille_id": 2024,
      "photo_id": 14
    },
    {
      "id": 3032,
      "libelle": "",
      "famille_id": 2025,
      "photo_id": 99
    },
    {
      "id": 3033,
      "libelle": "",
      "famille_id": 2022,
      "photo_id": 15
    },
    {
      "id": 3034,
      "libelle": "",
      "famille_id": 2024,
      "photo_id": 15
    },
    {
      "id": 3035,
      "libelle": "",
      "famille_id": 2026,
      "photo_id": 15
    },
    {
      "id": 3036,
      "libelle": "BOMBE ANNEAU LIBRE",
      "famille_id": 2027,
      "photo_id": 16
    },
    {
      "id": 3037,
      "libelle": "BOMBE ANNEAU FIXE",
      "famille_id": 2027,
      "photo_id": 99
    },
    {
      "id": 3038,
      "libelle": "PLAT AVEC ANNEAU",
      "famille_id": 2027,
      "photo_id": 99
    },
    {
      "id": 3039,
      "libelle": "AVEC EMBOUT",
      "famille_id": 2028,
      "photo_id": 17
    },
    {
      "id": 3040,
      "libelle": "AVEC ANNEAU",
      "famille_id": 2028,
      "photo_id": 99
    },
    {
      "id": 3041,
      "libelle": "LEGER",
      "famille_id": 2029,
      "photo_id": 18
    },
    {
      "id": 3042,
      "libelle": "STANDARD",
      "famille_id": 2029,
      "photo_id": 18
    },
    {
      "id": 3043,
      "libelle": "BOULE",
      "famille_id": 2030,
      "photo_id": 19
    },
    {
      "id": 3044,
      "libelle": "OLIVE",
      "famille_id": 2030,
      "photo_id": 20
    },
    {
      "id": 3045,
      "libelle": "CLIQUET",
      "famille_id": 2065,
      "photo_id": 71
    },
    {
      "id": 3046,
      "libelle": "CYLINDRIQUES LISSES",
      "famille_id": 2065,
      "photo_id": 72
    },
    {
      "id": 3047,
      "libelle": "NAVETTE",
      "famille_id": 2065,
      "photo_id": 73
    },
    {
      "id": 3048,
      "libelle": "MOUSQUETON CLASSIQUE",
      "famille_id": 2065,
      "photo_id": 74
    },
    {
      "id": 3049,
      "libelle": "MOUSQUETON ROND",
      "famille_id": 2065,
      "photo_id": 75
    },
    {
      "id": 3050,
      "libelle": "MOUSQUETON BAGUE",
      "famille_id": 2065,
      "photo_id": 76
    },
    {
      "id": 3051,
      "libelle": "MOUSQUETON BAGUE ANN",
      "famille_id": 2065,
      "photo_id": 77
    },
    {
      "id": 3052,
      "libelle": "MOUSQUETON ANNEAU TO",
      "famille_id": 2065,
      "photo_id": 78
    },
    {
      "id": 3053,
      "libelle": "MOUSQUETON EN HUIT",
      "famille_id": 2065,
      "photo_id": 79
    },
    {
      "id": 3054,
      "libelle": "MOUSQUETON TORSADE",
      "famille_id": 2065,
      "photo_id": 80
    },
    {
      "id": 3055,
      "libelle": "CHAINETTE COLLIER",
      "famille_id": 2031,
      "photo_id": 21
    },
    {
      "id": 3056,
      "libelle": "HUIT DE SECURITE",
      "famille_id": 2031,
      "photo_id": 22
    },
    {
      "id": 3057,
      "libelle": "CHAINETTE BRACELET",
      "famille_id": 2031,
      "photo_id": 99
    },
    {
      "id": 3058,
      "libelle": "",
      "famille_id": 2032,
      "photo_id": 99
    },
    {
      "id": 3059,
      "libelle": "FIL DEMI-JONC",
      "famille_id": 2033,
      "photo_id": 23
    },
    {
      "id": 3060,
      "libelle": "TRIANGLE FANTAISIE",
      "famille_id": 2033,
      "photo_id": 24
    },
    {
      "id": 3061,
      "libelle": "TRIANGLE FONTE",
      "famille_id": 2033,
      "photo_id": 25
    },
    {
      "id": 3062,
      "libelle": "TRIANGLE LISSE",
      "famille_id": 2033,
      "photo_id": 26
    },
    {
      "id": 3063,
      "libelle": "",
      "famille_id": 2034,
      "photo_id": 27
    },
    {
      "id": 3064,
      "libelle": "",
      "famille_id": 2035,
      "photo_id": 28
    },
    {
      "id": 3065,
      "libelle": "BOULE ET ANNEAU",
      "famille_id": 2036,
      "photo_id": 29
    },
    {
      "id": 3066,
      "libelle": "BOULE",
      "famille_id": 2036,
      "photo_id": 30
    },
    {
      "id": 3067,
      "libelle": "COUPELLE",
      "famille_id": 2036,
      "photo_id": 31
    },
    {
      "id": 3068,
      "libelle": "COMPLET",
      "famille_id": 2037,
      "photo_id": 32
    },
    {
      "id": 3069,
      "libelle": "SANS TIGE",
      "famille_id": 2037,
      "photo_id": 33
    },
    {
      "id": 3070,
      "libelle": "TIGE SEULE",
      "famille_id": 2037,
      "photo_id": 34
    },
    {
      "id": 3071,
      "libelle": "TIGE SEULE",
      "famille_id": 2038,
      "photo_id": 34
    },
    {
      "id": 3072,
      "libelle": "COMPLET",
      "famille_id": 2038,
      "photo_id": 35
    },
    {
      "id": 3073,
      "libelle": "SANS TIGE",
      "famille_id": 2038,
      "photo_id": 36
    },
    {
      "id": 3074,
      "libelle": "",
      "famille_id": 2039,
      "photo_id": 37
    },
    {
      "id": 3075,
      "libelle": "AVEC ANNEAU",
      "famille_id": 2040,
      "photo_id": 38
    },
    {
      "id": 3076,
      "libelle": "FLEUR DE LYS",
      "famille_id": 2040,
      "photo_id": 39
    },
    {
      "id": 3077,
      "libelle": "SANS ANNEAU",
      "famille_id": 2040,
      "photo_id": 40
    },
    {
      "id": 3078,
      "libelle": "FIL",
      "famille_id": 2041,
      "photo_id": 41
    },
    {
      "id": 3079,
      "libelle": "FIL FERME",
      "famille_id": 2041,
      "photo_id": 42
    },
    {
      "id": 3080,
      "libelle": "FONTE ANNEAU FACE",
      "famille_id": 2041,
      "photo_id": 43
    },
    {
      "id": 3081,
      "libelle": "FONTE",
      "famille_id": 2041,
      "photo_id": 44
    },
    {
      "id": 3082,
      "libelle": "",
      "famille_id": 2042,
      "photo_id": 45
    },
    {
      "id": 3083,
      "libelle": "",
      "famille_id": 2043,
      "photo_id": 46
    },
    {
      "id": 3084,
      "libelle": "DOUBLE ANNEAU",
      "famille_id": 2044,
      "photo_id": 47
    },
    {
      "id": 3085,
      "libelle": "ESTAMPE",
      "famille_id": 2044,
      "photo_id": 48
    },
    {
      "id": 3086,
      "libelle": "TOUR",
      "famille_id": 2044,
      "photo_id": 49
    },
    {
      "id": 3087,
      "libelle": "PRINCESSE",
      "famille_id": 2044,
      "photo_id": 54
    },
    {
      "id": 3088,
      "libelle": "CALICE",
      "famille_id": 2045,
      "photo_id": 50
    },
    {
      "id": 3089,
      "libelle": "ESTAMPE",
      "famille_id": 2045,
      "photo_id": 51
    },
    {
      "id": 3090,
      "libelle": "NAVETTE",
      "famille_id": 2046,
      "photo_id": 52
    },
    {
      "id": 3091,
      "libelle": "GOUTTE",
      "famille_id": 2047,
      "photo_id": 53
    },
    {
      "id": 3092,
      "libelle": "",
      "famille_id": 2048,
      "photo_id": 55
    },
    {
      "id": 3093,
      "libelle": "",
      "famille_id": 2049,
      "photo_id": 56
    },
    {
      "id": 3094,
      "libelle": "6 GRIFFES",
      "famille_id": 2050,
      "photo_id": 57
    },
    {
      "id": 3095,
      "libelle": "4 GRIFFES",
      "famille_id": 2050,
      "photo_id": 99
    },
    {
      "id": 3096,
      "libelle": "4 GRIFFES",
      "famille_id": 2051,
      "photo_id": 58
    },
    {
      "id": 3097,
      "libelle": "ZOP SIMPLE",
      "famille_id": 2052,
      "photo_id": 59
    },
    {
      "id": 3098,
      "libelle": "",
      "famille_id": 2053,
      "photo_id": 60
    },
    {
      "id": 3099,
      "libelle": "",
      "famille_id": 2054,
      "photo_id": 61
    },
    {
      "id": 3100,
      "libelle": "",
      "famille_id": 2055,
      "photo_id": 62
    },
    {
      "id": 3101,
      "libelle": "",
      "famille_id": 2056,
      "photo_id": 63
    },
    {
      "id": 3102,
      "libelle": "",
      "famille_id": 2057,
      "photo_id": 64
    },
    {
      "id": 3103,
      "libelle": "",
      "famille_id": 2058,
      "photo_id": 99
    },
    {
      "id": 3104,
      "libelle": "",
      "famille_id": 2059,
      "photo_id": 65
    },
    {
      "id": 3105,
      "libelle": "",
      "famille_id": 2060,
      "photo_id": 66
    },
    {
      "id": 3106,
      "libelle": "",
      "famille_id": 2061,
      "photo_id": 67
    },
    {
      "id": 3107,
      "libelle": "",
      "famille_id": 2062,
      "photo_id": 68
    },
    {
      "id": 3108,
      "libelle": "",
      "famille_id": 2063,
      "photo_id": 69
    },
    {
      "id": 3109,
      "libelle": "",
      "famille_id": 2064,
      "photo_id": 70
    },
    {
      "id": 3110,
      "libelle": "",
      "famille_id": 2054,
      "photo_id": 61
    },
    {
      "id": 3111,
      "libelle": "",
      "famille_id": 2055,
      "photo_id": 62
    },
    {
      "id": 3112,
      "libelle": "",
      "famille_id": 2056,
      "photo_id": 63
    },
    {
      "id": 3113,
      "libelle": "",
      "famille_id": 2057,
      "photo_id": 64
    },
    {
      "id": 3114,
      "libelle": "",
      "famille_id": 2058,
      "photo_id": 99
    },
    {
      "id": 3115,
      "libelle": "",
      "famille_id": 2059,
      "photo_id": 65
    },
    {
      "id": 3116,
      "libelle": "",
      "famille_id": 2060,
      "photo_id": 66
    },
    {
      "id": 3117,
      "libelle": "",
      "famille_id": 2063,
      "photo_id": 69
    },
    {
      "id": 3118,
      "libelle": "",
      "famille_id": 2066,
      "photo_id": 81
    },
    {
      "id": 3119,
      "libelle": "",
      "famille_id": 2067,
      "photo_id": 82
    },
    {
      "id": 3120,
      "libelle": "",
      "famille_id": 2068,
      "photo_id": 83
    },
    {
      "id": 3121,
      "libelle": "",
      "famille_id": 2069,
      "photo_id": 84
    },
    {
      "id": 3122,
      "libelle": "",
      "famille_id": 2070,
      "photo_id": 85
    },
    {
      "id": 3123,
      "libelle": "",
      "famille_id": 2071,
      "photo_id": 86
    },
    {
      "id": 3124,
      "libelle": "",
      "famille_id": 2072,
      "photo_id": 87
    },
    {
      "id": 3125,
      "libelle": "",
      "famille_id": 2073,
      "photo_id": 88
    },
    {
      "id": 3126,
      "libelle": "",
      "famille_id": 2074,
      "photo_id": 89
    },
    {
      "id": 3127,
      "libelle": "",
      "famille_id": 2075,
      "photo_id": 99
    },
    {
      "id": 3128,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2057,
      "photo_id": 90
    },
    {
      "id": 3129,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2057,
      "photo_id": 90
    },
    {
      "id": 3130,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2058,
      "photo_id": 91
    },
    {
      "id": 3131,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2058,
      "photo_id": 92
    },
    {
      "id": 3132,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2059,
      "photo_id": 96
    },
    {
      "id": 3133,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2059,
      "photo_id": 96
    },
    {
      "id": 3134,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2060,
      "photo_id": 99
    },
    {
      "id": 3135,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2060,
      "photo_id": 99
    },
    {
      "id": 3136,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2062,
      "photo_id": 97
    },
    {
      "id": 3137,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2062,
      "photo_id": 97
    },
    {
      "id": 3138,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2076,
      "photo_id": 91
    },
    {
      "id": 3139,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2076,
      "photo_id": 92
    },
    {
      "id": 3140,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2077,
      "photo_id": 93
    },
    {
      "id": 3141,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2077,
      "photo_id": 93
    },
    {
      "id": 3142,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2078,
      "photo_id": 94
    },
    {
      "id": 3143,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2078,
      "photo_id": 94
    },
    {
      "id": 3144,
      "libelle": "PLAQUE OVALE",
      "famille_id": 2079,
      "photo_id": 95
    },
    {
      "id": 3145,
      "libelle": "PLAQUE RECTANGLE",
      "famille_id": 2079,
      "photo_id": 95
    }
  ],
  "metal": [
    {
      "id": 1,
      "libelle": "OR"
    },
    {
      "id": 2,
      "libelle": "ARGENT"
    },
    {
      "id": 3,
      "libelle": "PLATINE"
    },
    {
      "id": 4,
      "libelle": "PALLADIUM"
    },
    {
      "id": 5,
      "libelle": "RHODIUM"
    },
    {
      "id": 9,
      "libelle": "NON PRECIEUX"
    }
  ],
  "alliage": [
    {
      "id": 15,
      "libelle": "ARGENT 545 ./.. "
    },
    {
      "id": 151,
      "libelle": "ARGENT 600 ./.. "
    },
    {
      "id": 16,
      "libelle": "ARGENT 635 ./.. "
    },
    {
      "id": 5,
      "libelle": "ARGENT 650 ./.. "
    },
    {
      "id": 6,
      "libelle": "ARGENT 670 ./.. "
    },
    {
      "id": 17,
      "libelle": "ARGENT 805 ./.. "
    },
    {
      "id": 31,
      "libelle": "ARGENT 925 ./.. "
    },
    {
      "id": 52,
      "libelle": "ARGENT 930 ./.. "
    },
    {
      "id": 74,
      "libelle": "ARGENT 950 ./.. "
    },
    {
      "id": 53,
      "libelle": "ARGENT 955 ./.. "
    },
    {
      "id": 75,
      "libelle": "ARGENT 960 ./.. "
    },
    {
      "id": 54,
      "libelle": "ARGENT 965 ./.. "
    },
    {
      "id": 33,
      "libelle": "ARGENT 1000 ./.. "
    },
    {
      "id": 159,
      "libelle": "NON PRECIEUX 0.0 ./.. "
    },
    {
      "id": 18,
      "libelle": "OR 0.3 ./.. ROUGE 5N"
    },
    {
      "id": 19,
      "libelle": "OR 0.8 ./.. JAUNE 2N"
    },
    {
      "id": 166,
      "libelle": "OR 0.8 ./.. JAUNE 3N"
    },
    {
      "id": 167,
      "libelle": "OR 0.8 ./.. ROSE 4N"
    },
    {
      "id": 20,
      "libelle": "OR 1.0 ./.. JAUNE 2N"
    },
    {
      "id": 168,
      "libelle": "OR 1.0 ./.. JAUNE 3N"
    },
    {
      "id": 169,
      "libelle": "OR 1.0 ./.. ROSE 4N"
    },
    {
      "id": 21,
      "libelle": "OR 4 ./.. JAUNE 3N"
    },
    {
      "id": 8,
      "libelle": "OR 375 ./.. GRIS STANDARD"
    },
    {
      "id": 9,
      "libelle": "OR 375 ./.. JAUNE"
    },
    {
      "id": 65,
      "libelle": "OR 376 ./.. GRIS STANDARD"
    },
    {
      "id": 63,
      "libelle": "OR 376 ./.. JAUNE"
    },
    {
      "id": 64,
      "libelle": "OR 376 ./.. ROSE"
    },
    {
      "id": 22,
      "libelle": "OR 500 ./.. "
    },
    {
      "id": 23,
      "libelle": "OR 579 ./.. "
    },
    {
      "id": 24,
      "libelle": "OR 683 ./.. "
    },
    {
      "id": 160,
      "libelle": "OR 750 ./.. GRIS PD 12%"
    },
    {
      "id": 27,
      "libelle": "OR 750 ./.. GRIS PD 13%"
    },
    {
      "id": 4,
      "libelle": "OR 750 ./.. GRIS STANDARD"
    },
    {
      "id": 2,
      "libelle": "OR 750 ./.. JAUNE"
    },
    {
      "id": 3,
      "libelle": "OR 750 ./.. ROSE"
    },
    {
      "id": 86,
      "libelle": "OR 751 ./.. GRIS PD 12%"
    },
    {
      "id": 43,
      "libelle": "OR 751 ./.. GRIS PD 13%"
    },
    {
      "id": 11,
      "libelle": "OR 751 ./.. GRIS PD 5%"
    },
    {
      "id": 42,
      "libelle": "OR 751 ./.. GRIS STANDARD"
    },
    {
      "id": 10,
      "libelle": "OR 751 ./.. GRIS STANDARD"
    },
    {
      "id": 38,
      "libelle": "OR 751 ./.. JAUNE 2N"
    },
    {
      "id": 37,
      "libelle": "OR 751 ./.. JAUNE 3N"
    },
    {
      "id": 12,
      "libelle": "OR 751 ./.. JAUNE 3N"
    },
    {
      "id": 13,
      "libelle": "OR 751 ./.. ROSE 4N"
    },
    {
      "id": 39,
      "libelle": "OR 751 ./.. ROSE 4N"
    },
    {
      "id": 14,
      "libelle": "OR 751 ./.. ROUGE 5N"
    },
    {
      "id": 40,
      "libelle": "OR 751 ./.. ROUGE 5N"
    },
    {
      "id": 41,
      "libelle": "OR 751 ./.. ROUGE 6N"
    },
    {
      "id": 72,
      "libelle": "OR 752 ./.. GRIS PD 13%"
    },
    {
      "id": 71,
      "libelle": "OR 752 ./.. GRIS STANDARD"
    },
    {
      "id": 67,
      "libelle": "OR 752 ./.. JAUNE 2N"
    },
    {
      "id": 66,
      "libelle": "OR 752 ./.. JAUNE 3N"
    },
    {
      "id": 68,
      "libelle": "OR 752 ./.. ROSE 4N"
    },
    {
      "id": 69,
      "libelle": "OR 752 ./.. ROUGE 5N"
    },
    {
      "id": 70,
      "libelle": "OR 752 ./.. ROUGE 6N"
    },
    {
      "id": 50,
      "libelle": "OR 754 ./.. GRIS PD 13%"
    },
    {
      "id": 51,
      "libelle": "OR 754 ./.. GRIS PD 15%"
    },
    {
      "id": 49,
      "libelle": "OR 754 ./.. GRIS STANDARD"
    },
    {
      "id": 45,
      "libelle": "OR 754 ./.. JAUNE 2N"
    },
    {
      "id": 44,
      "libelle": "OR 754 ./.. JAUNE 3N"
    },
    {
      "id": 46,
      "libelle": "OR 754 ./.. ROSE 4N"
    },
    {
      "id": 47,
      "libelle": "OR 754 ./.. ROUGE 5N"
    },
    {
      "id": 48,
      "libelle": "OR 754 ./.. ROUGE 6N"
    },
    {
      "id": 34,
      "libelle": "OR 1000 ./.. "
    },
    {
      "id": 25,
      "libelle": "PALLADIUM 100 ./.. "
    },
    {
      "id": 35,
      "libelle": "PALLADIUM 1000 ./.. "
    },
    {
      "id": 7,
      "libelle": "PLATINE 0.0 ./.. "
    },
    {
      "id": 153,
      "libelle": "PLATINE 1.0 ./.. "
    },
    {
      "id": 154,
      "libelle": "PLATINE 51 ./.. "
    },
    {
      "id": 152,
      "libelle": "PLATINE 55 ./.. "
    },
    {
      "id": 77,
      "libelle": "PLATINE 953 ./.. "
    },
    {
      "id": 78,
      "libelle": "PLATINE 955 ./.. "
    },
    {
      "id": 55,
      "libelle": "PLATINE 956 ./.. "
    },
    {
      "id": 36,
      "libelle": "PLATINE 1000 ./.. "
    },
    {
      "id": 163,
      "libelle": "RHODIUM 2 ./.. BLANC"
    },
    {
      "id": 157,
      "libelle": "RHODUM 20 ./.. BLANC"
    },
    {
      "id": 158,
      "libelle": "RHODUM 20 ./.. NOIR"
    }
  ],
  "etat": [
    {
      "id": 1,
      "libelle": "RECUIT"
    },
    {
      "id": 2,
      "libelle": "ECROUI"
    }
  ],
  "complement": [
    {
      "id": 1,
      "libelle": "LARGEUR SPECIALE",
      "mini": "1.00",
      "maxi": "99.00",
      "pas": "1.00"
    },
    {
      "id": 6,
      "libelle": "EN SPIRE RONDE",
      "mini": "40.00",
      "maxi": "70.00",
      "pas": "2.00"
    }
  ],
  "modefacturation": [
    {
      "id": 27,
      "libelle_long": "FACON GRAMME",
      "libelle_court": "€/g"
    },
    {
      "id": 17,
      "libelle_long": "FACON PIECE",
      "libelle_court": "€/p"
    },
    {
      "id": 19,
      "libelle_long": "PRIX FORFAIT",
      "libelle_court": "€"
    },
    {
      "id": 20,
      "libelle_long": "PRIX AU GRAMME",
      "libelle_court": "€/g"
    },
    {
      "id": 50,
      "libelle_long": "FACON KILOGRAMME",
      "libelle_court": "€/kg"
    }
  ],
  "photo": [
    {
      "id": 1,
      "url": "http://mysaamp.com/myapi/images/grenamo0.gif"
    },
    {
      "id": 2,
      "url": "http://mysaamp.com/myapi/images/grefon.gif"
    },
    {
      "id": 3,
      "url": "http://mysaamp.com/myapi/images/fir.gif"
    },
    {
      "id": 4,
      "url": "http://mysaamp.com/myapi/images/fj.gif"
    },
    {
      "id": 5,
      "url": "http://mysaamp.com/myapi/images/fic.gif"
    },
    {
      "id": 6,
      "url": "http://mysaamp.com/myapi/images/fire.gif"
    },
    {
      "id": 7,
      "url": "http://mysaamp.com/myapi/images/pla.gif"
    },
    {
      "id": 8,
      "url": "http://mysaamp.com/myapi/images/tube.gif"
    },
    {
      "id": 9,
      "url": "http://mysaamp.com/myapi/images/plAuCu.gif"
    },
    {
      "id": 10,
      "url": "http://mysaamp.com/myapi/images/brasures.gif"
    },
    {
      "id": 11,
      "url": "http://mysaamp.com/myapi/images/sering.gif"
    },
    {
      "id": 12,
      "url": "http://mysaamp.com/myapi/images/sels.gif"
    },
    {
      "id": 13,
      "url": "http://mysaamp.com/myapi/images/gbdo.gif"
    },
    {
      "id": 14,
      "url": "http://mysaamp.com/myapi/images/gbrho.gif"
    },
    {
      "id": 15,
      "url": "http://mysaamp.com/myapi/images/gsdo.gif"
    },
    {
      "id": 16,
      "url": "http://mysaamp.com/myapi/images/mb07al.gif"
    },
    {
      "id": 17,
      "url": "http://mysaamp.com/myapi/images/am11clj3.gif"
    },
    {
      "id": 18,
      "url": "http://mysaamp.com/myapi/images/ar5osj3.gif"
    },
    {
      "id": 19,
      "url": "http://mysaamp.com/myapi/images/fimb07J3.gif"
    },
    {
      "id": 20,
      "url": "http://mysaamp.com/myapi/images/fimv05J3.gif"
    },
    {
      "id": 21,
      "url": "http://mysaamp.com/myapi/images/surcol.gif"
    },
    {
      "id": 22,
      "url": "http://mysaamp.com/myapi/images/surhui.gif"
    },
    {
      "id": 23,
      "url": "http://mysaamp.com/myapi/images/BDJ1,507J3.gif"
    },
    {
      "id": 24,
      "url": "http://mysaamp.com/myapi/images/bel163J3.gif"
    },
    {
      "id": 25,
      "url": "http://mysaamp.com/myapi/images/BEL169J3.gif"
    },
    {
      "id": 26,
      "url": "http://mysaamp.com/myapi/images/bel162J3.gif"
    },
    {
      "id": 27,
      "url": "http://mysaamp.com/myapi/images/pbpmj3.gif"
    },
    {
      "id": 28,
      "url": "http://mysaamp.com/myapi/images/ti10pm.gif"
    },
    {
      "id": 29,
      "url": "http://mysaamp.com/myapi/images/tiba.gif"
    },
    {
      "id": 30,
      "url": "http://mysaamp.com/myapi/images/tibl.gif"
    },
    {
      "id": 31,
      "url": "http://mysaamp.com/myapi/images/tica03.gif"
    },
    {
      "id": 32,
      "url": "http://mysaamp.com/myapi/images/guacpm.gif"
    },
    {
      "id": 33,
      "url": "http://mysaamp.com/myapi/images/gustpm.gif"
    },
    {
      "id": 34,
      "url": "http://mysaamp.com/myapi/images/tigu10j3.gif"
    },
    {
      "id": 35,
      "url": "http://mysaamp.com/myapi/images/coscpm.gif"
    },
    {
      "id": 36,
      "url": "http://mysaamp.com/myapi/images/cosgm.gif"
    },
    {
      "id": 37,
      "url": "http://mysaamp.com/myapi/images/bascgmj3.gif"
    },
    {
      "id": 38,
      "url": "http://mysaamp.com/myapi/images/dora01.gif"
    },
    {
      "id": 39,
      "url": "http://mysaamp.com/myapi/images/drmf01.gif"
    },
    {
      "id": 40,
      "url": "http://mysaamp.com/myapi/images/dors01.gif"
    },
    {
      "id": 41,
      "url": "http://mysaamp.com/myapi/images/hookw1.gif"
    },
    {
      "id": 42,
      "url": "http://mysaamp.com/myapi/images/hookw3.gif"
    },
    {
      "id": 43,
      "url": "http://mysaamp.com/myapi/images/hookc2.gif"
    },
    {
      "id": 44,
      "url": "http://mysaamp.com/myapi/images/hookc1.gif"
    },
    {
      "id": 45,
      "url": "http://mysaamp.com/myapi/images/b05n2dj3.gif"
    },
    {
      "id": 46,
      "url": "http://mysaamp.com/myapi/images/b03n2lj3.gif"
    },
    {
      "id": 47,
      "url": "http://mysaamp.com/myapi/images/ct4130j308.gif"
    },
    {
      "id": 48,
      "url": "http://mysaamp.com/myapi/images/ct4120j303.gif"
    },
    {
      "id": 49,
      "url": "http://mysaamp.com/myapi/images/ct40810.gif"
    },
    {
      "id": 50,
      "url": "http://mysaamp.com/myapi/images/ct6550j325.gif"
    },
    {
      "id": 51,
      "url": "http://mysaamp.com/myapi/images/ct6110j310.gif"
    },
    {
      "id": 52,
      "url": "http://mysaamp.com/myapi/images/ct2131j3.gif"
    },
    {
      "id": 53,
      "url": "http://mysaamp.com/myapi/images/ct3361j3.gif"
    },
    {
      "id": 54,
      "url": "http://mysaamp.com/myapi/images/ct4670j310.gif"
    },
    {
      "id": 55,
      "url": "http://mysaamp.com/myapi/images/clo342.gif"
    },
    {
      "id": 56,
      "url": "http://mysaamp.com/myapi/images/clo352.gif"
    },
    {
      "id": 57,
      "url": "http://mysaamp.com/myapi/images/RO4251J3.gif"
    },
    {
      "id": 58,
      "url": "http://mysaamp.com/myapi/images/gaj3.gif"
    },
    {
      "id": 59,
      "url": "http://mysaamp.com/myapi/images/clizop.gif"
    },
    {
      "id": 60,
      "url": "http://mysaamp.com/myapi/images/crp.gif"
    },
    {
      "id": 61,
      "url": "http://mysaamp.com/myapi/images/fdi030mdj.gif"
    },
    {
      "id": 62,
      "url": "http://mysaamp.com/myapi/images/gdi025mdj.gif"
    },
    {
      "id": 63,
      "url": "http://mysaamp.com/myapi/images/fro025mdj.gif"
    },
    {
      "id": 64,
      "url": "http://mysaamp.com/myapi/images/ca1035mj3.gif"
    },
    {
      "id": 65,
      "url": "http://mysaamp.com/myapi/images/mfo040mdj.gif"
    },
    {
      "id": 66,
      "url": "http://mysaamp.com/myapi/images/mba030mj3.gif"
    },
    {
      "id": 67,
      "url": "http://mysaamp.com/myapi/images/c4f.gif"
    },
    {
      "id": 68,
      "url": "http://mysaamp.com/myapi/images/jas045mj3.gif"
    },
    {
      "id": 69,
      "url": "http://mysaamp.com/myapi/images/ser020mdj.gif"
    },
    {
      "id": 70,
      "url": "http://mysaamp.com/myapi/images/ven009mdj.gif"
    },
    {
      "id": 71,
      "url": "http://mysaamp.com/myapi/images/hjcli3.gif"
    },
    {
      "id": 72,
      "url": "http://mysaamp.com/myapi/images/hjcy1.gif"
    },
    {
      "id": 73,
      "url": "http://mysaamp.com/myapi/images/hjn132.gif"
    },
    {
      "id": 74,
      "url": "http://mysaamp.com/myapi/images/hjm270.gif"
    },
    {
      "id": 75,
      "url": "http://mysaamp.com/myapi/images/hjm330.gif"
    },
    {
      "id": 76,
      "url": "http://mysaamp.com/myapi/images/hjm540.gif"
    },
    {
      "id": 77,
      "url": "http://mysaamp.com/myapi/images/hjm640.gif"
    },
    {
      "id": 78,
      "url": "http://mysaamp.com/myapi/images/hjtwi.gif"
    },
    {
      "id": 79,
      "url": "http://mysaamp.com/myapi/images/hjm410.gif"
    },
    {
      "id": 80,
      "url": "http://mysaamp.com/myapi/images/hjm710.gif"
    },
    {
      "id": 81,
      "url": "http://mysaamp.com/myapi/images/jmedj20.gif"
    },
    {
      "id": 82,
      "url": "http://mysaamp.com/myapi/images/jmer20.gif"
    },
    {
      "id": 83,
      "url": "http://mysaamp.com/myapi/images/bgou06cdj.gif"
    },
    {
      "id": 84,
      "url": "http://mysaamp.com/myapi/images/bjas05cdj.gif"
    },
    {
      "id": 85,
      "url": "http://mysaamp.com/myapi/images/bpalcdj.gif"
    },
    {
      "id": 86,
      "url": "http://mysaamp.com/myapi/images/balt12cdj.gif"
    },
    {
      "id": 87,
      "url": "http://mysaamp.com/myapi/images/bame16cdj.gif"
    },
    {
      "id": 88,
      "url": "http://mysaamp.com/myapi/images/bfdo10cdj.gif"
    },
    {
      "id": 89,
      "url": "http://mysaamp.com/myapi/images/cr4020cdj.gif"
    },
    {
      "id": 90,
      "url": "http://mysaamp.com/myapi/images/bba11rmdj.gif"
    },
    {
      "id": 91,
      "url": "http://mysaamp.com/myapi/images/bba31rmdj.gif"
    },
    {
      "id": 92,
      "url": "http://mysaamp.com/myapi/images/bba32rmdj.gif"
    },
    {
      "id": 93,
      "url": "http://mysaamp.com/myapi/images/bbfc1vmdj.gif"
    },
    {
      "id": 94,
      "url": "http://mysaamp.com/myapi/images/bbgm1r.gif"
    },
    {
      "id": 95,
      "url": "http://mysaamp.com/myapi/images/bbbs1vmdj.gif"
    },
    {
      "id": 96,
      "url": "http://mysaamp.com/myapi/images/bbfm1rmdj.gif"
    },
    {
      "id": 97,
      "url": "http://mysaamp.com/myapi/images/bbja1r.gif"
    }
  ],
  "unite": [
    {
      "id": 1,
      "UNIT_LIB_LONG": "PIECE",
      "UNIT_LIB_COURT": "pc"
    },
    {
      "id": 2,
      "UNIT_LIB_LONG": "PAIRE",
      "UNIT_LIB_COURT": "pa"
    },
    {
      "id": 3,
      "UNIT_LIB_LONG": "METRE",
      "UNIT_LIB_COURT": "m"
    },
    {
      "id": 4,
      "UNIT_LIB_LONG": "GRAMME",
      "UNIT_LIB_COURT": "g"
    },
    {
      "id": 5,
      "UNIT_LIB_LONG": "LITRE",
      "UNIT_LIB_COURT": "l"
    },
    {
      "id": 6,
      "UNIT_LIB_LONG": "Millimètre",
      "UNIT_LIB_COURT": "mm"
    },
    {
      "id": 7,
      "UNIT_LIB_LONG": "Millilitre",
      "UNIT_LIB_COURT": "ml"
    },
    {
      "id": 8,
      "UNIT_LIB_LONG": "Degrés Celsius",
      "UNIT_LIB_COURT": "°C"
    },
    {
      "id": 9,
      "UNIT_LIB_LONG": "Carat",
      "UNIT_LIB_COURT": "ct"
    }
  ]
}
 ');
 */
 ?>
 
 <?php // echo json_encode($referentiels->famille1 );

 ?>
<h2> {{__('msg.Half Products')}}</h2> 

<div class="card shadow mb-4 pt-10 pl-10 pr-10 pb-20">
 {{__('Select a category')}}<br><br>

	<div class="row">
	<?php $i=0;
//	foreach($referentiels->famille1 as $famille1) 
	foreach($referentiels as $famille1) 
{ 
// 101 = half products
 	if($famille1->type_id==101){
		
$i++; 
if($i==1 ||$i==6 || $i== 11 ){$color='primary';}
if($i==2 ||$i==7 || $i== 12 ){$color='info';}
if($i==3 ||$i==8 || $i== 13 ){$color='success';}
if($i==4 ||$i==9 || $i== 14 ){$color='warning';}
if($i==5 ||$i==10 || $i== 15 ){$color='danger';}		
		//echo $famille1->id .'<br>';
		echo
		'<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-'.$color.' shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 font-weight-bold text-gray-800 text-uppercase mb-0">
                                              ';?>
                                              <a href="<?php echo route('catalog',['type'=>101,'famille1'=>$famille1->id]);?>"><?php echo $famille1->libelle; ?></a></div>
 									<?php   echo ' </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
		
	}
}?>
                         
 
 				
						
	</div>
 
 
 </div>
					
@endsection					