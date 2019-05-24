export class Profile{
    idpost:number;
    topic:string="";
    date:Date;
    iduser: number;
    title:string="";
    body: string="";
    constructor(idpost:number, topic:string="", date:Date, iduser:number, title:string="", body:string=""){
        this.idpost=idpost;
        this.topic=topic;
        this.date=date;
        this.iduser=iduser;
        this.title = title;
        this.body = body;
    }
}