import Link  from 'next/link'
import React from 'react';
import {Bar,Line} from 'react-chartjs-2';

class Assistants{

  

time = (stamp) => {
      var date = new Date(stamp);
      var mes = (date.getMonth()+1)
      if((date.getMonth()+1) < 10){
        var mes = "0"+(date.getMonth()+1)
      }
      return date.getDate()+"/"+mes+"/"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()
}

timedatabase = (stamp) => {
  var date = new Date(stamp);
  return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
}

generateKey(iLen) {
    var sRnd = '';
    var sChrs = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    for (var i = 0; i < iLen; i++) {
      var randomPoz = Math.floor(Math.random() * sChrs.length);
      sRnd += sChrs.substring(randomPoz, randomPoz + 1);
    }
    return sRnd;
}

diferenceMatch = (time) => {
   
  function t(time) {
     var timeStart = new Date(time)
        .getTime();
     var timeEnd = new Date()
        .getTime();
     var hourDiff = timeEnd - timeStart;
     var secDiff = hourDiff / 1000;
     var minDiff = hourDiff / 60 / 1000;
     var hDiff = hourDiff / 3600 / 1000;
     var humanReadable = {};
     humanReadable.hours = Math.floor(hDiff);
     humanReadable.minutes = minDiff - 60 * humanReadable.hours;
     return humanReadable; 
  }
  
  const i = t(time)
  
  if (i.hours === 0) {
     return i.minutes + " minutos atrás"
  }
  
  if (i.hours <= 23) {
     return i.hours + " horas atrás"
  }
  
  return Math.round(i.hours / 24) + " dias atrás"
  
}

Days = (d) => {
  var teste = []
  for(var i = 0; i < d.length; i++){
    if(i === d.length - 1)
    {
    teste.push(`e ${d[i]}`)
    }else{
    teste.push(` ${d[i]}`)
    }
  }
  return(<>{String(teste)}</>)
}

Niveis = (l) =>{
  switch(l){
    case 0:
    return 'Cliente'
    case 1:
    return 'Normal'
    case 2:
    return 'Booster'
    case 3:
    return 'Master'
  }
}

}

class LeagueOfTools extends Assistants{

Champions = [{HeroID : "1",   Name:  "Aatrox"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Aatrox"},
        {HeroID : "2",   Name:  "Ahri"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ahri"},
        {HeroID : "3",   Name:  "Akali"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Akali"},
        {HeroID : "4",   Name:  "Alistar"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Alistar"},
        {HeroID : "5",   Name:  "Amumu"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Amumu"},
        {HeroID : "6",   Name:  "Anivia"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Anivia"},
        {HeroID : "7",   Name:  "Annie"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Annie"},
        {HeroID : "150", Name:  "Aphelios"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Aphelios"},
        {HeroID : "8",   Name:  "Ashe"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ashe"},
        {HeroID : "9",   Name:  "Aurelion Sol"    ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/AurelionSol"},
        {HeroID : "10",  Name:  "Azir"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Azir"},
        {HeroID : "11",  Name:  "Bardo"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Bard"},
        {HeroID : "12",  Name:  "Blitzcrank"      ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Blitzcrank"},
        {HeroID : "13",  Name:  "Brand"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Brand"},
        {HeroID : "14",  Name:  "Braum"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Braum"},
        {HeroID : "15",  Name:  "Caitlyn"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Caitlyn"   },
        {HeroID : "16",  Name:  "Camille"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Camille"},
        {HeroID : "17",  Name:  "Cassiopeia"      ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Cassiopeia"},
        {HeroID : "18",  Name:  "Cho'Gath"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Chogath"},
        {HeroID : "19",  Name:  "Corki"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Corki"},
        {HeroID : "20",  Name:  "Darius"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Darius"},
        {HeroID : "21",  Name:  "Diana"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Diana"},
        {HeroID : "23",  Name:  "Dr. Mundo"       ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/DrMundo"  },
        {HeroID : "22",  Name:  "Draven"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Draven"},
        {HeroID : "24",  Name:  "Ekko"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ekko"},
        {HeroID : "25",  Name:  "Elise"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Elise"},
        {HeroID : "26",  Name:  "Evelynn"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Evelynn"},
        {HeroID : "27",  Name:  "Ezreal"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ezreal"},
        {HeroID : "28",  Name:  "Fiddlesticks"    ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Fiddlesticks"},
        {HeroID : "29",  Name:  "Fiora"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Fiora"},
        {HeroID : "30",  Name:  "Fizz"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Fizz"},
        {HeroID : "31",  Name:  "Galio"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Galio"},
        {HeroID : "32",  Name:  "Gangplank"       ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Gangplank"},
        {HeroID : "33",  Name:  "Garen"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Garen"},
        {HeroID : "34",  Name:  "Gnar"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Gnar"},
        {HeroID : "35",  Name:  "Gragas"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Gragas"},
        {HeroID : "36",  Name:  "Graves"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Graves"},
        {HeroID : "165", Name:  "Gwen"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Gwen"},
        {HeroID : "37",  Name:  "Hecarim"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Hecarim"},
        {HeroID : "38",  Name:  "Heimerdinger"    ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Heimerdinger"},
        {HeroID : "39",  Name:  "Illaoi"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Illaoi"},
        {HeroID : "40",  Name:  "Irelia"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Irelia"},
        {HeroID : "41",  Name:  "Ivern"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ivern"},
        {HeroID : "42",  Name:  "Janna"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Janna"},
        {HeroID : "43",  Name:  "Jarvan IV"       ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/JarvanIV"},
        {HeroID : "44",  Name:  "Jax"             ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Jax"},
        {HeroID : "45",  Name:  "Jayce"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Jayce"},
        {HeroID : "46",  Name:  "Jhin"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Jhin"},
        {HeroID : "47",  Name:  "Jinx"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Jinx"},
        {HeroID : "48",  Name:  "Kai\'Sa"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kaisa"},
        {HeroID : "49",  Name:  "Kalista"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kalista"},
        {HeroID : "50",  Name:  "Karma"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Karma"},
        {HeroID : "51",  Name:  "Karthus"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Karthus"},
        {HeroID : "52",  Name:  "Kassadin"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kassadin"},
        {HeroID : "53",  Name:  "Katarina"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Katarina"},
        {HeroID : "54",  Name:  "Kayle"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kayle"},
        {HeroID : "55",  Name:  "Kayn"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kayn"},
        {HeroID : "56",  Name:  "Kennen"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kennen"},
        {HeroID : "57",  Name:  "Kha\'Zix"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Khazix"},
        {HeroID : "58",  Name:  "Kindred"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kindred"},
        {HeroID : "59",  Name:  "Kled"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Kled"},
        {HeroID : "60",  Name:  "Kog\'Maw"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/KogMaw"},
        {HeroID : "61",  Name:  "LeBlanc"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Leblanc"},
        {HeroID : "62",  Name:  "Lee Sin"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/LeeSin"},
        {HeroID : "63",  Name:  "Leona"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Leona"},
        {HeroID : "154", Name:  "Lillia"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lillia"},
        {HeroID : "64",  Name:  "Lissandra"       ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lissandra"},
        {HeroID : "65",  Name:  "Lucian"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lucian"},
        {HeroID : "66",  Name:  "Lulu"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lulu"},
        {HeroID : "67",  Name:  "Lux"             ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Lux"},
        {HeroID : "68",  Name:  "Malphite"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Malphite"},
        {HeroID : "69",  Name:  "Malzahar"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Malzahar"},
        {HeroID : "70",  Name:  "Maokai"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Maokai"},
        {HeroID : "71",  Name:  "Master Yi"       ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/MasterYi"},
        {HeroID : "72",  Name:  "Miss Fortune"    ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/MissFortune"},
        {HeroID : "160", Name:  "Mordekaiser"     ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Mordekaiser1"},
        {HeroID : "75",  Name:  "Morgana"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Morgana"},    
        {HeroID : "76",  Name:  "Nami"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nami"},
        {HeroID : "77",  Name:  "Nasus"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nasus"},
        {HeroID : "78",  Name:  "Nautilus"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nautilus"},
        {HeroID : "79",  Name:  "Neeko"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Neeko"},
        {HeroID : "80",  Name:  "Nidalee"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nidalee"},
        {HeroID : "81",  Name:  "Nocturne"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nocturne"}, 
        {HeroID : "82",  Name:  "Nunu e Willump"  ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Nunu"},
        {HeroID : "83",  Name:  "Olaf"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Olaf"},
        {HeroID : "84",  Name:  "Orianna"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Orianna"},
        {HeroID : "85",  Name:  "Ornn"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ornn"},
        {HeroID : "86",  Name:  "Pantheon"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Pantheon"},
        {HeroID : "87",  Name:  "Poppy"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Poppy"},
        {HeroID : "88",  Name:  "Pyke"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Pyke"},
        {HeroID : "153", Name:  "Qiyana"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Qiyana"},
        {HeroID : "89",  Name:  "Quinn"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Quinn"},
        {HeroID : "90",  Name:  "Rakan"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rakan"},
        {HeroID : "91",  Name:  "Rammus"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rammus"},
        {HeroID : "92",  Name:  "Rek\'Sai"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/RekSai"},
        {HeroID : "163", Name:  "Rell"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rell"},
        {HeroID : "93",  Name:  "Renekton"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Renekton"},  
        {HeroID : "94",  Name:  "Rengar"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rengar"},
        {HeroID : "95",  Name:  "Riven"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Riven"},
        {HeroID : "96",  Name:  "Rumble"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Rumble"},
        {HeroID : "97",  Name:  "Ryze"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ryze"},
        {HeroID : "156", Name:  "Samira"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Samira"},
        {HeroID : "98",  Name:  "Sejuani"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sejuani"},
        {HeroID : "152", Name:  "Senna"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Senna"},
        {HeroID : "162", Name:  "Seraphine"       ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Seraphine"},
        {HeroID : "151", Name:  "Sett"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sett"},
        {HeroID : "99",  Name:  "Shaco"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Shaco"},
        {HeroID : "100", Name:  "Shen"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Shen"},
        {HeroID : "101", Name:  "Shyvana"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Shyvana"},
        {HeroID : "102", Name:  "Singed"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Singed"},
        {HeroID : "103", Name:  "Sion"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sion"},
        {HeroID : "104", Name:  "Sivir"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sivir" },
        {HeroID : "105", Name:  "Skarner"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Skarner"},
        {HeroID : "106", Name:  "Sona"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sona"},
        {HeroID : "107", Name:  "Soraka"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Soraka"},
        {HeroID : "108", Name:  "Swain"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Swain"},
        {HeroID : "109", Name:  "Sylas"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Sylas"},
        {HeroID : "110", Name:  "Syndra"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Syndra"},
        {HeroID : "111", Name:  "Tahm Kench"      ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/TahmKench"},
        {HeroID : "112", Name:  "Taliyah"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Taliyah"},
        {HeroID : "113", Name:  "Talon"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Talon"},
        {HeroID : "114", Name:  "Taric"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Taric"},
        {HeroID : "115", Name:  "Teemo"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Teemo"},
        {HeroID : "116", Name:  "Thresh"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Thresh"},
        {HeroID : "117", Name:  "Tristana"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Tristana" },
        {HeroID : "118", Name:  "Trundle"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Trundle"},
        {HeroID : "119", Name:  "Tryndamere"      ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Tryndamere"},
        {HeroID : "120", Name:  "Twisted Fate"    ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/TwistedFate"},
        {HeroID : "121", Name:  "Twitch"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Twitch"},
        {HeroID : "122", Name:  "Udyr"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Udyr"},
        {HeroID : "123", Name:  "Urgot"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Urgot"},
        {HeroID : "124", Name:  "Varus"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Varus"},
        {HeroID : "125", Name:  "Vayne"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Vayne"},
        {HeroID : "126", Name:  "Veigar"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Veigar"},
        {HeroID : "127", Name:  "Vel\'Koz"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Velkoz"},
        {HeroID : "128", Name:  "Vi"              ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Vi"},
        {HeroID : "164", Name:  "Viego"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Viego"},
        {HeroID : "129", Name:  "Viktor"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Viktor"},
        {HeroID : "130", Name:  "Vladimir"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Vladimir"},
        {HeroID : "161", Name:  "Volibear"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Volibear"},
        {HeroID : "132", Name:  "Warwick"         ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Warwick"},
        {HeroID : "73",  Name:  "Wukong"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/MonkeyKing"},
        {HeroID : "133", Name:  "Xayah"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Xayah"},
        {HeroID : "134", Name:  "Xerath"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Xerath"},
        {HeroID : "135", Name:  "Xin Zhao"        ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/XinZhao" }, 
        {HeroID : "136", Name:  "Yasuo"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Yasuo"},
        {HeroID : "155", Name:  "Yone"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Yone"},
        {HeroID : "137", Name:  "Yorick"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Yorick"},
        {HeroID : "138", Name:  "Yuumi"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Yuumi"},
        {HeroID : "139", Name:  "Zac"             ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zac"},
        {HeroID : "140", Name:  "Zed"             ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zed"},
        {HeroID : "141", Name:  "Ziggs"           ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Ziggs"},
        {HeroID : "142", Name:  "Zilean"          ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zilean"},
        {HeroID : "143", Name:  "Zoe"             ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zoe"},
            {HeroID : "144", Name:  "Zyra"            ,Img : "https://elojobhigh.com.br/app/assets/imagens/campeoes/Zyra"}]

GameMode =  [{"queueId" : 0,"map" : "Custom games","description" : null,"notes" : null},
            {"queueId" : 2,"map" : "Summoner's Rift","description" : "5v5 Blind Pick games","notes" : "Deprecated in patch 7.19 in favor of queueId 430"},
{"queueId" : 4,"map" : "Summoner's Rift","description" : "5v5 Ranked Solo games","notes" : "Deprecated in favor of queueId 420"},
{"queueId" : 6,"map" : "Summoner's Rift","description" : "5v5 Ranked Premade games","notes" : "Game mode deprecated"},
{"queueId" : 7,"map" : "Summoner's Rift","description" : "Co-op vs AI games","notes" : "Deprecated in favor of queueId 32 and 33"},
{"queueId" : 8,"map" : "Twisted Treeline","description" : "3v3 Normal games","notes" : "Deprecated in patch 7.19 in favor of queueId 460"},
{"queueId" : 9,"map" : "Twisted Treeline","description" : "3v3 Ranked Flex games","notes" : "Deprecated in patch 7.19 in favor of queueId 470"},
{"queueId" : 14,"map" : "Summoner's Rift","description" : "5v5 Draft Pick games","notes" : "Deprecated in favor of queueId 400"},
{"queueId" : 16,"map" : "Crystal Scar","description" : "5v5 Dominion Blind Pick games","notes" : "Game mode deprecated"},
{"queueId" : 17,"map" : "Crystal Scar","description" : "5v5 Dominion Draft Pick games","notes" : "Game mode deprecated"},
{"queueId" : 25,"map" : "Crystal Scar","description" : "Dominion Co-op vs AI games","notes" : "Game mode deprecated"},
{"queueId" : 31,"map" : "Summoner's Rift","description" : "Co-op vs AI Intro Bot games","notes" : "Deprecated in patch 7.19 in favor of queueId 830"},
{"queueId" : 32,"map" : "Summoner's Rift","description" : "Co-op vs AI Beginner Bot games","notes" : "Deprecated in patch 7.19 in favor of queueId 840"},
{"queueId" : 33,"map" : "Summoner's Rift","description" : "Co-op vs AI Intermediate Bot games","notes" : "Deprecated in patch 7.19 in favor of queueId 850"},
{"queueId" : 41,"map" : "Twisted Treeline","description" : "3v3 Ranked Team games","notes" : "Game mode deprecated"},
{"queueId" : 42,"map" : "Summoner's Rift","description" : "5v5 Ranked Team games","notes" : "Game mode deprecated"},
{"queueId" : 52,"map" : "Twisted Treeline","description" : "Co-op vs AI games","notes" : "Deprecated in patch 7.19 in favor of queueId 800"},
{"queueId" : 61,"map" : "Summoner's Rift","description" : "5v5 Team Builder games","notes" : "Game mode deprecated"},
{"queueId" : 65,"map" : "Howling Abyss","description" : "5v5 ARAM games","notes" : "Deprecated in patch 7.19 in favor of queueId 450"},
{"queueId" : 67,"map" : "Howling Abyss","description" : "ARAM Co-op vs AI games","notes" : "Game mode deprecated"},
{"queueId" : 70,"map" : "Summoner's Rift","description" : "One for All games","notes" : "Deprecated in patch 8.6 in favor of queueId 1020"},
{"queueId" : 72,"map" : "Howling Abyss","description" : "1v1 Snowdown Showdown games","notes" : null},
{"queueId" : 73,"map" : "Howling Abyss","description" : "2v2 Snowdown Showdown games","notes" : null},
{"queueId" : 75,"map" : "Summoner's Rift","description" : "6v6 Hexakill games","notes" : null},
{"queueId" : 76,"map" : "Summoner's Rift","description" : "Ultra Rapid Fire games","notes" : null},
{"queueId" : 78,"map" : "Howling Abyss","description" : "One For All : Mirror Mode games","notes" : null},
{"queueId" : 83,"map" : "Summoner's Rift","description" : "Co-op vs AI Ultra Rapid Fire games","notes" : null},
{"queueId" : 91,"map" : "Summoner's Rift","description" : "Doom Bots Rank 1 games","notes" : "Deprecated in patch 7.19 in favor of queueId 950"},
{"queueId" : 92,"map" : "Summoner's Rift","description" : "Doom Bots Rank 2 games","notes" : "Deprecated in patch 7.19 in favor of queueId 950"},
{"queueId" : 93,"map" : "Summoner's Rift","description" : "Doom Bots Rank 5 games","notes" : "Deprecated in patch 7.19 in favor of queueId 950"},
{"queueId" : 96,"map" : "Crystal Scar","description" : "Ascension games","notes" : "Deprecated in patch 7.19 in favor of queueId 910"},
{"queueId" : 98,"map" : "Twisted Treeline","description" : "6v6 Hexakill games","notes" : null},
{"queueId" : 100,"map" : "Butcher's Bridge","description" : "5v5 ARAM games","notes" : null},
{"queueId" : 300,"map" : "Howling Abyss","description" : "Legend of the Poro King games","notes" : "Deprecated in patch 7.19 in favor of queueId 920"},
{"queueId" : 310,"map" : "Summoner's Rift","description" : "Nemesis games","notes" : null},
{"queueId" : 313,"map" : "Summoner's Rift","description" : "Black Market Brawlers games","notes" : null},
{"queueId" : 315,"map" : "Summoner's Rift","description" : "Nexus Siege games","notes" : "Deprecated in patch 7.19 in favor of queueId 940"},
{"queueId" : 317,"map" : "Crystal Scar","description" : "Definitely Not Dominion games","notes" : null},
{"queueId" : 318,"map" : "Summoner's Rift","description" : "ARURF games","notes" : "Deprecated in patch 7.19 in favor of queueId 900"},
{"queueId" : 325,"map" : "Summoner's Rift","description" : "All Random games","notes" : null},
{"queueId" : 400,"map" : "Summoner's Rift","description" : "5v5 Draft Pick games","notes" : null},
{"queueId" : 410,"map" : "Summoner's Rift","description" : "5v5 Ranked Dynamic games","notes" : "Game mode deprecated in patch 6.22"},
{"queueId" : 420,"map" : "Summoner's Rift","description" : "Rankeada Solo","notes" : null},
{"queueId" : 430,"map" : "Summoner's Rift","description" : "5v5 Blind Pick games","notes" : null},
{"queueId" : 440,"map" : "Summoner's Rift","description" : "5v5 Ranked Flex games","notes" : null},
{"queueId" : 450,"map" : "Howling Abyss","description" : "5v5 ARAM games","notes" : null},
{"queueId" : 460,"map" : "Twisted Treeline","description" : "3v3 Blind Pick games","notes" : "Deprecated in patch 9.23"},
{"queueId" : 470,"map" : "Twisted Treeline","description" : "3v3 Ranked Flex games","notes" : "Deprecated in patch 9.23"},
{"queueId" : 600,"map" : "Summoner's Rift","description" : "Blood Hunt Assassin games","notes" : null},
{"queueId" : 610,"map" : "Cosmic Ruins","description" : "Dark Star : Singularity games","notes" : null},
{"queueId" : 700,"map" : "Summoner's Rift","description" : "Clash games","notes" : null},
{"queueId" : 800,"map" : "Twisted Treeline","description" : "Co-op vs. AI Intermediate Bot games","notes" : "Deprecated in patch 9.23"},
{"queueId" : 810,"map" : "Twisted Treeline","description" : "Co-op vs. AI Intro Bot games","notes" : "Deprecated in patch 9.23"},
{"queueId" : 820,"map" : "Twisted Treeline","description" : "Co-op vs. AI Beginner Bot games","notes" : null},
{"queueId" : 830,"map" : "Summoner's Rift","description" : "Co-op vs. AI Intro Bot games","notes" : null},
{"queueId" : 840,"map" : "Summoner's Rift","description" : "Co-op vs. AI Beginner Bot games","notes" : null},
{"queueId" : 850,"map" : "Summoner's Rift","description" : "Co-op vs. AI Intermediate Bot games","notes" : null},
{"queueId" : 900,"map" : "Summoner's Rift","description" : "URF games","notes" : null},
{"queueId" : 910,"map" : "Crystal Scar","description" : "Ascension games","notes" : null},
{"queueId" : 920,"map" : "Howling Abyss","description" : "Legend of the Poro King games","notes" : null},
{"queueId" : 940,"map" : "Summoner's Rift","description" : "Nexus Siege games","notes" : null},
{"queueId" : 950,"map" : "Summoner's Rift","description" : "Doom Bots Voting games","notes" : null},
{"queueId" : 960,"map" : "Summoner's Rift","description" : "Doom Bots Standard games","notes" : null},
{"queueId" : 980,"map" : "Valoran City Park","description" : "Star Guardian Invasion : Normal games","notes" : null},
{"queueId" : 990,"map" : "Valoran City Park","description" : "Star Guardian Invasion : Onslaught games","notes" : null},
{"queueId" : 1000,"map" : "Overcharge","description" : "PROJECT : Hunters games","notes" : null},
{"queueId" : 1010,"map" : "Summoner's Rift","description" : "Snow ARURF games","notes" : null},
{"queueId" : 1020,"map" : "Summoner's Rift","description" : "One for All games","notes" : null},
{"queueId" : 1030,"map" : "Crash Site","description" : "Odyssey Extraction : Intro games","notes" : null},
{"queueId" : 1040,"map" : "Crash Site","description" : "Odyssey Extraction : Cadet games","notes" : null},
{"queueId" : 1050,"map" : "Crash Site","description" : "Odyssey Extraction : Crewmember games","notes" : null},
{"queueId" : 1060,"map" : "Crash Site","description" : "Odyssey Extraction : Captain games","notes" : null},
{"queueId" : 1070,"map" : "Crash Site","description" : "Odyssey Extraction : Onslaught games","notes" : null},
{"queueId" : 1090,"map" : "Convergence","description" : "Teamfight Tactics games","notes" : null},
{"queueId" : 1100,"map" : "Convergence","description" : "Ranked Teamfight Tactics games","notes" : null},
{"queueId" : 1110,"map" : "Convergence","description" : "Teamfight Tactics Tutorial games","notes" : null},
{"queueId" : 1111,"map" : "Convergence","description" : "Teamfight Tactics test games","notes" : null},
{"queueId" : 1200,"map" : "Nexus Blitz","description" : "Nexus Blitz games","notes" : "Deprecated in patch 9.2"},
{"queueId" : 1300,"map" : "Nexus Blitz","description" : "Nexus Blitz games","notes" : null},
{"queueId" : 2000,"map" : "Summoner's Rift","description" : "Tutorial 1","notes" : null},
{"queueId" : 2010,"map" : "Summoner's Rift","description" : "Tutorial 2","notes" : null},
            {"queueId" : 2020,"map" : "Summoner's Rift","description" : "Tutorial 3","notes" : null}]
  


eloImg(elo, div, type) {
      if (type == 'imagem') {
          if (elo == 'desafiante' || elo == 'grao-mestre' || elo == 'mestre') {
              return elo;
          }
          return elo + '_' + div;
      }
      if (type == 'nome') {
          if (elo == 'desafiante' || elo == 'grao-mestre' || elo == 'mestre') {
              return strtoupper(elo);
          }
          return strtoupper(elo) + ' ' + div;
      }
      if (type == 'formulario') {
          if (elo == 'desafiante' || elo == 'grao-mestre' || elo == 'mestre') {
              return null;
          }
          return div;
      }
}

searchHero = (e) => {
        for(var Key of this.Champions){
            if(parseInt(Key["HeroID"]) === parseInt(e)){
                return Key;
            }
        }
}

searchGameMode = (e) => {
  for(var Key of this.GameMode){
    if(parseInt(Key["queueId"]) === parseInt(e)){
        return Key;
    }
}
}

MaestriasTO(s){
  switch(s){
      case 'm1':
      return 'M0 até M1';
      case 'm2':
      return 'M1 até M2';
      case 'm3':
      return 'M2 até M3';
      case 'm4':
      return 'M3 até M4';
      case 'm5':
      return 'M4 até M5';
      case 'm6':
      return 'M5 até M6';
      case 'm7':
      return 'M6 até M7';
  }
}


}

class More extends LeagueOfTools{

Show = (e) =>{
  
  var trajeto = e.target.localName === 'a' ? e.target.nextSibling.parentElement : e.target.nextSibling.parentElement.parentElement

  if($(trajeto).find('ul:first').css("display") === 'none'){
    $(trajeto).find('ul:first').css('display', 'block')
  }else{
    $(trajeto).find('ul:first').css('display', 'none')
  }
         // $(e.target.nextSibling.parentElement).find('ul').toggle();  
}
  
checkToken = async () =>{
          const formData = new URLSearchParams();
          formData.append('config', 'alertbox')
          const res = await fetch('/api/config/cookie', {
              method: 'POST',
              body: formData
            })
          const json = await res.json()
          return json
}
  
acceptedBox = async () =>{
         const status =  await this.checkToken()
         if(status.code > 0){
                 return console.log(status)
         }
         $(".modal.fade.show").remove();
}
  
alertBox = (c) =>{
          if(typeof c === 'undefined')
          {
                  return(<div className="modal fade show" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-modal="true" style={{display: 'block',paddingRight: '17px',background: '#0000007a'}}>
                  <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div className="modal-content">
                      <div className="modal-header">
                        <h6 className="modal-title" id="modal-title-default">Sua sessão é limitada!</h6>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div className="modal-body">
                        <p>Você será desconectado após 1 hora de acesso, mas não se preocupe, você poderá entrar novamente.</p>
                      </div>
                      <div className="modal-footer">
                        <button type="button" className="btn btn-primary" onClick={this.acceptedBox}>Entendi</button>
                      </div>
                    </div>
                  </div>
                </div>)
                }
}
  
navbarLiItem(page){
    var items = []
    var pages = [
    {page:  "home",     nome: "Inicio",   url:"/", icon: "ni-tv-2"},
    {page:  "clients",  nome: "Clientes", icon: "ni-circle-08", suburl:[{nome: 'Meus Clientes', url: '/manage/customers/my', icon: "ni-single-02"},{nome: 'Clients Disponiveis', url:'/manage/customers', icon: "ni-badge"}]}
    ]
    
      for(var item of pages)
      {
        var active = page === item.page ? 'active': ''
        if(typeof item.suburl !== 'undefined'){
          var ul = []
          for(var item2 of item.suburl)
          {
            ul.push(<li className="nav-item" key={this.generateKey(20)}> <Link href={""+item2.url+""}><a className="nav-link"> <i className={"ni "+item2.icon+" text-primary"}></i> <span className="nav-link-text">{item2.nome}</span> </a></Link> </li>)
          }
            items.push(<li className="nav-item" key={this.generateKey(20)}><a className={"nav-link "+active} href="#!" onClick={this.Show}><i className={"ni "+item.icon+" text-orange"}></i><span className="nav-link-text">{item.nome}</span> </a><ul>{ul}</ul></li>)
      }
      else
      {
        items.push(<li className="nav-item" key={this.generateKey(20)}> <Link href={""+item.url+""}><a className={"nav-link "+active}> <i className={"ni "+item.icon+" text-primary"}></i><span className="nav-link-text">{item.nome}</span></a></Link></li>)
      }
    }
    return (<>{items}</>)
}

navbarLiItemOther(page){
  var items = []
  var items2 = []
  var pages = [
    {
       page :"development",
       nome :"Desenvolver",
       icon :"ni-atom",
       suburl :[
          {
             nome :"Usuarios",
             url :"/manage/customers/my",
             icon :"ni-user-run",
             suburl :[
                {
                   nome :"Lista",
                   url :"/development/users/list",
                   icon :"ni-user-run"
                },
                {
                  nome :"Adicionar",
                  url :"/development/users/add",
                  icon :"ni-user-run"
               }
             ]
          },
          {
            nome: "Personalização",
            url :"/manage/customers/my",
            icon : "ni-palette",
            suburl :[
              {
                nome: "Geren. Avatares",
                url :"/development/avatares/list",
                icon :"ni-satisfied"
              },
              {
                nome: "Geren. Banners",
                url :"/development/banners/list",
                icon :"ni-image"
              },
              {
                nome: "Geren. Temas",
                url :"/development/themes/list",
                icon :"ni-palette"
              },
              {
                nome: "Add Avatar",
                url :"/development/avatares/add",
                icon :"ni-fat-add"
              },
              {
                nome: "Add Banner",
                url :"/development/banners/add",
                icon :"ni-fat-add"
              },
              {
                nome: "Add Tema",
                url :"/development/themes/add",
                icon :"ni-fat-add"
              },

            ]
          },
          {
          nome: "Pedidos",
          url: "/mnage/customers/my",
          icon :"ni-cart",
          suburl: [
            {
              nome: "Gerenciar",
              url :"/development/orders/list",
              icon: "ni-bullet-list-67"
            }
          ]

          },
          {
            nome: "Noticias",
            url: "/mnage/customers/my",
            icon :"ni-notification-70",
            suburl: [
              {
                nome: "Gerenciar",
                url :"/development/news/list",
                icon: "ni-settings"
              },
              {
                nome: "Publicar",
                url :"/development/news/new/create",
                icon: "ni-fat-add"
              }
            ]
          },
          {
            nome: "Cupons",
            url: "/mnage/customers/my",
            icon :"ni-tag",
            suburl: [
              {
                nome: "Gerenciar",
                url :"/development/coupons/list",
                icon: "ni-settings"
              },
              {
                nome: "Criar",
                url :"/development/coupons/add",
                icon: "ni-fat-add"
              }
            ]
          }
       ]
    }
  ] 
  
    for(var item of pages)
    {
      var active = page === item.page ? 'active': ''
      if(typeof item.suburl !== 'undefined'){
        var ul = []
        var ul2 = []
        for(var item2 of item.suburl)
        {

          if(typeof item2.suburl !== 'undefined'){

            for(var item3 of item2.suburl){
              ul2.push(<li className="nav-item" key={this.generateKey(20)}> <Link href={""+item3.url+""}><a className="nav-link"> <i className={"ni "+item3.icon+" text-primary"}></i> <span className="nav-link-text">{item3.nome}</span> </a></Link> </li>)
            }

            ul.push(<li className="nav-item" key={this.generateKey(20)}><a className={"nav-link "+active} href="#!" onClick={this.Show}><i className={"ni "+item2.icon+" text-orange"}></i><span className="nav-link-text">{item2.nome}</span> </a><ul style={{display: 'none'}}>{ul2}</ul></li>)
            ul2 = [null] // Nao mexe kkkkk RESETA A LISTA
          }

        }
          items.push(<li className="nav-item" key={this.generateKey(20)}><a className={"nav-link "+active} href="#!" onClick={this.Show}><i className={"ni "+item.icon+" text-orange"}></i><span className="nav-link-text">{item.nome}</span> </a><ul>{ul}</ul></li>)
    }
    else
    {
      items.push(<li className="nav-item" key={this.generateKey(20)}> <Link href={""+item.url+""}><a className={"nav-link "+active}> <i className={"ni "+item.icon+" text-primary"}></i><span className="nav-link-text">{item.nome}</span></a></Link></li>)
    }
  }
  return (<>{items}{items2}</>)
}
  
addServices(data){
    const items = []
  
    const template = (Name) => {
     return (<tr key={this.generateKey(20)}>
        <th width="20%">{Name}</th>
        <td><span className="label success">sim</span></td>
    </tr>)
    }

    const detailHero = (ids) =>{
      const heros = []
      for(var hero of ids){
        var Detail = this.searchHero(hero)
        heros.push(<img key={this.generateKey(20)} src={Detail.Img+".png"} data-toggle="tooltip" data-placement="top" title={Detail.Name} alt={Detail.Name} style={{maxHeight: '35px'}} />)
      } 
      return heros
    }
  
    data.Chat          === '1' ? items.push(template('Chat Offline')): false
    data.SpellsPosi    === '1' ? items.push(template('Posição de Feitiços'),<tr key={this.generateKey(20)}><th width="20%">Flash</th><td><img src="https://elojobhigh.com.br/app/assets/imagens/spell-flash.png" style={{maxHeight: '25px'}}/> <span>FLASH - {data.FlashPosi}</span></td></tr>): false
    data.RateMMR       === '1' ? items.push(template('Taxa MMR')) : false
    data.SoloService   === '1' ? items.push(template('Serviço Solo')) : false
    data.SchedulesREST === '1' ? items.push(template('Horários Restritos')) : false // Horario especifico, por Texto
    //data.Schedules === '1' ?....

    data.BoosterFavority === '1' ? items.push(<tr key={this.generateKey(20)}><th width="20%">Booster Favorito</th><td><a href="#" title="Akali">{data.BoosterFavorityB}</a></td></tr>) : false // BoosterFavorityB
    data.SpecificCHAMPs === '1' ? items.push(<tr key={this.generateKey(20)}><th width="20%">Campeões</th><td style={{display: 'contents'}}>{detailHero(data.Champions)}</td></tr>) : false


    if(data.Mastery === '1')
    {
      var maestrias = []
      for(var heros of data.MasteryHero){
        var details = heros.split("/")
        var hero = this.searchHero(details[0])
        maestrias.push(<td key={this.generateKey(4)} style={{display:'contents'}}><span className="label info"><img src={hero.Img+".png"} data-toggle="tooltip" title="" alt={hero.Name} style={{maxHeight:'35px',marginTop: '12px'}}data-original-title={hero.Name}/> {this.MaestriasTO(details[1])}</span></td>)
      }

     items.push(<tr key={this.generateKey(20)}><th width="20%">Maestria(s)</th>{maestrias}</tr>) 
    }



    data.SpecificRO    === '1' ? items.push(template('Rotas Específicas'),<tr key={this.generateKey(20)}><th width="20%">Rota - Primário</th><td><img src={"/lol/routes/lane-"+data.RoutePrimary+".png"} style={{maxHeight: '25px'}}/> {data.RoutePrimary.toUpperCase()}</td></tr>,<tr key={this.generateKey(20)}><th width="20%">Rota - Secundaria</th><td><img src={"/lol/routes/lane-"+data.RouteSecondary+".png"} style={{maxHeight: '25px'}}/> {data.RouteSecondary.toUpperCase()}</td></tr>) : false
    data.KDAReduce     === '1' ? items.push(template('Redução do KDA')): false
    data.StreamON      === '1' ? items.push(template('Stream Online')) : false
    data.ExtraWin      === '1' ? items.push(template('Vitória Extra')) : false

   

  return(<>{items}</>)
  
}


loadConfigMessages = async (id,token) => {
  const Formulario = new URLSearchParams();
  Formulario.append('id', id)
  Formulario.append('token',token)
  const Resultado = await fetch(process.env.URLSERVERSIDE+'/api/config/messages', {
      method: 'POST',
      body: Formulario
    })
  const Json = await Resultado.json()
  return Json
}

loadMessages = (data) => {
  const Messages = data.final.m.mensagens
  if(Messages.length === 0){
    return(<><li style={{width: '100%',marginLeft:0}}>Nenhuma mensagem encontrada</li></>)
  }

  Messages.sort(function (x, y) {
    var a = x.id
    var b = y.id
    return a - b;
  });

  var LoadMessagens = []
  for(var M of Messages){
    var tipo = M.tipo !== 1 ? 'highlight': 'other'
    LoadMessagens.push(<li className={tipo} data-attribute={M.id} key={this.generateKey(10)}><small>{this.time(M.data)}</small><a href="URL" title={M.nome}><img src={"/lol/profiles/avatar/"+M.avatar+""} alt={M.nome} className="img-circle avatar"/> <strong>{M.nome}</strong></a> diz: {M.mensagem}</li>)
  }
   return(<>{LoadMessagens}</>)
}

async loadIntervalMessages(i,t){
  const data = await this.loadConfigMessages(i,t)

  console.log('Chat Atualizado')

  try{
  const Messages = data.mensagens

    $("#mensagens ul").empty()

    if(Messages.length === 0){
      return($("mensagens ul").append('<li style={{width: "100%",marginLeft:0}}>Nenhuma mensagem encontrada</li>'))
    }
  
    Messages.sort(function (x, y) {
      var a = x.id
      var b = y.id
      return a - b;
    });
  
    for(var M of Messages){
      var tipo = M.tipo !== 1 ? 'highlight': 'other'
      $("#mensagens ul").append(`<li class=${tipo} data-attribute=${M.id}><small>${this.time(M.data)}</small><a href="URL" title=${M.nome}><img src=${"/lol/profiles/avatar/"+M.avatar+""} alt=${M.nome} class="img-circle avatar"/> <strong>${M.nome}</strong></a> diz: ${M.mensagem}</li>`)
    }
    $('#mensagens').scrollTop($('#mensagens')[0].scrollHeight);
  }catch(e){
    //console.log('Chat inativo')
  }
}


setPropetsMessage = async (id,mensagem,token) => {
    const f = new URLSearchParams();
    f.append('id', id)
    f.append('mensagem',mensagem)
    f.append('token',token)
    const r = await fetch('/api/propets/send-message', {
        method: 'POST',
        body: f
      })
    const j = await r.json()
    return j
}

sendMensagemMore = async () => {
  const message =  document.getElementById("mensagem").value
  const orderid =  document.getElementById("compraid").value
  const token =  document.getElementById("autorizacao").value
  const Send = await  this.setPropetsMessage(orderid,message,token)

  if(Send.status)
  {
    document.getElementById("mensagem").value = ''
    if(Send.command !== 0){
      if(Send.command === 1){
        return alert("Alerta enviado com sucesso!")
      }
      return alert("Ocorreu um erro ao tentar avisar o usuario!")
    }

    for(var mm of Send.mensagens){
    var tipo = mm.tipo !== 1 ? 'highlight': 'other'
     if(typeof $('*[data-attribute="'+mm.id+'"]')[0] === 'undefined'){
      $("#mensagens ul").append(`<li class="${tipo}" data-attribute="${mm.id}" key="${this.generateKey(10)}"><small>${this.time(mm.data)}</small><a href="URL" title="${mm.nome}"><img src="/lol/profiles/avatar/${mm.avatar}" alt="${mm.nome}" class="img-circle avatar"/> <strong>${mm.nome}</strong></a> diz: ${mm.mensagem}</li>`)
     }
   }
    $('#mensagens').scrollTop($('#mensagens')[0].scrollHeight);

  }else{
    console.log('error')
  }

}


LoadGraphic1(data){
  const getNameDay = (y) => {
    var days = ['Do', 'Seg', 'Ter', 'Quar', 'Quin', 'Sex', 'Sab'];
    var d = y !== null ? new Date(y):  new Date();
   return days[d.getDay()];
  }

    const days = [{dia: 'Seg', nome: 'Segunda'}, {dia: 'Ter', nome: 'Terça'}, {dia:'Quar', nome:"Quarta"}, {dia: 'Quin', nome:"Quinta"}, {dia:'Sex', nome:"Sexta"}, {dia: 'Sab', nome: 'Sabado'}, {dia:'Do', nome:'Domingo'}]
    const colors = (function(days){ var colorsp = []; for(var select of days) { if(getNameDay(null) === select.dia){ colorsp.push("#33BD00")}else{colorsp.push("#fb6340")}} return colorsp })(days)

		var ordersChart = {
      
      labels: days.map(function(dias){return dias.dia}),
      type: 'bar',
      datasets: [
        {
            label: 'Sales',
            data: data.days,
            backgroundColor: colors,
            labelWidth: 2,
            borderColor: colors,
            borderWidth:2,
            borderRadius: 8,
            borderSkipped: false,
        }
      ],
		}

 


    return(<Bar className="chart-canvas chartjs-render-monitor" width="356" height="350" data={ordersChart}  options={{
      responsive:true,
      maintainAspectRatio: false,
      aspectRatio: 1, 
      plugins:{
        title:{
          display: false,
        },
        legend: {
          display: false
       },
       tooltip: {
        callbacks: {
          label: function(item) {
            var label = item.label
              var yLabel = item.formattedValue;
              var content = '';
  
              if (item.dataset.data > 1) {
                content += '' + label + '';
              }
  
              content += '' + yLabel + ' Usuarios';
              return content;
          },
        },
      }
      },
     
      scales: {
        x: {
          grid: {
            offset: false,
            display: false
          },
        },

        y: {
          ticks: {
            beginAtZero: true,
          },
          grid: {
            offsetGridLines: false,
            display: false
          },
          ticks: {
            callback: function(value) {
              if (Number.isInteger(value)) {
                return value
              }
            }
          }
        },
      }
    }}/>)
}

LoadGraphic2(data){

    var colors = {
      gray: {
        100: '#f6f9fc',
        200: '#e9ecef',
        300: '#dee2e6',
        400: '#ced4da',
        500: '#adb5bd',
        600: '#8898aa',
        700: '#525f7f',
        800: '#32325d',
        900: '#212529'
      },
      theme: {
        'default': '#172b4d',
        'primary': '#5e72e4',
        'secondary': '#f4f5f7',
        'info': '#11cdef',
        'success': '#2dce89',
        'danger': '#f5365c',
        'warning': '#fb6340'
      },
      black: '#12263F',
      white: '#FFFFFF',
      transparent: 'transparent',
    };


		var ordersChart = {
        labels: ['Jan', 'Fev', 'Marc', 'Abril', 'Maio', 'Jun', 'Julh', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        
        datasets: [{
          label: 'Performance',
          data: data.months,
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.3
        }],
        
		}

    return(<Line id="chart-sales-dark" width="844" height="350" className="chart-canvas chartjs-render-monitor" data={ordersChart} options={{
      responsive:true,
      maintainAspectRatio: false,
      aspectRatio: 1, 
      plugins:{
        title:{
          display: false,
        },
        legend: {
          display: false
       },
       
        tooltip: {
          callbacks: {
            label: function(item) {
              var label = item.label
              var yLabel = item.formattedValue;
              var content = '';
  
              if (item.dataset.data > 1) {
                content += '' + label + '';
              }
  
              content += '' + yLabel + ' Pedidos';
              return content;
            }
          }
        }
      },
      scales: {
        y: {
          grid: {
            offset: false,
            display: false
          },
          ticks: {
            color: '#8898aa',
            callback: function(value) {
              if (Number.isInteger(value)) {
                return '' + parseInt(value) + '(P)';
              }
            }
          }
        },
        x:{
          ticks: {
            color: '#8898aa',
          }
        }
      },
      
    }}/>)
}

paginationScr(d,url){
  
  var it = []
  var i = 0
     for(var o = 0; i < Math.ceil(d.count / 3); o++){
       i++
        if(i == d.page){
           it.push(<li className="page-item active"><Link href={url+"?l="+i} key={i}><a className="page-link">{i}</a></Link></li>)
        }else{
           it.push(<li className="page-item"><Link href={url+"?l="+i} key={i}><a className="page-link">{i}</a></Link></li>)
        }
      }

  return(<>{it}</>)
}

LastMessage(data){
  if(data.mensagens.length > 0){
    var Mensagens = []
      for(var m of data.mensagens){
        Mensagens.push(<tr key={this.generateKey(11)}><th scope="row">Pedido {m.order_id}</th><td><strong>{m.user_send}</strong></td><td>"{m.message.substr(0, 45)}..."</td><td>dia {this.time(m.date)}</td><td><Link href={"/manage/customers/"+m.order_id+"/chat"}><a><i className="ni ni-chat-round"></i></a></Link></td></tr>)
      }
    }else{
      var Mensagens = [<tr><td>Nenhuma mensagem foi encontrada</td></tr>]
    }
return (Mensagens)

}

CronLogout(){
  console.log('eita')
  var seconds, upgradeTime
  var state = localStorage.getItem('loginDate')
  seconds = upgradeTime = localStorage.getItem('loginDate')
 

  function timer() {
    var days = Math.floor(seconds / 24 / 60 / 60);
    var hoursLeft = Math.floor((seconds) - (days * 86400));
    var hours = Math.floor(hoursLeft / 3600);
    var minutesLeft = Math.floor((hoursLeft) - (hours * 3600));
    var minutes = Math.floor(minutesLeft / 60);
    var remainingSeconds = seconds % 60;
    // add a 0 in front of single digit seconds
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;
    }
    // add a 0 in front of single digit minutes
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    
    document.getElementById('CronometroLogout').innerHTML = /*days + ":" + hours + ":" + */
    minutes + ":" + remainingSeconds;
   
    if (seconds === 0) {
        clearInterval(countdownTimer);
        document.getElementById('CronometroLogout').innerHTML = "Completado";
        //    reload page
    } else {
        localStorage.setItem('loginDate', state--);
        seconds--;
    }
}

var countdownTimer = setInterval(timer, 1000);

}

KeyPressMensagem = (event) =>{
  if(document.getElementById("previasmensagens").children.length !== 0 || document.getElementById("mensagem").value === '')
  {
    document.getElementById("previasmensagens").style.display = 'none'
    document.getElementById("previasmensagens").innerHTML = ''
  }
    const Previas = ["/alertar containcorreta","/alertar precisodevoce"]
  if(event.key === '/' || document.getElementById("mensagem").value[0] === "/"){
      if(Previas.filter(x => x.includes(document.getElementById("mensagem").value)).length > 0){
        document.getElementById("previasmensagens").style.display = 'none'
        document.getElementById("previasmensagens").innerHTML = ''
        document.getElementById("previasmensagens").style.display = 'block'
        for(var previa of Previas.filter(x => x.includes(document.getElementById("mensagem").value))){
          document.getElementById("previasmensagens").innerHTML += '<h6 class="text-sm text-muted m-0">'+previa+'</h6>'
        }
      }else{
        document.getElementById("previasmensagens").style.display = 'none'
        document.getElementById("previasmensagens").innerHTML = ''
      }
  }
}

}

module.exports = {
  More : More,
  LeagueOfTools: LeagueOfTools,
  Assistants: Assistants
}