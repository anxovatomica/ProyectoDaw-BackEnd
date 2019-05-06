export class Drop{
    idSNEAKER:number;
    brand:string="";
    model:string="";
    colorWay:string="";
    dropDate:Date;
    retailPrice:number;
    constructor( idSNEAKER:number, brand:string="", model:string="",
    colorWay:string="",dropDate:Date, retailPrice:number){
        this.idSNEAKER=idSNEAKER;
        this.brand=brand;
        this.model=model;
        this.colorWay=colorWay;
        this.dropDate=dropDate;
        this.retailPrice=retailPrice;
    }
}