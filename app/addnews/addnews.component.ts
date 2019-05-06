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
    

    nuevoPost : Post = new Post(null, "",new Date(), null, "", "" );

    constructor(private serviceUser: PostService) { }

    addNewPost() {
        this.serviceUser.postNew(this.nuevoPost).
          subscribe(
            (result) => {
              console.log("----")
              this.news = result["resposta"];
    
              console.log(this.news);
            },
            (error) => { console.log(error) }
          );
    
      }

};