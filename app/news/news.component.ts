import { Component, OnInit } from "@angular/core";
import { PostService } from "./news.service";
import { Post } from './post';
import { Router } from "@angular/router";

@Component({

    selector:'news-tag',
    templateUrl:'./news.component.html',
    styleUrls:['./news.component.css'],
    providers:[PostService]

})

export class NewsComponent implements OnInit {
    news: Post[] = [];
    failproxy: string = "";

    constructor(private serviceNews: PostService, private _router: Router) { }

    ngOnInit(): void {

        this.getNews();
      }

      getNews() {
        this.serviceNews.getNews().subscribe(
          (result) => {
            console.log(result["data"]);
            this.news = result["data"];
    
          },
          (error) => {
            console.log(error);
          });
      }

      checkUser3(){
        var token = localStorage.getItem('token');
        console.log(token);
        if(token == null){
            this.failproxy = "No puedes acceder sin logear"
        }else{
            this._router.navigate(['/news']);
        }
    }

};