export class Post{
    idpost:number;
    topic:string="";
    date:String;
    iduser: number;
    title:string="";
    body: string="";
    url_post: string="";
    constructor(idpost:number, topic:string="", date:String, iduser:number, title:string="", body:string="",url_post: string=""){
        this.idpost=idpost;
        this.topic=topic;
        this.date=date;
        this.iduser=iduser;
        this.title = title;
        this.body = body;
        this.url_post = url_post;
    }
}
