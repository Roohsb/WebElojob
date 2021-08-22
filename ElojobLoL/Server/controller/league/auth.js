const RiotRequest = require('riot-lol-api');

module.exports = class Summoner
{
    constructor(t){
        this.token = t
    }

    auth = () => new RiotRequest(this.token);

    tryAuth(){
      return new Promise((resolve, reject) => {
        this.auth().request('br1', 'summoner', '/lol/summoner/v4/summoners/by-name/Edo Sophy', function(err, res) {
        if(err) {
          reject(err)
        }
        else {
          resolve(res);
        }
      })
    });
    }

    getSummoner(summoner) {
        return new Promise((resolve, reject) => {
            this.auth().request('br1', 'summoner', '/lol/summoner/v4/summoners/by-name/' + summoner, function(err, res) {
            if(err) {
              resolve(err)
            }
            else {
              resolve(res);
            }
          })
        });
      }

     getMatchsID(puuid,matchs) {
       return new Promise((resolve, reject) => {
           this.auth().request('americas', 'match', '/lol/match/v5/matches/by-puuid/'+puuid+'/ids?start=0&count='+matchs+'', function(err, res) {
           if(err) {
             reject(err)
           }
           else {
             resolve(res);
           }
         })
       });
     }

     getMatchsDetails(match) {
      return new Promise((resolve, reject) => {
          this.auth().request('americas', 'match', '/lol/match/v5/matches/'+match, function(err, res) {
          if(err) {
            reject(err)
          }
          else {
            resolve(res);
          }
        })
      });
    }

}
