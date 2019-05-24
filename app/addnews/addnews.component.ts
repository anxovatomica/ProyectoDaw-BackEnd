import { Component, OnInit } from "@angular/core";
import { PostService } from '../news/news.service';
import { Post } from '../news/post';

@Component({

    selector:'addnews-tag',
    templateUrl:'./addnews.component.html',
    styleUrls:['./addnews.component.css'],
    providers:[PostService]

})

export class AddNewsComponent {
    news: Post[] = [];
     date = new Date('2017-03-07T10:00:00');
     str = this.date.toDateString();
    //datetime = new Date('Y-m-d');
    //datetime.toDateString();
    nuevoPost : Post = new Post(null, "", this.str, 4, "", "",  );

    constructor(private serviceUser: PostService) { }

    addNewPost() {
        this.serviceUser.postNew(this.nuevoPost).
          subscribe(
            (result) => {
              console.log("----")
              // Devuelve el parametro en JSON del PHP.
             // this.news = result["resposta"];
    
              //console.log(this.news);

              console.log(result);
            },
            (error) => { console.log(error) }
          );
    
      }

};