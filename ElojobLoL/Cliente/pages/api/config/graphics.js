import Mysql from '../../../controller/database/control'
import Logged from '../../../components/front/logged/class'
const fs = require('fs');


const LoggedAuth = new Logged()

const AuthenticatorMYSQL = new Mysql()



const getNameDay = (y) => {
    var days = ['Do', 'Seg', 'Ter', 'Quar', 'Quin', 'Sex', 'Sab'];
    var d = y !== null ? new Date(y):  new Date();
   return days[d.getDay()];
}

Date.prototype.getWeek = function (dowOffset) {
    /*getWeek() was developed by Nick Baicoianu at MeanFreePath: http://www.meanfreepath.com */
    
        dowOffset = typeof(dowOffset) == 'number' ? dowOffset : 0; //default dowOffset to zero
        var newYear = new Date(this.getFullYear(),0,1);
        var day = newYear.getDay() - dowOffset; //the day of week the year begins on
        day = (day >= 0 ? day : day + 7);
        var daynum = Math.floor((this.getTime() - newYear.getTime() - 
        (this.getTimezoneOffset()-newYear.getTimezoneOffset())*60000)/86400000);
        var weeknum;
        //if the year starts before the middle of a week
        if(day < 4) {
            weeknum = Math.floor((daynum+day-1)/7) + 1;
            if(weeknum > 52) {
                nYear = new Date(this.getFullYear() + 1,0,1);
                nday = nYear.getDay() - dowOffset;
                nday = nday >= 0 ? nday : nday + 7;
                /*if the next year starts before the middle of
                  the week, it is week #1 of that year*/
                weeknum = nday < 4 ? 1 : 53;
            }
        }
        else {
            weeknum = Math.floor((daynum+day-1)/7);
        }
        return weeknum;
    };

const getCountDay = (data,filte) =>{
    var i = 0;
         data.filter(function(createds){
            if(new Date(createds.created).getWeek() === new Date().getWeek()){
                if(getNameDay(createds.created) === filte){
                    i++;
                }
            }else{
                i = 0;
            }
        })
    return i
}

const getCountMonth = (data,filte) =>{
    return data.filter(function(createds){
        if(new Date(createds.date).getFullYear() === new Date().getFullYear()){
            if(new Date(createds.date).getMonth() === filte){
                return createds.date
            }
        }else{
            return []
        }
    }).length
}

export default async function(req, res)
{
   
    if (typeof req.body.token === 'undefined' ||
        LoggedAuth.VerifyToken(req.body.token) === 0)
    {
        res.send(
        {
            status: false,
            errorcode: 1,
            mensagem: 'Campos invalidos'
        })
        return res.end()
    }

    try
    {

        var a = () => fs.readFileSync('./components/back/database/common.json', { endoding: 'utf8'})
        var b = () => fs.readFileSync('./components/back/database/canvasusers.json', { endoding: 'utf8'})
        var c = () => fs.readFileSync('./components/back/database/canvasorders.json', { endoding: 'utf8'})
        
        const Comum  = JSON.parse(a())
        const Users  = JSON.parse(b())
        const Orders = JSON.parse(c())


      if (new Date().getTime() > Comum[0].update)
        {
            const Users = await AuthenticatorMYSQL.prepareQuery("SELECT id FROM elo_users WHERE level = ?", [0])
            const AccountsG = await AuthenticatorMYSQL.prepareQuery("SELECT created FROM elo_users")
            const Invoices = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_invoices")

            const InvociesFinish = Invoices.filter(function(element){ return element.payment === '3' ? element : null}).length

            const InvociesFree = Invoices.filter(function(element){return element.payment === 2 && element.booster !== 'undefined' ? element : null}).length


            var writeStream = fs.createWriteStream('./components/back/database/common.json');
            writeStream.write(`[
              {
                "users": ${Users.length},
                "orders": ${Invoices.length},
                "ordersfinish": ${InvociesFinish},
                "ordersopen": ${InvociesFree},
                "update": ${new Date(new Date().getTime() + 10*60000).getTime()}
              }
            ]`)

            writeStream = fs.createWriteStream('./components/back/database/canvasorders.json');
            writeStream.write(`[
              {
                "year":  ${new Date().getFullYear()},
                "month": ${new Date().getMonth() + 1},
                "update": ${new Date(new Date().getTime() + 10*60000).getTime()},
                "months":  [${getCountMonth(Invoices,1)},${getCountMonth(Invoices,2)},${getCountMonth(Invoices,3)},${getCountMonth(Invoices,4)},${getCountMonth(Invoices,5)},${getCountMonth(Invoices,6)},${getCountMonth(Invoices,7)},${getCountMonth(Invoices,8)},${getCountMonth(Invoices,9)},${getCountMonth(Invoices,10)},${getCountMonth(Invoices,11)},${getCountMonth(Invoices,12)}]
              }
            ]`);

            writeStream = fs.createWriteStream('./components/back/database/canvasusers.json');
            writeStream.write(`[
              {
                "week":   ${new Date().getWeek()},
                "update": ${new Date(new Date().getTime() + 10*60000).getTime()},
                "days": [${getCountDay(AccountsG,'Seg')},${getCountDay(AccountsG,'Ter')},${getCountDay(AccountsG,'Quar')},${getCountDay(AccountsG,'Quin')},${getCountDay(AccountsG,'Sex')},${getCountDay(AccountsG,'Sab')},${getCountDay(AccountsG,'Do')}]
              }
            ]`)

            writeStream.end();
        }

        res.send({
            status: true,
            Comum,
            Users,
            Orders
        })
        return res.end()

    }
    catch (e)
    {
        res.send({
            status: false,
            errorcode: 2,
            mensagem: 'Erro interno'
        })
        return res.end()

    }
}